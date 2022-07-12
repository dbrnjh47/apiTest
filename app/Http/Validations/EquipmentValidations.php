<?php


namespace App\Http\Validations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as V;
use Illuminate\Validation\Validator as ValidationValidator;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Http\Services\EquipmentTypeService;
use Log;
class EquipmentValidations
{
    public function index(Request $request): V
    {
        $validator = Validator::make($request->all(), [
            'search' => ''
        ]);

        $validator->after(function (ValidationValidator $validator) use ($request) {
            if (!$validator->errors()->messages()) {
                $equipment = Equipment::query()
                ->where('serial_number', 'LIKE', "%{$request->search}%") 
                ->first();
                if (!$equipment) $validator->errors()->add('elements', 'объект не найден');
            }
        });
        return $validator;
    }
    
    public function show($id): V
    {
        $arr['id'] = $id;
        $validator = Validator::make($arr, [
            'id' => 'required|integer|exists:App\Models\Equipment,id'
        ]);

        return $validator;
    }

    public function destroy($id): V
    {
        $arr['id'] = $id;
        $validator = Validator::make($arr, [
            'id' => 'required|integer|exists:App\Models\Equipment,id'
        ]);

        return $validator;
    }

    public function store(Request $request): V
    {
        $validator = Validator::make($request->all(), [
            'equipment' => 'required|array',
            'equipment.*.id' => 'required|integer|exists:App\Models\Equipment,id',
            'equipment.*.equipment_type_id' => 'required|integer|exists:App\Models\EquipmentType,id',
            'equipment.*.serial_number' => 'required|string',
            'equipment.*.description' => 'required|string',
        ]);

        $validator->after(function (ValidationValidator $validator) use ($request) {
            if (!$validator->errors()->messages()) {
                foreach($request->equipment as $key_q => $q){
                    $q = (object) $q;
                    $mask = EquipmentTypeService::Mask($q, $q->equipment_type_id);
                    if($mask){
                        $validator->errors()->add("elements.$key_q", "id = {$mask['id']}, name = {$mask['name']}, mask ={$mask['mask']} ");
                    }
                }
            }
        });
        return $validator;
    }
}
