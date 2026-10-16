<?php

declare(strict_types=1);

namespace App\Services\Seo;

use App\Models\City;
use App\Models\ServiceArea;
use App\Models\ServiceCategory;

/**
 * SchemaGeneratorService
 *
 * Generates structured JSON-LD schema arrays for Rootera Plumbing pSEO pages.
 * All methods return raw PHP arrays ready for json_encode() injection into
 * <script type="application/ld+json"> tags.
 *
 * @package App\Services\Seo
 */
class SchemaGeneratorService
{
    /**
     * Business telephone (E.164 format for schema.org).
     */
    protected const TELEPHONE = '+6281385404000';

    /**
     * Default HQ address when no city-specific branch exists.
     */
    protected const HQ_ADDRESS = [
        'streetAddress'   => 'Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung, Kec. Ps. Rebo',
        'addressLocality' => 'Jakarta Timur',
        'addressRegion'   => 'DKI Jakarta',
        'postalCode'      => '13770',
        'addressCountry'  => 'ID',
    ];

    /** Default HQ geo coordinates */
    protected const HQ_LAT = -6.3275278;
    protected const HQ_LNG = 106.8627778;

    /**
     * Social / sameAs profiles for the Organization entity.
     */
    protected const SAME_AS = [
        'https://www.youtube.com/@RooteraPlumbing',
        'https://www.instagram.com/rootera_plumbing/',
        'https://www.tiktok.com/@rooteraplumbing.id',
        'https://x.com/RooteraPlumbing',
        'https://www.linkedin.com/in/rooteraplumbing/',
        'https://id.pinterest.com/rooteraplumbing/',
        'https://www.facebook.com/people/Jasa-Saluran-Pipa-Mampet/61591857691922/',
        'https://maps.google.com/?cid=16012437648585635749',
    ];

    /**
     * Build a PlumbingService / HomeAndConstructionBusiness LocalBusiness schema.
     *
     * Dynamically resolves GeoCoordinates and AreaServed from the City model
     * when a city is provided, or falls back to the Rootera HQ address.
     *
     * @param  City|null  $city  Optional city for localised schema generation.
     * @return array<string, mixed>
     */
    public function getLocalBusinessSchema(?City $city = null): array
    {
        $cityName = $city ? $city->name : null;
        $businessName = $cityName
            ? "Rootera Plumbing {$cityName}"
            : 'Rootera Plumbing';

        $canonicalUrl = $city
            ? url("/jasa-saluran-mampet/{$city->slug}")
            : url('/');

        // Resolve address from City model (physical branch) or fall back to HQ
        $address = self::HQ_ADDRESS;
        $lat     = self::HQ_LAT;
        $lng     = self::HQ_LNG;

        if ($city) {
            if ($city->street_address) {
                $address['streetAddress'] = $city->street_address;
            }
            if ($city->district_locality) {
                $address['addressLocality'] = $city->district_locality;
            }
            if ($city->postal_code) {
                $address['postalCode'] = $city->postal_code;
            }
            if (!empty($city->latitude) && !empty($city->longitude)) {
                $lat = (float) $city->latitude;
                $lng = (float) $city->longitude;
            }
        }

        // AggregateRating: use city-specific values when available, else defaults
        $ratingValue = ($city && $city->rating_value > 0) ? (float) $city->rating_value : 5.0;
        $reviewCount = ($city && $city->review_count > 0) ? (int) $city->review_count : 127;

        // AreaServed: primary City + neighbouring ServiceAreas from DB
        $areaServed = [];
        if ($city) {
            $areaServed[] = [
                '@type' => 'City',
                'name'  => $city->full_name,
            ];

            // Pull related ServiceArea records matching the city name
            ServiceArea::where('is_active', true)
                ->where(function ($q) use ($city) {
                    $q->where('name', 'like', '%' . $city->name . '%')
                      ->orWhere('slug', 'like', '%' . $city->slug . '%');
                })
                ->take(5)
                ->get()
                ->each(function (ServiceArea $area) use (&$areaServed) {
                    $areaServed[] = [
                        '@type' => 'AdministrativeArea',
                        'name'  => $area->name,
                    ];
                });
        } else {
            $areaServed = [
                ['@type' => 'State', 'name' => 'Jabodetabek'],
                ['@type' => 'City',  'name' => 'Semarang'],
                ['@type' => 'City',  'name' => 'Bandar Lampung'],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type'    => ['PlumbingService', 'HomeAndConstructionBusiness'],
            '@id'      => $canonicalUrl . '#local-business',
            'name'     => $businessName,
            'url'      => $canonicalUrl,
            'image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
            'logo'     => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
            'telephone'   => self::TELEPHONE,
            'priceRange'  => '$$',
            'description' => $cityName
                ? "Layanan jasa saluran pipa mampet profesional 24 jam di {$cityName} dan sekitarnya. Teknisi berpengalaman, tanpa bongkar lantai, bergaransi resmi 30 hari."
                : 'Layanan jasa saluran pipa mampet profesional 24 jam. Teknisi berpengalaman, tanpa bongkar lantai, bergaransi resmi 30 hari.',
            'address' => array_merge(['@type' => 'PostalAddress'], $address),
            'geo'     => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => $lat,
                'longitude' => $lng,
            ],
            'areaServed' => $areaServed,
            'aggregateRating' => [
                '@type'       => 'AggregateRating',
                'ratingValue' => $ratingValue,
                'reviewCount' => $reviewCount,
                'bestRating'  => 5,
                'worstRating' => 1,
            ],
            'openingHoursSpecification' => [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => [
                    'Monday', 'Tuesday', 'Wednesday', 'Thursday',
                    'Friday', 'Saturday', 'Sunday',
                ],
                'opens'  => '00:00',
                'closes' => '23:59',
            ],
            'sameAs'    => self::SAME_AS,
            'parentOrganization' => [
                '@type' => 'Organization',
                'name'  => 'J&J GROUP',
                'url'   => url('/'),
            ],
        ];
    }

