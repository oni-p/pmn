<?php

namespace App\Http\Controllers\Api;

use App\Models\Departemen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\DepartemenResource;
use Illuminate\Http\Response;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departemen = Departemen::Latest()->get();
        return  DepartemenResource::collection($departemen);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'departemen' => 'required|unique:departemens',
        ]);    

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                Response::HTTP_UNPROCESSABLE_ENTITY
             );
        }

        else{

            $departemen = Departemen::create([
            'departemen'=>$request->departemen,
            ]);
            
            $departemen->save();
            return response()->json( 'Data Berhasil Disimpan', Response::HTTP_OK);
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
        $departemen = Departemen::whereId($id)->first();
        

        if ($departemen) {

            return new DepartemenResource($departemen, Response::HTTP_OK);
           
        } 
        else {
            return response()->json([
                'success' => false,
                'message' => 'Departemen Tidak Ditemukan!',
                
            ], Response::HTTP_NOT_FOUND);
      
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        
        $validator = Validator::make($request->all(),[
            'departemen'=>'required|unique:departemens'
        ]);

        $departemen = Departemen::findOrFail($id);
 
        if($validator->fails())
        {     
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
       
        else {
            
           $departemen->update($request->all());
           $response = [
               'message'=>'departemen sudah diupdate',
               'data'=>$departemen
           ];

           return new DepartemenResource($departemen, Response::HTTP_OK);
                   
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
        //
    }
}
