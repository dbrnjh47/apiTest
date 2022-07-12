<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\SmsCodeService;
use App\Http\Validations\UserValidations;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Validations\ClientValidations;
use App\Models\Client;


class AuthController extends Controller
{

    public $validator;
    private $smsCodeService;

    public function __construct()
    {
        // $this->validator = new UserValidations();
        // $this->clientValidator = new ClientValidations();
        // $this->smsCodeService = new SmsCodeService();
    }

    public function userGetCode(Request $request): JsonResponse
    {
        $data = $this->validation($request);

        $nextAttempt = $this->smsCodeService->send($data['phone'], User::class);

        return response()->json([
            'time_left' => $nextAttempt
        ]);
    }

    // public function clientGetCode(Request $request)
    // {
    //     $data = $this->clientValidator->clientGetCode($request);
    //     $data = $data->validated();

    //     if (!Client::where('contact_phone', $data['contact_phone'])->first()) {
    //         Client::create(['contact_phone' => $data['contact_phone']]);
    //     }

    //     $nextAttempt = $this->smsCodeService->send($data['contact_phone'], Client::class);

    //     return response()->json([
    //         'time_left' => $nextAttempt
    //     ]);
    // }

    // public function userCodeVerify(Request $request): JsonResponse
    // {
    //     $data = $this->validation($request);
    //     $user = User::where('phone', $data['phone'])->first();

    //     $user->tokens()->delete();

    //     $access_token = $user->createToken('access_token');

    //     return response()->json(['success' => true, 'access_token' => $access_token->plainTextToken]);
    // }

    public function clientCodeVerify(Request $request)
    {
        $data = $this->clientValidator->clientCodeVerify($request);
        $data = $data->validated();

        $client = Client::where('contact_phone', $data['contact_phone'])->first();

        $client->tokens()->delete();

        $access_token = $client->createToken('access_token');

        return ['access_token' => $access_token->plainTextToken];
    }

}
