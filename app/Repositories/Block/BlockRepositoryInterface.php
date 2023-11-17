<?php

namespace App\Repositories\Block;

use App\Repositories\BaseRepositoryInterface;

interface BlockRepositoryInterface extends BaseRepositoryInterface {
    public function searchBlocksByAttribute(int $itemPerPage, string $searchValue, $attribute = "name", $column=['*']);
    public function GetHotelsInBlock (string $blockId, string $hotelId, $column = ['*']);
    public function GetHotelNotBlock (string $blockId, string $hotelId, $column = ['*']);
    public function GetFullBlockInfo(string $blockId, $column = ['*']);
}
