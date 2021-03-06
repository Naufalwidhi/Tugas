<?php

namespace App\Http\Controllers;

use App\Models\data;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\http\Request;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    public function index(){
        return data::all();
    }

    public function test(){
        return response()->json([
            'date' => Carbon::now(),
            'timezone_type' => '3',
            'timezone' => 'UTC'
        ]);
    }

    public function useradd(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'password' => 'required'
        ]);

        $data = data::create(
            $request->only(['nama', 'password'])
        );

        return response()->json([
            'created' => true,
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id){
        try {
            $data = data::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $data->fill(
            $request->only(['nama', 'password'])
        );
        $data->save();

        return response()->json([
            'updated' => true,
            'data' => $data
        ], 200);
    }

    public function userdestroy($id){
        try {
            $data = data::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                'message' => 'user not found'
                ]
            ], 404);
        }
        $data->delete();
        return response()->json([
            'deleted' => true
        ], 200);
    }

}
