<?php

namespace App\Repositories\PaymentInformation;

use App\Repositories\BaseRepositoryInterface;

interface PaymentInformationRepositoryInterface extends BaseRepositoryInterface
{
    public function FindWithParameters(string $searchValue, $attribute = "userId", $column = ['*']);
}
