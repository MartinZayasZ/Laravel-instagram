<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

//modelos
use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function config(){
        return view('user.config');
    }

    public function update(Request $request){

        //identificar el usuario a modificar
        $user = Auth::user();
        $id = $user->id;

        //validación del form
        $validate = $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', "unique:users,nick,$id"],
            'email' => ['required', 'string', 'max:255', "unique:users,email,$id"]
        ]);

        //datos del form
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //asignar nuevos valores al objeto user
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir la imagen
        $image_path = $request->file('image_path');

        if( $image_path ){
            $image_path_name = time() . $image_path->getClientOriginalName();

            //guardamos en el storage la imagen y le damos un nombre
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //ya solo agregamos el nombre de la imagen en el campo del usuario
            $user->image = $image_path_name;
        }

        // Ejecutar consulta y cambios en la DB
        $user->update();

        return redirect()->route('config')
                            ->with(['message' => 'Usuario actualizado!']);

    }

    public function getImage( $filename ){
        $file = Storage::disk('users')->get( $filename );
        return new Response($file, 200);
    }

    public function profile( $id ){

        $user =  User::find( $id );

        return view('user.profile',[
            'user' => $user
        ]);

    }

    public function users( $search = null ){

        if( $search ){
            $users = User::where('nick', 'LIKE', "%$search%")
                            ->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('surname', 'LIKE', "%$search%")
                            ->orderBy('id', 'desc')
                            ->paginate(5);

        }else{
            $users = User::orderBy('id', 'desc')->paginate(5);
        }


        return view('user.index', [
            'users' => $users
        ]);

    }

}
