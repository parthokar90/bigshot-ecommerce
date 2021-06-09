 
 
 <div class="banner">
   @php
   $banner=DB::table('posts')
   ->where('post_type','banner')
   ->join('postmeta','posts.ID','=','postmeta.post_id')
   ->first();
   @endphp
   @if(isset($banner) && $banner->meta_key=='banner_image')
   @php $img=$banner->meta_value; @endphp 
   <img src="{{asset('backend/banner/'.$img)}}" class="img-fluid" alt="Responsive image">
   @endif
</div>

