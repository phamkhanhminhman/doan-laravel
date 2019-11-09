<!--  /*
*
*   Description :   data dynamic angular, logic button
*   26/2/2019 - notice khi change status, search theo dropdown, count số đơn
*/ -->
@extends('layouts.admin')
@section('title', 'Order')
@section('content')
<div class="right_col" role="main" ng-app="myApp" ng-controller="MyController">
 <div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Danh sách đơn hàng <span><a href="{{url('admin/order-add')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> Tạo Đơn Mới </a></span>
        <a href="" class="btn btn-success" ng-click="updateExceptDone()">Đồng Bộ Đơn Sendo</a>
        </h3>


    </div>
    <div class="title_right">
      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        <div class="input-group">
          <label for="">Sửa đơn hàng &nbsp </label>
          <input type="checkbox" ng-model="show">
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="">
          <div class="clearfix"></div>
          <div class="">
            <!-- START HEAD ------------------------------------------------------------------------------------------------------->
            <div class="row">
              <div class="col-md-3 col-sm-2 col-xs-12">
               <input class="form-control" placeholder="mã đơn,mã ship, sdt" ng-model="searchText" ng-keypress="searchFull($event)">
             </div>
             <div class="col-md-3 col-sm-2 col-xs-12">
              <select class="form-control col-md-7 col-xs-12" name="categoryID" id="" ng-click="order_status()" ng-model="orderStatus">
                <option value="">         Trạng thái đơn hàng</option>
                <option value="Shipping"> Đang vận chuyển</option>
                <option value="Received"> Đã nhận hàng</option>
                <option value="Done">     Đơn hoàn tất</option>
                <option value="ReturnOK"> Đã nhận lại</option>
                <option value="Returning">Chuyển hoàn</option>
                <option value="Complain"> Khiếu nại</option>
              </select>
            </div>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <select class="form-control col-md-7 col-xs-12" name="categoryID" id="" ng-change="channel()" ng-model="xyz">
                <option value="">            Channel</option>
                <option value="Sen Đỏ" >       Sen Đỏ</option>
                <option value="Shopee">       Shopee</option>
              </select>
            </div>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span>December 26, 2018 - January 24, 2019</span> <b class="caret"></b>
              </div>
            </div>
          </div>
          <!-- END HEAD ------------------------------------------------------------------------------------------------->
          <br>
          <!-- START BUTTON --------------------------------------------------------------------------------------------->
          <div class="row">
           <div class="col-md-6 col-sm-6 col-xs-6">
             <div class="col-md-6 col-xs-12">
               <button class="col-md-12 col-xs-12 btn" id="all" style="background: orange; color:black;font-weight:bold" ng-click=get_all()>Tất cả (@{{count_all}})
               </button>
             </div>
             <div class="col-md-6 col-xs-12">
              <button class="col-md-12 col-xs-12 btn" id="dhvc" style="color:black;font-weight:bold" ng-click="get_dhvc()">
                Đơn Vận Chuyển (@{{count_ship_and_received}})
              </button>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6" >
           <div class="col-md-6 col-xs-12">
             <button class="col-md-12 col-xs-12 btn " id="dhht" style="color:black;font-weight:bold" ng-click="get_dhht()" >Đơn Hoàn Tất (@{{count_completed_received}})</button>
           </div>
           <div class="col-md-6 col-xs-12">
             <button class="col-md-12 col-xs-12 btn " id="dhsc" style="color:black;font-weight:bold" ng-click="get_dhsc()" >Đơn Hàng Sự Cố (@{{count_cancle_return}})</button>
           </div>
         </div>
       </div>

      <div class="container">
        <div class="row" style="margin-top: 8px;" >
          <div class="col-md-12 col-xs-12 col-md-offset-2">
             <button class="btn " disabled="" id="clh" >Chờ Lấy Hàng</button>
             <button class="btn " disabled="" id="dvc" ng-click="get_shipping()">Đang Vận Chuyển (@{{count_shipping}})</button>
             <button class="btn " disabled="" id="dnh" ng-click="get_dnh()">Đã Nhận Hàng (@{{count_received}})</button>
             <button class="btn " disabled="" id="dnt" ng-click="get_dnt()"> Đã Nhận Tiền (@{{count_done}})</button>
             <button class="btn " disabled="" id="dnl" ng-click="get_dnl()"> Đã Nhận Lại (@{{count_returnok}})</button>
             <button class="btn " disabled="" id="ch"  ng-click="get_ch()"> Chuyển Hoàn (@{{count_returning}})</button>
             <button class="btn " disabled="" id="kn"  ng-click="get_kn()" >Khiếu Nại (@{{count_complain}})</button>
          </div>
        </div>
      </div>
     <!-- END BUTTON ---------------------------------------------------------------------------------------------------->
   </div>
 </div>
