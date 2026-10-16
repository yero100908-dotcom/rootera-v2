<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Concerns;

use Illuminate\Support\Str;

/**
 * Normalises repeater (dynamic JSON) inputs coming from admin forms:
 * strips empty rows so validation & content scoring only see real data.
 */
trait NormalizesLocalSeoInput
{
    protected function cleanStringList(?array $items): array
    {
        return array_values(array_filter(
            array_map(static fn ($v) => is_string($v) ? trim($v) : '', $items ?? []),
            static fn (string $v) => $v !== ''
        ));
    }

    /**
     * @param array<int, array<string,mixed>>|null $rows
     * @param string[] $keys
     */
    protected function cleanRowList(?array $rows, array $keys, string $requiredKey): array
    {
        $out = [];
        foreach ($rows ?? [] as $row) {
            if (!is_array($row)) {
                continue;
            }
            $clean = [];
            foreach ($keys as $key) {
                $clean[$key] = trim((string) ($row[$key] ?? ''));
            }
            if ($clean[$requiredKey] !== '') {
                $out[] = $clean;
            }
        }

        return $out;
    }

    protected function slugOrFrom(string $slugField, string $sourceField): string
    {
        $slug = trim((string) $this->input($slugField, ''));

        return Str::slug($slug !== '' ? $slug : (string) $this->input($sourceField, ''));
    }
}
