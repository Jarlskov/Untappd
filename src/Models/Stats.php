<?php

declare(strict_types=1);

namespace Jarlskov\Untappd\Models;

use stdClass;

class Stats
{
    public function __construct(private int $totalCount,
        private int $monthlyCount,
        private int $totalUserCount,
        private int $userCount
    ) { }

    public function getMonthlyCount(): int
    {
        return $this->monthlyCount;
    }

    public function getTotalUserCount(): int
    {
        return $this->totalUserCount;
    }

    public function getUserCount(): int
    {
        return $this->userCount;
    }

    public static function fromUntappdResponse(stdClass $response = null): ?self
    {
        if (!$response) {
            return null;
        }

        return new self(
            $response->total_count,
            $response->monthly_count,
            $response->total_user_count,
            $response->user_count
        );
    }
}
