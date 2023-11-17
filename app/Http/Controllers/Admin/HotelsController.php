<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hotels;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateHotelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\Hotel\HotelRepositoryInterface;
use App\Repositories\TypeRoom\TypeRoomRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpFoundation\File\File;

class HotelsController extends Controller
{

    protected HotelRepositoryInterface $hotelRepository;
    protected TypeRoomRepositoryInterface $typeRoomRepository;

    public function __construct(HotelRepositoryInterface $hotelRepository, TypeRoomRepositoryInterface $typeRoomRepository)
    {
        $this->hotelRepository = $hotelRepository;
        $this->typeRoomRepository = $typeRoomRepository;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $q = '';
        if ($request->has('q')) {
            $q = $request->q;
            if ($q == '') {
                $hotels = $this->hotelRepository->all(3);
            } else {
                $hotels = $this->hotelRepository->searchHotelsByName(3, $q, 'name');
            }
        } else {
            $hotels = $this->hotelRepository->all(3);
        }
        return view('admin.hotels.index', compact(['hotels', 'q']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'roomName' => 'required|array|min:1',
            'roomName.*' => 'required|string',
            'roomPrice' => 'required|array|min:1',
            'roomPrice.*' => 'required|numeric',
            'available' => 'required|array|min:1',
            'available.*' => 'required|min:1',
        ], [
            'name.required' => 'Tên khách sạn không được để trống',
            'location.required' => 'Địa chỉ khách sạn không được để trống',
            'description.required' => 'Mô tả khách sạn không được để trống',
            'roomName.required' => 'Thông tin phòng khách sạn không được để trống',
            'roomName.array' => 'Thông tin phòng khách sạn phải là một mảng',
            'roomName.*.required' => 'Tên phòng không được để trống',
            'roomPrice.required' => 'Thông tin giá phòng khách sạn không được để trống',
            'roomPrice.array' => 'Thông tin giá phòng khách sạn phải là một mảng',
            'roomPrice.*.numeric' => 'Giá phòng phải là một số',
            'available.required' => 'Thông tin trạng thái phòng khách sạn không được để trống',
            'available.array' => 'Thông tin trạng thái phòng khách sạn phải là một mảng',
            'available.*.boolean' => 'Trạng thái phòng phải là true hoặc false',
        ]);

        $data = $request->all();
        $roomData = [];
        $hotelData = [];
        $image = $request->file('image');

        $slug = Str::slug($request->name, "-");
        $hotelData['slug'] = $slug;
        $hotelData['name'] = $request->name;
        $hotelData['location'] = $request->location;
        $hotelData['level'] = $request->level;
        $hotelData['description'] = $request->description;
        $hotelData['numberRoom'] = count($image);
        $hotelData['isTop'] = $request->isTop == 'on' ? true : false;
        $response = $this->hotelRepository->create($hotelData);
        $newHotelId = $response->id;

        for ($i = 0; $i < count($image); $i++) {
            $img_name = hexdec(uniqid()) . '.' . $image[$i]->getClientOriginalExtension();
            Image::make($image[$i])->save('img/room/' . $img_name);
            $last_img = 'img/room/' . $img_name;
            $roomData[] = [
                "name" => $request->roomName[$i],
                "image" => $last_img,
                "price" => $request->roomPrice[$i],
                "available" => $request->available[$i],
                "hotelId" => $newHotelId
            ];
        }

        $this->typeRoomRepository->CreateMany($roomData);

        return redirect()->route('hotels.index')->with('success', 'Tạo khách sạn mới thành công.');
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
        $hotel = $this->hotelRepository->find($id);
        $typeRooms = $this->typeRoomRepository->FindByHotelId($id, '*');
        return view('admin.hotels.edit', compact(['hotel', 'typeRooms']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $roomData = [];
        $roomUpdateData = [];
        $deletedElements = [];
        $updateElements = [];
        $createElements = [];
        $typeRooms = $this->typeRoomRepository->FindByHotelId($id)->toArray();
        $typeRoomsRequest = [];
        $typeRoomIds = $request->typeRoomId;
        $image = $request->file('image');


        for ($i = 0; $i < count($typeRoomIds); $i++) {
            if ($typeRoomIds[$i]) {
                $typeRoomsRequest[] = [
                    "name" => $request->roomName[$i],
                    "id" => $typeRoomIds[$i],
                    "image" => isset($image[$i]) ? $image[$i] : $typeRooms[$i]['image'],
                    "price" => $request->roomPrice[$i],
                    "available" => $request->available[$i],
                    "hotelId" => $id
                ];
            } else {
                $createElements[] = [
                    "name" => $request->roomName[$i],
                    "price" => $request->roomPrice[$i],
                    "available" => $request->available[$i],
                    "image" => $image[$i],
                    "hotelId" => $id
                ];
            }
        }

        if ($typeRooms != $typeRoomsRequest) {
            for ($i = 0; $i < count($typeRooms); $i++) {
                if (!isset($typeRoomsRequest[$i])) {
                    $deletedElements[] = $typeRooms[$i];
                }
            }

            $updateElements = array_filter($typeRoomsRequest, function ($room) use ($typeRooms) {
                return !in_array($room, $typeRooms);
            });
        }

        if (count($deletedElements)) {
            for ($i = 0; $i < count($deletedElements); $i++) {
                $this->typeRoomRepository->delete($deletedElements[$i]['id']);
            }
        }

        if (count($createElements)) {
            foreach ($createElements as $element) {
                $img_name = hexdec(uniqid()) . '.' . $element['image']->getClientOriginalExtension();
                Image::make($element['image'])->save('img/room/' . $img_name);
                $last_img = 'img/room/' . $img_name;
                $roomData[] = [
                    "name" => $element['name'],
                    "image" => $last_img,
                    "price" => $element['price'],
                    "available" => $element['available'],
                    "hotelId" => $id
                ];
            }
            $this->typeRoomRepository->CreateMany($roomData);
        }

        if (count($updateElements)) {
            foreach ($updateElements as $element) {
                if (gettype($element['image']) == 'string') {
                    $roomUpdateData = [
                        "name" => $element['name'],
                        "image" => $element['image'],
                        "price" => $element['price'],
                        "available" => $element['available'],
                        "hotelId" => $id
                    ];
                } else {
                    $img_name = hexdec(uniqid()) . '.' . $element['image']->getClientOriginalExtension();
                    Image::make($element['image'])->save('img/room/' . $img_name);
                    $last_img = 'img/room/' . $img_name;
                    $roomUpdateData = [
                        "name" => $element['name'],
                        "image" => $last_img,
                        "price" => $element['price'],
                        "available" => $element['available'],
                        "hotelId" => $id
                    ];
                }
                $this->typeRoomRepository->update($element['id'], $roomUpdateData);
            }
        }

        $countRoomType = count($this->typeRoomRepository->FindByHotelId($id));
        $this->hotelRepository->update($id, [
            "name" => $request->name,
            "location" => $request->location,
            "level" => $request->level,
            "description" => $request->description,
            "isTop" => $request->isTop == 'on' ? true : false,
            "numberRoom" => $countRoomType
        ]);

        return redirect()->route('hotels.index')->with('success', 'Chỉnh sửa khách sạn mới thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotel = $this->hotelRepository->find($id);
        if ($hotel) {
            $typeRooms = $this->typeRoomRepository->FindByHotelId($id);
            foreach ($typeRooms as $room) {
                $this->typeRoomRepository->delete($room->id);
            }
            $this->hotelRepository->delete($id);
        }
        return redirect()->route('hotels.index')->with('success', 'Xoá khách sạn mới thành công.');
    }
}
