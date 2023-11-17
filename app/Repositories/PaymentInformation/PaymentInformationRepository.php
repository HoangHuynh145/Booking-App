<?php 

namespace App\Repositories\PaymentInformation;

use App\Models\PaymentInformation;
use App\Repositories\BaseRepository;
use App\Repositories\PaymentInformation\PaymentInformationRepositoryInterface;

class PaymentInformationRepository extends BaseRepository implements PaymentInformationRepositoryInterface {
    public function __construct(PaymentInformation $model) {
        parent::__construct($model);
    }

    public function FindWithParameters(string $searchValue, $attribute = "userId", $column = ['*'])
    {
        return $this->model::select($column)
        ->where([
            ['deleteFlag', 0],
            [$attribute, $searchValue]
        ])
        ->orderBy('updated_at', 'desc')
        ->get();
    }
}
