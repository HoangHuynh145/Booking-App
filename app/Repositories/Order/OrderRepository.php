<?php 

namespace App\Repositories\Order;

use App\Models\Orders;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface {
    public function __construct(Orders $model) {
        parent::__construct($model);
    }

    public function FindAttributes(int $itemPerPage, string $searchValue, $attribute = "userId", $column = ['*'])
    {
        return $this->model::select($column)
        ->where([
            ['deleteFlag', 0],
            [$attribute, $searchValue]
        ])
        ->orderBy('updated_at', 'desc')
        ->paginate($itemPerPage);
    }
}
