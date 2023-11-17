<?php

namespace App\Repositories\WishList;

use App\Repositories\BaseRepositoryInterface;

interface WishListRepositoryInterface extends BaseRepositoryInterface
{
    public function FindAttributes(int $itemPerPage, string $searchValue, $attribute = "userId", $column = ['*']);
    public function findDetail(string $userId, string $hotelId, $column = ['*']);
    public function forceDelete(string $wishListId);
}
