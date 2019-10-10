@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="right_col" role="main">
	<div class="">
		<!-- HEADER START -->
		<div class="page-title">
			<div class="title_left">
				<h3>Tạo Đơn Hàng Mới</h3>
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
				<!-- <div class="x_title">
						<span class="section">Thông Tin Chi Tiết</span>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Settings 1</a>
								</li>
								<li><a href="#">Settings 2</a>
								</li>
							</ul>
						</li>
						<li><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div> -->
				<div class="x_content">		
				<!-- <p>For alternative validation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a>
				</p>	 -->				
				<div class="row">
					<!-- FORM START -->
					<form action="{{url('admin/category-insert')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
						<!-- DON HANG START -->
						<div class="col-md-5"> 
							<span class="section">Đơn Hàng</span>				
							@csrf
							<!-- MA DON HANG START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mã Đơn Hàng <span class="required">*</span>
								</label>
								<div class="col-md-4 col-sm-4 col-xs-8">
									<input id="name" name="categoryID" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nhập Mã Đơn" required="required" type="text">
								</div>
								<div class="col-md-3 col-sm-2 col-xs-4">
									<select class="form-control col-md-7 col-xs-12" name="categoryID" id="">
										<option value="Sendo">Sendo</option>
										<option value="Home">Home</option>
										<option value="Shopee">Shopee</option>
									</select>
								</div>
							</div>
							<!-- MA DON HANG END -->

							<!-- MA VAN CHUYEN START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Mã Vận Chuyển <span class="required">*</span>
								</label>
								<div class="col-md-4 col-sm-4 col-xs-8">
									<input type="text" name="categoryName" required="required" class="form-control col-md-7 col-xs-12">
								</div>
								<div class="col-md-3 col-sm-2 col-xs-4">
									<select class="form-control col-md-7 col-xs-12" name="categoryID" id="">
										<option value="GHN">GHN</option>
										<option value="Home">Home</option>
										<option value="VNPost">VnPost</option>
										<option value="NJV">NJV</option>
									</select>
								</div>
							</div>
							<!-- MA VAN CHUYEN END -->

							<!-- NOTE START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Ghi Chú <span class="required">*</span>
								</label>
								<div class="col-md-7 col-sm-6 col-xs-12">
									<textarea type="text"  cols="30" rows="4  name="categoryNote" required="required" class="form-control col-md-7 col-xs-12"></textarea>
								</div>
							</div>	
							<!-- NOTE END -->

							<!-- <div class="ln_solid"></div> -->
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<button type="submit" class="btn btn-primary">Bỏ Qua</button>
									<button id="send" type="submit" class="btn btn-success">Thêm</button>
								</div>
							</div>

						</div>
						<!-- DON HANG END -->

						<!-- KHACH HANG START -->
						<div class="col-md-7">
							<span class="section">Khách Hàng</span>
							<!-- MA KHACH HANG START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mã Khách Hàng <span class="required">*</span>
								</label>
								<div class="col-md-4 col-sm-4 col-xs-9">
									<input id="makhachhang" disabled name="categoryID" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Search theo SDT" required="required" type="text">
								</div>
								<div class="col-md-5 col-sm-2 col-xs-3">
									<input type="checkbox"  name="checkabc" unchecked /> Khách Hàng Cũ
								</div>
							</div>
							<!-- MA KHACH HANG END -->

							<!-- TEN KHACH HANG START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên Khách Hàng <span class="required">*</span>
								</label>
								<div class="col-md-4 col-sm-4 col-xs-8">
									<input id="name" name="categoryID" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nhập Tên Khách Hàng" required="required" type="text">
								</div>
								<div class="col-md-3 col-sm-2 col-xs-4">
									<select class="form-control col-md-7 col-xs-12" name="categoryID" id="">
										<option value="Male">Nam</option>
										<option value="Female">Nữ</option>

									</select>
								</div>
							</div>					
							<!-- TEN KHACH HANG END -->
							<!-- TEN KHACH HANG START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Thành Phố <span class="required">*</span>
								</label>
								<div class="col-md-4 col-sm-4 col-xs-8">						
									<select class="selectpicker form-control" data-live-search="true"  ng-model="bbb" ng-change="changeorder(bbb)">
										@foreach ($data_tinhthanh as $p)
										<option value="{{$p->matp}}">{{$p->name}}</option>
										@endforeach									  
									</select>						
								</div>
								<div class="col-md-3 col-sm-2 col-xs-4">
									<select class="form-control col-md-7 col-xs-12" name="categoryID" id="">
										<option ng-repeat="mot in quanhuyen" value="Male">@{{mot.name}}</option>


									</select>
								</div>
							</div>					
							<!-- TEN KHACH HANG END -->
							<!-- DIA CHI KHACH HANG START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Địa Chỉ <span class="required">*</span>
								</label>
								<div class="col-md-7 col-sm-4 col-xs-8">
									<input id="name" name="categoryID" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nhập Địa Chỉ"  type="text">
								</div>

							</div>					
							<!-- DIA CHI KHACH HANG END -->
							<!-- SDT KHACH HANG START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Điện Thoại <span class="required">*</span>
								</label>
								<div class="col-md-7 col-sm-4 col-xs-8">
									<input id="name" name="categoryID" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nhập Số Điện Thoại"  type="text">
								</div>

							</div>					
							<!-- SDT KHACH HANG END -->
							<!-- EMAIL KHACH HANG START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
								</label>
								<div class="col-md-7 col-sm-4 col-xs-8">
									<input id="name" name="categoryID" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nhập Email"  type="email">
								</div>

							</div>					
							<!-- EMAIL KHACH HANG END -->

						</div>
						<!-- KHACH HANG END -->
					</form>
					<!-- FORM END -->
					<div class="test3"></div>
					<div class="row">
						<form action="/admin/order-insert" method="POST">
							{{csrf_field()}}
							<div class="panel panel-footer" >
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Tên Sản Phẩm</th>
											<th>Brand</th>
											<th>Số lượng</th>
											<th>Giá nhập</th>
											<th>Gía Bán</th>
											<th>Tổng nhập</th>
											<th>Tổng bán</th>
											<th><a href="#" class="addRow"><i class="glyphicon glyphicon-plus"></i></a></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" name="product_name[]" class="form-control product_name"></td> 
											<td><input type="text" name="brand[]" class="form-control brand"></td>    
											<td><input type="text" name="quantity[]" class="form-control quantity" required=""></td>
											<td><input type="text" name="gianhap[]" class="form-control gianhap"></td>
											<td><input type="text" name="budget[]" class="form-control budget"></td>
											<td><input type="text" name="tongnhap[]" class="form-control tongnhap"></td>
											<td><input type="text" name="amount[]" class="form-control amount"></td>
											<td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></a></td>
											</tr>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td style="border: none"></td>
											<td style="border: none"></td>
											<td style="border: none"></td>
											<td style="border: none"></td>
											<td>Tiền lãi &nbsp<b class="tienlai"></b></td>
											<td>Tổng nhập &nbsp<b class="tongnhap"></b> </td>
											<td>Tổng bán &nbsp<b class="total"></b> </td>
											<td><input type="submit" name="" value="Submit" class="btn btn-success"></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
@endsection
@push('scripts')

@endpush