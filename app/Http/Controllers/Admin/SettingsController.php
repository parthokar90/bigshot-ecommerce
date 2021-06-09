<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        if($request->user()->can('manage-settings')) {
       $extraInfo=array(
        'title'=>"District List",
        'page'=>'settings'
      );
     $district=DB::table('term_taxonomy')->where('taxonomy','district')
        ->join('terms','terms.term_id','=', 'term_taxonomy.term_id')
        ->select('terms.term_id','terms.name as district')
        ->get();
      return view('settings.district',compact('district'))->with($extraInfo);  
    }
    }

    public function districtStore(Request $request){
       $terms=DB::table('terms')->insert([
         'name' =>$request->district,
         'slug' =>lcfirst($request->district),
         'term_group' =>0,
         'status' =>1,
       ]);
       $id=DB::getPdo()->lastInsertId();
       DB::table('term_taxonomy')->insert([
         'taxonomy' =>'district',
         'description' =>$request->delivery_charge,
         'term_id' =>$id,
         'parent' =>0, 
       ]);
       session()->flash("success","Information saved Successfully");
       return back();
    }

    public function thanaStore(Request $request){
       DB::table('terms')->insert([
         'name' =>$request->thana,
         'slug' =>lcfirst($request->thana),
         'term_group' =>0,
         'status' =>1,
       ]);
      $term_id=DB::getPdo()->lastInsertId();
      DB::table('term_taxonomy')->insert([
         'taxonomy' =>'city',
         'term_id' =>$term_id,
         'parent' =>$request->dist_id, 
       ]); 
       DB::table('term_taxonomy')->insert([
         'taxonomy' =>'postcode',
         'term_id' =>$term_id,
         'parent' =>$term_id, 
         'description' =>$request->postcode, 
       ]);
       session()->flash("success","Information saved Successfully");
       return back();
    }

    public function districtEdit($id){
       $extraInfo=array(
        'title'=>"District Edit",
        'page'=>'settings'
      );
        $district=DB::table('term_taxonomy')->where('taxonomy','district')
        ->join('terms','terms.term_id','=', 'term_taxonomy.term_id')
        ->select('terms.term_id','terms.name as district')
        ->get();
         $dist_name=DB::table('terms')->where('term_id',$id)->first();
         $delivery_charge=DB::table('term_taxonomy')->where('term_id',$id)->where('taxonomy','district')->first();
         return view('settings.district_edit',compact('district','dist_name','delivery_charge'))->with($extraInfo);
    }

    public function districtUpdate(Request $request,$id){
       DB::table('terms')->where('term_id',$id)->update([
         'name' =>$request->district,
         'slug' =>lcfirst($request->district),
       ]);
       DB::table('term_taxonomy')->where('term_id',$id)->where('taxonomy','district')->update([
          'description' =>$request->delivery_charge,
       ]);
       session()->flash("success","Information update Successfully");
       return back();
    }

    public function thanaEdit($dist_id,$thana_id){
           $extraInfo=array(
        'title'=>"Thana Edit",
        'page'=>'settings'
      );
       $district=DB::table('term_taxonomy')->where('taxonomy','district')
        ->join('terms','terms.term_id','=', 'term_taxonomy.term_id')
        ->select('terms.term_id','terms.name as district')
        ->get();
         $thana=DB::table('terms')->where('term_id',$thana_id)->first();
         $postcode=DB::table('term_taxonomy')->where(['taxonomy'=>'postcode','term_id'=>$thana_id])->first();
         $dist_name=DB::table('terms')->where('term_id',$dist_id)->first();
         $delivery_charge=DB::table('term_taxonomy')->where('term_id',$dist_id)->where('taxonomy','district')->first();
         return view('settings.thana_edit',compact('district','thana','postcode','dist_name','delivery_charge'))->with($extraInfo);
    }

    public function districtThanaPostcodeUpdate(Request $request,$thana_id){
       DB::table('term_taxonomy')->where(['taxonomy'=>'postcode','term_id'=>$thana_id])->update([
         'description' =>$request->postcode,
       ]);
         DB::table('terms')->where(['term_id'=>$thana_id])->update([
         'name' =>$request->thana,
         'slug' =>lcfirst($request->thana),
       ]);
      session()->flash("success","Information update Successfully");
       return back();
    }

    public function databaseBackup(){
      // Database configuration
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database_name = env('DB_DATABASE');


        // Get connection object and set the charset
        $conn = mysqli_connect($host, $username, $password, $database_name);
        $conn->set_charset("utf8");


        // Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }

        $sqlScript = "";
        foreach ($tables as $table) {
            
            // Prepare SQLscript for creating table structure
            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);
            
            $sqlScript .= "\n\n" . $row[1] . ";\n\n";
            
            
            $query = "SELECT * FROM $table";
            $result = mysqli_query($conn, $query);
            
            $columnCount = mysqli_num_fields($result);
            
            // Prepare SQLscript for dumping data for each table
            for ($i = 0; $i < $columnCount; $i ++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sqlScript .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j ++) {
                        $row[$j] = $row[$j];
                        
                        if (isset($row[$j])) {
                            $sqlScript .= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript .= '""';
                        }
                        if ($j < ($columnCount - 1)) {
                            $sqlScript .= ',';
                        }
                    }
                    $sqlScript .= ");\n";
                }
            }
            
            $sqlScript .= "\n"; 
        }

        if(!empty($sqlScript))
        {
            // Save the SQL script to a backup file
            $backup_file_name = $database_name . '_backup_' . time() . '.sql';
            $fileHandler = fopen($backup_file_name, 'w+');
            $number_of_lines = fwrite($fileHandler, $sqlScript);
            fclose($fileHandler); 

            // Download the SQL backup file to the browser
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($backup_file_name));
            ob_clean();
            flush();
            readfile($backup_file_name);
            exec('rm ' . $backup_file_name); 
        }
    }
}
