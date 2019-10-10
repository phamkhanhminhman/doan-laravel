@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><i class="fa fa-cube"></i> Sửa Ngành Hàng </h3>
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

		<form action="{{url('admin/category-update')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
			@csrf
			<!-- <p>For alternative validation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a> -->
            @foreach ($data_category as $p)   
            
            </p>
			<span class="section">Thông Tin Chi Tiết</span>

			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mã Ngành <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input id="name" name="categoryID" value="{{$p->categoryID}}" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nhập Mã Ngành" required="required" type="text">
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tên Ngành Hàng <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="categoryName" value="{{$p->categoryName}}" required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
            <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Hình Ảnh<span class="required">*</span>
				</label>
                <img  class="img-thumbnail" name="IMG"  src="../../{{$p->IMG}}" width="30%" height="200px" style="margin-left: 10px" >				
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Ghi Chú <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<textarea type="text"  name="categoryNote" required="required" class="form-control col-md-7 col-xs-12" rows="7" cols="50">{{$p->categoryNote}}</textarea>
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Upload<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="file"  name="IMG" class="form-control col-md-7 col-xs-12" >
                    <input  type="hidden" name="anhcu" value="{{$p->IMG}}">
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-md-offset-3">
					<a class="btn btn-primary" href="{{url('admin/category')}}">Trở Về</a>
					<button id="send" type="submit" class="btn btn-success"  >Cập Nhật</button>
				</div>
			</div>
            @endforeach  
		</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection