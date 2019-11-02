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
          @includeIf('partials.admin_sidebar')
          <!-- SIDE BAR -->
          @include('sweetalert::alert')
        </div>
      </div>
      <!-- top navigation bar -->
      @includeIf('partials.admin_navbar')
      <!-- /top navigation bar -->
      <!-- page content -->
      <div class="right_col" role="main">
        <!-- HEADER START -->
        <!-- HEADER END -->
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_content">   
        <!-- <p>For alternative validation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a>
        </p>   -->        
        <div class="row">
          <!-- FORM START ------------------------------------------------------------------------------->
          <form action="/admin/order-insert" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <!-- DON HANG START ------------------------------------------------------------------------------->
            <div class="col-md-5"> 
              <span class="section"><i class="fa fa-tag"></i>&nbsp Đơn Hàng</span>       
              
              <!-- MA DON HANG START ------------------------------------------------------------------------------->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mã Đơn Hàng
                </label>
                <div class="col-md-4 col-sm-4 col-xs-8">
                  <input id="name" name="orderID" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nhập Mã Đơn"  type="text">
                </div>
                <div class="col-md-3 col-sm-2 col-xs-4">
                  <select class="form-control col-md-7 col-xs-12" name="orderChannel" id="">
                    <option value="Store">Store</option>
                  </select>
                </div>
              </div>
              <!-- MA DON HANG END ------------------------------------------------------------------------------->

              <!-- MA VAN CHUYEN START ------------------------------------------------------------------------------->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Mã Vận Chuyển <!-- <span class="required">*</span> -->
                </label>
                <div class="col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="orderShipLink"  class="form-control col-md-7 col-xs-12">
                </div>
                <div class="col-md-3 col-sm-2 col-xs-4">
                  <select class="form-control col-md-7 col-xs-12" name="orderShip" id="">
                    <option value="Store">Store</option>
                  </select>
                </div>
              </div>
              <!-- MA VAN CHUYEN END ------------------------------------------------------------------------------->

              <!-- NOTE START ------------------------------------------------------------------------------->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Ghi Chú <!-- <span class="required">*</span> -->
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                  <textarea type="text"  cols="30" rows="4"  name="orderNote" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
              </div>  
              <!-- NOTE END ------------------------------------------------------------------------------->
            </div>
            <!-- DON HANG END ------------------------------------------------------------------------------->

            <!-- KHACH HANG START ------------------------------------------------------------------------------->
            <div class="col-md-7">
              <span class="section"><i class="fa fa-user"></i>&nbspKhách Hàng</span>
              <!-- MA KHACH HANG START ------------------------------------------------------------------------------->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mã Khách Hàng <!-- <span class="required">*</span> -->
                </label>
                @foreach ($customer as $c) 
                <div class="col-md-4 col-sm-4 col-xs-9">
                  <input id="makhachhang" disabled name="customerID" class="form-control col-md-7 col-xs-12"  type="text" value="{{$c->customerID}}">
                </div>
                @endforeach
                <div class="col-md-5 col-sm-2 col-xs-3">
                  <input type="checkbox"  name="checkbox" unchecked /> Khách Hàng Cũ
                </div>
              </div>
              <!-- MA KHACH HANG END ------------------------------------------------------------------------------->

              <!-- TEN KHACH HANG START ------------------------------------------------------------------------------->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên Khách Hàng <!-- <span class="required">*</span> -->
                </label>
                <div class="col-md-4 col-sm-4 col-xs-8">
                  <input id="name" class="form-control col-md-7 col-xs-12" name="customerName" placeholder="Nhập Tên Khách Hàng"  type="text">
                </div>
                <div class="col-md-3 col-sm-2 col-xs-4">
                  <select class="form-control col-md-7 col-xs-12" name="customerGender" id="">
                    <option value="Male">Nam </option>
                    <option value="Female">Nữ</option>
                  </select>
                </div>
              </div>          
              <!-- TEN KHACH HANG END ------------------------------------------------------------------------------->
              <!-- TEN KHACH HANG START ------------------------------------------------------------------------------->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Thành Phố <!-- <span class="required">*</span> -->
                </label>
                <div class="col-md-4 col-sm-4 col-xs-8">            
                  <select class="selectpicker form-control" data-live-search="true" name="customerProvince" ng-model="bbb" ng-change="changeorder(bbb)">
                    @foreach ($data_tinhthanh as $p)
                    <option value="{{$p->matp}}">{{$p->name}}</option>
                    @endforeach                   
                  </select>           
                </div>
                <div class="col-md-3 col-sm-2 col-xs-4">
                  <select class="form-control col-md-7 col-xs-12" name="customerDistrict" id="">
                    <option ng-repeat="mot in quanhuyen" value="@{{mot.name}}">@{{mot.name}}</option>
                  </select>
                </div>
              </div>          
              <!-- TEN KHACH HANG END ------------------------------------------------------------------------------->
              <!-- DIA CHI KHACH HANG START ------------------------------------------------------------------------------->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Địa Chỉ <!-- <span class="required">*</span> -->
                </label>
                <div class="col-md-7 col-sm-4 col-xs-8">
                  <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="customerAddress" placeholder="Nhập Địa Chỉ"  type="text">
                </div>
              </div>          
              <!-- DIA CHI KHACH HANG END ------------------------------------------------------------------------------->
              <!-- SDT KHACH HANG START ------------------------------------------------------------------------------->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Điện Thoại <!-- <span class="required">*</span> -->
                </label>
                <div class="col-md-7 col-sm-4 col-xs-8">
                  <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="customerTel" placeholder="Nhập Số Điện Thoại" type="text">
                </div>
              </div>          
              <!-- SDT KHACH HANG END------------------------------------------------------------------------------------- -->
              <!-- EMAIL KHACH HANG START ----------------------------------------------------------------------------------->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <!-- <span class="required">*</span> -->
                </label>
                <div class="col-md-7 col-sm-4 col-xs-8">
                  <input id="name"class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="customerMail" placeholder="Nhập Email"  type="email">
                </div>
              </div>          
              <!-- EMAIL KHACH HANG END ------------------------------------------------------------------------------------ -->
            </div>
            <!-- KHACH HANG END------------------------------------------------------------------------------------- -->
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <span class="section"><i class="fa fa-credit-card"></i>&nbsp Thanh Toán</span> 

                <table class="table table-bordered" id="datatable-buttons">
                  <thead>
                    <tr>
                      <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
                      <th class="col-md-1">Mã SP</th>
                      <th class="col-md-2">Tên  SP </th>
                      <th class="col-md-1">IMG</th>
                      <th>Giá Nhập (VND)</th>
                      <th>Giá bán  (VND)</th>
                      <!-- <th>Note</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type='checkbox' class='chkbox'/></td>
                      <td><input class="form-control autocomplete_txt" type='text' data-type="countryname" id='countryname_1' name='countryname[]' required="true" /></td>
                      <td><input class="form-control productID"   type='text'  id='productID_1' name='productID[]'ng-click="changestatus(aaa)" ng-model="aaa"/> </td>
                      <td><img style="margin: 5px" src=""id='productImage_1' alt="" width="80px" height="80px"></td>
                      <td><input class="form-control productCost" type='text'  id='productCost_1' name='productCost[]'/> </td>
                      <td><input class="form-control productSell" type='text'  id='productSell_1' name='productSell[]'/> </td>
                      <!-- <td><input class="form-control productSell" type='text'  id='productSell_1' name='productSell[]'/> </td> -->
                      
                      <!-- <td><input class="form-control autocomplete_txt" type='text' data-type="quantity" value="1"   id='quantity' name='quantity[]'/> </td> -->

                    </tr>
                  </tbody>  
                  <tfoot>
                    <tr>
                      <!-- <td style="border: none"></td> -->
                      <td style="border: none"></td>
                      <td style="border: none"></td>
                      <td style="border: none"></td>
                      <td style="border: none"></td>
                      <td><i class="fa fa-money"></i>&nbspTổng nhập (VND) <input class="form-control" type='text' id='tongnhap' name='tongnhap' disabled /> </td>
                      <td><i class="fa fa-money"></i>&nbspTổng bán  (VND) <input class="form-control" type='text' id='tongban' name='tongban'/>  </td>
                      <td>Tiền lãi <i class="fa fa-money"></i>&nbsp<input class="form-control" type='text'  id='tienlai' name='tienlai'/></td>

                    </tr>
                  </tfoot>
                </table>
                <button type="button" class='btn btn-danger delete'><i class="fa fa-close"></i>&nbsp Delete</button>
                <button type="button" class='btn btn-success addbtn'><i class="fa fa-plus"></i>&nbsp Thêm</button>
                <td><button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbspXác nhận</button></td>

              </div>
            </div>
          </form>
        </div>
        <!--  START THANH TOAN ---------------------------------------------------------------------------------->
        
        <!--  END THANH TOAN ---------------------------------------------------------------------------------->
      </div>
    </div>
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
 //START Hàm để delete những record đã chọn trong phần thanh toán-----------------------------------------------------------------------
 $(".delete").on('click', function() {
  $('.chkbox:checkbox:checked').parents("tr").remove();
  $('.check_all').prop("checked", false); 
  updateSerialNo();
});
 //END Hàm để delete những record đã chọn trong phần thanh toán-------------------------------------------------------------------------
 
 //START Hàm để disable ô Mã Khách Hàng tùy theo cũ mới----------------------------------------------------------------------------------
 $('input[name=checkbox]').on( 'click', function() {
   if($(this).prop("checked") == true){
    $('form input[type="text"]').prop("disabled", false);
  }else{
    $('#makhachhang').prop("disabled", true);
  }
});
  //END Hàm để disable ô Mã Khách Hàng tùy theo cũ mới----------------------------------------------------------------------------------
  
  //START Hàm append thêm record mới trong phần thanh toán------------------------------------------------------------------------------
  var i=$('table tr').length;
  $(".addbtn").on('click',function(){
    count=$('table tr').length;

    var data="<tr><td><input type='checkbox' class='chkbox'/></td>";
    data+="<td><input class='form-control autocomplete_txt' type='text' data-type='countryname' id='countryname_"+i+"' name='countryname[]'/></td>";
    data+="<td><input class='form-control productID'   type='text' data-type='productID'   id='productID_"+i+"' name='productID[]'/></td>";
    data+="<td><img style='margin: 5px' src='' id='productImage_"+i+"' width='80px' height='80px'></td>";
    data+="<td><input disabled class='form-control productCost' type='text' data-type='productCost' id='productCost_"+i+"' name='productCost[]'/></td>";
    data+="<td><input disabled class='form-control productSell' type='text' data-type='productSell' id='productSell_"+i+"' name='productSell[]'/></td>";
    
    // data+="<td><input class='form-control autocomplete_txt' type='text' data-type='country_code' value='1' id='country_code_"+i+"' name='country_code[]'/></td></tr>";

    $('table').append(data);
    i++;
  });
