<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function searchUsersByAttribute(int $itemPerPage, string $searchValue, $attribute = "fullName", $column=['*']);
}