</div>
</div>
</div>

<!-- PAGINATION ---------------------------------------------------------------------------------------------------------->
<div class="x_panel" style="padding: 5px; height: 70px;">
  <nav aria-label="Page navigation example" style="margin-top: -15px; margin-left: 10px;">
  <ul class="pagination pagination-circle pg-blue pagination-lg justify-content-end">
    <li class="page-item ">
      <a class="page-link" tabindex="-1">Previous</a>
    </li>
    <!-- <li class="page-item active"><a class="page-link" ng-click="pagination(123,456)">1</a></li> -->
    <li class="page-item" ng-repeat="t in arrayPageIndex" ng-click="pagination(t.id,10)" ng-class="{active: t.id===page}">
      <a class="page-link">@{{t.id}}</a></li>
    <li class="page-item ">
      <a class="page-link">Next</a>
    </li>
  </ul>
</nav>
</div>
<!-- PAGINATION ---------------------------------------------------------------------------------------------------------->


<div class="row" ng-repeat="pp in all | filter:searchText" ng-show="!show">
<div class="col-md-12 col-xs-12">
<div class="x_panel">
  <div class="x_title">
    <a href="@{{pp.orderLink}}" class="col-md-1" target="_blank" style="color:blue">
      <div style="margin-top:10px">
      <h4 ng-model="pp.orderChannel" class ="label" style="font-size:18px;background-color:#FA5430; margin-left: -15px" ng-if="pp.orderChannel === 'Shopee' ">@{{pp.orderChannel}}</h4>
        <h4 ng-model="pp.orderChannel" class ="label" style="font-size:18px;background-color:red; margin-left: -15px " ng-if="pp.orderChannel === 'Sen Đỏ' ">@{{pp.orderChannel}} - @{{pp.orderShopName}}</h4>
        <h4 ng-model="pp.orderChannel" class ="label" style="font-size:18px;background-color:#FFA500; margin-left: -15px " ng-if="pp.orderChannel === 'Store' ">@{{pp.orderChannel}}</h4>
      </div>
    </a>
    <div>
    <a href="@{{pp.orderLink}}" class="col-md-2"target="_blank" style="color:red;font-weight:bold" ng-if ="pp.orderChannel === 'Sen Đỏ'"><h4 ng-model="pp.orderID" style="font-size:18px "  >@{{pp.orderID}}</h4> </a>
    <a href="@{{pp.orderLink}}" class="col-md-2"target="_blank" style="color:orange;font-weight:bold" ng-if ="pp.orderChannel === 'Shopee'"><h4 ng-model="pp.orderID" style="font-size:18px "  >@{{pp.orderID}}</h4> </a>
    <a href="@{{pp.orderLink}}" class="col-md-2"target="_blank" style="color:orange;font-weight:bold" ng-if ="pp.orderChannel === 'Store'"><h4 ng-model="pp.orderID" style="font-size:18px "  >@{{pp.orderID}}</h4> </a>
    
    </div>
    
    <div class="col-md-2"><h4>@{{pp.orderDate | date : "dd.MM.y" }}</h4></div>
    <div class="col-md-3" style="margin-top:10px">
      <!-- <a href="@{{pp.orderShipLink}}" target="_blank"><h4 class="label label-warning" style="font-size:16px;font-weight: 90">@{{pp.orderShip}}-@{{pp.orderShipID}}</h4>
      </a> -->
      <!-- <a href="@{{pp.orderShipLink}}" target="_blank"><h4 class="label" style="font-size:16px;font-weight: 90; background-color: #188038">@{{pp.CarrierName}} @{{pp.orderShipID}} @{{pp.shipToRegionName}}</h4>
      </a> -->
      <a href="@{{pp.orderShipLink}}" target="_blank"><h4 class="label" style="font-size:16px;font-weight: 90; background-color: #00B3A6;color:white; align-content:center" ng-if="pp.CarrierName === 'VIETTEL-CPN' ">@{{pp.CarrierName}} @{{pp.shipToRegionName}}</h4>
      </a>
      <a href="@{{pp.orderShipLink}}" target="_blank"><h4 class="label" style="font-size:16px;font-weight: 90; background-color: #FCB71E;color:white" ng-if="pp.CarrierName === 'VNPost' ">@{{pp.CarrierName}} @{{pp.shipToRegionName}}</h4>
      </a>
      <a href="@{{pp.orderShipLink}}" target="_blank"><h4 class="label" style="font-size:16px;font-weight: 90; background-color: #0049FF;color:white" ng-if="pp.CarrierName === 'GHN' ">@{{pp.CarrierName}} @{{pp.shipToRegionName}}</h4>
      </a>
      <a href="@{{pp.orderShipLink}}" target="_blank"><h4 class="label" style="font-size:16px;font-weight: 90; background-color: #DB0037;color:white" ng-if="pp.CarrierName === 'NJV-STANDARD' ">@{{pp.CarrierName}} @{{pp.shipToRegionName}}</h4>
      </a>
      <a href="@{{pp.orderShipLink}}" target="_blank"><h4 class="label" style="font-size:16px;font-weight: 90; background-color: #196F3D ;color:white; align-content:center" ng-if="pp.CarrierName === 'Giao Hàng Tiết Kiệm' ">GHTK @{{pp.shipToRegionName}}</h4>
      </a>
      <a href="@{{pp.orderShipLink}}" target="_blank"><h4 class="label" style="font-size:16px;font-weight: 90; background-color: blue ;color:white; align-content:center" ng-if="pp.CarrierName === 'Store' ">Store @{{pp.shipToRegionName}}</h4>
      </a>
    </div>
    <div class="col-md-1 col-xs-4"><h4>@{{pp.user}}</h4></div>
    <div style="margin-top:10px;margin-left:-108px" class="col-md-2 col-xs-4">
      <!-- <h4 class="label labels label-primary " id="orderStatus" style="font-size:16px;font-weight: 90">@{{pp.orderStatus_vi}}</h4> -->
      <h4 class="label labels" id="orderStatus" style="font-size:16px;font-weight: 90;background:#04A862" ng-if="pp.orderStatus === '2'">@{{pp.orderStatusDes}}</h4>
      <h4 class="label labels" id="orderStatus" style="font-size:16px;font-weight: 90;background:#7D3C98" ng-if="pp.orderStatus === '3'">@{{pp.orderStatusDes}}</h4>
      <h4 class="label labels" id="orderStatus" style="font-size:16px;font-weight: 90;background:#007DBD" ng-if="pp.orderStatus === '6'">@{{pp.orderStatusDes}}</h4>
      <h4 class="label labels" id="orderStatus" style="font-size:16px;font-weight: 90;background:#47B347" ng-if="pp.orderStatus === '7'">@{{pp.orderStatusDes}}</h4>
      <h4 class="label labels" id="orderStatus" style="font-size:16px;font-weight: 90;background:green"   ng-if="pp.orderStatus === '8'">@{{pp.orderStatusDes}}</h4>
      <h4 class="label labels" id="orderStatus" style="font-size:16px;font-weight: 90;background:black"   ng-if="pp.orderStatus === '13'">@{{pp.orderStatusDes}}</h4>
    </div>
    <div class="col-md-1 " style="color: red;margin-left:10px"><h4 style="font-weight:bold">@{{pp.orderSell|number:0}} đ</h4></div>
    <!-- <div class="col-md-1 " style="color: red;margin-left:10px"><h4 style="font-weight:bold">@{{pp.orderSell-pp.orderCost |number:0}} đ</h4></div> -->
    <div class="clearfix"></div>
  </div>
  <div class="x_content"  ng-repeat="t in allv2" ng-if="t.orderID==pp.orderID" style="padding:0px">
    <div class="row" style="height:60px">
      <div class="col-md-1" style="margin-top:-10px">
        <!-- <img src="../@{{t.productImage}}" alt="" width="80px" height="80px"> MAN -->
        <img  src="@{{t.productImage}}" alt="" width="80px" height="80px">
      </div>
      <div style="margin-left:7px" class="col-md-2">
        <h4 style="font-weight:bold">@{{t.productName}} </h4>
      </div>
      <div class="col-md-2" >
        <h4 ><span style="color:#666666">SKU:</span> <span style="font-weight:bold">@{{t.productSKU}}</span> </h4>
      </div>
      <div class="col-md-2" >
        <h4><span style="color:#666666">Số lượng:</span>  <span style="font-weight:bold">@{{t.Amount}}</span>  </h4>
      </div>
      <div class="col-md-2" >
        <h4><span style="color:#666666">Giá nhập:</span> @{{t.productCost |number:0}}</h4>
      </div>
      <div class="col-md-2">
        <h4><span style="color:#666666">Giá bán:</span> <span style="font-weight:bold">@{{t.product_Sell |number:0}}</span></h4>
      </div>
    </div>
    <hr>
  </div>

  <div class="row" >
   
   
   <div class="col" style="float: right">
     <button  type="button" style="background:#2ecc71;color:white"class="btn btn-success" ng-click="confirmOrderSendo(pp.orderID)">Xác Nhận Đơn</button>
     <button  type="button" style="background:#FF5230;color:white" class="btn"  onclick="new PNotify({
                                title: 'Cập nhật thành công',
                                text: 'Chuyển trạng thái đơn ĐANG VẬN CHUYỂN',
                                type: 'success',
                                styling: 'bootstrap3'
                                });">Chi tiết đơn hàng</button>  
     <button  type="button" style="background:#101010;color:white"class="btn btn-success"  onclick="new PNotify({
                                title: 'Cập nhật thành công',
                                text: 'Chuyển trạng thái đơn ĐANG VẬN CHUYỂN',
                                type: 'success',
                                styling: 'bootstrap3'
                                });">Hủy Đơn</button>  
   </div>
  <div class="col"><h2 style="font-size:19px;font-weight:bold;color:black;margin-top:30px">@{{pp.customerName}} @{{pp.customerTel}}</h2></div>

               
      
