@extends('layouts.admin')
@section('title', 'Order')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Khách hàng</h3>
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
      <div class="col-md-12">
        <div class="x_panel">

          <div class="x_content">
            <a href="{{url('admin/customer-table')}}" class="btn btn-success">Dạng bảng</a>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                
              </div>
              <div class="clearfix"></div>
              @foreach($customer as $p)
              <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                <div class="well profile_view">
                  <div class="col-sm-12">
                    <h4 class="brief"><i>{{$p->customerID}}</i></h4>
                    <div class="left col-xs-7">
                      <h1>{{$p->customerName}}</h1>
                      <p><strong>Gender:{{$p->customerGender}} </strong>  </p>
                      <ul class="list-unstyled">          
                        <li><i class="fa fa-phone"></i> Phone #:{{$p->customerTel}} </li>
                        <li><i class="fa fa-send"></i> Email #:{{$p->customerMail}} </li>
                        <li><i class="fa fa-building"></i> Address:{{$p->customerAddress}} </li>
                      </ul>
                    </div>
                    <div class="right col-xs-5 text-center">
                      <img src="../upload/user.png" alt="" class="img-circle img-responsive">
                    </div>
                  </div>
                  <div class="col-xs-12 bottom text-center">
                    <div class="col-xs-12 col-sm-6 emphasis">
                      <p class="ratings">
                        <a>4.0</a>
                        <a href="#"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star-o"></span></a>
                      </p>
                    </div>
                    <div class="col-xs-12 col-sm-6 emphasis">
                      <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
                      </i> <i class="fa fa-comments-o"></i> </button>
                      <a href="{{url('admin/customer-profile',$p->customerID)}}" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"> </i>View Profile
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<!-- /page content -->
@endsection