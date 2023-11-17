<?php 

namespace App\Repositories\SearchHistory;

use App\Models\UserSearchHistory;
use App\Repositories\BaseRepository;

class SearchHistoryRepository extends BaseRepository implements SearchHistoryRepositoryInterface {
    public function __construct(UserSearchHistory $model) {
        parent::__construct($model);
    }

    public function FindAttributes(string $searchValue, $attribute = "userId", $column = ['*'])
    {
        return $this->model::select($column)
        ->where([
            [$attribute, $searchValue]
        ])
        ->orderBy('updated_at', 'desc')
        ->get();
    }

    public function findWithoutDeleteFlag(string $id, $column = ['*'])
    {
        return $this->model::select($column)->where('id', $id)->first();
    }
}
