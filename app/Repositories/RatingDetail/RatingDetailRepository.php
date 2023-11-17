<?php 

namespace App\Repositories\RatingDetail;

use App\Models\RatingDetail;
use App\Repositories\BaseRepository;

class RatingDetailRepository extends BaseRepository implements RatingDetailRepositoryInterface {
    public function __construct(RatingDetail $model) {
        parent::__construct($model);
    }

    public function findByDetailRating(string $hotelId, string $userId) {
        return $this->model
        ->where([['hotelId', $hotelId], ['userId', $userId]])
        ->get();
    }
}
