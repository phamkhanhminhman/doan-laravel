@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
<div class="right_col" role="main">
	<div class="">
		<!-- HEADER START -->
		<div class="page-title">
			<div class="title_left">
				<h3><i class="fa fa-cubes"></i> Sửa Loại Sản Phẩm </h3>
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
						<form action="{{url('admin/product-type-update')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
							@csrf
							@foreach ($data_product_type as $p)   						
							<span class="section">Thông Tin Chi Tiết</span>
							<!-- MA LOAI SP START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mã Loại Sản Phẩm <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" name="product_typeID" value="{{$p->product_typeID}}" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nhập Mã Ngành"  type="text">
								</div>
							</div>
							<!-- MA LOAI SP END -->

							<!-- TEN LOAI SP START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên Loại Sản Phẩm <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="product_typeName" value="{{$p->product_typeName}}" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<!-- TEN LOAI SP END -->

							<!-- MA NGANH HANG START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mã Ngành Hàng <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" name="categoryID" id="">
										<option value="{{$p->categoryID}}" selected="selected">{{$p->categoryID}}</option> 
										@foreach ($data_category as $pp)								  
											<option value="{{$pp->categoryID}}">{{$pp->categoryID}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<!-- MA NGANH HANG START -->
							
							<!-- GIA NHAP START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Giá Nhập <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text"  name="product_typeCost" value="{{$p->product_typeCost}}"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<!-- GIA NHAP END -->

							<!-- GIA BAN START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Giá Bán  <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text"  name="product_typeSell" value="{{$p->product_typeSell}}" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<!-- GIA BAN END -->

							<!-- NOTE START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ghi Chú  <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea type="text"  name="product_typeNote" class="form-control col-md-7 col-xs-12" rows="7" cols=50>{{$p->product_typeNote}}</textarea>
								</div>
							</div>
							<!-- NOTE END -->

							<!-- IMG START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Hình Ảnh Cũ<span class="required">*</span>
								</label>
								<div class="border">
								<img class="img-thumbnail" src="../../{{$p->product_typeIMG}}" width="30%" height="200px" style="margin-left: 10px">	
								</div>			
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Hình Ảnh <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="file"  name="IMG" class="form-control col-md-7 col-xs-12" >
									<input  type="hidden" name="anhcu" value="{{$p->product_typeIMG}}">
								</div>
							</div>
							<!-- IMG END -->
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<a class="btn btn-primary" href="{{url('admin/product-type')}}">Trở Về</a>
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