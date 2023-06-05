<?php
        namespace App\Http\Controllers\Back\News;
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use App\Models\News;
        use DB;
        use Hash;
        use Illuminate\Support\Arr;

        class NewsController extends Controller
        {
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function index(Request $request)
            {
                $data = News::orderBy("id","DESC")->get();
                return view("back.News.index",compact("data"))
                    ->with("i", ($request->input("page", 1) - 1) * 5);
            }
        
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function create()
            {
                return view("back.News.create");
            }
        
        
        
            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
        
            public function store(Request $request)
            {
               
                    $this->validate($request, ["title" => "required",
"text" => "required",
"type" => "required",
]);
                $input = $request->all();
                
              if ($request->hasfile("image")) {
                $fileName = time() . rand(1, 100) . "." . $request->file("image")->extension();
                $file = $request->file("image");
                $file->move(public_path("images/News"), $fileName);
                dump("images");
            }
            if(!empty($fileName)){ 
                $input["image"] = $fileName;
            }else{
                $input["image"] = "";
            }
              
                
              if ($request->hasfile("file")) {
                $fileName = time() . rand(1, 100) . "." . $request->file("file")->extension();
                $file = $request->file("file");
                $file->move(public_path("files/News"), $fileName);
            }
            if(!empty($fileName)){ 
                $input["file"] = $fileName;
            }else{
                $input["file"] = "";
            }
              
                $News = News::create($input);
               
            
                return redirect()->route("news.index")
                ->with("success","News created successfully");
            
            }
        
        
            /**
                 * Display the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
        
                public function show($id)
                {
                    $News = News::find($id);
                    return view("back.News.show",compact("News"));
                }
            

            
                /**
                 * Show the form for editing the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function edit($id)
                {
                    $News = News::find($id);
                    return view("back.News.edit",compact("News"));
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
                
                   
                        $this->validate($request, ["title" => "required",
"text" => "required",
"type" => "required",
]);
                        

                    $input = $request->all();

                    
              if ($request->hasfile("image")) {
                $fileName = time() . rand(1, 100) . "." . $request->file("image")->extension();
                $file = $request->file("image");
                $file->move(public_path("images/News"), $fileName);
                dump("images");
            }
            if(!empty($fileName)){ 
                $input["image"] = $fileName;
            }else{
                $input["image"] = "";
            }
              
                    
              if ($request->hasfile("file")) {
                $fileName = time() . rand(1, 100) . "." . $request->file("file")->extension();
                $file = $request->file("file");
                $file->move(public_path("files/News"), $fileName);
            }
            if(!empty($fileName)){ 
                $input["file"] = $fileName;
            }else{
                $input["file"] = "";
            }
              
                    
                    $News = News::find($id);
                    $News->update($input);
                
                    return redirect()->route("news.index")
                    ->with("success","News updated successfully");
                
                }
            

                /**
                 * Remove the specified resource from storage.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function destroy($id)
                {
                    News::find($id)->delete();
                    return redirect()->route("news.index")
                    ->with("success","News deleted successfully");
                
                }
            }
        
        ?>