</div>     
    <!-- LIST BUTTON -->
    <!-- <div class="row">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-7">
        <button type="button" style="background:#177A89;color:white"class="btn btn-info" ng-model="dnh" ng-click="changeOrderStatus(pp)" onclick="new PNotify({
                                title: 'Cập nhật thành công',
                                text: 'Đã chuyển trạng thái đơn thành ĐÃ NHẬN HÀNG',
                                type: 'success',
                                styling: 'bootstrap3'
                            });">Đã Nhận Hàng</button>
        <button class="btn btn" style="background:#4CAF50;color:white" type="button" ng-click="changeOrderStatusv2(pp)" id="dnt-b" onclick="new PNotify({
                                title: 'Cập nhật thành công',
                                text: 'Đã chuyển trạng thái đơn thành HOÀN TẤT',
                                type: 'success',
                                styling: 'bootstrap3'
                            });">Đã Nhận Tiền</button>
        <button type="button" ng-click="changeOrderStatusv3(pp)" style="background:black;color:white" class="btn btn-danger" onclick="new PNotify({
                                title: 'Cập nhật thành công',
                                text: 'Đã chuyển trạng thái đơn thành CHUYỂN HOÀN',
                                type: 'success',
                                styling: 'bootstrap3'
                            });">Chuyển Hoàn</button>
        <button type="button" ng-click="changeOrderStatusv4(pp)" style="background:#EE2A24;color:white" class="btn btn-danger" onclick="new PNotify({
                                title: 'Cập nhật thành công',
                                text: 'Đã chuyển trạng thái đơn thành KHIẾU NẠI',
                                type: 'success',
                                styling: 'bootstrap3'
                            });" >Khiếu Nại</button>
        <button type="button" ng-click="changeOrderStatusv5(pp)" style="background:#ff9900;color:white" class="btn" onclick="new PNotify({
                                title: 'Cập nhật thành công',
                                text: 'Đã chuyển trạng thái đơn thành ĐÃ NHẬN LẠI',
                                type: 'success',
                                styling: 'bootstrap3'
                            });" >Đã Nhận Lại</button>
      </div>
    </div> -->




  </div>
