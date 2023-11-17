<?php

namespace App\Repositories\TypeRoom;

use App\Repositories\BaseRepositoryInterface;

interface TypeRoomRepositoryInterface extends BaseRepositoryInterface
{
    public function CreateMany(array $data);
    public function FindByHotelId(string $hotelId, $column = ['*']);
    public function FindByHotelIdAndAttribute(string $hotelId, string $attributeValue, string $attribute, $column = ['*']);
}
