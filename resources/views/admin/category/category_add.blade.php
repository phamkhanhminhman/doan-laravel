@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><i class="fa fa-cube"></i> Thêm Ngành Hàng Mới</h3>
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
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
				
					<div class="x_content">

		<form action="{{url('admin/category-insert')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
			@csrf
			<!-- <p>For alternative validation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a> -->
			</p>
			<span class="section">Thông Tin Chi Tiết</span>

			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mã Ngành <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input id="name" name="categoryID" class="form-control col-md-7 col-xs-12" placeholder="Nhập Mã Ngành" required="required" type="text">
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tên Ngành Hàng <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="categoryName" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nhập Tên Ngành Hàng">
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Ghi Chú <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<textarea type="text" name="categoryNote" class="form-control col-md-7 col-xs-12" placeholder="Nhập Ghi Chú" rows="7" cols="50""></textarea>
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Hình Ảnh <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="file"  name="IMG"  class="form-control col-md-7 col-xs-12" required="true">
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-md-offset-3">
					<a href="/admin" class="btn btn-primary">Bỏ Qua</a>
					<button id="send" type="submit" class="btn btn-success">Thêm</button>
				</div>
			</div>
		</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection