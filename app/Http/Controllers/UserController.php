<?php
namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        //return Article::all();
        //$article = User::orderBy('updated_at', 'desc')->get();
        //return  response()->json($article, 200);
        $user = User::select('name', 'email', 'type', 'id', 'created_at', 'updated_at')
        ->where('type', '!=', 'admin')
        ->orderBy('created_at', 'desc')
        ->get();

         return response()->json($user , 200);
    }

    public function show($user)
    {
        
        $users = User::select('name', 'email', 'type', 'id', 'created_at', 'updated_at')->where('id', $user)->get();
       // $users = User::find($user);
        
        return response()->json($users[0], 200);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 200);
    }
    
    public function add(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 200);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
    
    public function user($id) {
    	$user = User::all()->where('id', $id);
    	return response()->json($user, 200);
    }
}