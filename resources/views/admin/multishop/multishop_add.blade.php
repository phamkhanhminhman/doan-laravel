@extends('layouts.admin')
@section('title', 'Lịch sử hoạt động')
@section('content')
<div class="right_col" role="main">
 <a id="send" type="submit" class="btn btn-primary" href="{{url('admin/multishop')}}">Trở Về</a>
 

 <div class="row">
  <div class="col-md-9 col-sm-9 col-xs-9">
    <div class="x_panel">
      <div class="x_content">
        <form  action="{{url('admin/multishop-insert')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
          @csrf
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Client ID <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12" name="clientID"  placeholder="Nhập Client ID"  type="text">
            </div>
            <button     id="send" type="submit" class="btn btn-success">Xác Nhận</button>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Secret ID<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"  name="secretID"  class="form-control col-md-7 col-xs-12" placeholder="Nhập Secret ID">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Partner ID<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"  name="partnerID"  class="form-control col-md-7 col-xs-12" placeholder="Nhập Partner ID">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tên Sàn<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"  name="shopChannel"  class="form-control col-md-7 col-xs-12" placeholder="Nhập Tên San">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tên Shop<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="shopName"  class="form-control col-md-7 col-xs-12" placeholder="Nhập Tên Shop">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">ShopCode<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="code" id="" class="form-control">
                <option value="SD">Sen Do (SD)</option>
                <option value="SP">Shopee (SP)</option>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>



</div>
</div>
@endsection