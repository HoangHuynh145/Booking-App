<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Hotel\HotelRepositoryInterface;
use App\Repositories\PaymentInformation\PaymentInformationRepositoryInterface;
use App\Repositories\RatingDetail\RatingDetailRepositoryInterface;
use App\Repositories\TypeRoom\TypeRoomRepositoryInterface;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    protected TypeRoomRepositoryInterface $typeRoomRepository;
    protected RatingDetailRepositoryInterface $ratingDetailRepository;
    protected HotelRepositoryInterface $hotelRepository;
    protected PaymentInformationRepositoryInterface $paymentInformationRepository;

    public function __construct(
        TypeRoomRepositoryInterface $typeRoomRepository,
        RatingDetailRepositoryInterface $ratingDetailRepository,
        HotelRepositoryInterface $hotelRepository,
        PaymentInformationRepositoryInterface $paymentInformationRepository
    ) {
        $this->typeRoomRepository = $typeRoomRepository;
        $this->ratingDetailRepository = $ratingDetailRepository;
        $this->hotelRepository = $hotelRepository;
        $this->paymentInformationRepository = $paymentInformationRepository;
    }

    public function convertDate(string $rawDate)
    {
        $date = new DateTime($rawDate);
        return $date->format('l, M j');
    }

    public function convertDateCart(string $rawDate)
    {
        $date = new DateTime($rawDate); 
        return $date->format('d/m');
    }

    public function index(Request $request)
    {
        $userId = $request->session()->get('user')->id;
        $typeRoom = $this->typeRoomRepository->find($request->typeRoomId);
        $hotel = $this->hotelRepository->find($request->hotelId);
        $formattedDateCheckin = $this->convertDate($request->checkin);
        $formattedDateCheckout = $this->convertDate($request->checkout);
        $checkin = new DateTime($request->checkin);
        $checkout = new DateTime($request->checkout);
        $interval = $checkin->diff($checkout);
        $dateDiff = $interval->days;
        $response = $this->paymentInformationRepository->FindWithParameters($userId, 'userId', ['cardNumber', 'expDate', 'id']);
        $cardInfo = [];
        
        $orderInfo = [
            "checkout" => $formattedDateCheckout,
            "checkin" => $formattedDateCheckin,
            "dateDiff" => $dateDiff,
            "payment" => ($dateDiff * $typeRoom->price),
            "rawCheckin" => $request->checkin,
            "rawCheckout" => $request->checkout
        ];

        foreach ($response as $value) {
            $cardInfo[] = [
                "id" => $value->id,
                "cardNumber" => $value->cardNumber,
                "expDate" =>  $this->convertDateCart($value->expDate),
            ];
        }

        return view('booking', compact(['typeRoom', 'hotel', 'orderInfo', 'cardInfo']));
    }
}
