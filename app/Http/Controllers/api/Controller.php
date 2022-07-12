<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validation($request)
    {
        $data = $this->runValidator($request);
        if ($data->fails())
            throw new ValidationException($data);
        return $data->validated();
    }

    public function runValidator($request) {
        $currentAction = Route::currentRouteAction();
        list($controller, $method) = explode('@', $currentAction);
        return $this->validator->$method($request);
    }
}
