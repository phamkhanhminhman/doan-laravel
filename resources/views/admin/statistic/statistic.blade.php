@extends('layouts.admin')
@section('title', 'Loại Sản Phẩm')
@section('content')
<div class="right_col" role="main">
  <!-- <a href="{{url('admin/statistic')}}" class="btn btn-primary">Ngày</a> -->
      <a href="{{url('admin/statistic_month')}}" class="btn btn-primary">Tháng</a>
      <a href="{{url('admin/product-type-add')}}" class="btn btn-primary">Năm</a>
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-line-chart"></i>Biểu đồ </h3>
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
                        <th class="text-center">Ngày</th>
                          <th>Tháng</th>
                          <th>Doanh thu</th>
                          <th>Lợi nhuận</th>
                          <th>Tổng vốn</th>
                          <th>Tổng số đơn hàng</th>
                          <th>Tổng số bomb hàng</th>
                          <th>Tổng số khiếu nại</th>                       
                        </tr>
                      </thead>
                      <tbody>
                       @foreach ($statistic as $p)
                        <tr>
                           <td>{{$p->report_ngay_id}}</td>
                           <td>{{$p->report_thang_id}}</td>
                           <td>{{$p->doanhthu}}</td>
                           <td>{{$p->loinhuan}}</td>
                           <td>{{$p->tongvon}}</td>
                           <td>{{$p->tongsodonhang}}</td>
                           <td>{{$p->tongsobombhang}}</td>
                           <td>{{$p->tongsokhieunai}}</td>

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