<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\News_model;
use Illuminate\Support\Facades\Validator;

class GetNewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function Index()
    {
        $news = [];
        $response =  DB::select('select * from news');
        for ($v = 0; $v < count($response); $v++) {
            $res_news = $response[$v];
            array_push($news, $res_news);
        }
        return response([
            "data" => $response,
            "msg" => "success"
        ], 200);
      
    }
}
