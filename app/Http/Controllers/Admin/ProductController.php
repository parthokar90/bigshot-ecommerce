<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Model\admin\attribute_taxonomie;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use DataTables;
use PDF;
use App\Model\front\Post;




class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
          if($request->user()->can('manage-product')) {
        $extraInfo=array(
            'title'=>"Product List",
            'page'=>'product'
        );
        if ($request->ajax()) {
            $data=DB::table('posts')
            ->where('posts.post_type','product')
            ->orderBy('ID','DESC')
            ->get(); 
            return Datatables::of($data)
            ->addIndexColumn()

            // ->addColumn('p_status', function($row){
            //     if($row->post_status=='unpublish') {
            //         $product_status='';
            //     }else{
            //        $product_status = '<span style="color:red">Publish</span>';
            //     }
            //     return  $product_status;
            //   })    

            ->addColumn('action', function($row){
                $btn = '<a class="btn btn-primary" title="Edit Product" href="'.route('product.edit',$row->ID).'"> <i class="fa fa-edit"></i> Edit</a> <a class="btn btn-warning" title="Generate Sku" href="'.route('generate.sku',$row->ID).'"> <i class="fa fa-edit"></i>Generate Sku</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);       
        }        
        return view('admin.product.list')->with($extraInfo);
      }
    }

    public function generateSku(Request $request,$id){
     if($request->user()->can('manage-product')) {
        $price=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'sale_price'])->first();
        $name=DB::table('posts')->where(['ID'=>$id])->first();
        $allAttribute = DB::table('posts')
        ->where('post_parent',$id)
        ->where('meta_key','attribute')
        ->join('postmeta','postmeta.post_id','=','posts.ID')
        ->select('post_id')
        ->get();
        $cate_name=DB::table('term_relationships')->where('object_id',$id)
        ->join('terms','terms.term_id','=','term_relationships.term_taxonomy_id')
        ->select('name')
        ->first();
    
         $sku=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'_sku'])->first();
         $pdf = PDF::loadView('admin.product.sku_download',array('price' =>$price,'name'=>$name,'allAttribute'=>$allAttribute,'sku'=>$sku,'id'=>$id,'cate_name'=>$cate_name));
         return $pdf->download('sku.pdf'); 

         
         //return view('admin.product.sku_download',array('price' =>$price,'name'=>$name,'allAttribute'=>$allAttribute,'sku'=>$sku,'id'=>$id));
      }
    }

    public function create(Request $request)
    {    
          if($request->user()->can('manage-product')) {   
            DB::table('temp_attribute_stock')->delete();    
        $extraInfo=array(
            'title'=>"New Product",
            'page'=>'product'
        );
        // categories
        $categories=DB::table('term_taxonomy')
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->where('term_taxonomy.taxonomy','product_cat')
        ->where('terms.status',1)
        ->select('term_taxonomy.*','terms.name','terms.status')
        ->get();   

        // tag
        $tags=DB::table('term_taxonomy')
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->where('term_taxonomy.taxonomy','product_tag')
        ->where('terms.status',1)
        ->select('term_taxonomy.*','terms.name','terms.status')
        ->get();          
        // attribute 

        $attributes=attribute_taxonomie::where('status',1)->get();
        return view('admin.product.create',compact('categories','tags','attributes'))->with($extraInfo);
    }
    }

    public function store(ProductStoreRequest $request){
  
        if($request->user()->can('manage-product')) {
        $year=$request->year;
        $month=$request->month;
        $day=$request->day;
        $H=$request->HH;
        $min=$request->min;
        $post_date=date('Y-m-d H:i:00',strtotime($year.'-'.$month.'-'.$day.' '.$H.':'.$min.':00'));
        $post_date_gmt=date('Y-m-d H:i:s',strtotime($post_date.'+6 hour'));
        $product=array(
            'post_title'=>$request->post_title,
            'post_name'=>$request->post_title,
            'post_content'=>$request->post_content,
            'post_excerpt'=>$request->post_excerpt,
            'post_status'=>$request->submit,
            'post_author'=>Auth::user()->id,
            'post_date'=>$post_date,
            'post_date_gmt'=>$post_date_gmt,
            'to_ping'=>'',
            'pinged'=>'',
            'post_content_filtered'=>'',
            'post_type'=>'product',
        );        
        $post_id=DB::table('posts')->insertGetId($product);
    
        // product categories
      if(count($request->category) > 0){
            foreach ($request->category as $value) {
               DB::table('term_relationships')->insert(['object_id'=>$post_id,'term_taxonomy_id'=>$value]); 
           }
       }
    DB::table('postmeta')->insert(['post_id'=>$post_id,'meta_key'=>'stock_status','meta_value'=>$request->stock_status]);
    DB::table('postmeta')->insert(['post_id'=>$post_id,'meta_key'=>'regular_price','meta_value'=>$request->regular_price]);
    DB::table('postmeta')->insert(['post_id'=>$post_id,'meta_key'=>'sale_price','meta_value'=>$request->sale_price]);
    DB::table('postmeta')->insert(['post_id'=>$post_id,'meta_key'=>'weight','meta_value'=>$request->weight]);
    DB::table('postmeta')->insert(['post_id'=>$post_id,'meta_key'=>'length','meta_value'=>$request->length]);
    DB::table('postmeta')->insert(['post_id'=>$post_id,'meta_key'=>'width','meta_value'=>$request->width]);
    DB::table('postmeta')->insert(['post_id'=>$post_id,'meta_key'=>'height','meta_value'=>$request->height]);
    DB::table('postmeta')->insert(['post_id'=>$post_id,'meta_key'=>'product_stock','meta_value'=>$request->product_stock]);
    if(isset($request->product_stock) && $request->product_stock!=0){
        DB::table('postmeta')->insert(['post_id'=>$post_id,'meta_key'=>'start_stock','meta_value'=>$request->product_stock]);
    }
    if($request->valueName==null){
     DB::table('postmeta')->insert(['post_id'=>$post_id,'meta_key'=>'default_qty','meta_value'=>$request->stockQuality]);
     DB::table('postmeta')->insert(['post_id'=>$post_id,'meta_key'=>'alert_qty','meta_value'=>$request->lowStockThreshold]);
    }
   
    if($request->product_sku==''){  
              $digits = 3;
              $rand=rand(pow(10, $digits-1), pow(10, $digits)-1);
              $s_k_u=$rand; 
    }else{
        $digits = 3;
        $rand=rand(pow(10, $digits-1), pow(10, $digits)-1); 
        $s_k_u=$request->product_sku.$rand; 
    } 
    DB::table('postmeta')->insert(['post_id' => $post_id, 'meta_key' => '_sku', 'meta_value' => $s_k_u]);
      // product image 
      $image_name=null;
      if($request->hasFile('product_image')){
          $image_name = time().'.'.$request->product_image->getClientOriginalExtension();
          $request->product_image->move(('backend/products'), $image_name);
          $porductImage=array(
              'post_id'=>$post_id,
              'meta_key'=>'attached_file',
              'meta_value'=>$image_name
          );
          $postmeta=DB::table('postmeta')->insert($porductImage);
      }
        // gallery image
        if($request->hasFile('galleryImage'))
        {
            $galleryImage = [];
            foreach($request->file('galleryImage') as $image)
            {
                $filename = $image->getClientOriginalName();
                $image->move(('backend/products'), $filename);
                $porductGalleryImage=array(
                    'post_id'=>$post_id,
                    'meta_key'=>'gallery_file',
                    'meta_value'=>$filename
                );

                $postmeta=DB::table('postmeta')->insert($porductGalleryImage);
            }

        }
     //insert temp attribute data with post table and postmeta table
        $post_insert_id=[];
        $all_temp_att=DB::table('temp_attribute_stock')->get(); 
        foreach($all_temp_att as $att){ 
            DB::table('posts')->insert([
                'post_parent' =>$post_id,
                'post_type' =>'product_varient',
                'post_author' =>auth()->user()->id,
            ]);
            $id_last=DB::getPdo()->lastInsertId();
            $post_insert_id[]=$id_last;
            DB::table('postmeta')->insert([
            'post_id' =>$id_last,  
            'meta_key'  =>'attribute',
            'meta_value'=> $att->attribute_value,
            ]);
            DB::table('postmeta')->insert([
            'post_id' =>$post_id,  
            'meta_key'  =>'default_attribute',
            'meta_value'=> $att->attribute_value,
            ]);
            DB::table('postmeta')->insert([
            'post_id' =>$id_last,  
            'meta_key'  =>'attribute_stock',
            'meta_value'=> $request->stockQuality,
            ]);
             DB::table('postmeta')->insert([
            'post_id' =>$id_last,  
            'meta_key'  =>'attribute_low_stock',
            'meta_value'=> $request->lowStockThreshold,
            ]);
               DB::table('postmeta')->insert([
                'post_id' =>$id_last,  
                'meta_key'  =>'att_status',
                'meta_value'=> 1,
                ]);
        }
         $i=0;
        foreach($all_temp_att as $list){
          $attribute=json_decode($list->attribute_value);
          $parent=0;
         
          foreach($attribute as $key=>$att){
            DB::table('product_attibutes')->insert([
              'post_id' =>$post_id,
              'taxonomy' =>$att->taxonomy,
              'term' =>$att->term,
              'term_id' =>$att->term_id,
              'parent_id'=>$parent,
              'product_parent'=>$post_insert_id[$i],
              'status' =>1
            ]);
            $id=DB::getPdo()->lastInsertId();
            $parent=$id;
            
          }
            $i++;
        }
        DB::table('temp_attribute_stock')->delete(); 
      session()->flash("success","Information saved Successfully");
      return redirect(route('product.index'));
     }
    }



