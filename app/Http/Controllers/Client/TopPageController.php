<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Block\BlockRepositoryInterface;
use App\Repositories\Hotel\HotelRepositoryInterface;
use App\Repositories\SearchHistory\SearchHistoryRepositoryInterface;
use App\Repositories\TypeRoom\TypeRoomRepositoryInterface;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;

class TopPageController extends Controller
{
    //
    protected HotelRepositoryInterface $hotelRepository;
    protected TypeRoomRepositoryInterface $typeRoomRepository;
    protected BlockRepositoryInterface $blockRepository;
    protected SearchHistoryRepositoryInterface $searchHistoryRepository;

    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        TypeRoomRepositoryInterface $typeRoomRepository,
        BlockRepositoryInterface $blockRepository,
        SearchHistoryRepositoryInterface $searchHistoryRepository
    ) {
        $this->hotelRepository = $hotelRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->blockRepository = $blockRepository;
        $this->searchHistoryRepository = $searchHistoryRepository;
    }

    // public function moneyFormat ($priceAmount) {
    //     dd();
    //     return number_format($priceAmount / 100, 2);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $listBlocks = [];
        $listBlockRender = [];
        $blocks = $this->blockRepository->all(3);
        $hotelsBlock = [];
        $hotels = [];
        $searchHistories = null;

        foreach ($blocks as $key => $value) {
            $response = $this->blockRepository->GetFullBlockInfo($value->id)->toArray();
            $listBlocks[] = $response;
            $listBlockRender[] = [
                "blockName" => $response[0]['blockName'],
                "blockId" => $response[0]['blockId'],
                "blockDesc" => $response[0]['blockdescription'],
                "hotels" => []
            ];
        }

        foreach ($listBlocks as $blocks) {
            $hotelsBlock = array_merge($hotelsBlock, $blocks);
        }

        foreach ($hotelsBlock as $hotel) {
            foreach ($listBlockRender as &$value) {
                if ($hotel['blockId'] == $value['blockId']) {
                    $value['hotels'][] = [
                        "hotelId" => $hotel['id'],
                        "hotelName" => $hotel['name'],
                        "location" => $hotel['location'],
                        "description" => $hotel['description'],
                        "price" => number_format($hotel['price'] / 1000, 3),
                        "image" => $hotel['image']
                    ];
                }
            }
        }

        $hotelTop = $this->hotelRepository->searchHotelsByAttribute(1, 1, 'isTop', ['name', 'id', 'description'])->first();
        if(isset($hotelTop)) {
            $listRooms = $this->typeRoomRepository->FindByHotelId($hotelTop->id);
            $lowCast = $listRooms[0]->price;
            $roomImgs = [];
    
            foreach ($listRooms as $room) {
                if($lowCast > $room->price) {
                    $lowCast = $room->price;
                }
                $roomImgs[] = $room->image;;
            }
    
            $hotelTop->cast = number_format($lowCast / 1000, 3);
            $hotelTop->imgs = $roomImgs;
        }

        if($request->session()->get('user') !== null) {
            $userId = $request->session()->get('user')->id;
            $response = $this->searchHistoryRepository->FindAttributes($userId, 'userId', 'searchText');
            foreach ($response as $searchItem) {
                $hotel = $this->hotelRepository->getHightLightInfo($searchItem->searchText)[0]->toArray();
                $searchHistories[] = $hotel;
            }
        }

        return view('home-page', compact(['listBlockRender', 'hotelTop', 'searchHistories']));
    }
}
