<?php

namespace App\Repositories\Hotel;

use App\Repositories\BaseRepositoryInterface;

interface HotelRepositoryInterface extends BaseRepositoryInterface {
    public function searchHotelsByName(int $itemPerPage, string $searchValue, $attribute = "name", $column=['*']);
    public function searchHotelsByAttribute(int $itemPerPage, string $attributeValue, $attribute = "name", $column=['*']);
    public function FindWithColumn();
    public function getDetail ();
    public function getHightLightInfo(string $hotelId);
}
