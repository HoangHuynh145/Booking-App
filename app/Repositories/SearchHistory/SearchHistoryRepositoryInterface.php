<?php

namespace App\Repositories\SearchHistory;

use App\Repositories\BaseRepositoryInterface;

interface SearchHistoryRepositoryInterface extends BaseRepositoryInterface
{
    public function FindAttributes(string $searchValue, $attribute = "userId", $column = ['*']);
    public function findWithoutDeleteFlag(string $id, $column = ['*']);
}