</div>
</div>
</div>
<!-- EDIT DON HANG---------------------------------------------------------------------------------------------------------------------->
<div class="row" ng-repeat="pp in all | filter:searchText " ng-show="show">
<div class="col-md-12 col-xs-12">
<div class="x_panel">
  <div class="x_title">
    <div class="col-md-2">
      <input type="text" name="orderID"  class="form-control" ng-model="pp.orderID">
    </div>
     <div class="col-md-2"> <select ng-model="pp.orderChannel" id="" class="form-control">
                <option value="Sendo"> Sendo</option>
                <option value="Shopee">Shopee</option>
                <option value="Home"> Home</option>
    </select></div>
    <div class="col-md-2"> <select ng-model="pp.orderShip" id="" class="form-control">
                <option value="">           Nhà Vận Chuyển</option>
                <option value="GHN" >       GHN</option>
                <option value="GHTK">       GHTK</option>
                <option value="VNPost">     VNPost</option>
                <option value="Viettel">ViettelPost</option>
                <option value="NJV">        NJV</option>
                <option value="Home">       Home</option>
    </select></div>
    <div class="col-md-2">
      <input type="text" class="form-control" ng-model="pp.orderShipID">
    </div>
    <div class="col-md-2 col-xs-4"><h4>@{{pp.user}}</h4></div>
    <div style="margin-top:10px" class="col-md-2 col-xs-4">
      <h4 class="label labels label-primary " id="orderStatus" style="font-size:16px;font-weight: 90">@{{pp.orderStatus_vi}}</h4>
    </div>
    <div class="col-md-1 " style="color: red"><h4>@{{pp.orderSell-pp.orderCost}}đ</h4></div>
    <div class="clearfix"></div>
  </div>
  <div class="x_content"  ng-repeat="t in allv2" ng-if="t.orderID==pp.orderID">
    <div class="row">
      <div class="col-md-1">
        <img src="@{{t.productImage}}" alt="" width="80px" height="80px">
      </div>
      <div class="col-md-3">
        <h4>@{{t.productName}}</h4>
      </div>
      <div class="col-md-3">
        <h4>MÃ SP: @{{t.productID}} </h4>
      </div>
      <div class="col-md-3">
        <h4>SỐ LƯỢNG</h4>
      </div>
    </div>
    <hr>
  </div>
  <div class="form-group">
    <h2>@{{pp.customerName}} - @{{pp.customerTel}} - <span>@{{pp.name}}</span></h2>
    <div class="col-md-3 col-sm-9 col-xs-12 col-md-offset-10">
      <button type="button" ng-click="editOrder(pp)" style="color:white"class="btn btn-info" ng-model="dnh" ng-click="" onclick="new PNotify({
                              title: 'Cập nhật đơn hàng thành công',
                              text: 'Sửa đơn hàng',
                              type: 'success',
                              styling: 'bootstrap3'
                          });">Xác nhận
      </button>
      <button type="button" style="background:#EE2A24;color:white" class="btn"  ng-click="" onclick="new PNotify({
                              title: 'Xóa đơn hàng thành công',
                              text: '',
                              type: 'warning',
                              styling: 'bootstrap3'
                          });">Delete
      </button>
    </div>
  </div>
</div>
</div>
</div>
<!-- EDIT DON HANG------------------------------------------------------------------------------------------------------------------------------  -->
</div>
</div>
<script src="{{asset('assets/admin/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/vendors/button-business.js')}}"></script>
<script>
$(document).ready(function() {
    var orderID=$("#ee").text();
    console.log(orderID);
    $.ajax({
    url: "{{ route('order_detail') }}",
    dataType: 'json',
    data: {orderID: orderID},
    })
    .done(function(data) {
    console.log(data);
    })
    .fail(function() {
    console.log("error");
    })
    .always(function() {
    console.log("complete");
    });
});


$('li').click(function() {
  $(this).addClass('active').siblings().removeClass('active');
});
</script>
@endsection
