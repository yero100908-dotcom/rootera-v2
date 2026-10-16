<?php

declare(strict_types=1);

namespace App\Services\Seo;

use Illuminate\Database\Eloquent\Model;

/**
 * ContentScoreCalculator — anti-doorway quality gate.
 *
 * Scores a hyper-local entity (ResidentialCluster / District) 0–100 based on
 * how much *genuinely unique* local data it holds. Pages below the threshold
 * are forced to noindex so thin, name-swapped pages never reach Google.
 *
 *   ≥ 3 landmarks                                 +15
 *   ≥ 2 typical_issues (issue + solution filled)  +25
 *   intro_override ≥ 80 words                     +25
 *   ≥ 1 linked ProjectGallery                     +25
 *   latitude & longitude present                  +10
 */
final class ContentScoreCalculator
{
    public const THRESHOLD = 70;

    public const MIN_LANDMARKS     = 3;
    public const MIN_ISSUES        = 2;
    public const MIN_INTRO_WORDS   = 80;

    /**
     * @return array{score:int, breakdown:array<string,int>}
     */
    public function calculate(Model $model, int $galleryCount): array
    {
        $breakdown = [
            'landmarks'   => $this->countFilled((array) ($model->landmarks ?? [])) >= self::MIN_LANDMARKS ? 15 : 0,
            'issues'      => $this->countValidIssues((array) ($model->typical_issues ?? [])) >= self::MIN_ISSUES ? 25 : 0,
            'intro'       => $this->wordCount((string) ($model->intro_override ?? '')) >= self::MIN_INTRO_WORDS ? 25 : 0,
            'gallery'     => $galleryCount >= 1 ? 25 : 0,
            'coordinates' => ($model->latitude !== null && $model->longitude !== null) ? 10 : 0,
        ];

        return ['score' => array_sum($breakdown), 'breakdown' => $breakdown];
    }

    /**
     * Apply score to the model and enforce the indexing gate (no save).
     */
    public function apply(Model $model, int $galleryCount): void
    {
        $score = $this->calculate($model, $galleryCount)['score'];

        $model->content_score = $score;

        if ($score < self::THRESHOLD) {
            $model->is_indexable = false;
        }
    }

    public function wordCount(string $text): int
    {
        $plain = trim(strip_tags($text));

        return $plain === '' ? 0 : count(preg_split('/\s+/u', $plain) ?: []);
    }

    private function countFilled(array $items): int
    {
        // Support both plain strings and associative arrays with a 'name' key
        return count(array_filter($items, static function ($v): bool {
            if (is_string($v)) {
                return trim($v) !== '';
            }
            if (is_array($v)) {
                return trim((string) ($v['name'] ?? '')) !== '';
            }
            return false;
        }));
    }

    private function countValidIssues(array $issues): int
    {
        return count(array_filter($issues, static function ($row): bool {
            if (! is_array($row)) {
                return false;
            }
            $hasIssue = trim((string) ($row['issue'] ?? '')) !== '';
            // Accept 'solution' OR 'detail' as the explanation field
            $hasDetail = trim((string) ($row['solution'] ?? $row['detail'] ?? '')) !== '';

            return $hasIssue && $hasDetail;
        }));
    }
}
