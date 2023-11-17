<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Hotel\HotelRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\RatingDetail\RatingDetailRepositoryInterface;
use App\Repositories\SearchHistory\SearchHistoryRepositoryInterface;
use App\Repositories\TypeRoom\TypeRoomRepositoryInterface;
use App\Repositories\WishList\WishListRepositoryInterface;
use Illuminate\Http\Request;

class DetailHotelController extends Controller
{
    //
    protected HotelRepositoryInterface $hotelRepository;
    protected TypeRoomRepositoryInterface $typeRoomRepository;
    protected RatingDetailRepositoryInterface $ratingDetailRepository;
    protected WishListRepositoryInterface $wishlistRepository;
    protected SearchHistoryRepositoryInterface $searchHistoryRepository;
    protected OrderRepositoryInterface $orderRepository;

    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        TypeRoomRepositoryInterface $typeRoomRepository,
        RatingDetailRepositoryInterface $ratingDetailRepository,
        WishListRepositoryInterface $wishlistRepository,
        SearchHistoryRepositoryInterface $searchHistoryRepository,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->hotelRepository = $hotelRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->ratingDetailRepository = $ratingDetailRepository;
        $this->wishlistRepository = $wishlistRepository;
        $this->searchHistoryRepository = $searchHistoryRepository;
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request, string $id)
    {   
        $roomResponse = $this->typeRoomRepository->find($id);
        $hotels = $this->hotelRepository->searchHotelsByAttribute(1, $roomResponse->hotelId, 'id');
        $rooms = $this->typeRoomRepository->FindByHotelId($roomResponse->hotelId);
        $hotel = null;
        $wishListId = '';
        $dateCheckin = isset($request->dateCheckin) ? $request->dateCheckin : '';
        $dateCheckout = isset($request->dateCheckout) ? $request->dateCheckout : '';
        $ratingValue = null;
        $acceptReview = false;

        foreach ($hotels as $item) {
            $hotel = $item;
        }

        if($request->session()->get('user') !== null) {
            $userId = $request->session()->get('user')->id;
            $response = $this->ratingDetailRepository->findByDetailRating($id, $userId);
            $ratingValue = count($response) > 0 ? $response->toArray()[0]['ratingValue'] : 5;
            $responseWishlist = $this->wishlistRepository->findDetail($userId, $hotel['id'], 'id');
            if(isset($responseWishlist[0])) {
                $wishListId = $this->wishlistRepository->findDetail($userId, $hotel['id'], 'id')[0]->id;
            } else {
                $wishListId = null;
            }
            $listSearch = $this->searchHistoryRepository->FindAttributes($userId, 'userId', ['userId', 'searchText'])->toArray();
            $listId = [];
            $currSearch = [
                "userId" => $userId,
                "searchText" => $hotel['id']
            ];

            foreach ($listSearch as $key => $item) {
                $listId[] = [
                    "userId" => $item['userId'],
                    "searchText" => $item['searchText']
                ];
            }
            
            if(!in_array($currSearch, $listId)) {
                
                if(count($listId) >= 10) {
                    $lastId = $listId[9];
                    $deleteRecord = $this->searchHistoryRepository->findWithoutDeleteFlag($lastId);
                    $deleteRecord->delete();
                }
                $this->searchHistoryRepository->create([
                    'userId' => $userId,
                    'searchText' => $hotel['id'],
                ]);
            }

            // Check Accept review
            $responseRoom = $this->orderRepository->FindAttributes(10000, $userId, 'userId', 'hotel');
            $listOrderTypeRoomIds = null;
            $listHotelTypeRoomIds = null;

            foreach ($responseRoom as $key => $room) {
                $listOrderTypeRoomIds[] = intval($room['hotel']);
            }

            foreach ($rooms as $key => $room) {
                $listHotelTypeRoomIds[] = $room->id;
            }

            if($listOrderTypeRoomIds !== null) {
                for ($i=0; $i < count($listOrderTypeRoomIds); $i++) { 
                    if(in_array($listOrderTypeRoomIds[$i], $listHotelTypeRoomIds)) {
                        $acceptReview = true;
                        break;
                    } else {
                        $acceptReview = false;
                    }
                }
            }

        }
        
        return view('hotel-detail', compact(['hotel', 'rooms', 'dateCheckin', 'dateCheckout', 'wishListId', 'ratingValue', 'acceptReview']));
    }

    public function updateRating(Request $request, string $hotelId)
    {
        $userId = $request->session()->get('user')->id;
        $hotels = $this->hotelRepository->searchHotelsByAttribute(1, $hotelId, 'id');
        $rooms = $this->typeRoomRepository->FindByHotelId($hotelId);
        $ratingValue = $request->rating ?? 5;
        $response = $this->ratingDetailRepository->findByDetailRating($hotelId, $userId)->toArray();
        $hotel = null;
        $newAvgRatingValue = 0;

        foreach ($hotels as $item) {
            $hotel = $item;
        }

        if (count($response) > 0) {
            $currRatingValue = $response[0]['ratingValue'];
            $currAverageRatingValue = $hotel->stars;
            $numberOfRating = $hotel->countRating;
            $newAvgRatingValue = ((($numberOfRating * $currAverageRatingValue) - $currRatingValue) +  $request->rating) / $numberOfRating;

            $this->ratingDetailRepository->update($response[0]['id'], [
                "ratingValue" => $request->rating
            ]);

            $this->hotelRepository->update($hotelId, [
                "stars" => $newAvgRatingValue
            ]);

        } else {
            $currAverageRatingValue = $hotel->stars;
            $numberOfRating = $hotel->countRating;
            $newAvgRatingValue = (($numberOfRating * $currAverageRatingValue) + $request->rating) / ($numberOfRating + 1);

            $this->ratingDetailRepository->create([
                'userId' => $userId,
                'hotelId' => $hotelId,
                'ratingValue' => $request->rating,
            ]);

            $this->hotelRepository->update($hotelId, [
                "countRating" => $numberOfRating + 1,
                "stars" => $newAvgRatingValue
            ]);
        }

        $hotels = $this->hotelRepository->searchHotelsByAttribute(1, $hotelId, 'id');
        foreach ($hotels as $item) {
            $hotel = $item;
        }
        $acceptReview = true;

        return view('hotel-detail', compact('hotel', 'rooms', 'ratingValue', 'acceptReview'));
    }
}
