<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::orderBy('created_at', 'DESC')->get();
        $response = [
            'message' => 'List transaction order by time',
            'data' => $threads
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $threads = Thread::create($request->all());

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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get data for updated
        $thread = Thread::findOrFail($id);

        $response = [
            'message' => 'Detail data with id',
            'data' => $thread
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // get data for updated
        $thread = Thread::findOrFail($id);

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
            $thread->update($request->all());

            $response = [
                'message' => 'Thread Updated.',
                'data' => $thread
            ];

            return response()->json($response, Response::HTTP_OK);

        } catch(QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get data berdasarkan id
        $thread = Thread::findOrFail($id);

        try {
            // data tersebut dilakukan delete
            $thread->delete();

            // siapkan response
            $response = [
                'message' => 'Deleted data success.'
            ];

            // kembalikan response
            return response()->json($response, Response::HTTP_OK);

        } catch(QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }

    }
}
