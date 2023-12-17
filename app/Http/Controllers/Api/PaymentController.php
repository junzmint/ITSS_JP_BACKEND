<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment = DB::table('apartments')
            ->join('rooms', 'rooms.apartment_id', '=', 'apartments.id')
            ->join('payments', 'payments.room_id', '=', 'rooms.id')
            ->get();
        return $payment;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payment = Payment::create($request->all());

        return $payment;
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return Payment::where('id', $payment->id)->with('room')->with('room.apartment')->with('room.tenants')->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $payment->update($request->all());

        return $payment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
