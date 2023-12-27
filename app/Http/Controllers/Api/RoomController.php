<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Room::all();
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
        return Room::where('id', $id)->with('room_type')->with('room_medias')->with('apartment')->with('tenants')->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addTentantToRoom(Request $request, string $id)
    {
        $checkAvailalbe = DB::
            table('room_tenant')
            ->where('room_id', $id)
            ->where('deleted_at', null)
            ->get();
        if ($checkAvailalbe->count() == 0) {
            $room = Room::where('id', $id)->first();
            $room->rent_status = 'Rented';
            $room->save();
        }

        if (Tenant::where('citizen_number', $request->input('citizen_number'))->first() != null) {
            $tenant = Tenant::where('citizen_number', $request->input('citizen_number'));

            $room = Room::where('id', $id)->first();
            $room->tenants()->attach($tenant, [
                'room_host' => $request->input('room_host'),
                'rent_type' => $request->input('rent_type'),
                'living_status' => $request->input('living_status'),
                'created_at' => now(),
            ]);

            return $tenant;
        } else {
            $tenant = Tenant::create([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                'citizen_number' => $request->input('citizen_number'),
                'gender' => $request->input('gender'),
                'email' => $request->input('email'),
            ]);
            $room = Room::where('id', $id)->first();

            $room->tenants()->attach($tenant, [
                'room_host' => $request->input('room_host'),
                'rent_type' => $request->input('rent_type'),
                'living_status' => $request->input('living_status'),
                'created_at' => now(),
            ]);

            return $tenant;
        }
    }

    public function DeleteTentantInRoom(string $id, string $tenant_id)
    {
        DB::
            table('room_tenant')
            ->where('room_id', $id)
            ->where('tenant_id', $tenant_id)
            ->update(['deleted_at' => now()]);

        $checkAvailalbe = DB::
            table('room_tenant')
            ->where('room_id', $id)
            ->where('deleted_at', null)
            ->get();
        if ($checkAvailalbe->count() == 0) {
            $room = Room::where('id', $id)->first();
            $room->rent_status = 'Available';
            $room->save();
        }
    }

    public function showRoomPayment(string $id)
    {
        return Room::where('id', $id)->with('payments')->get();
    }
}
