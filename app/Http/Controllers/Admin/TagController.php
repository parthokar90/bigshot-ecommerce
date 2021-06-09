<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Session;
use Illuminate\Support\Str;


class TagController extends Controller
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
     if($request->user()->can('manage-tag')) {
      $extraInfo=array(
            'title'=>"Tag List",
            'page'=>'tag'
        );
        $q=$request->tag;
        if($q==''){
            $tags=DB::table('term_taxonomy')
            ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
            ->where('term_taxonomy.taxonomy','product_tag')
            ->select('term_taxonomy.*','terms.name','terms.status')
            ->orderBy('term_taxonomy.term_taxonomy_id','desc')
            ->paginate(50);  
        }else{
            $tags=DB::table('term_taxonomy')
            ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
            ->where('term_taxonomy.taxonomy','product_tag')
            ->where('terms.name', 'like', '%' .$q. '%')
            ->select('term_taxonomy.*','terms.name','terms.status')
            ->orderBy('term_taxonomy.term_taxonomy_id','desc')
            ->paginate(50); 
        }            
        return view('admin.tag.list',compact('tags'))->with($extraInfo);
      }
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
         if($request->user()->can('manage-tag')) {
       $this->validate($request,[
        'tagName'=>'required|min:3',
        ]);    
       $termInfo=array(
           'name'=>$request->tagName,
           'status'=>$request->status,
           'slug'=>Str::slug($request->tagName)
       );
       $term=DB::table('terms')->insertGetId($termInfo);

       $termTexonomyInfo=array(
           'term_id'=>$term,
           'taxonomy'=>'product_tag',
           'description'=>'',
       );
       $term=DB::table('term_taxonomy')->insert($termTexonomyInfo);
       session()->flash("success","Information saved Successfully");
       return redirect(route('tag.index'));
      }
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
    public function edit($id,Request $request)
    {
         if($request->user()->can('manage-tag')) {
         $extraInfo=array(
            'title'=>"Tag Edit",
            'page'=>'tag'
        );

        $tag=DB::table('terms')
        ->where('term_id',$id)
        ->first();
        
        $tags=DB::table('term_taxonomy')
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->where('term_taxonomy.taxonomy','product_tag')
        ->select('term_taxonomy.*','terms.name','terms.status')
        ->orderBy('term_taxonomy.term_taxonomy_id','desc')
        ->paginate(10);
        return view('admin.tag.list',compact('tags','tag'))->with($extraInfo);
      }
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
         if($request->user()->can('manage-tag')) {
         $this->validate($request,[
            'tagName'=>'required|min:3',
        ]);    
           $termInfo=array(
               'name'=>$request->tagName,
               'status'=>$request->status,
               'slug'=>Str::slug($request->tagName)
           );
           $term=DB::table('terms')
           ->where('term_id',$id)
           ->update($termInfo);
           session()->flash("success","Information Update Successfully");
           return redirect(route('tag.index'));
        }
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
