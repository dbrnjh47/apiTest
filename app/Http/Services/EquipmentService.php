<?php

namespace App\Http\Services;

use App\Models\Equipment;
use Illuminate\Validation\ValidationException;
use Log;
use Illuminate\Support\Str;

class EquipmentService
{
    public static function newNumber($mask)
    {
        $mask_list = str_split($mask);
        Log::debug($mask_list);
        $number = '';
        foreach ($mask_list as $m) {
            switch ($m) {
                case 'a':
                    $number .= Str::lower(Str::random(1));
                    break;
                case 'A':
                    $number .= Str::upper(Str::random(1));
                    break;
                case 'N':
                    $number .= random_int(0, 9);
                    break;
                case 'X':
                    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $number .= substr(str_shuffle($permitted_chars), 0, 1);
                    break;
                case 'Z':
                    $permitted_chars = '-_@';
                    $number .= substr(str_shuffle($permitted_chars), 0, 1);
                    break;
                default:
                    throw new \Exception('Неверный формат');
                    break;
            }
        }
        return $number;
    }

    public function get($r)
    {
        $Equipment = Equipment::query()
        ->where('serial_number', 'LIKE', "%{$r['search']}%") 
        ->get();

        return $Equipment;
    }

    public function getOne($r)
    {
        $Equipment = Equipment::where('id', $r['id'])->get();

        return $Equipment;
    }

    public function destroyOne($r)
    {
        $Equipment = Equipment::where('id', $r['id'])->delete();

        return;
    }

    public function updateArr($r)
    {
        foreach($r as $_r){
            Equipment::where('id', $_r['id'])->update($_r);
        }

        return;
    }
}