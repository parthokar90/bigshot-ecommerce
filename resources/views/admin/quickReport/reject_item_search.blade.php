@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper" style="min-height: 1203.6px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			    @include('admin.includes.messages')
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Reject Item List</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="{{route('admin.home')}}">Home</a>
						</li>
						<li class="breadcrumb-item active">Reject Item</li>
					</ol>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2"></div>
		</div>
		<!-- /.container-fluid -->
		<div class="s002">
			<div class="d-flex font-weight-bold justify-content-center h2 mb-3">Search Reject Item</div>
			<div class="d-flex justify-content-center">
			<form class="form-inline" method="get" action="{{route('reject.item.search.data')}}" >
				<div class="form-group mb-2">
				<label for="depart" class="mr-2">Start Date </label>
				<input class="form-control datepicker" name="start" value="{{date('Y-m-d')}}" id="depart" type="date"/>
				</div>
				<div class="form-group mx-sm-3 mb-2">
				<label for="return" class="mr-2">End Date </label>
				<input class="form-control datepicker" name="end" value="{{date('Y-m-d')}}" id="return" type="date"/>
				</div>
				<button type="submit" class="btn btn-primary mb-2">SEARCH</button>
			</form>
			</div>
           </div>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container">
				<div class="col-12 text-center font-weight-bold mb-2">
							Search date {{$startDate}} to {{$endDate}}
				</div>
				<div class="card">
					<div class="card-header">
					</div>
					<div class="card-body">
						
						<div class="table-responsive-sm">
							<table class="table table-striped">
								<thead>
									<tr>
										<th class="center">SKU</th>
										<th class="right">Item</th>
										<th class="right">Categories</th>
										<th class="right">Quantity</th>
										<th class="right">Amount</th>
										<th class="right">Reject Date</th>
										<th class="right">Action</th>
									</tr>
								</thead>
								<tbody>
									@php $total_qty=0; $total_price=0; @endphp
									@foreach($data as $item)
									 @php 
									 $check_id=DB::table('posts')
									->where('ID',$item->post_id)
									->select('ID','post_parent')
									->first();
									 @endphp 
									@if(isset($check_id))
											@if($check_id->post_parent==0) 
											@php $p_id=$check_id->ID; @endphp  
											@else 
											@php $p_id=$check_id->post_parent; @endphp 
											@endif
									@endif
									<tr>
						
									       @php 
											$qty_id=DB::table('postmeta')->where('post_id',$item->post_id)
											->where('meta_key','reject_qty')
											->first(); 
											@endphp
								
										<td class="center">
											@php 
											 $sku=DB::table('postmeta')
											->where('post_id',$p_id) 
											->where('meta_key','_sku')
											->first(); 
											 $post_date=DB::table('posts')
											->where('ID',$p_id) 
											->first();
											 $price=DB::table('postmeta')
											->where('post_id',$p_id) 
											->where('meta_key','sale_price')
											->first(); 
											@endphp
											@if(isset($sku))
											 {{$sku->meta_value}} 
											@endif<br> 
											{{date('d-m-Y',strtotime($post_date->post_date))}}
										</td>
										<td class="right">
                                          @php $name=DB::table('posts')->where('ID',$p_id)->first(); @endphp @if(isset($name)) @php $pro_name=$name->post_title; @endphp @endif {{$pro_name}}
										  	@php 
														$lists=DB::table('postmeta')
														->where('post_id',$item->post_id)
														->where('meta_key','attribute')
														->select('meta_value','post_id')
														->first();
														@endphp
														@if(isset($lists))
														 @php $attribute=json_decode($lists->meta_value); @endphp
														   @foreach($attribute as $att)
                                                                        {{$att->taxonomy}} :
                                                                        {{$att->term}}     
                                                           @endforeach 
														@endif 
										</td>
										<td>
										@php 
										  $relationShips=DB::table('term_relationships')
										->join('terms','terms.term_id','=','term_relationships.term_taxonomy_id')
										->where('object_id',$p_id)
										->first();  
										@endphp 
											@if(isset($relationShips))
												{{$relationShips->name}}
											@endif
										</td>

										<td>
											@php 
											$qty=DB::table('postmeta')->where('post_id',$item->post_id)
											->where('meta_key','reject_qty')->first(); 
											@endphp
											@if(isset($qty)) @php $qtyy=$qty->meta_value; @endphp @endif
											{{$qtyy}} @php $total_qty+=$qtyy; @endphp
										</td>
											<td>
											
											 @if(isset($price)) {{number_format($price->meta_value)}} Tk @php $total_price+=$price->meta_value; @endphp @endif
											</td>
										<td>
											{{$item->meta_value}}
										</td>
									
					
										<td>
										 <a href="{{route('stock_itemsss_remove',array('date_id'=>$item->meta_id,'qty_id'=>$qty_id->meta_id))}}">Remove</a>
										</td>
									</tr>
									@endforeach 
								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-5"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="box bg-primary">
							<!-- <i class="fa fa-lemon ml-1"></i> -->
							<h3 class="text-center">{{$total_qty}}</h3>
							<p class="lead text-center font-weight-bold">Total Quantity</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box bg-success">
							<!-- <i class="fa fa-lemon ml-1"></i> -->
							<h3 class="text-center">{{number_format($total_price)}} Tk</h3>
							<p class="lead text-center font-weight-bold">Total Amount</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
	<!-- /.content -->
	<!--  </div> -->
</div>
@endsection