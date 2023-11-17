<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Block\BlockRepositoryInterface;
use App\Repositories\Hotel\HotelRepositoryInterface;
use App\Repositories\TypeRoom\TypeRoomRepositoryInterface;
use Illuminate\Http\Request;

class ListHotelController extends Controller
{
    //
    protected HotelRepositoryInterface $hotelRepository;
    protected TypeRoomRepositoryInterface $typeRoomRepository;
    protected BlockRepositoryInterface $blockRepository;

    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        TypeRoomRepositoryInterface $typeRoomRepository,
        BlockRepositoryInterface $blockRepository
    ) {
        $this->hotelRepository = $hotelRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->blockRepository = $blockRepository;
    }


    public function index(
        Request $request
    ) {
        $minPrice = $request->minPrice ?? 0;
        $maxPrice = $request->maxPrice ?? 0;
        $rating = $request->rating ?? 0;
        $star = $request->star ?? 1;
        $location = $request->location ?? '';
        $sortType = $request->sortType ?? 'latest';
        $countStar = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];
        $dateCheckin = isset($request->dateCheckin) ? $request->dateCheckin : '';
        $dateCheckout = isset($request->dateCheckout) ? $request->dateCheckout : '';
        $guests = isset($request->guests) ? $request->guests : '';

        $hotels = $this->hotelRepository->getDetail(
            $minPrice,
            $maxPrice,
            $rating,
            $star,
            $location,
            $sortType,
        );

        foreach ($hotels as $item) {
            $countStar[$item->level] += 1;
        }

        $countHotels = count($this->hotelRepository->all(10000));
        return view('hotel-listing', compact([
            'hotels', 
            'countHotels', 
            'minPrice',
            'maxPrice',
            'rating',
            'star',
            'location',
            'sortType',
            'countStar',
            'dateCheckin',
            'dateCheckout',
            'guests'
        ]));
    }

}
