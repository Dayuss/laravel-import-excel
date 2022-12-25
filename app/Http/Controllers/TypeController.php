<?php

namespace App\Http\Controllers;

use App\Imports\TypeImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class TypeController extends Controller
{
    public function import(Request $request){
        $validator = Validator::make($request->all(), [
			'file' => 'required|mimes:xls,xlsx'
        ]);
        if ($validator->fails()) 
            return response()->json($validator->errors()->all());
        try{
            Excel::import(new TypeImport, $request->file('file'));
            return response()->json([ 'status' => 'Success' ]);
        }catch (\Maatwebsite\Excel\Validators\ValidationException $failures){
            return response()->json([ 
                'status' => 'Failed', 
                'data' => [],
                'message' => $failures->errors() 
            ]);

        }

    }
}
