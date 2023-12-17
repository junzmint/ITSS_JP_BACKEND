<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tenant::with('rooms')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tenant = Tenant::create([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'citizen_number' => $request->input('citizen_number'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
        ]);

        if ($request->input('room_ids') != null) {
            foreach ($request->input('room_ids') as $room) {
                $tenant->rooms()->attach($room['room_id'], [
                    'room_host' => $room['room_host'],
                    'rent_type' => $room['rent_type'],
                    'living_status' => $room['living_status'],
                    'created_at' => now(),
                ]);
            }
        }

        return $tenant;
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        return Tenant::where('id', $tenant->id)->with('rooms.apartment')->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $tenant->update($request->all());

        return $tenant;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        DB::
            table('tenants')
            ->where('id', $tenant->id)
            ->update(['deleted_at' => now()]);
        DB::
            table('room_tenant')
            ->where('tenant_id', $tenant->id)
            ->update(['deleted_at' => now()]);
    }
}