public function attributeValue($id,Request $request){   
      if($request->user()->can('manage-product')) {     
 $attribute=attribute_taxonomie::where('attribute_id',$id)->first();
 $attributeValues=DB::table('term_taxonomy')
 ->join('terms','terms.term_id','=','term_taxonomy.term_id')
 ->where('taxonomy',$attribute->attribute_label)
 ->get();  

 echo json_encode($attributeValues);
      }

}

public function att_status_update($id,$status,$product_id){
   DB::table('postmeta')->where('post_id',$id)->where('meta_key','att_status')->update([
      'meta_value' =>$status
   ]);
    DB::table('product_attibutes')
    ->where('product_parent',$id)
    ->where('post_id',$product_id)
    ->update([
      'status' =>$status
   ]);
   return back();
}

// product edit
public function edit($id,Request $request)
{        
   if($request->user()->can('manage-product')) {
    $extraInfo=array(
        'title'=>"New Product",
        'page'=>'product'
    );
    // for bands
    // $brands=DB::table('term_taxonomy')
    // ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    // ->leftJoin('ecommerce_termmeta', 'ecommerce_termmeta.ecommerce_term_id', '=', 'terms.term_id')
     // ->leftJoin('postmeta', 'ecommerce_termmeta.meta_value', '=', 'postmeta.post_id')
    // ->where('term_taxonomy.taxonomy','product_brand')
    // ->select('term_taxonomy.*','terms.name','terms.status','postmeta.meta_value')
    // ->get();

    // categories
    $gallery_images=DB::table('postmeta')
    ->where('post_id',$id) 
    ->where('meta_key','gallery_file')
    ->select('meta_key','meta_value','meta_id')
    ->get();

    $categories=DB::table('term_taxonomy')
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->where('term_taxonomy.taxonomy','product_cat')
    ->select('term_taxonomy.*','terms.name','terms.status')
    ->get(); 

    // tag
    $tags=DB::table('term_taxonomy')
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->where('term_taxonomy.taxonomy','product_tag')
    ->select('term_taxonomy.*','terms.name','terms.status')
    ->get();    

    // attribute 
     $product=DB::table('posts')
    ->where('ID',$id)
    ->first();

    // product categorys                
    $texonomoys=DB::table('term_relationships')
    ->where('object_id',$id)
    ->where('term_taxonomy.taxonomy','product_cat')
    ->join('term_taxonomy','term_taxonomy.term_id','=','term_relationships.term_taxonomy_id')
    ->join('terms','terms.term_id', '=', 'term_taxonomy.term_id')
    ->select('terms.name')
    ->get();
    $nameTaxonomy=array();
    foreach ($texonomoys as  $value) {
        array_push($nameTaxonomy,$value->name);
    }    

    // product tag                
    $texonomoys=DB::table('term_relationships')
    ->join('term_taxonomy', 'term_taxonomy.term_taxonomy_id', '=', 'term_relationships.term_taxonomy_id')
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->where('object_id',$id)
    ->where('term_taxonomy.taxonomy','product_tag')
    ->select('terms.name')
    ->get();
    $tagTaxonomy=array();
    foreach ($texonomoys as  $value) {
        array_push($tagTaxonomy,$value->name);
    }                  

    // product band                
    $texonomoys=DB::table('term_relationships')
    ->join('term_taxonomy', 'term_taxonomy.term_taxonomy_id', '=', 'term_relationships.term_taxonomy_id')
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->where('object_id',$id)
    ->where('term_taxonomy.taxonomy','product_brand')
    ->select('terms.name')
    ->get();
    $bandTaxonomy=array();
    foreach ($texonomoys as  $value) {
        array_push($bandTaxonomy,$value->name);
    }                  

    // product image 
    $image=DB::table('postmeta')
    ->where('post_id',$id)
    ->where('meta_key','attached_file')
    ->first();

    // product pice 
    $image=DB::table('postmeta')
    ->where('post_id',$id)
    ->where('meta_key','attached_file')
    ->first();

    $stock_status=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'stock_status'])->first();
    $regular_price=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'regular_price'])->first();
    $sale_price=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'sale_price'])->first();
    $weight=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'weight'])->first();
    $length=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'length'])->first();
    $width=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'width'])->first();
    $height=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'height'])->first();
    $qty=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'default_qty'])->select('meta_value')->first();
    $alert_qty=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'alert_qty'])->select('meta_value')->first();
    $stock=DB::table('postmeta')->where(['post_id'=>$id,'meta_key'=>'product_stock'])->first();
    $sku = DB::table('postmeta')->where(['post_id' => $id, 'meta_key' => '_sku'])->first();
    $allAttribute=DB::table('posts')
    ->where('post_parent',$id)
    ->where('meta_key','attribute')
    ->join('postmeta','postmeta.post_id','=','posts.ID')
    ->select('meta_value','post_id')
    ->get();
    
    $attributes=attribute_taxonomie::where('status',1)->get();
    return view('admin.product.edit',compact('categories','tags','attributes',
        'product','nameTaxonomy','tagTaxonomy','bandTaxonomy','image',
        'stock_status','regular_price','sale_price','weight',
        'length','width','height','qty','alert_qty','allAttribute','stock',
        'sku','gallery_images'
    ))->with($extraInfo);
   }
  }

  public function gallery_image_delete($id){
    DB::table('postmeta')->where(['meta_id'=>$id,'meta_key'=>'gallery_file'])->delete();
    session()->flash("success","Image has been deleted");
    return back();
  }

