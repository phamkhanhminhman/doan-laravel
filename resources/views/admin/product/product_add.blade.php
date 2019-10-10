<!--  /*
    *   Created by  :   pkmm - 20/1/2019 
    *   Updated by  :   pkmm - 21/2/2019 - auto return img, them dc nhieu sp 1 lan 
    *   Description :   autocomplete search
*/ -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="" type="" />

  <title>QUẢN LÝ BÁN HÀNG</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
  <link href="{{asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{asset('assets/admin/build/css/custom.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

  <!-- <link rel="stylesheet" href="{{asset('assets/admin/vendors/angular-material.min.css')}}"> -->
</head>

<body class="nav-md" ng-app="myApp" ng-controller="MyController">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="{{url('admin')}}" class="site_title"><i class="fa fa-paw"></i> <span>ADMIN</span></a>
          </div>

          <div class="clearfix"></div>
          <!-- SIDE BAR -->
         @if(Session::get('role')==1)
          @includeIf('partials.admin_sidebar')
          @endif
          @if(Session::get('role')!==1)
          @includeIf('partials.smod_sidebar')
          @endif
          <!-- SIDE BAR -->
        </div>
      </div>
      <!-- top navigation bar -->
      @includeIf('partials.admin_navbar')
      <!-- /top navigation bar -->
      <!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<!-- HEADER START -->
		<div class="page-title">
			<div class="title_left">
				<h3><i class="fa fa-tag"></i> Thêm Sản Phẩm Mới</h3>
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
						<form action="{{url('admin/product-insert')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
							@csrf
							<span class="section">Thông Tin Chi Tiết</span>
							
							<!-- MA LOAI SP END -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên Loại Sản Phẩm <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input class="form-control autocomplete_txt" placeholder="Search theo tên loại SP có sẵn" type='text' data-type="countryname" id='countryname_1' name='product_typeName'/>
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mã Loại Sản Phẩm <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input class="form-control"  type='text' data-type="product_typeID" id='product_typeID' name='product_typeID'/>
									
									<div id="countryList">

									</div>
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số lượng <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input class="form-control" type='text'  name='amount'/>
								</div>
							</div>
							<!-- MA LOAI SP START -->
							@foreach ($data_product as $p)
							<div class="item form-group">
								<label  class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mã Sản Phẩm <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input disabled id="productID" name="productID" class="form-control col-md-7 col-xs-12" placeholder="Nhập Mã Loại Sản Phẩm" required="required" type="number" value="{{$p->productID+1}}">
								</div>
							</div>
							@endforeach
							<!-- GIA NHAP START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Giá Nhập <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12" >
									<div>
									<input type="text"  name="productCost" id="product_typeCost" value="" class="form-control col-md-7 col-xs-12">
									</div>
									<div id="gianhap">

									</div>	
								</div>
							</div>
							<!-- GIA NHAP END -->

							<!-- GIA BAN START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Giá Bán <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div>
									<input type="text"  name="productSell" id="product_typeSell" value="" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
							</div>
							<!-- GIA BAN END -->

							<!-- IMG START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">IMG <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<img class="img-thumbnail" src=""  name="productImage" id="product_typeIMG" width="70%" class="col-md-7 col-xs-12">
								</div>
							</div>
							<!--IMG END -->

							<!-- NOTE START -->
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ghi Chú <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text"  name="productNote"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<!-- NOTE END -->

							
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<a href="/admin/product" class="btn btn-primary">Trở về</a>
									<button id="send" type="submit" class="btn btn-success">Thêm Mới</button>
								</div>
							</div>
						</form>
					</div>
					<!-- CONTENT END -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- footer content -->
@includeIf('partials.admin_footer')
<!-- /footer content -->
<script src="{{asset('assets/admin/vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- jQuery -->

<!-- Bootstrap -->
<script src="{{asset('assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- <script src="{{asset('assets/admin/vendors/font-awesome/css/all.js')}}"></script> -->
<!-- Custom Theme Scripts -->
<script src="{{asset('assets/admin/build/js/custom.min.js')}}"></script>
<!-- Switchery -->
<script src="{{asset('assets/admin/vendors/switchery/dist/switchery.min.js')}}"></script>
<!-- ANGULAR -->
<script src="{{asset('assets/admin/vendors/angular-1.5.min.js')}}"></script>  
<script src="{{asset('assets/admin/vendors/angular-animate.min.js')}}"></script>
<script src="{{asset('assets/admin/vendors/angular-aria.min.js')}}"></script>
<script src="{{asset('assets/admin/vendors/angular-messages.min.js')}}"></script>
<script src="{{asset('assets/admin/vendors/angular-material.min.js')}}"></script> 
<script src="{{asset('assets/admin/vendors/1.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
 $(document).on('focus','.autocomplete_txt',function(){
  type = $(this).data('type');
  
  if(type =='countryname' )autoType='name'; 
  
  $(this).autocomplete({
   minLength: 0,
   source: function( request, response ) {
    $.ajax({
      url: "{{ route('product-searchajax') }}",
      dataType: "json",
      data: {
        term : request.term,
        type : type,
      },
      success: function(data) {
        var array = $.map(data, function (item) {
         return {
           label123: item[autoType],
           value: item[autoType],
           data : item
         }
       });
        response(array)
      }
    });
  },
  select: function( event, ui ) {
   var data = ui.item.data;           
   id_arr = $(this).attr('id');
   id = id_arr.split("_");
   elementId = id[id.length-1];
   $('#countryname').val(data.name);
   $('#product_typeCost').val(data.cost);
   $('#product_typeSell').val(data.sell);
   $('#product_typeID').val(data.pid);
   $('#product_typeIMG').attr('src', '../'+data.img); 
 }
});


});
</script>
