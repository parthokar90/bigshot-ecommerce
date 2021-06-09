
@extends('admin.layouts.master')
@section('content')

<style></style>
<div class="content-wrapper" style="min-height: 1203.6px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<!-- <h1>Pending Order</h1> -->
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="{{route('admin.home')}}">Home</a>
						</li>
						<li class="breadcrumb-item active">Gross profit</li>
					</ol>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
		<div class="s002">
			<form method="post" action="{{route('order.grossProfit.report')}}">
       @csrf() 
        
				<fieldset>
					<legend>Gross profit</legend>
				</fieldset>
				<div class="inner-form ml-5">
					<div class="input-field second-wrap">
						<div class="icon-wrap">
							<svg
								xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
								<path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
							</svg>
						</div>
						<input class="datepicker" name="start" value="{{date('Y-m-01')}}" id="depart" type="date"/>
					</div>
					<div class="input-field third-wrap">
						<div class="icon-wrap">
							<svg
								xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
								<path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
							</svg>
						</div>
						<input class="datepicker" name="end" value="{{date('Y-m-t')}}" id="return" type="date"/>
					</div>
					<div class="input-field fifth-wrap">
						<button type="submit" class="btn-search" type="button">SEARCH</button>
					</div>
				</div>
			</form>
		</div>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="container">
			<h4 class="text-center">Gross profit in details Year {{date('Y')}}</h4>
			<div class="card">
				<div class="card-body">
					<div class="table-responsive-sm">
						<table class="table">
							<tr style="background:#e7e7e7;">
								<th>Date</th>
								<th>Order Id  </th>
								<th>Description</th>
								<th>Quantity</th>
								<th>Sales amount</th>
								<th>Cost</th>
								<th>Gross Profit</th>
							</tr>
							<tbody>
          @php $total_qty=0; $total_sale_amount=0; $total_cost=0; $total_profit=0; $qty=0; $product_id=0; $sale_price=0; $cost=0; @endphp
          @foreach($order as $item)
            
								<tr>
									<td>{{date('d-m-Y',strtotime($item->post_date))}}</td>
									<td>{{$item->ID}}</td>
									<td>
										<table style="width:100%">
                  @foreach($item->orderItem as $meta)
                  
											<tr>
												<td>{{$meta->order_item_name}}</td>
											</tr>
                   @endforeach
                
										</table>
									</td>
									<td>
										<table style="width:100%">
              @foreach($item->orderItem as $meta)
                  @foreach($meta->orderMeta as $value) 
                    @if($value->meta_key=='_qty') @php $qty=$value->meta_value; @endphp @endif
                  @endforeach
                
											<tr>
												<td>{{$qty}} pcs  </td>
											</tr>
                @php $total_qty+=$qty; @endphp
              @endforeach
              
										</table>
									</td>
									<td>
										<table style="width:100%">
                @foreach($item->orderItem as $meta)
                  @foreach($meta->postMeta as $value)
                     @if($value->meta_key=='sale_price') @php $sale_price=$value->meta_value; @endphp @endif
                  @endforeach
                
											<tr>
												<td>{{number_format($sale_price)}}</td>
											</tr>
                @php $total_sale_amount+=$sale_price; @endphp
                @endforeach
              
										</table>
									</td>
									<td>
										<table style="width:100%">
                @foreach($item->orderItem as $meta)
                  @foreach($meta->postMeta as $value)
                     @if($value->meta_key=='product_stock') @php $cost=$value->meta_value; @endphp @endif
                  @endforeach
                
											<tr>
												<td>{{number_format($cost)}}</td>
											</tr>
                 @php $total_cost+=$cost; @endphp
                @endforeach
              
										</table>
									</td>
									<td>
										<table style="width:100%">
                  @foreach($item->orderItem as $meta)
                    @foreach($meta->postMeta as $value)
                      @if($value->meta_key=='sale_price') @php $sale_price=$value->meta_value; @endphp @endif
                      @if($value->meta_key=='product_stock') @php $cost=$value->meta_value; @endphp @endif
                    @endforeach
                
											<tr>
												<td>@php $profit=$sale_price-$cost; @endphp {{$profit}}</td>
											</tr>
                 @php $total_profit+=$profit; @endphp
                @endforeach
              
										</table>
									</td>
								</tr>
           @endforeach 
        
							</tbody>
							<tfoot>
								<tr style="background:#e7e7e7;">
									<td><b>Total</b></td>
									<td></td>
									<td></td>
									<td>
										<b>{{$total_qty}}</b>
									</td>
									<td>
										<b>{{number_format($total_sale_amount)}}tk
											<b/>
										</td>
										<td>
											<b>{{number_format($total_cost)}}tk</b>
										</td>
										<td>
											<b>{{number_format($total_profit)}}tk</b>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection
