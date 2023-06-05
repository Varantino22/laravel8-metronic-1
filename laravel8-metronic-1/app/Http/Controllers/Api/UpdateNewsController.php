<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\News_model;
use Illuminate\Support\Facades\Validator;

class UpdateNewsController extends Controller
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
             #update member
             $update = News_model::where('id', $request->id)->first();
             $update->title = $request->title;
             $update->short_desc = $request->short_desc;
             $update->text = $request->text;
             $update->type = $request->type;
             $update->image = $request->image;
             $update->video = $request->video;
             $update->quote_text = $request->quote_text;
             $update->quote_author = $request->quote_author;
             $update->author = $request->author;
             $update->slug = $request->slug;
             $update->status = $request->status;
             $update->images_code = $request->images_code;
             $update->order = $request->order;
             $update->category_id = $request->category_id;
     
             try {
                 $update->save();
                 return response("Your member data sucessfully updated");
             } catch (\Throwable $th) {
                 return response("ERROR update member data " . $th->getMessage(), 400);
             }

      
    }
}
