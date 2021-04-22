<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
use App\Subscribe;
use App\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;

use Mail;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
    	$subscribes = DB::table('subscribes')->where(
    		[
    			['subscribes.author_id','=',$user->id]
    		]
    		)
    		
       ->select('subscribes.*')
       ->orderBy('updated_at', 'desc')
       ->get();
       
       /*
       if ($subscribes->count() !== 0) {
       		return response()->json($subscribes, 200);
       } else {
       	return response()->json([]);
       }*/
       return response()->json($subscribes, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Subscribe $subscribe)
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
	    
	    $count = 0;
	    $arr = $request->all();

	    
	    for ($i = 0; $i < count($arr); $i++) {
	    $count = $count+1;
	       $sub = Subscribe::where(
	    [	
	      	['author_id','=',$arr[$i]['author_id'] ]
	    	,['category_id','=',$arr[$i]['category_id'] ]
	    	,['city_id','=',$arr[$i]['city_id'] ]
	    	,['type','=',$arr[$i]['type'] ]
    	]
	    )->first();
	   
	   if ($sub === NULL) {
	   	  Subscribe::Create(  
	    	['category_id' => $arr[$i]['category_id'],
	    	'city_id' =>  $arr[$i]['city_id'],
	    	'type' => $arr[$i]['type'],
	    	'author_id' => $arr[$i]['author_id']
	    	]   );
	    	$response = 'Подписка оформлена!';
	    	
	   } else {
	   		$response = 'Подписка уже была оформлена ранее!';
	   }
			}
		$data = DB::table('subscribes')->where(
    		[
    			['subscribes.author_id','=',$arr[0]['author_id']]
    		]
    		)
    		
       ->select('subscribes.*')
       // ->orderBy('updated_at', 'desc')
       ->get();

        return response()->json(['res'=>'OK','msg'=>$response, 'data' => $data  ], 200); 
    }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        	$subscribes = DB::table('subscribes')->where(
    		[
    			['subscribes.author_id','=',$id]
    		]
    		)
    		
       ->select('subscribes.*')
       ->orderBy('updated_at', 'desc')
       ->get();
       
       
       if ($subscribes->count() !== 0) {
       		return response()->json($subscribes, 200);
       } else {
       	return response()->json([]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscribe $subscribe)
    {
        $subscribe->delete();

        return response()->json(null, 204);
    }
}