public function update(ProductUpdateRequest $request,$id){ 
   if($request->user()->can('manage-product')) { 
   DB::table('term_relationships')->where('object_id',$id)->delete();
       //update post table
        $year=$request->year;
        $month=$request->month;
        $day=$request->day;
        $H=$request->HH;
        $min=$request->min;
        $post_date=date('Y-m-d H:i:s',strtotime($year.'-'.$month.'-'.$day.' '.$H.':'.$min.':00'));
        $post_date_gmt=date('Y-m-d H:i:s',strtotime($post_date.'+6 hour'));
        DB::table('posts')->where('ID',$id)->update([
        'post_title'=>$request->post_title,
        'post_name'=>$request->post_title,
        'post_content'=>$request->post_content,
        'post_excerpt'=>$request->post_excerpt,
        'post_status'=>$request->satuts==1?'publish':'unpublish',
        'post_author'=>Auth::user()->id,
        'post_date'=>$post_date,
        'post_date_gmt'=>$post_date_gmt,
        'to_ping'=>'',
        'pinged'=>'',
        'post_content_filtered'=>'',
        'post_type'=>'product',
       ]);


       //update product image 
       if($request->hasFile('product_image')){
            $image_name = time().'.'.$request->product_image->getClientOriginalExtension();
            $request->product_image->move(('backend/products'), $image_name);
            DB::table('postmeta')->where('post_id',$id)->where('meta_key','attached_file')->update([
              'meta_value' => $image_name
            ]);
            }else{
             DB::table('postmeta')->where('post_id',$id)->where('meta_key','attached_file')->update([
              'meta_value' => $request->oldImage
            ]);
        }

        //Insert gallery image 
        if($request->gallery_image!=null){
         $galleryImage = [];
        foreach($request->file('gallery_image') as $image)
         {
            $filename = $image->getClientOriginalName();
            $image->move(('backend/products'), $filename);
            $porductGalleryImage=array(
                    'post_id'=>$id,
                    'meta_key'=>'gallery_file',
                    'meta_value'=>$filename
            );
            DB::table('postmeta')->insert($porductGalleryImage);
         }
        }

        //update postmeta table
        DB::table('postmeta')->where('post_id',$id)->where('meta_key','stock_status')->update(['meta_value'=>$request->stock_status]);
        DB::table('postmeta')->where('post_id',$id)->where('meta_key','regular_price')->update(['meta_value'=>$request->regular_price]);
        DB::table('postmeta')->where('post_id',$id)->where('meta_key','sale_price')->update(['meta_value'=>$request->sale_price]);
        DB::table('postmeta')->where('post_id',$id)->where('meta_key','weight')->update(['meta_value'=>$request->weight]);
        DB::table('postmeta')->where('post_id',$id)->where('meta_key','length')->update(['meta_value'=>$request->length]);
        DB::table('postmeta')->where('post_id',$id)->where('meta_key','width')->update(['meta_value'=>$request->width]);
        DB::table('postmeta')->where('post_id',$id)->where('meta_key','height')->update(['meta_value'=>$request->height]);
        DB::table('postmeta')->where('post_id',$id)->where('meta_key','product_stock')->update(['meta_value'=>$request->product_stock]);
        DB::table('postmeta')->where('post_id',$id)->where('meta_key','start_stock')->update(['meta_value'=>$request->product_stock]);

        //if attribute found then update stock from attribute stock 
        if($request->stock!=null){
          for($i=0;$i<count($request->stock);$i++){
             DB::table('postmeta')
             ->where('post_id',$request->post_id[$i])
             ->where('meta_key','attribute_stock')
             ->update(['meta_value'=>$request->stock[$i]]);
              DB::table('postmeta')
             ->where('post_id',$request->post_id[$i])
             ->where('meta_key','attribute_low_stock')
             ->update(['meta_value'=>$request->low_stock[$i]]);
          }
        }
        
       if($request->valueName==null){
          DB::table('postmeta')->where('post_id',$id)->where('meta_key','default_qty')->update(['meta_value'=>$request->stockQuality]);
          DB::table('postmeta')->where('post_id',$id)->where('meta_key','alert_qty')->update(['meta_value'=>$request->lowStockThreshold]);
        }

       //product categories
        if($request->category!=null){
            foreach ($request->category as  $value) {   
              DB::table('term_relationships')->insert(['object_id'=>$id,'term_taxonomy_id'=>$value]); 
            }
         }
  
       DB::table('posts')->where('ID',$id)->update([
         'post_status' =>$request->status 
       ]);
         //check if product has variant
       $v_product=DB::table('posts')->where('post_type','product_varient')->where('post_parent',$id)->count();
       if($v_product>0){
         DB::table('posts')->where('post_type','product_varient')->where('post_parent',$id)->update([
            'post_title'=>$request->post_title,
            'post_name'=>$request->post_title,
            'post_content'=>$request->post_content,
            'post_excerpt'=>$request->post_excerpt,
            'post_status'=>$request->satuts==1?'publish':'unpublish',
            'post_author'=>Auth::user()->id,
            'post_date'=>$post_date,
            'post_date_gmt'=>$post_date_gmt,
            'to_ping'=>'',
            'pinged'=>'',
            'post_content_filtered'=>'',
         ]);
       }
       session()->flash("success","Product information has been successfully update");
       return redirect(route('product.index'));
    }
  }
