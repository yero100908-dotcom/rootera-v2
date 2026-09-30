<?php

namespace App\Services;

use App\Models\City;
use App\Models\District;
use App\Models\ServiceCategory;

class LocalSchemaService
{
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
        $locationName = $district ? "{$district->name}, {$city->full_name}" : $city->full_name;
        $serviceName = $category ? $category->name : "Jasa Saluran Pipa Mampet";

        // 1. PlumbingService / LocalBusiness Schema
        $plumbingSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'PlumbingService',
            '@id' => $canonical . '#plumbing-service',
            'name' => "Rootera Plumbing - {$serviceName} {$locationName}",
            'image' => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
            'url' => $canonical,
            'telephone' => $hub['telephone'],
            'priceRange' => 'Rp',
            'description' => "Layanan pelancaran saluran pipa mampet 24 jam tanpa bongkar di {$locationName}. Bergaransi resmi 30 hari.",
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $hub['street_address'],
                'addressLocality' => $hub['locality'],
                'addressRegion' => $hub['province_name'],
                'postalCode' => $hub['postal_code'],
                'addressCountry' => 'ID',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => $hub['latitude'],
                'longitude' => $hub['longitude'],
            ],
            'areaServed' => [
                '@type' => 'AdministrativeArea',
                'name' => $locationName,
            ],
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
            ],
            'areaServed' => [
                '@type' => 'AdministrativeArea',
                'name' => $locationName,
            ],
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
