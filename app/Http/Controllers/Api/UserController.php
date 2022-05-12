<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;


class UserController extends Controller
{
    public function index()
    {
        // $user = User::With('seksi')->Latest()->get();
        $user = User::With('seksi')->Latest()->get();
        // return response()->json($user, 200);
        return  UserResource::collection($user);
    }

    public function show($id)

    {

        $user = User::whereId($id)->first();
            
            if ($user) 
            {
                return new UserResource($user, Response::HTTP_OK);
            } 
                
            else 
            {    
                return response()->json([
                'success' => false,
                'message' => 'User Tidak Ditemukan!'], Response::HTTP_NOT_FOUND);      
            }
    }
}