//END Hàm append thêm record mới trong phần thanh toán-----------------------------------------------------------------------------------

//START Hàm select all record phần thanh toán--------------------------------------------------------------------------------------------
function select_all() {
  $('input[class=chkbox]:checkbox').each(function(){ 
    if($('input[class=check_all]:checkbox:checked').length == 0){ 
      $(this).prop("checked", false); 
    } else {
      $(this).prop("checked", true); 
    } 
  });
}
//END Hàm select all record phần thanh toán----------------------------------------------------------------------------------------------
function updateSerialNo(){
  obj=$('table tr').find('span');
  $.each( obj, function( key, value ) {
    id=value.id;
    $('#'+id).html(key+1);
  });
}
//START autocomplete script trong phần THANH TOÁN------------------------------------------------------------------------------------
$(document).on('focus','.autocomplete_txt',function(){
  type = $(this).data('type');
  
  if(type =='countryname' )autoType='sku'; 
  if(type =='country_code' )autoType='sortname'; 
  
  $(this).autocomplete({
   minLength: 0,
   source: function( request, response ) {
    $.ajax({
      url: "{{ route('searchajax') }}",
      dataType: "json",
      data: {
        term : request.term,
        type : type,
      },
      success: function(data) {
        var array = $.map(data, function (item) {
         return {
           // label: item[autoType]+' '+'Mã'+' '+item.sku,
           label: item.sku + ' ' + item.name,
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
   $('#countryname_'+elementId).val(data.name);
   $('#productCost_'+elementId).val(data.cost);
   $('#productSell_'+elementId).val(data.sell);
   $('#productID_'  +elementId).val(data.name);
   console.log(data.pid);
   $('#productImage_'  +elementId).attr('src', data.img); 
 }
});
});
//END autocomplete script trong phần THANH TOÁN------------------------------------------------------------------------------------
</script>
<script type="text/javascript">
  $('body').click('body',function(){
    var tr=$(this).parent().parent();
    var quantity=tr.find('.quantity').val();
    var productCost=tr.find('.productCost').val();
    var productSell=tr.find('.productSell').val();
    total();
  });
  function total(){
    var total=0;
    var total2=0;
    $('.productCost').each(function(i,e){
      var amount=$(this).val()-0;
      total +=amount;
                  //  console.log("tong nhap "+total);
                  $('#tongnhap').val(total);
                });
    $('.productSell').each(function(i,e){
      var amount2=$(this).val()-0;
      total2 +=amount2;
      $('#tongban').val(total2);
    });
    console.log("tong nhap "+total);
    $('#tienlai').val(total2-total+".00 VND");

  }
//Hàm tính tổng tiền nhập bán lãi-----------------------------------------------------------------------------------------------
</script>
</body>
</html>
