<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    // store to user / register
    public function store(Request $request)
    {
        // validation required
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'desc' => ['required']
        ]);

        // condition for validation fail
        if ($validator->fails()) {
            return response()-> json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
        }
        
        // save data in try catch
        try {

            $user = User::create($request->all());

            $response = [
                'message' => 'Thread Created.'
            ];

            return response()->json($response, Response::HTTP_CREATED);

        } catch(QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }

    }
}
