<?php

namespace App\Repositories\Block;

use App\Models\Blocks;
use App\Repositories\BaseRepository;

class BlockRepository extends BaseRepository implements BlockRepositoryInterface {
    public function __construct(Blocks $model) {
        parent::__construct($model);
    }

    public function searchBlocksByAttribute(int $itemPerPage, string $searchValue, $attribute = "name", $column=['*']) {
        return $this->model->where('deleteFlag', 0)
            ->where($attribute, 'like', '%'.$searchValue.'%')
            ->paginate($itemPerPage)
            ->withQueryString();
    }

    public function GetHotelsInBlock (string $blockId, string $hotelId, $column = ['*']) {
        return $this->model
        ->select('hotels.*')
        ->where([['blocks.deleteFlag', 0], ['block_details.blockId', $blockId], ['hotels.id', $hotelId]])
        ->join('block_details', 'blocks.id', '=', 'block_details.blockId')
        ->join('hotels', 'block_details.hotelId', '=', 'hotels.id')
        ->get()
        ;
    }

    public function GetHotelNotBlock (string $blockId, string $hotelId, $column = ['*']) {
        return $this->model
        ->select('hotels.id', 'hotels.name', 'blocks.id as blockId')
        ->where([['blocks.deleteFlag', 0], ['block_details.blockId', '!=', $blockId], ['hotels.id', $hotelId]])
        ->join('block_details', 'blocks.id', '=', 'block_details.blockId')
        ->join('hotels', 'block_details.hotelId', '=', 'hotels.id')
        ->get()
        ;
    }

    public function GetFullBlockInfo(string $blockId, $column = ['*']) {
        return $this->model
            ->select( 
                'hotels.*', 
                'type_rooms.hotelId',
                'type_rooms.image',
                'type_rooms.price',
                'blocks.name as blockName',
                'blocks.id as blockId',
                'blocks.description as blockdescription'
            )
            ->where([['blocks.deleteFlag', 0], ['block_details.blockId', $blockId]])
            ->join('block_details', 'blocks.id', '=', 'block_details.blockId')
            ->join('hotels', 'block_details.hotelId', '=', 'hotels.id')
            ->join(
                $this->model::raw("(SELECT MIN(id) as min_id, hotelId FROM type_rooms GROUP BY hotelId) AS subquery"),
                function ($join) {
                    $join->on('hotels.id', '=', $this->model::raw('subquery.hotelId'));
                }
            )
            ->join('type_rooms', 'subquery.min_id', '=', 'type_rooms.id')
            ->distinct()
            ->get();
    }
}
