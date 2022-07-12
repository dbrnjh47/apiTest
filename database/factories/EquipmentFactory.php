<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EquipmentType;
use App\Http\Services\EquipmentService;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $equipmentType = EquipmentType::inRandomOrder()->first();
        return [
            'equipment_type_id' => $equipmentType->id,
            'serial_number' => EquipmentService::newNumber($equipmentType->mask_serial_number),
        ];
    }
}
