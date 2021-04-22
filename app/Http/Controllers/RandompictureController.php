<?php
namespace App\Http\Controllers;
use App\Randompicture;
use App\User;

use Illuminate\Http\Request;


class RandompictureController extends Controller
{
    public function randomimg()
    {
        
        $random = Carbon(Randompicture::all());
       // return response()->json($random,200);
       //return response(Randompik::all(),200);
       return $random;
    }
    
    public function randomuser()
    {
        
        $random = Carbon(User::select('id','name','age','stage','favorite','readytodrink')->where('alko',1)->get());
       // return response()->json($random,200);
       //return response(Randompik::all(),200);
       return $random;
    }
// Table::select('name','surname')->where('id', 1)->get();
}