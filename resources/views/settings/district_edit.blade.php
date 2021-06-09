@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>District,Thana,Postcode</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="{{route('admin.home')}}">Home</a>
						</li>
						<li class="breadcrumb-item active">District,Thana,Postcode</li>
					</ol>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
        @include('admin.includes.messages')
			<div class="row">
				<div class="col-md-5">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">District,Thana,Postcode</h3>
                      </div>
                      <form role="form" method="POST" action="{{route('district.update',['id' => $dist_name->term_id])}}"> 
		                	@csrf 
							<div class="card-body">
								  <div class="form-group">
									  <label for="categoryName">District</label>
									   <input type="text" name="district" value="{{$dist_name->name}}" class="form-control" required autocomplete="off" placeholder="Enter District Name">
									</div>
									  <div class="form-group">
									  <label for="categoryName">Delivery Charge</label>
									  @if(isset($delivery_charge)) @php $charge=$delivery_charge->description; @endphp @else @php $charge=0; @endphp @endif
									   <input type="text" name="delivery_charge" value="{{$charge}}" class="form-control" required autocomplete="off" placeholder="Enter Delivery Charge">
									</div>
                                </div>
								<!-- /.card-body -->
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-save"></i>Update
									</button>
								</div>
                          </form>
                       <form role="form" method="POST" action="{{route('thana.store')}}" enctype="multipart/form-data"> 
		                	@csrf 
							<div class="card-body">
								  <div class="form-group">
									  <label for="categoryName">Select District</label>
									  <select class="form-control" name="dist_id" required>
                                          @foreach($district as $districts) 
                                             <option value="{{$districts->term_id}}">{{$districts->district}}</option>
                                          @endforeach 
									  </select>
                                    </div>
                                  <div class="form-group">
									  <label for="categoryName">Thana</label>
									   <input type="text" name="thana" class="form-control" required autocomplete="off" placeholder="Enter Thana Name">
									</div>
                                    <div class="form-group">
									  <label for="categoryName">Post Code</label>
									   <input type="text" name="postcode" class="form-control" required autocomplete="off" placeholder="Enter Post Code">
									</div>
                                </div>
								<!-- /.card-body -->
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-save"></i>Add New
									</button>
								</div>
                          </form>
						</div>
					</div>
					<div class="col-md-7">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">District,Thana,Postcode</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<table class="table table-bordered table-striped">
									<thead class="bg-info">
										<tr>
                                            <th style="width: 10px">#</th>
											<th style="width: 10px">District</th>
											<th>Information</th>
											<!-- <th>Action</th> -->
										</tr>
									</thead>
									<tbody>
                                      @php $tt_id=0;  @endphp
									  @foreach($district as $key=>$districts) 
										<tr>
                                            <td>{{++$key}}</td>
											<td>{{$districts->district}} <a class="btn btn-success btn-sm" href="{{route('district.edit',$districts->term_id)}}">Edit</button></td>
											<td>
                                                    <table style="width:100%">
                                                    <tr>
                                                        <th>id</th>
                                                        <th>City/Thana</th>
                                                        <th>Post Code</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    @php
                                                       $thana=DB::table('term_taxonomy')->where(['taxonomy'=>'city','parent'=>$districts->term_id])
                                                        ->join('terms','terms.term_id','=','term_taxonomy.term_id')
                                                        ->select('terms.name as thana_name','terms.term_id as t_id','term_taxonomy.term_id as ac_id')
                                                        ->get();
                                                    @endphp
                                                    @foreach($thana as $thanas) 
                                                      @php  $post_code = DB::table('term_taxonomy')->where(['taxonomy'=>'postcode','parent'=>$thanas->ac_id])
                                                    ->select('description as zip')
                                                    ->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{$thanas->t_id}}</td>
                                                        <td>{{$thanas->thana_name}}</td>
                                                        <td>@if(isset($post_code)) {{$post_code->zip}}  @endif </td>
                                                                                                                <td><a class="btn btn-success btn-sm" href="{{route('thana.update',['dist_id'=>$districts->term_id,'thana_id'=>$thanas->t_id])}}">Edit</a> </td>
                                                    </tr>
                                                    @endforeach 
                                                    </table>
                                                  </td>
                                            <!-- <td><a class="btn btn-danger" href="">Delete</a></td> -->
										</tr>

                                       @endforeach 
									</tbody>
								</table>
							</div>
							<div class="d-flex justify-content-center"></div>
						</div>
						<!-- /.card -->
					</div>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
@endsection