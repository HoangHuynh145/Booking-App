<?php

namespace App\Repositories\RatingDetail;

use App\Repositories\BaseRepositoryInterface;

interface RatingDetailRepositoryInterface extends BaseRepositoryInterface
{
    public function findByDetailRating(string $hotelId, string $userId);
}