//stock sticker print
public function stockPrintSticker($id){
        $pro_name=DB::table('posts')->where('ID',$id)->first();
        $product=DB::table('postmeta')->where('post_id',$id)->get();
        $category = DB::table('term_relationships')
        ->where('object_id', $id)
            ->where('taxonomy', 'product_cat')
            ->join('term_taxonomy', 'term_relationships.term_taxonomy_id', '=', 'term_taxonomy.term_taxonomy_id')
            ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
            ->select('terms.name as cat_name')
            ->first();
        $allAttribute = DB::table('posts')
        ->where('post_parent',$id)
        ->where('post_type','product_varient')
        ->where('meta_key','attribute')
        ->join('postmeta','posts.ID','=','postmeta.post_id')
        ->get();
          $taxo=[];
 
        foreach($allAttribute as $att){
              $arributeArray=json_decode($att->meta_value);
              foreach($arributeArray as $value){
                $taxo[]=$value->taxonomy.':'.$value->term;
              }
         }
        $pdf = PDF::loadView('admin.stock.stock_sticker_print', array(
                'product' => $product, 'category'=>$category,'id'=>$id,'taxo'=>$taxo,'pro_name'=>$pro_name
        ));
    return $pdf->download('sku_sticker.pdf');
}

public function attributeStockAdd(Request $request){
     if($request->valueNametemp!=null ){
            $attribute=[];
            foreach($request->valueNametemp as $value){
                $detailVal=DB::table('term_taxonomy')
                ->join('terms','terms.term_id','=','term_taxonomy.term_id')
                ->where('term_taxonomy.term_id',$value)
                ->select('term_taxonomy.*','terms.name')
                ->first();
                $attribute[]=array(
                    'taxonomy'=>$detailVal->taxonomy,
                    'term'=>$detailVal->name,
                    'term_id'=>$value,
                );
            }
            $attributes=json_encode($attribute);
            $attributeMeta=array(
                'attribute_value'=> $attributes
            );
            DB::table('temp_attribute_stock')->insert($attributeMeta);
            $data=$value;
            return response()->json($data);
        
    }

}

