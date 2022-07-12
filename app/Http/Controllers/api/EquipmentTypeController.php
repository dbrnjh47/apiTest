<?php

namespace App\Http\Controllers\Api;

use App\Models\EquipmentType;
use App\Http\Requests\StoreEquipment_typeRequest;
use App\Http\Requests\UpdateEquipment_typeRequest;

class EquipmentTypeController 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEquipment_typeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipment_typeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment_type  $equipment_type
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentType $equipment_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment_type  $equipment_type
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentType $equipment_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEquipment_typeRequest  $request
     * @param  \App\Models\Equipment_type  $equipment_type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEquipment_typeRequest $request, EquipmentType $equipment_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment_type  $equipment_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentType $equipment_type)
    {
        //
    }
}
