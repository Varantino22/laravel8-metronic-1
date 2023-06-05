<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\News_model;
use Illuminate\Support\Facades\Validator;

class DeleteNewsController extends Controller
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
             $update->deleted = true;
     
             try {
                 $update->save();
                 return response("Your data sucessfully deleted");
             } catch (\Throwable $th) {
                 return response("ERROR deleted data " . $th->getMessage(), 400);
             }

      
    }
}
