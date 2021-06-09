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
            <form role="form" method="POST" action="{{route('banner.update',$banner->meta_id)}}" enctype="multipart/form-data"> 
			 @csrf  
             {{ method_field('PATCH') }}
							<div class="card-body">
							      <div class="form-group">
									<label for="categoryName">Image</label>
									   <input type="file" name="banner_img" class="form-control" accept="image/x-png,image/gif,image/jpeg">
								  </div>
                                  @if($banner->meta_key=='banner_image') @php $img=$banner->meta_value; @endphp @endif
                                  <img width="100%" height="100px" src="{{asset('backend/banner/'.$img)}}">
                                  <input type="hidden" name="default_img" value="{{$img}}">
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