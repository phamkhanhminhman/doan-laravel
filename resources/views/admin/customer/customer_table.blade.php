@extends('layouts.admin')
@section('title', 'Khách hàng')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><i class="fa fa-tag"></i> Khách hàng </h3>
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
            <a href="{{url('admin/customer')}}" class="btn btn-success">Dạng thẻ</a>
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

            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th>Tên</th>
                  <th>Địa chỉ</th>
                  <th>Số điện thoại</th>                        
                  <th>Giới tính</th>
                  <th>Ghi chú</th>  
                  <th>Sửa</th>
                  <th>Xóa</th>                    
                </tr>
              </thead>
              <tbody>
                @foreach ($customer as $p)   
                <tr>
                  <td class="text-center">{{$p->customerID}}</td>
                  <td class="text-center">{{$p->customerName}}</td>
                  <td>{{$p->customerAddress}}</td>
                  <td>{{$p->customerTel}}</td>
                  <td>{{$p->customerNote}}</td>
                  <td>{{$p->customerMail}}</td>
                  <td><a href="{{url('admin/customer-edit',$p->customerID)}}" class="btn btn-warning"><i class="fa fa-pencil"></i></i></a></td>
                  <td><a href="{{url('admin/customer-delete',$p->customerID)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-close"></i></a></td>
                </tr>
                @endforeach  
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection