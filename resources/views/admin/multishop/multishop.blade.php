@extends('layouts.admin')
@section('title', 'Lịch sử hoạt động')
@section('content')
<div class="right_col" role="main">
 <a id="send" type="submit" class="btn btn-primary" href="{{url('admin/multishop/add-new-shop')}}">Thêm Shop Mới</a>
 

 <div class="row">


  <?php foreach ($multishop as $k): ?>
    <div class="col-md-9 col-sm-9 col-xs-9">
      <div class="x_panel">
        <div class="x_content">
          <form  class="form-horizontal" >
            @csrf
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Client ID <span class="required">*</span>

              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input  class="form-control col-md-7 col-xs-12" name="clientID" value="{{$k->shopID}}" placeholder="Nhập Client ID"  type="text">
              </div>
               <td><a href="{{url('admin/multishop-edit',$k->shopID)}}" class="btn btn-warning"><i class="fa fa-pencil">Sửa</i></a></td>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Secret ID<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text"  name="secretID" value="{{$k->secretID}}" class="form-control col-md-7 col-xs-12" placeholder="Nhập Secret ID">
              </div>
            </div>
             <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Partner ID<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text"  name="partnerID" value="{{$k->partnerID}}" class="form-control col-md-7 col-xs-12" placeholder="Nhập Partner ID">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tên Sàn<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text"  name="shopChannel" value="{{$k->shopChannel}}" class="form-control col-md-7 col-xs-12" placeholder="Nhập Tên San">
              </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tên Shop<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="shopName" value="{{$k->shopName}}" class="form-control col-md-7 col-xs-12" placeholder="Nhập Tên Shop">
            </div>
          </div>



        </form>
      </div>
      </div>
    </div>
<?php endforeach ?>


</div>
</div>
@endsection