public function stockSkuSearch(Request $request){
        $extraInfo = array(
            'title' => "Stock List",
            'page' => 'stock'
        ); 
   $sku=$request->product_sku;
    $products=DB::table('postmeta')
    ->where(['meta_key'=>'_sku','meta_value'=>$sku])
   ->get();
  
   return view('admin.order.stock_search',compact('products','sku'))->with($extraInfo);
}

    public function stockSkuSearchLower(Request $request)
    {
        $extraInfo = array(
            'title' => "Stock List",
            'page' => 'stock'
        );
        $sku = $request->product_sku;
        $products = DB::table('postmeta')->where(['meta_key' => '_sku', 'meta_value' => $sku])
            ->join('posts', 'postmeta.post_id', '=', 'posts.ID')
            ->get();
        return view('admin.order.stock_search_lower', compact('products'))->with($extraInfo);
    }

    public function stockSkuSearchSold(Request $request)
    {
        $extraInfo = array(
            'title' => "Stock List",
            'page' => 'stock'
        );
        $sku = $request->product_sku;
        $products = DB::table('postmeta')->where(['meta_key' => '_sku', 'meta_value' => $sku])
        ->join('posts', 'postmeta.post_id', '=', 'posts.ID')
        ->get();
        return view('admin.order.stock_search_sold',compact('products'))->with($extraInfo);
    }


    //product attribute stock update
    public function varient_stock(Request $request){
        if($request->sku==''){
          $lists=[];  
          $sku_list=DB::table('postmeta')->where('meta_key','_sku')->get();
          return view('admin.product.attribute_stock',compact('sku_list','lists'));
        }else{
        $post_id=DB::table('postmeta')
        ->where('meta_key','_sku')
        ->where('meta_value',$request->sku)
        ->select('post_id')
        ->first(); 
        $lists=DB::table('posts')
        ->where('post_parent',$post_id->post_id)
        ->where('post_type','product_varient')
        ->where('postmeta.meta_key','attribute')
        ->join('postmeta','posts.ID','=','postmeta.post_id')
        ->select('postmeta.meta_value','post_id')
        ->get();  
        $sku_list=DB::table('postmeta')->where('meta_key','_sku')->get();
        return view('admin.product.attribute_stock',compact('sku_list','lists'));
        }
     
    }

    public function attributeStockupdate(Request $request){
    for($i=0;$i<count($request->post_id);$i++){
        DB::table('postmeta')
        ->where('post_id',$request->post_id[$i])
        ->where('meta_key','attribute_stock')
        ->update([
        'meta_value' =>$request->stock[$i]
        ]);
    }
    session()->flash("success","Stock has been update successfully");
    return back();
    }

    //option insert for delivery charge
    public function optionList(){
        $lists=DB::table('options')->orderBy('option_id','DESC')->first();
        return view('settings.options.option_list',compact('lists'));
    } 

    //option store
    public function optionStore(Request $request){
      DB::table('options')->insert([
        'option_name'=>$request->option_name, 
        'option_value'=>$request->option_value, 
      ]);
      session()->flash("success","Option has been insert successfully");
       return back();
    }

    public function optionUpdate(Request $request,$id){
     DB::table('options')->where('option_id',$id)->update([
        'option_name'=>$request->option_name, 
        'option_value'=>$request->option_value, 
      ]);
      session()->flash("success","Option has been update successfully");
       return back();
    }


}
