<?php 

namespace App\Repositories\WishList;

use App\Models\Wishlists;
use App\Repositories\BaseRepository;

class WishListRepository extends BaseRepository implements WishListRepositoryInterface {
    public function __construct(Wishlists $model) {
        parent::__construct($model);
    }

    public function FindAttributes(int $itemPerPage, string $searchValue, $attribute = "userId", $column = ['*'])
    {
        return $this->model::select($column)
        ->where([
            [$attribute, $searchValue]
        ])
        ->orderBy('updated_at', 'desc')
        ->paginate($itemPerPage);
    }

    public function findDetail(string $userId, string $hotelId, $column = ['*']) {
        return $this->model::select($column)
        ->where([
            ['userId', $userId],
            ['hotel', $hotelId],
        ])
        ->get(1);
    }

    public function forceDelete(string $wishListId) {
        return $this->model->delete($wishListId);
    }
}
