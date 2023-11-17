<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentInformation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentInformationRequest;
use App\Http\Requests\UpdatePaymentInformationRequest;
use App\Repositories\PaymentInformation\PaymentInformationRepositoryInterface;
use DateTime;
use Illuminate\Http\Request;

class PaymentInformationController extends Controller
{
    protected PaymentInformationRepositoryInterface $paymentInformationRepository;

    public function __construct(
        PaymentInformationRepositoryInterface $paymentInformationRepository
    ) {
        $this->paymentInformationRepository = $paymentInformationRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function convertDateCart(string $rawDate)
    {
        $date = new DateTime($rawDate); 
        return $date->format('d/m');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $userId = $request->session()->get('user')->id;
        $this->paymentInformationRepository->create([
            'nameOnCard' => $request->nameOnCard,
            'cardNumber' => $request->cardNumber,
            'expDate' => $request->expDate,
            'CVC' => $request->CVC,
            'country' => $request->country,
            'userId' => $userId 
        ]);
        $cardInfo = [];
        $response = $this->paymentInformationRepository->FindWithParameters($userId );

        foreach ($response as $value) {
            $cardInfo[] = [
                "cardNumber" => $value->cardNumber,
                "expDate" =>  $this->convertDateCart($value->expDate),
            ];
        }

        return redirect()->back()->with([
            'success' => 'Tạo thẻ mới thành công.',
            'cardInfo' => $cardInfo
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentInformation $paymentInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentInformation $paymentInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentInformationRequest $request, PaymentInformation $paymentInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentInformation $paymentInformation)
    {
        //
    }
}
