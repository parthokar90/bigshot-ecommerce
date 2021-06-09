<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\admin\attribute_taxonomie;
use DB;
use Session;
use Illuminate\Support\Str;

class AttributeController extends Controller
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
          if($request->user()->can('manage-attribute')) {
        $extraInfo=array(
            'title'=>"Attribute List",
            'page'=>'attribute'
        );
        $q=$request->attribute;
        if($q==''){
            $attributes=attribute_taxonomie::paginate(50); 
        }else{
            $attributes=attribute_taxonomie::where('attribute_name', 'like', '%' .$q. '%')->paginate(50);
        }
              
        return view('admin.attribute.list',compact('attributes'))->with($extraInfo);
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
          if($request->user()->can('manage-attribute')) {
        $this->validate($request,[
            'attribute_name'=>'required|min:3',
            ]);    
           $attribute= new attribute_taxonomie;
           $attribute->attribute_name=$request->attribute_name;
           $attribute->status=$request->status;
           $attribute->attribute_label=Str::slug($request->attribute_name);
           $attribute->attribute_type='select';
           $attribute->attribute_orderby='menu_order';
           $attribute->save();
           session()->flash("success","Information saved Successfully");
           return redirect(route('attribute.index'));
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
          if($request->user()->can('manage-attribute')) {
        $extraInfo=array(
            'title'=>"Attribute List",
            'page'=>'attribute'
        );
        $attribute=attribute_taxonomie::where('attribute_id',$id)->first();

        $attributes=attribute_taxonomie::paginate(5);        
        return view('admin.attribute.list',compact('attributes','attribute'))->with($extraInfo);
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
          if($request->user()->can('manage-attribute')) {
        $this->validate($request,[
            'attribute_name'=>'required|min:3',
            ]);    

            $info=array(
                'attribute_name'=>$request->attribute_name,
                'status'=>$request->status,
                'attribute_label'=>Str::slug($request->attribute_name),
                'attribute_type'=>'select',
                'attribute_orderby'=>'menu_order'
            );

            DB::table('attribute_taxonomies')
              ->where('attribute_id', $id)
              ->update($info);

           session()->flash("success","Information saved Successfully");
           return redirect(route('attribute.index'));
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

    public function attributeValue($id,Request $request){
          if($request->user()->can('manage-attribute')) {
        $extraInfo=array(
            'title'=>"Attribute value List",
            'page'=>'attribute'
        );

        $attribute=attribute_taxonomie::where('attribute_id',$id)->first();
        $attributeValues=DB::table('term_taxonomy')
            ->join('terms','terms.term_id','=','term_taxonomy.term_id')
            ->where('taxonomy',$attribute->attribute_label)
            ->paginate(3);     
            return view('admin.attribute.valueList',compact('attribute','attributeValues'))->with($extraInfo);
    }
    }

    public function attributeValueSave(Request $request)
    {
          if($request->user()->can('manage-attribute')) {
        $attribute=attribute_taxonomie::where('attribute_id',$request->attribute_id)->first();
        $term_info=array(
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'status'=>1,
            'createdDate'=>date('Y-m-d H:i:s')
        );
       $term_id=DB::table('terms')->insertGetId($term_info);
       $taxonomy=array(
        'term_id'=>$term_id,
        'taxonomy'=>$attribute->attribute_label,
        'description'=>'',
        'createdDate'=>date('Y-m-d H:i:s')
       );
       $texonomy_id=DB::table('term_taxonomy')->insert($taxonomy);
       session()->flash("success","Information saved Successfully");
       return redirect(route('attribute.attributeValue',$attribute->attribute_id));  
    }     
    }

    public function attributeValueEdit($id,Request $request){
          if($request->user()->can('manage-attribute')) {
        $extraInfo=array(
            'title'=>"Attribute value List",
            'page'=>'attribute'
        );

        $attriValue=DB::table('terms')
        ->where('term_id',$id)
        ->first();
        
        $taxonomy=DB::table('term_taxonomy')
        ->where('term_id',$id)
        ->first();

        $attributeValues=DB::table('term_taxonomy')
        ->join('terms','terms.term_id','=','term_taxonomy.term_id')
        ->where('taxonomy',$taxonomy->taxonomy)
        ->paginate(3); 

        return view('admin.attribute.valueList',compact('attriValue','attributeValues'))->with($extraInfo);
    }
    }

    public function attributeValueUpdate(Request $request, $id){
          if($request->user()->can('manage-attribute')) {
        $term_info=array(
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'status'=>$request->status            
        );
       $term_id=DB::table('terms')
       ->where('term_id',$id)
       ->update($term_info);

       // find the texonomy
       $taxonomy=DB::table('term_taxonomy')
        ->where('term_id',$id)
        ->first();
        
        $label=Str::after($taxonomy->taxonomy,'');
        
        // get attribute id 
        $attribute=DB::table('attribute_taxonomies')
        ->where('attribute_label',$label)
        ->first();
       session()->flash("success","Information update Successfully");
       return redirect(route('attribute.attributeValue',$attribute->attribute_id));   
    } 
    }
}
