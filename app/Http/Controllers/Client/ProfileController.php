<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Repositories\Hotel\HotelRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\PaymentInformation\PaymentInformationRepositoryInterface;
use App\Repositories\RatingDetail\RatingDetailRepositoryInterface;
use App\Repositories\TypeRoom\TypeRoomRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    protected UserRepositoryInterface $userRepository;
    protected OrderRepositoryInterface $orderRepository;
    protected TypeRoomRepositoryInterface $typeRoomRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        OrderRepositoryInterface $orderRepository,
        TypeRoomRepositoryInterface $typeRoomRepository
    ) {
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->typeRoomRepository = $typeRoomRepository;
    }

    public function convertDate(string $rawDate)
    {
        $date = new DateTime($rawDate);
        return $date->format('l, M j');
    }

    public function convertDateToTime(string $rawDate)
    {
        $carbonDateTime = \Carbon\Carbon::parse($rawDate);
        return $carbonDateTime->format('h:i A');
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
        $userId = $request->session()->get('user')->id;
        $user = $this->userRepository->find($userId);
        return view('profile', compact(['user']));
    }

    public function userOrders(Request $request)
    {
        //
        $userId = $request->session()->get('user')->id;
        $orders = $this->orderRepository->FindAttributes(2, $userId, 'userId');
        $listOrder = [];

        foreach ($orders as $order) {
            $room = $this->typeRoomRepository->find($order->hotel);
            $listOrder[] = [
                'hotelId' => $order->hotel,
                'totalPayment' => $order->totalPayment,
                'checkInTime' => $this->convertDateToTime($order->checkInTime),
                'checkOutTime' => $this->convertDateToTime($order->checkOutTime),
                'checkInDay' => $this->convertDate($order->checkInTime),
                'checkOutDay' => $this->convertDate($order->checkOutTime),
                'image' => $room->image
            ];
        }

        return view('orderHistory', compact(['listOrder', 'orders']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = $this->userRepository->find($id);
        if($request->avatar) {
            $image = $request->file('avatar');
            $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('img/avatar/' . $img_name);
            $last_img = 'img/avatar/' . $img_name;
            $this->userRepository->update($id, [
                'imageProfile' => $last_img
            ]);
            $user = $this->userRepository->find($id);
            $request->session()->put('user', $user);
            return redirect()->back()->with('success', 'Cập nhập ảnh đại diện thành công.');
        } else if(isset($request->fullName) && $request->fullName !== $user->fullName) {
            $this->userRepository->update($id, [
                'fullName' => $request->fullName
            ]);
            return redirect()->back()->with('success', 'Cập nhập tên thành công.');
        } else if(isset($request->email) && $request->email !== $user->email) {
            $this->userRepository->update($id, [
                'email' => $request->email
            ]);
            return redirect()->back()->with('success', 'Cập nhập email thành công.');
        } else if(isset($request->phone) && $request->phone !== $user->phone) {
            $this->userRepository->update($id, [
                'phone' => $request->phone
            ]);
            return redirect()->back()->with('success', 'Cập nhập số điện thoại thành công.');
        } else if(isset($request->password)) {
            if(Hash::check($request->password, $user->password)) {
                $this->userRepository->update($id, [
                    'password' => Hash::make($request->newPassword)
                ]);
                return redirect()->back()->with('success', 'Cập nhập thành công.');
            } else {
                return redirect()->back()->with('error', 'Mật khẩu không chính xác.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
