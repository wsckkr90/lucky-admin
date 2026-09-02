<?php

namespace App\Services;

class SeoAuditService
{
    public function audit(array $seo): array
    {
        $title = trim(
            $seo['title'] ?? ''
        );

        $description = trim(
            $seo['description'] ?? ''
        );

        $keyword = trim(
            $seo['focus_keyword'] ?? ''
        );

        $canonical = trim(
            $seo['canonical'] ?? ''
        );

        $checks = [];

        $checks[] = [
            'key' => 'title_present',
            'label' => 'Meta title is present',
            'passed' => $title !== '',
        ];

        $checks[] = [
            'key' => 'title_length',
            'label' => 'Meta title length is reasonable',
            'passed' =>
                mb_strlen($title) >= 30 &&
                mb_strlen($title) <= 60,
        ];

        $checks[] = [
            'key' => 'description_present',
            'label' => 'Meta description is present',
            'passed' => $description !== '',
        ];

        $checks[] = [
            'key' => 'description_length',
            'label' => 'Meta description length is reasonable',
            'passed' =>
                mb_strlen($description) >= 120 &&
                mb_strlen($description) <= 160,
        ];

        $checks[] = [
            'key' => 'keyword_present',
            'label' => 'Focus keyword is present',
            'passed' => $keyword !== '',
        ];

        $checks[] = [
            'key' => 'keyword_title',
            'label' => 'Focus keyword appears in title',
            'passed' =>
                $keyword !== '' &&
                str_contains(
                    mb_strtolower($title),
                    mb_strtolower($keyword)
                ),
        ];

        $checks[] = [
            'key' => 'keyword_description',
            'label' => 'Focus keyword appears in description',
            'passed' =>
                $keyword !== '' &&
                str_contains(
                    mb_strtolower($description),
                    mb_strtolower($keyword)
                ),
        ];

        $checks[] = [
            'key' => 'canonical',
            'label' => 'Canonical URL is present',
            'passed' => $canonical !== '',
        ];

        $passed = collect($checks)
            ->where('passed', true)
            ->count();

        $total = count($checks);

        return [
            'score' =>
                $total > 0
                    ? round(
                        ($passed / $total) * 100
                    )
                    : 0,

            'passed' => $passed,

            'total' => $total,

            'checks' => $checks,
        ];
    }
}