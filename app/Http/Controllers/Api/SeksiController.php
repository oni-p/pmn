<?php

namespace App\Http\Controllers\Api;

use App\Models\Seksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SeksiResource;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class SeksiController extends Controller
{

    public function index()
    {
        $seksi = Seksi::With('departemen')->Latest()->get();
        return  SeksiResource::collection($seksi);
    }
    
   public function store(Request $request)
   {

            $validator = Validator::make($request->all(), [
                'seksi' => 'required|unique:seksis',
            ]);    

            if ($validator->fails()) {
                return response()->json(
                    $validator->errors(),
                    Response::HTTP_UNPROCESSABLE_ENTITY
                 );
            }

            else{

                $seksi = Seksi::create([
    	        'seksi'=>$request->seksi,
                ]);
                
                $seksi->save();
                return response()->json( 'Data Berhasil Disimpan', Response::HTTP_OK);
            }

      
    }

    public function show($id)
    {
        $seksi = Seksi::whereId($id)->first();
        // $seksi = Seksi::findOrFail($id);

        if ($seksi) {

            return new SeksiResource($seksi, Response::HTTP_OK);
           
        } 
        else {
            return response()->json([
                'success' => false,
                'message' => 'Seksi Tidak Ditemukan!',
                
            ], Response::HTTP_NOT_FOUND);
      
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'seksi'=>'required|unique:seksis'
        ]);

        $seksi = Seksi::findOrFail($id);
 
        if($validator->fails())
        {     
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
       
        else {
           $seksi->update($request->all());

           
           $response = [
               'message'=>'seksi sudah diupdate',
               'data'=>$seksi
           ];
        
           return new SeksiResource($seksi, Response::HTTP_OK);
        
                   
        }   
    }
             

    public function destroy($id)
    {
    $seksi = Seksi::findOrFail($id);
    $seksi->delete();
    }

    
}
