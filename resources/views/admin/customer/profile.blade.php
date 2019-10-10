<!-- /*
    *   Created by  :   pkmm - 5/3/2019 
    *   Description :   PROFILE CUA CUSTOMER
*/ -->
@extends('layouts.admin')
@section('title', 'Profile')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>User Profile</h3>
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
          <div class="x_title">
            <h2>User Report <small>Activity report</small></h2>
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
          </div>
          <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <img src="../../upload/user.png" alt="" class="img-circle img-responsive">
                </div>
              </div>
              @foreach ($profile as $p)
              <h3>{{$p->customerName}}</h3>
              <ul class="list-unstyled user_data">
                <li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp{{$p->customerAddress}}</li>
                <li><i class="fa fa-briefcase user-profile-icon"></i> {{$p->customerGender}}</li>
                <li class="m-top-xs">
                  <i class="fa fa-external-link user-profile-icon"></i>
                  <a href="http://www.kimlabs.com/profile/" target="_blank">{{$p->customerTel}}</a>
                </li>
              </ul>
              @endforeach
              <a href="{{url('admin/customer-edit',$p->customerID)}}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
              <br />
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Hoạt Động Gần Đây</a>
                  </li>
                </ul>
                @foreach ($order_profile as $pp)
                <div id="myTabContent" class="tab-content">                 
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                 
                    <!-- start recent activity -->
                    <ul class="messages">
                      <li>
                        <img src="../../upload/user.png" class="avatar" alt="Avatar">
                        <div class="message_date">
                          <h3 class="date text-info"><?php echo date('d',strtotime("$pp->orderCreate"));?></h3>
                          <p class="month">Tháng <?php echo date('m',strtotime("$pp->orderCreate"));?></p>
                        </div>
                        <div class="message_wrapper">
                          <h4 class="heading">{{$pp->orderStatus_vi}}</h4>
                          <blockquote class="message">Đã mua sp trên 
                            <a href="{{$pp->orderLink}}" class="label label-primary">{{$pp->orderChannel}}-{{$pp->orderID}}</a>
                          </blockquote>
                          <br />
                          <p class="url">
                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                            <a href="{{$pp->orderShipLink}}"><i class="fa fa-paperclip"></i> Nhà Vận Chuyển: {{$pp->orderShip}}-{{$pp->orderShipID}}</a>
                          </p>
                        </div>
                      </li>
                    </ul>
                    <!-- end recent activity -->
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
<!-- /page content -->
@endsection