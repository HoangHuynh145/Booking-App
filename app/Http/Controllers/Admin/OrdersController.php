<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Repositories\Hotel\HotelRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\PaymentInformation\PaymentInformationRepositoryInterface;
use App\Repositories\TypeRoom\TypeRoomRepositoryInterface;
use DateTime;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected OrderRepositoryInterface $orderRepository;
    protected TypeRoomRepositoryInterface $typeRoomRepository;
    protected HotelRepositoryInterface $hotelRepository;
    protected PaymentInformationRepositoryInterface $paymentInformationRepository;

    public function __construct(
        TypeRoomRepositoryInterface $typeRoomRepository,
        OrderRepositoryInterface $orderRepository,
        HotelRepositoryInterface $hotelRepository,
        PaymentInformationRepositoryInterface $paymentInformationRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->typeRoomRepository = $typeRoomRepository;
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


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $q = "";
        $maxRow = Orders::count();
        $orders = Orders::paginate(10);
        return view('admin.orders.index', compact('orders', 'q', 'maxRow'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if(isset($request->card_select)) {
            $typeRoom = $this->typeRoomRepository->find($request->hotel);
            $hotel = $this->hotelRepository->find($typeRoom->hotelId);
            
            $this->typeRoomRepository->update($request->hotel, [
                'available' => $typeRoom->available - 1,
            ]);

            $this->hotelRepository->update($typeRoom->hotelId, [
                'totalSold' => $hotel->totalSold + 1,
            ]);

            $userId = $request->session()->get('user')->id;
            $this->orderRepository->create([
                'userId' => $userId,
                'hotel' => $request->hotel,
                'price' => $request->price,
                'tax' => $request->tax,
                'totalPayment' => $request->totalPayment,
                'checkInTime' => $request->checkInTime,
                'checkOutTime' => $request->checkOutTime
            ]);

            return redirect()->route('profile.orders')->with('success', 'Đặt phòng thành công, hẹn gặp bạn tại ' . $request->hotelName . '.');
        } else {
            return redirect()->back()->with('error', 'Vui lòng chọn thẻ thanh toán.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrdersRequest $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
