<?php
echo "CRUD GENERATOR LARAVEL";
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$base_url = "localhost"; // default must be ""
$img_folder = "img";

$filename = "test.php";

$actualpath = "C:/laragon/www/laravel8-metronic-1/public/crud-generator/";
#DEFINISIKAN NAMA USECASE YANG AKAN DIBUAT SEBAGAI NAMA FOLDER DAN CONTROLLER
$USE_CASE = "Menumakanan";
$domain = $actualpath . $USE_CASE . '/';
$controller_PATH = $domain . "controller/";
$model_PATH = $domain . "model/";
$view_PATH = $domain . "view/";


#CREATE FOLDER
mkdir($domain, 0777, true);
mkdir($controller_PATH, 0777, true);
mkdir($model_PATH, 0777, true);
mkdir($view_PATH, 0777, true);


#VALUE CONTENT CONTROLLER
$content_controller = '<?php
namespace App\Http\Controllers\Back;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\\'.$USE_CASE.';
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class '.$USE_CASE.'Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $data = User::orderBy("id","DESC")->get();
        $roles = Role::pluck("name","name")->all();
        return view("back.users.index",compact("data","roles"))
            ->with("i", ($request->input("page", 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $roles = Role::pluck("name","name")->all();
        return view("back.users.create",compact("roles"));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|same:confirm-password",
            "roles" => "required"
        ]);

        $input = $request->all();
        $input["password"] = Hash::make($input["password"]);
        $user = User::create($input);
        $user->assignRole($request->input("roles"));

        return redirect()->route("users.index")
        ->with("success","User created successfully");

    }


    /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

        public function show($id)
        {
            $user = User::find($id);
            return view("back.users.show",compact("user"));
        }

        

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

        public function edit($id)
        {
            $user = User::find($id);
            $roles = Role::pluck("name","name")->all();
            $userRole = $user->roles->pluck("name","name")->all();
            return view("back.users.edit",compact("user","roles","userRole"));
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
        
            $this->validate($request, [
                "name" => "required",
                // "email" => "required|email|unique:users,email,".$id,
                "password" => "same:confirm-password",
                // "roles" => "required"
                "file" => "max:2048",
            ]);

            if ($request->hasfile("avatar")) {
                $fileName = time() . rand(1, 100) . '.' . $request->file("avatar")->extension();
                $file = $request->file("avatar");
                $file->move(public_path("images/users"), $fileName);
                dump("images");
            }

            $input = $request->all();
            if(!empty($input["password"])){ 
                $input["password"] = Hash::make($input["password"]);
            }else{
                $input = Arr::except($input,array("password"));    
            }

            if(!empty($fileName)){ 
                $input["image"] = $fileName;
            }else{
                $input["image"] = "";
            }
            
            $user = User::find($id);
            $user->update($input);

            DB::table("model_has_roles")->where("model_id",$id)->delete();
            $user->assignRole($request->input("roles"));

            return redirect()->route("users.index")
            ->with("success","User updated successfully");

        }

        
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

        public function destroy($id)
        {
            dd("hapus");
            User::find($id)->delete();
            return redirect()->route("back.users.index")
            ->with("success","User deleted successfully");

        }
    }

?>';


    $mycontroller = fopen($controller_PATH.$USE_CASE."Controller.php", "w");
    if (!$mycontroller){
        echo "cannot write file";
    } else {
        fwrite($mycontroller, $content_controller);
        fclose($mycontroller);
        chmod($path . $USE_CASE."Controller.php", 0777); 
        echo "<p>Success writing controller file to server</p>";
    }

    $mymodel = fopen($model_PATH.$USE_CASE."_model.php", "w");
    if (!$mymodel){
        echo "cannot write file";
    } else {
        fwrite($mymodel, $data);
        fclose($mymodel);
        chmod($path . $USE_CASE."_model.php", 0777); 
        echo "<p>Success writing model file to server</p>";
    }

    $myviewindex = fopen($view_PATH."index.blade.php", "w");
    if (!$myviewindex){
        echo "cannot write file";
    } else {
        fwrite($myviewindex, $data);
        fclose($myviewindex);
        chmod($path ."index.blade.php", 0777); 
        echo "<p>Success writing view index file to server</p>";
    }

    $myviewshow = fopen($view_PATH."show.blade.php", "w");
    if (!$myviewshow){
        echo "cannot write file";
    } else {
        fwrite($myviewshow, $data);
        fclose($myviewshow);
        chmod($path ."show.blade.php", 0777); 
        echo "<p>Success writing view show file to server</p>";
    }

    $myviewcreate = fopen($view_PATH."create.blade.php", "w");
    if (!$myviewcreate){
        echo "cannot write file";
    } else {
        fwrite($myviewcreate, $data);
        fclose($myviewcreate);
        chmod($path ."create.blade.php", 0777); 
        echo "<p>Success writing view create file to server</p>";
    }

    $myviewedit = fopen($view_PATH."edit.blade.php", "w");
    if (!$myviewedit){
        echo "cannot write file";
    } else {
        fwrite($myviewedit, $data);
        fclose($myviewedit);
        chmod($path ."edit.blade.php", 0777); 
        echo "<p>Success writing view edit file to server</p>";
    }


?>