    /**
     * Build a valid FAQPage schema from an array of question/answer pairs.
     *
     * Each FAQ item must have keys 'question' and 'answer' (or legacy 'q'/'a').
     *
     * @param  array<int, array{question?: string, answer?: string, q?: string, a?: string}>  $faqs
     * @return array<string, mixed>  Empty array if $faqs is empty.
     */
    public function getFaqSchema(array $faqs): array
    {
        if (empty($faqs)) {
            return [];
        }

        $mainEntity = [];
        foreach ($faqs as $faq) {
            $question = $faq['question'] ?? $faq['q'] ?? '';
            $answer   = $faq['answer']   ?? $faq['a'] ?? '';

            if ($question === '' || $answer === '') {
                continue;
            }

            $mainEntity[] = [
                '@type' => 'Question',
                'name'  => $question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => $answer,
                ],
            ];
        }

        if (empty($mainEntity)) {
            return [];
        }

        return [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => $mainEntity,
        ];
    }

    /**
     * Build a Service entity with Provider, TermsOfService, and ServiceType.
     *
     * @param  ServiceCategory  $service  The service category record.
     * @param  City|null        $area     Optional city to localise the schema.
     * @return array<string, mixed>
     */
    public function getServiceSchema(ServiceCategory $service, ?City $area = null): array
    {
        $locationName = $area ? $area->full_name : 'Jabodetabek';
        $canonicalUrl = $area
            ? url("/layanan-pipa-mampet/{$service->slug}/{$area->slug}")
            : url("/layanan/{$service->slug}");

        return [
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            '@id'         => $canonicalUrl . '#service',
            'name'        => "{$service->name} {$locationName}",
            'serviceType' => $service->name,
            'description' => $service->description
                ?? "Jasa {$service->name} profesional di {$locationName}. Teknisi spesialis mesin spiral & CCTV pipa, respon cepat 24 jam.",
            'provider' => [
                '@type' => 'PlumbingService',
                'name'  => 'Rootera Plumbing',
                'url'   => url('/'),
                '@id'   => url('/') . '#local-business',
            ],
            'areaServed' => $area
                ? ['@type' => 'City', 'name' => $area->full_name]
                : ['@type' => 'State', 'name' => 'Jabodetabek'],
            'termsOfService' => 'Garansi Pengerjaan Ulang 30 Hari (Tuntas Baru Bayar)',
            'offers' => [
                '@type'        => 'Offer',
                'priceCurrency' => 'IDR',
                'availability'  => 'https://schema.org/InStock',
                'url'           => $canonicalUrl,
                'priceSpecification' => [
                    '@type'           => 'PriceSpecification',
                    'priceCurrency'   => 'IDR',
                    'description'     => $service->price_description ?? 'Harga sesuai survei teknisi',
                ],
            ],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name'  => "Katalog Layanan {$service->name}",
                'itemListElement' => [
                    [
                        '@type'       => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name'  => 'Pelancaran Mekanis Rotary Spiral (Tanpa Bongkar Lantai)',
                        ],
                    ],
                    [
                        '@type'       => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name'  => 'Hydro Jetting Tekanan Tinggi',
                        ],
                    ],
                    [
                        '@type'       => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name'  => 'Inspeksi CCTV Kamera Endoskopi Pipa',
                        ],
                    ],
                ],
            ],
            'aggregateRating' => [
                '@type'       => 'AggregateRating',
                'ratingValue' => $area && $area->rating_value > 0 ? (float) $area->rating_value : 5.0,
                'reviewCount' => $area && $area->review_count > 0 ? (int) $area->review_count : 127,
                'bestRating'  => 5,
            ],
        ];
    }

    /**
     * Encode a schema array to a JSON-LD string safe for Blade injection.
     *
     * @param  array<string, mixed>  $schema
     * @return string  Empty string for empty/invalid schemas.
     */
    public function toJsonLd(array $schema): string
    {
        if (empty($schema)) {
            return '';
        }

        $json = json_encode(
            $schema,
            JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );

        return $json !== false ? $json : '';
    }

    /**
     * Build an array of JSON-LD strings for all three schema types for a pSEO page.
     * Returns an indexed array of non-empty JSON strings ready for Blade output.
     *
     * @param  City|null             $city
     * @param  ServiceCategory|null  $service
     * @param  array<int, array>     $faqs
     * @return array<int, string>
     */
    public function buildPseoSchemas(?City $city, ?ServiceCategory $service, array $faqs = []): array
    {
        $schemas = [];

        $localBusiness = $this->getLocalBusinessSchema($city);
        if ($encoded = $this->toJsonLd($localBusiness)) {
            $schemas[] = $encoded;
        }

        if ($service !== null) {
            $serviceSchema = $this->getServiceSchema($service, $city);
            if ($encoded = $this->toJsonLd($serviceSchema)) {
                $schemas[] = $encoded;
            }
        }

        $faqSchema = $this->getFaqSchema($faqs);
        if ($encoded = $this->toJsonLd($faqSchema)) {
            $schemas[] = $encoded;
        }

        return $schemas;
    }
}
