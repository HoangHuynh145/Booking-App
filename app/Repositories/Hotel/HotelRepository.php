<?php

namespace App\Repositories\Hotel;

use App\Models\Hotels;
use App\Repositories\BaseRepository;

class HotelRepository extends BaseRepository implements HotelRepositoryInterface
{
    public function __construct(Hotels $model)
    {
        parent::__construct($model);
    }

    public function searchHotelsByName(int $itemPerPage, string $searchValue, $attribute = "name", $column = ['*'])
    {
        return $this->model->where('deleteFlag', 0)
            ->where($attribute, 'like', '%' . $searchValue . '%')
            ->paginate($itemPerPage)
            ->withQueryString();
    }

    public function searchHotelsByAttribute(int $itemPerPage, string $attributeValue, $attribute = "name", $column = ['*'])
    {
        return $this->model::select($column)->where('deleteFlag', 0)
            ->where($attribute, $attributeValue)
            ->paginate($itemPerPage)
            ->withQueryString();
    }

    public function FindWithColumn($column = ['*'])
    {
        return $this->model::select($column)->where([
            ['deleteFlag', 0]
        ])->get();
    }

    public function getDetail(
        int $minPrice = 0,
        int $maxPrice = 0,
        int $ratingValue = null,
        int $starValue = null,
        string $locationValue = null,
        string $sortTypeValue = null
    ) {

        $orderByFieldname = 'hotels.created_at';
        $orderByValue = '';

        // Thêm logic sắp xếp nếu có giá trị $sortTypeValue.
        if ($sortTypeValue !== null) {
            switch ($sortTypeValue) {
                case 'latest':
                    $orderByFieldname = 'hotels.created_at';
                    $orderByValue = 'desc';
                    break;
                case 'cheapest':
                    $orderByFieldname = 'type_rooms.price';
                    $orderByValue = 'asc';
                    break;
                case 'reviews':
                    $orderByFieldname = 'hotels.countRating';
                    $orderByValue = 'desc';
                    break;
                default:
                    break;
            }
        }


        return $this->model
            ->select(
                'hotels.*',
                'type_rooms.hotelId',
                'type_rooms.image',
                'type_rooms.price',
            )
            ->where([
                ['hotels.deleteFlag', 0],
                ['hotels.level', '>=', $starValue !== null ? $starValue : 0],
                ['hotels.stars', '>=', $ratingValue  !== null ? $ratingValue  : 0],
                ['hotels.location', 'like', $locationValue !== null ? '%' . $locationValue . '%' : '%' . '' . '%'],
                ['type_rooms.price', '>=', $minPrice],
                ['type_rooms.price', $maxPrice != null ? '<=' : '>=', $maxPrice != null ? $maxPrice : 0],
            ])
            ->joinSub(function ($join) {
                $join->from('type_rooms')
                    ->select($this->model::raw('MIN(price) as min_price, hotelId'))
                    ->groupBy('hotelId');
            }, 'subquery', function ($join) {
                $join->on('hotels.id', '=', $this->model::raw('subquery.hotelId'));
            })
            ->join('type_rooms', function ($join) {
                $join->on('subquery.min_price', '=', 'type_rooms.price')
                    ->on('subquery.hotelId', '=', 'type_rooms.hotelId');
            })
            ->orderBy($orderByFieldname, $orderByValue == 'desc' ? 'desc' : 'asc')
            ->distinct('hotels.id')
            ->get();
    }

    public function getHightLightInfo(string $hotelId) {
        return $this->model
            ->select(
                'hotels.*',
                'type_rooms.hotelId',
                'type_rooms.image',
                'type_rooms.price',
            )
            ->where([
                ['hotels.deleteFlag', 0],
                ['hotels.id', $hotelId],
            ])
            ->joinSub(function ($join) {
                $join->from('type_rooms')
                    ->select($this->model::raw('MIN(price) as min_price, hotelId'))
                    ->groupBy('hotelId');
            }, 'subquery', function ($join) {
                $join->on('hotels.id', '=', $this->model::raw('subquery.hotelId'));
            })
            ->join('type_rooms', function ($join) {
                $join->on('subquery.min_price', '=', 'type_rooms.price')
                    ->on('subquery.hotelId', '=', 'type_rooms.hotelId');
            })
            ->get(1);
    }

}
