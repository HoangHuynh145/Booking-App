<?php

namespace App\Http\Controllers\Admin;

use App\Models\Wishlists;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateWishlistsRequest;
use App\Repositories\Hotel\HotelRepositoryInterface;
use App\Repositories\WishList\WishListRepositoryInterface;
use Illuminate\Http\Request;

class WishlistsController extends Controller
{
    protected WishListRepositoryInterface $wishlistRepository;
    protected HotelRepositoryInterface $hotelRepository;

    public function __construct(
        WishListRepositoryInterface $wishlistRepository,
        HotelRepositoryInterface $hotelRepository
    )
    {
        $this->wishlistRepository = $wishlistRepository;
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //getHightLightInfo
        $listHotel = [];
        $userId = $request->session()->get('user')->id;
        $wishList = $this->wishlistRepository->FindAttributes(1, $userId, 'userId');

        foreach ($wishList as $item) {
            $hotel = $this->hotelRepository->getHightLightInfo($item->hotel);
            $listHotel[] = $hotel[0];
        }
        return view('WishList', compact(['listHotel', 'wishList']));
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
        $hotel = $this->hotelRepository->find($request->hotelId);
        $this->hotelRepository->update($request->hotelId, [
            'likes' => $hotel->likes + 1
        ]);
        $userId = $request->session()->get('user')->id;
        $this->wishlistRepository->create([
            "hotel" => $request->hotelId,
            "userId" =>$userId
        ]);
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlists $wishlists)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlists $wishlists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWishlistsRequest $request, Wishlists $wishlists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $record = $this->wishlistRepository->FindAttributes(1000, $id, 'id');
        $hotel = $this->hotelRepository->find($record[0]->hotel);
        $this->hotelRepository->update($record[0]->hotel, [
            'likes' => $hotel->likes - 1
        ]);
        $record[0]->delete();
        return redirect()->back();
    }
}
