<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        try {
            $data = Auth::user();

            $response = [
                'code' => 200,
                'message' => 'successfully',
                'data' => new UserResource($data)
            ];
        } catch (\Exception $ex) {
            $response = [
                'code' => 500,
                'message' => $ex->getMessage(),
                'data' => null
            ];
        }

        return response()->json($response, $response['code']);
    }
}
