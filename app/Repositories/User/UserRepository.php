<?php 

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface {
    public function __construct(User $model) {
        parent::__construct($model);
    }

    public function searchUsersByAttribute(int $itemPerPage, string $searchValue, $attribute = "fullName", $column = ['*'])
    {
        return $this->model->where('deleteFlag', 0)
            ->where(function ($query) use ($attribute, $searchValue) {
                $query->where($attribute, 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%');
            })
            ->paginate($itemPerPage)
            ->withQueryString();
    }
}
