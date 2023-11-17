<?php

namespace App\Repositories\BlockDetail;

use App\Repositories\BaseRepositoryInterface;

interface BlockDetailRepositoryInterface extends BaseRepositoryInterface
{
    public function FindByBlockIdAndHotelId (string $blockId, string $hotelId);
    public function FindByBlockId (string $blockId);
    // public function deleteByID (string $blockId, string $hotelId);
}
