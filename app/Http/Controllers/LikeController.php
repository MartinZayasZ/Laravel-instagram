<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

//modelos
use App\Like;


class LikeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function like( $image_id ){

        // Datos del usuario e imagen
        $user = Auth::user();

        //Comprobar que el like ya existe
        $isset_like = Like::where([
            'user_id' => $user->id,
            'image_id' => $image_id
        ])->count();

        if( $isset_like ){

            return response()->json([
                'message' => 'El like ya existe'
            ]);
        }

        $like = new Like();
        $like->user_id = $user->id;
        $like->image_id = $image_id;

        //Guardar nuevo like
        $like->save();

        return response()->json([
            'like' => $like
        ]);


    }

    public function dislike( $image_id ){

        // Datos del usuario e imagen
        $user = Auth::user();

        //Comprobar que el like ya existe
        $like = Like::where([
            'user_id' => $user->id,
            'image_id' => $image_id
        ])->first();

        if( $like ){

            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'El like se ha eliminado correctamente!'
            ]);
        }

        return response()->json([
            'message' => 'el like no existe'
        ]);


    }

    public function likes(){
        $likes = Like::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);

        return view('like.likes', [
            'likes' => $likes
        ]);
    }

}
