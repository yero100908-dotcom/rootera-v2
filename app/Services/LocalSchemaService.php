<?php

namespace App\Services;

use App\Models\City;
use App\Models\District;
use App\Models\ServiceCategory;

class LocalSchemaService
{
    public const GOOGLE_MAPS_CID_URL = 'https://maps.google.com/?cid=16012437648585635749';
    public const INSTAGRAM_PROFILE_URL = 'https://www.instagram.com/rootera_plumbing/';

    /**
     * Build dynamic LocalBusiness/PlumbingService, Service, and FAQPage JSON-LD schemas.
     */
    public static function buildSchemas(
        City $city,
        ?District $district,
        array $hub,
        ?ServiceCategory $category,
        string $canonical,
        array $localFaqs = []
    ): array {
        $cityName = $city->full_name ?? $city->name;
        $locationName = $district ? "Kecamatan {$district->name}, {$cityName}" : $cityName;
        $serviceName = $category ? $category->name : "Jasa Perbaikan & Tukang Pipa Mampet";

        // Structured hierarchical areaServed
        if ($district) {
            $areaServed = [
                [
                    '@type' => 'AdministrativeArea',
                    'name' => "Kecamatan {$district->name}",
                    'containedInPlace' => [
                        '@type' => 'City',
                        'name' => $cityName,
                    ],
                ],
                [
                    '@type' => 'City',
                    'name' => $cityName,
                ],
            ];
        } else {
            $areaServed = [
                [
                    '@type' => 'City',
                    'name' => $cityName,
                ],
            ];
            if ($city->relationLoaded('districts') && $city->districts->isNotEmpty()) {
                foreach ($city->districts as $d) {
                    $areaServed[] = [
                        '@type' => 'AdministrativeArea',
                        'name' => "Kecamatan {$d->name}",
                        'containedInPlace' => [
                            '@type' => 'City',
                            'name' => $cityName,
                        ],
                    ];
                }
            }
        }

        // 1. PlumbingService / LocalBusiness Schema
        $plumbingSchema = [
            '@context' => 'https://schema.org',
            '@type' => ['PlumbingService', 'LocalBusiness', 'EmergencyService'],
            '@id' => $canonical . '#plumbing-service',
            'name' => "Rootera Plumbing - {$serviceName} {$locationName}",
            'alternateName' => [
                "Rootera Plumbing " . ($district ? $district->name : $cityName),
                "Jasa Perbaikan Pipa Mampet " . ($district ? $district->name : $cityName),
                "Tukang Pipa Mampet " . ($district ? $district->name : $cityName),
            ],
            'image' => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
            'logo' => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
            'url' => $canonical,
            'hasMap' => self::GOOGLE_MAPS_CID_URL,
            'sameAs' => [
                self::GOOGLE_MAPS_CID_URL,
                self::INSTAGRAM_PROFILE_URL,
            ],
            'telephone' => $hub['telephone'] ?? '+6281385404000',
            'priceRange' => 'Rp',
            'currenciesAccepted' => 'IDR',
            'paymentAccepted' => 'Cash, Transfer Bank, QRIS',
            'description' => "Layanan jasa perbaikan saluran pipa mampet 24 jam tanpa bongkar di {$locationName}. Panggil tukang pipa mampet profesional bergaransi resmi 30 hari.",
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $hub['street_address'] ?? "Pos Hub Armada {$locationName}",
                'addressLocality' => $district ? "{$district->name}, {$cityName}" : $cityName,
                'addressRegion' => $hub['province_name'] ?? ($city->province->name ?? 'Indonesia'),
                'postalCode' => $district->postal_code ?? ($hub['postal_code'] ?? ($city->postal_code ?? '10000')),
                'addressCountry' => 'ID',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => $district->latitude ?? ($hub['latitude'] ?? ($city->latitude ?? -6.3275975)),
                'longitude' => $district->longitude ?? ($hub['longitude'] ?? ($city->longitude ?? 106.8627125)),
            ],
            'areaServed' => $areaServed,
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                'opens' => '00:00',
                'closes' => '23:59',
            ],
        ];

        // 2. Service Schema
        $serviceSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            '@id' => $canonical . '#service',
            'name' => "{$serviceName} {$locationName}",
            'serviceType' => $serviceName,
            'provider' => [
                '@type' => 'PlumbingService',
                'name' => 'Rootera Plumbing',
                'url' => route('home'),
                'hasMap' => self::GOOGLE_MAPS_CID_URL,
                'sameAs' => [
                    self::GOOGLE_MAPS_CID_URL,
                    self::INSTAGRAM_PROFILE_URL,
                ],
            ],
            'areaServed' => $areaServed,
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'IDR',
                'availability' => 'https://schema.org/InStock',
                'validFrom' => '2026-01-01',
                'url' => $canonical,
            ],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Layanan Pelancaran Pipa Mampet',
                'itemListElement' => [
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Jasa Wastafel & Sink Dapur Mampet',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Jasa Floor Drain & Kamar Mandi Mampet',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Jasa Kloset WC & Toilet Tersumbat',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Pelancaran Got & Drainase Utama (Hydro Jetting)',
                        ],
                    ],
                ],
            ],
        ];

        // 3. FAQPage Schema
        $faqSchema = [];
        if (!empty($localFaqs)) {
            $mainEntity = [];
            foreach ($localFaqs as $faq) {
                $mainEntity[] = [
                    '@type' => 'Question',
                    'name' => $faq['question'] ?? $faq['q'] ?? '',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer'] ?? $faq['a'] ?? '',
                    ],
                ];
            }
            $faqSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $mainEntity,
            ];
        }

        return [
            'plumbingSchema' => $plumbingSchema,
            'serviceSchema'  => $serviceSchema,
            'faqSchema'      => $faqSchema,
        ];
    }
}
