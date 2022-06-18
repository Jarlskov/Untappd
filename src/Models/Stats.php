<?php

declare(strict_types=1);

namespace Jarlskov\Untappd\Models;

class Stats
{
    public function __construct(private int $totalCount,
        private int $monthlyCount,
        private int $totalUserCount,
        private int $userCount
    ) { }

    public static function fromUntappdResponse(\stdClass $response): self
    {
        return new self(
            $response->total_count,
            $response->monthly_count,
            $response->total_user_count,
            $response->user_count
        );
    }
}
