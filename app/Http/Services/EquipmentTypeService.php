<?php

namespace App\Http\Services;

use App\Models\EquipmentType;
use Illuminate\Validation\ValidationException;
use Log;

class EquipmentTypeService
{
    public static function newMask($number)
    {
        $number_list = str_split($number);
        Log::debug($number_list);
        return 1;
    }

    public static function mask($equipment, $id)
    {
        $equipmentType = EquipmentType::where('id', $id)->first();
        $mask = $equipmentType->mask_serial_number;
        $mask_list = str_split($mask);
        $number_list = str_split($equipment->serial_number);

        if (count($mask_list) != count($number_list)) {
            
            throw new \Exception("Неверный формат номера, маска: {$mask}");
        }

        setlocale(LC_ALL, "en_US.UTF-8");
        $error = [
            "id" => $id,
            "name" => $equipment->serial_number,
            "mask" => $equipmentType->name,
        ];
        $status = 0;
        
        foreach ($number_list as $n_key => $n) {
            $m = $mask_list[$n_key];
            switch ($m) {
                case 'a':
                    if (!ctype_alpha($n) || !ctype_lower($n)) {
                        // закоментил после дебага
                        // throw new \Exception("Неверный формат: {$n} ожидался формат {$m}");
                        $status = 1;
                        break 2;
                    }
                    break;
                case 'A':
                    if (!ctype_alpha($n) || !ctype_upper($n)) {
                        // throw new \Exception("Неверный формат: {$n} ожидался формат {$m}");
                        $status = 1;
                        break 2;
                    }
                    break;
                case 'N':
                    if (!is_numeric($n)) {
                        // throw new \Exception("Неверный формат: {$n} ожидался формат {$m}");
                        $status = 1;
                        break 2;
                    }
                    break;
                case 'X':
                    if (!ctype_alpha($n) || !ctype_upper($n)) {
                        if (!is_numeric($n)) {
                            // throw new \Exception("Неверный формат: {$n} ожидался формат {$m}");
                            $status = 1;
                            break 2;
                        }
                    }
                    break;
                case 'Z':
                    if (!stristr('-_@', $n)) {
                        // throw new \Exception("Неверный формат: {$n} ожидался формат {$m}");
                        $status = 1;
                        break 2;
                    }
                    break;
            }
        }

        return ($status ? $error : 0);
    }
}
