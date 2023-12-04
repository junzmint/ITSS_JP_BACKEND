<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Tenant;

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
        return Room::where('id', $id)->with('room_type')->with('room_medias')->with('apartment')->get();
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
