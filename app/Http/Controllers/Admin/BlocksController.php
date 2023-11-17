<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blocks;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBlocksRequest;
use App\Repositories\Block\BlockRepositoryInterface;
use App\Repositories\BlockDetail\BlockDetailRepositoryInterface;
use App\Repositories\Hotel\HotelRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class BlocksController extends Controller
{

    protected BlockRepositoryInterface $blockRepository;
    protected HotelRepositoryInterface $hotelRepository;
    protected BlockDetailRepositoryInterface $blockDetailRepository;

    public function __construct(
        BlockRepositoryInterface $blockRepository,
        HotelRepositoryInterface $hotelRepository,
        BlockDetailRepositoryInterface $blockDetailRepository
    ) {
        $this->blockRepository = $blockRepository;
        $this->hotelRepository = $hotelRepository;
        $this->blockDetailRepository = $blockDetailRepository;
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
                $blocks = $this->blockRepository->all(3);
            } else {
                $blocks = $this->blockRepository->searchBlocksByAttribute(3, $q, 'name');
            }
        } else {
            $blocks = $this->blockRepository->all(3);
        }

        return view('admin.blocks.index', compact(['blocks', 'q']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $hotels = $this->hotelRepository->all(1000);

        return view('admin.blocks.create', compact(['hotels']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            
        ], [
            'name.required' => 'Tên block không được để trống',
            'description.required' => 'Mô tả block không được để trống',
        ]);


        $slug = Str::slug($request->name, '-');
        $data = [
            "name" => $request->name,
            "description" => $request->description,
            "slug" => $slug
        ];
        $response = $this->blockRepository->create($data);

        foreach ($request->hotelIds as $id) {
            $hotel = $this->hotelRepository->find($id);
            if ($hotel) {
                $this->blockDetailRepository->create([
                    "blockId" => $response->id,
                    "hotelId" => $id
                ]);
            } else {
            }
        }

        return redirect()->route('blocks.index')->with('success', 'Thêm mới block thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blocks $blocks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $block = $this->blockRepository->find($id);
        $hotels = $this->blockRepository->all(1000);
        $blockHotelsIds = $this->blockDetailRepository->FindByBlockId($block->id, 'hotelId')->toArray();
        $originalHotels = $this->hotelRepository->FindWithColumn('id')->toArray();
        $baseHotels = [];
        $hotelsNotInBlock = [];
        $hotelsInBlock = [];

        foreach ($blockHotelsIds as $row) {
            $baseHotels[] = $row['hotelId'];
        }

        foreach ($baseHotels as $id) {
            $hotelsInBlock[] = $this->hotelRepository->find($id);
        }

        foreach ($originalHotels as $hotel) {
            if (!in_array(intval($hotel['id']), $baseHotels)) {
                $hotelsNotInBlock[] = $this->hotelRepository->find($hotel);
            }
        }

        return view('admin.blocks.edit', compact(['hotels', 'block', 'hotelsInBlock', 'hotelsNotInBlock']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = [];
        $originalBlock = $this->blockRepository->find($id, ['name', 'description']);
        $originalDetailBlock = $this->blockDetailRepository->FindByBlockId($id, 'hotelId')->toArray();
        $hotelDeleted = [];
        $hotelAdded = [];
        $baseDetailBlock = [];

        foreach ($originalDetailBlock as $row) {
            $baseDetailBlock[] = $row['hotelId'];
        }

        if ($request->name != $originalBlock->name) {
            $data['name'] = $request->name;
        }

        if ($request->description != $originalBlock->description) {
            $data['description'] = $request->description;
        }

        foreach ($request->hotelIds as $hotelId) {
            if(!in_array($hotelId, $baseDetailBlock)) {
                $hotelAdded[] = [$hotelId];
            };
        }

        foreach ($baseDetailBlock as $hotelId) {
            if(!in_array($hotelId, $request->hotelIds )) {
                $hotelDeleted[] = $hotelId;
            };
        }

        if(count($data)) {
            $this->blockRepository->update($id, [
                "name" => isset($data['name']) ? $data['name'] : $originalBlock->name,
                "description" => isset($data['description']) ? $data['description'] : $originalBlock->description
            ]);
        }

        if(count($hotelDeleted)) {
            // $test = [];
            foreach ($hotelDeleted as $value) {
                $foundedId = $this->blockDetailRepository->FindByBlockIdAndHotelId($id, $value, 'id');
                $this->blockDetailRepository->delete($foundedId[0]['id']);
            }
        }

        if(count($hotelAdded)) {
            foreach ($hotelAdded as $key => $value) {
                $hotelId = $value[$key];
                $this->blockDetailRepository->create([
                    "blockId" => $id,
                    "hotelId" => $hotelId
                ]);
            }
        }

        return redirect()->route('blocks.index')->with('success', 'Chỉnh sửa block thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $foundDetailBlocks = $this->blockDetailRepository->FindByBlockId($id, 'id');
        foreach ($foundDetailBlocks as $detailBlockId) {
            $this->blockDetailRepository->delete($detailBlockId['id']);
        }
        $this->blockRepository->delete($id);
        return redirect()->route('blocks.index')->with('success', 'Xoá block thành công.');
    }
}
