<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GoogleReviewController extends Controller
{
    public function getReviews()
    {
        $placeId = env('GOOGLE_PLACE_ID');
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        // Fallback Data as requested to prevent crash/blank UI
        $fallbackData = [
            'rating' => 5.0,
            'user_ratings_total' => 11,
            'reviews' => [
                [
                    'author_name' => 'Agim Firdaus20_',
                    'rating' => 5,
                    'text' => 'Terimakasih rootera plumbing atas pekerjaan saluran kloset di lampung, saluran sudah lancar, Teknisi ramah dan pengerjaan cepat',
                    'relative_time_description' => 'Baru saja'
                ],
                [
                    'author_name' => 'NUR SIDIK',
                    'rating' => 5,
                    'text' => 'Saluran Wastafel Sudah Saya Lancar, terimakasih rootera plumbing',
                    'relative_time_description' => 'Baru saja'
                ],
                [
                    'author_name' => 'Radit',
                    'rating' => 5,
                    'text' => 'Harga bersahabat, cepat, dan bergaransi, hasil maksimal, trm ksh J&J',
                    'relative_time_description' => 'Baru saja'
                ]
            ]
        ];

        // Graceful Fallback if .env is empty
        if (!$placeId || !$apiKey) {
            Log::warning('Google Maps API Key or Place ID is not configured. Falling back to graceful data.');
            return response()->json([
                'success' => true,
                'fallback' => true,
                'data' => $fallbackData
            ]);
        }

        // Fetch Live Data with 3600 seconds caching
        $data = Cache::remember('google_places_reviews_data', 3600, function () use ($placeId, $apiKey) {
            try {
                $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                    'place_id' => $placeId,
                    'key' => $apiKey,
                    'fields' => 'name,rating,user_ratings_total,reviews',
                    'language' => 'id'
                ]);

                if ($response->successful()) {
                    return $response->json()['result'] ?? null;
                }
            } catch (\Exception $e) {
                Log::error('GoogleReviewController Fetch Error: ' . $e->getMessage());
                return null;
            }
            return null;
        });

        // Graceful Fallback if Google API fetch failed/returned empty
        if (!$data) {
            Log::error('Google Places API returned empty result or failed. Falling back to graceful data.');
            return response()->json([
                'success' => true,
                'fallback' => true,
                'data' => $fallbackData
            ]);
        }

        return response()->json([
            'success' => true,
            'fallback' => false,
            'data' => $data
        ]);
    }
}
