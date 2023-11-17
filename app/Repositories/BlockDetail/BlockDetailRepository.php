<?php 

namespace App\Repositories\BlockDetail;

use App\Models\BlockDetails;
use App\Repositories\BaseRepository;

class BlockDetailRepository extends BaseRepository implements BlockDetailRepositoryInterface {
    public function __construct(BlockDetails $model) {
        parent::__construct($model);
    }

    public function FindByBlockIdAndHotelId (string $blockId, string $hotelId, $column = ['*']) {
        return $this->model::select($column)->where([
            ['deleteFlag', 0],
            ['blockId', $blockId],
            ['hotelId', $hotelId]
        ])->get();
    }

    public function FindByBlockId (string $blockId, $column = ['*']) {
        return $this->model::select($column)->where([
            ['deleteFlag', 0],
            ['blockId', $blockId]
        ])->get();
    }

    // public function deleteByID (string $blockId, string $hotelId) {
    //     $obj = $this->FindByBlockIdAndHotelId($blockId, $hotelId, 'id')->toArray();
    //     dd($obj[0]['id']);
    //     $deleteObj = $this->find()
    //     $obj->deleteFlag = true;
    //     return $obj->save();
    // }

}
