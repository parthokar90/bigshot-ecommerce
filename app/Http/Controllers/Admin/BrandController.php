<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Session;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(Request $request)
    {
        
       $extraInfo=array(
            'title'=>"Brand List",
            'page'=>'brand'
        );
        $q=$request->brand;
        if($q==''){
            $brands=DB::table('term_taxonomy')
            ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
            ->leftJoin('ecommerce_termmeta', 'ecommerce_termmeta.ecommerce_term_id', '=', 'terms.term_id')
            ->leftJoin('postmeta', 'ecommerce_termmeta.meta_value', '=', 'postmeta.post_id')
            ->where('term_taxonomy.taxonomy','product_brand')
            ->select('term_taxonomy.*','terms.name','terms.status','postmeta.meta_value as image')
            ->orderBy('term_taxonomy.term_taxonomy_id','desc')
            ->paginate(50); 
        }else{
            $brands=DB::table('term_taxonomy')
            ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
            ->leftJoin('ecommerce_termmeta', 'ecommerce_termmeta.ecommerce_term_id', '=', 'terms.term_id')
            ->leftJoin('postmeta', 'ecommerce_termmeta.meta_value', '=', 'postmeta.post_id')
            ->where('term_taxonomy.taxonomy','product_brand')
            ->where('terms.name', 'like', '%' .$q. '%')
            ->select('term_taxonomy.*', 'terms.name', 'terms.status', 'postmeta.meta_value as image')
            ->orderBy('term_taxonomy.term_taxonomy_id','desc')
            ->paginate(50);  
        }
        return view('admin.brand.list',compact('brands'))->with($extraInfo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $this->validate($request,[
            'brandName'=>'required|min:3',
            ]);    
           $termInfo=array(
               'name'=>$request->brandName,
               'status'=>$request->status,
               'slug'=>Str::slug($request->brandName)
           );
           $term=DB::table('terms')->insertGetId($termInfo);
           $termTexonomyInfo=array(
               'term_id'=>$term,
               'taxonomy'=>'product_brand',
               'description'=>'',
           );
           $termTaxonomoy=DB::table('term_taxonomy')->insert($termTexonomyInfo);
          // image uplaod code
           if($request->hasFile('image')){
           $image_name = time().'.'.$request->image->getClientOriginalExtension();
           $request->image->move(('assets/admin/brand'), $image_name);
           // insert into posts table
           $postInfo=array(
                'post_date'=>date('Y-m-d H:i:s'),
                'post_date_gmt'=>date('Y-m-d H:i:s',strtotime('6 hour')),
                'post_modified'=>date('Y-m-d H:i:s'),
                'post_modified_gmt'=>date('Y-m-d H:i:s',strtotime('6 hour')),
                'post_title'=>$request->brandName,
                'post_status'=>'inherit',
                'post_name'=>$request->brandName,
                'post_type'=>'attachment',
                'post_content'=>'',
                'post_excerpt'=>'',
                'to_ping'=>'',
                'pinged'=>'',
                'post_content_filtered'=>'',
           );
           $post_id=DB::table('posts')->insertGetId($postInfo);
           // insert into postmeta Table
           $postMetaInfo=array(
            'post_id'=>$post_id,
            'meta_key'=>'attached_file',
            'meta_value'=>$image_name,
            );
            DB::table('postmeta')->insert($postMetaInfo);

            // now insert into ecommerce_termmeta table
            $treamMetaInfo=array(
                'ecommerce_term_id'=>$term,
                'meta_key'=>'thumbnail_id',
                'meta_value'=>$post_id,
                );
                DB::table('ecommerce_termmeta')->insertGetId($treamMetaInfo);
           }

           session()->flash("success","Information saved Successfully");
           return redirect(route('brand.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $extraInfo=array(
            'title'=>"Brand Edit",
            'page'=>'band'
        );

        $brand=DB::table('terms')
        ->join('term_taxonomy', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->leftJoin('ecommerce_termmeta', 'ecommerce_termmeta.ecommerce_term_id', '=', 'terms.term_id')
        ->leftJoin('postmeta', 'ecommerce_termmeta.meta_value', '=', 'postmeta.post_id')
        ->select('terms.*', 'postmeta.meta_value as image')
        ->where('terms.term_id',$id)
        ->first();
  
        
        
        $brands=DB::table('term_taxonomy')
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->leftJoin('ecommerce_termmeta', 'ecommerce_termmeta.ecommerce_term_id', '=', 'terms.term_id')
        ->leftJoin('postmeta', 'ecommerce_termmeta.meta_value', '=', 'postmeta.post_id')
        ->where('term_taxonomy.taxonomy','product_brand')
        ->select('term_taxonomy.*','terms.name','terms.status','ecommerce_termmeta.meta_value','postmeta.meta_value as image')
        ->orderBy('term_taxonomy.term_taxonomy_id','desc')
        ->paginate(5); 
                
        return view('admin.brand.list',compact('brands','brand'))->with($extraInfo);
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
        $this->validate($request,[
            'brandName'=>'required|min:3',
        ]);    
           $termInfo=array(
               'name'=>$request->brandName,
               'status'=>$request->status,
               'slug'=>Str::slug($request->brandName)
           );
           $term=DB::table('terms')
           ->where('term_id',$id)
           ->update($termInfo);
           // image uplaod code
           if($request->hasFile('image')){
            // remove old image   
            if(file_exists('assets/admin/brand/'.$request->oldImage)){  
                if($request->oldImage!=null):      
                unlink('assets/admin/brand/'.$request->oldImage);
                endif;
            }
            // retrive post id form table ecommerce termmeta
            $etermmeta=DB::table('ecommerce_termmeta')
            ->where('ecommerce_term_id',$id)            
            ->where('meta_key','thumbnail_id')
            ->first();
            $image_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(('assets/admin/brand/'), $image_name);
            // update postmeta Table
             
           if($request->oldImage!=null && $etermmeta !=null){            

             $result=DB::table('ecommerce_termmeta')
             ->where('ecommerce_term_id',$id)                     
             ->update(['meta_value'=>$image_name]);            
           }
           else{
                $postMetaInfo=array(
                'meta_value'=>$image_name,
                'ecommerce_term_id'=>$id,
                'meta_key'=>'attached_file'
             );               
            $result= DB::table('ecommerce_termmeta')->insert($postMetaInfo);
          
           }    
        }
        session()->flash("success","Information Update Successfully");
        return redirect(route('brand.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}