<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function save(Request $request){

        $this->validate($request,[
            'image_id' => ['integer', 'required'],
            'content' => ['string', 'required']
        ]);

        $image_id = $request->input('image_id');
        $content = $request->input('content');
        $user = Auth::user();

        $comment = new Comment();
        $comment->image_id = $image_id;
        $comment->user_id = $user->id;
        $comment->content = $content;

        $comment->save();

        return redirect()->route('image.detail', ['id' =>  $image_id])->with([
            'message' => 'Se ha agregado un nuevo comentario!!'
        ]);

    }

}
