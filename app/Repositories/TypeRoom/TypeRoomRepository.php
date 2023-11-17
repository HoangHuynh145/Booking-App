<?php 

namespace App\Repositories\TypeRoom;

use App\Models\TypeRoom;
use App\Repositories\BaseRepository;

class TypeRoomRepository extends BaseRepository implements TypeRoomRepositoryInterface {
    public function __construct(TypeRoom $model) {
        parent::__construct($model);
    }

    public function CreateMany(array $data) {
        return $this->model->insert($data);
    }

    public function FindByHotelId(string $hotelId, $column = ['*']) {
        return $this->model::select($column)->where([['deleteFlag', 0],['hotelId', $hotelId]])->get();
    }

    public function FindByHotelIdAndAttribute(string $hotelId, string $attributeValue, string $attribute, $column = ['*']) {
        return $this->model::select($column)->where([
            ['deleteFlag', 0],
            ['hotelId', $hotelId],
            [$attribute, $attributeValue],
        ])->get();
    }
}
