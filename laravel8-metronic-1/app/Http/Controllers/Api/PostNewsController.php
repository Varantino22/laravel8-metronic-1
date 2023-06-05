<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\News_model;
use Illuminate\Support\Facades\Validator;

class PostNewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function Index(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'product_id' =>  $request->product_id,
        // ]);

        try 
        {
        //save to database
            $post = News_model::create([
                'title'=>$request->title,
                'short_desc'=>$request->short_desc,
                'text'=>$request->text,
                'type'=>$request->type,
                'image'=>$request->image,
                'video'=>$request->video,
                'quote_text'=>$request->quote_text,
                'quote_author'=>$request->quote_author,
                'author'=>$request->author,
                'slug'=>$request->slug,
                'status'=>$request->status,
                'images_code'=>$request->images_code,
                'order'=>$request->order,
                'category_id'=>$request->category_id,
            ]);

            return response([
                "msg" => "success"
                ], 200);
        }
        catch (\Exception $e) 
        {
            return response([
                "msg" => "failed"
                ], 200);
        }
    }
}
