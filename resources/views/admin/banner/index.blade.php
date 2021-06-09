@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Banner Image</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="{{route('admin.home')}}">Home</a>
						</li>
						<li class="breadcrumb-item active">Banner Image</li>
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
							<h3 class="card-title">Banner Image</h3>
            </div>
            <form role="form" method="POST" action="{{route('banner.store')}}" enctype="multipart/form-data"> 
			@csrf  
			 
							<div class="card-body">
								<div class="form-group">
									<label for="categoryName">Image</label>
									<input type="file" name="banner_img" class="form-control" accept="image/x-png,image/gif,image/jpeg">
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-save"></i>Upload
									</button>
								</div>
                          </form>
						</div>
					</div>
					@if(isset($banner))
					@if($banner->meta_key=='banner_image') @php $img=$banner->meta_value; @endphp @endif
					<div class="col-md-7">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Banner Image</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<table class="table table-bordered table-striped">
									<thead class="bg-info">
										<tr>
											<th style="width: 10px">#</th>
											<th>Image</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td><img width="70px" height="70px" src="{{asset('backend/banner/'.$img)}}"></td>
											<td>
												<a href="{{route('banner.edit',$banner->meta_id)}}" class="btn btn-primary">
													<i class="fa fa-trash"></i> Edit
												</a>
											</td>
                                        </tr>
									</tbody>
								</table>
							</div>
							<div class="d-flex justify-content-center"></div>
						</div>
						<!-- /.card -->
					</div>
                    @endif 
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