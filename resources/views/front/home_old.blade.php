@extends('front.layouts.front_master')
@section('title') Bigshot | Home @endsection 
@section('content')
		<div class="container mb-3">
			<div class="d-flex flex-column">
			   @include('front.includes.banner')
				<div class="d-flex flex-wrap mt-3">
				@php
				$rprice=0;
				$sprice=0;
				$image='';
				@endphp
				@foreach($products as $item)
				@foreach ($item->productMeta as $meta)
				@if($meta['meta_key']=='regular_price')
				@php
				$rprice=$meta['meta_value'];
				@endphp
				@endif
				@if($meta['meta_key']=='sale_price')
				@php
				$sprice=$meta['meta_value'];
				@endphp
				@endif
				@if($meta['meta_key']=='attached_file')
				@php
				$image=$meta['meta_value'];
				@endphp
				@endif
				@endforeach 
					<div class="col-6 col-md-3 mt-2 ml-0 pl-0">
						 <a style=" text-decoration: none;" href="{{url('product/'.$item->ID.'/'.urlencode($item->post_title))}}">
						<div class="card">
							<img src="{{asset('backend/products/'.$image)}}"  class="img-fluid1 rounded" style="height: 260px;" alt="...">
							<div class="card-body text-center">
								<span style="color:#000000" class="card-text font-weight-bold">{{$item->post_title}}</span>
								<p class="card-text">@if($rprice) <del style="color:red">৳{{$rprice}}</del>@endif <span style="color:#000000"> ৳{{$sprice}}</span></p>
							</div>
						</div>
						 </a>
					</div>  
                 @endforeach		
				</div>
			</div>
		</div>
@endsection 