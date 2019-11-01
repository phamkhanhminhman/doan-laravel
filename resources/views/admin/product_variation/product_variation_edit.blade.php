@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
<div class="right_col" role="main">
	<div class="">
		<!-- HEADER START -->
		<div class="page-title">
			<div class="title_left">
				<h3><i class="fa fa-tag"></i> Sửa Phân Cấp Sản Phẩm </h3>
			</div>

			<div class="title_right">
				<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Go!</button>
						</span>
					</div>
				</div>
			</div>
		</div>
	    <!-- HEADER END -->
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- CONTENT START -->
					<div class="x_content">
						<form action="{{url('admin/product-variation-update')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
							@csrf
							@foreach ($data_product as $p)   						
							<span class="section">Thông Tin Chi Tiết</span>
							<div class="item form-group">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" name="productVariationID" value="{{$p->productVariationID}}" class="form-control col-md-7 col-xs-12" type="hidden" >
								</div>
							</div>
							
							<!-- GIA NHAP START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Giá Nhập <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text"  name="productCost" value="{{$p->productCost}}" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<!-- GIA NHAP END -->


							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<a class="btn btn-primary" href="{{url('admin/product')}}">Trở Về</a>
									<button id="send" type="submit" class="btn btn-success"  >Cập Nhật</button>
								</div>
							</div>
							@endforeach  
						</form>
					</div>
					<!-- CONTENT END -->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection