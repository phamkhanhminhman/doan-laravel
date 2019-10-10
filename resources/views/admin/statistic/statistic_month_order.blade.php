<!--  /*
    *   Created by  :   pkmm - 3/4/2019 
    *   Description :   Show table data các đơn hàng trong tháng...
*/ -->
@extends('layouts.admin')
@section('title', 'Statistic')
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
                        <th class="text-center">ID</th>
                        <th>Channel</th>
                        <th>Ship</th>
                        <th>Name</th>
                        <th>Địa chỉ</th>
                        <th>Tổng vốn</th>
                        <th>Tổng bán</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                                 
                        </tr>
                      </thead>
                      <tbody>
                       @foreach ($order as $p)
                        <tr>
                          <td>{{$p->orderID}}</td>
                          <td>{{$p->orderChannel}}</td>
                          <td>{{$p->orderShip}}</td>
                          <td>{{$p->customerName}}</td>
                          <td>{{$p->name}}</td>
                          <td>{{$p->orderCost}}</td>
                          <td>{{$p->orderSell}}</td>
                          <td>{{$p->orderStatus_vi}}</td>
                          <td><?php echo date('d-m-Y H:m',strtotime("$p->orderCreate"));?></td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                </div>
                <div class="row tile_count">
           @foreach($report_thang_hientai as $r)
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top" ><i class="fa fa-user" ></i> Doanh Thu</span>
            <div class="count" style="color:#ff7043" ><?php echo number_format($r->doanhthu,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><?php echo round($doanhthu_up);?>% </i> So Với Tháng Trước  </span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Lợi Nhuận</span>
            <div class="count" style="color:#00c853"><?php echo number_format($r->loinhuan,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php echo round($loinhuan_up);?>% </i> So Với Cùng Kỳ</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Tổng Đơn Hàng</span>
            <div class="count green" style="color:#aa00ff"><?php echo number_format($r->tongsodonhang,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> So Với Cùng Kỳ</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i>  Tồn Kho </span>
            <div class="count"style="color:#795548"><?php echo $tonkho ?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> Try Harder</span>
           
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Đơn Chưa Hoàn Thành</span>
            <div class="count"style="color:#ff3d00"><?php echo $don_chua_hoan_thanh ?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i>Available</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Tiền Hàng Đóng Băng</span>
            <div class="count"style="color:#37474f">5.000.000</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i>Available</span>
          </div>
  
        </div>
        <!-- /top tiles -->
        <div class="row tile_count">
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Tổng Vốn</span>
            <div class="count red"style="color:#e91e63"><?php echo number_format($r->tongvon,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><?php echo round($tongvon_up);?>% </i> So Với Cùng Kỳ</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Chi Phí</span>
            <div class="count blue"style="color:#ff9100"><?php echo number_format($r->doanhthu - $r->tongvon - $r->loinhuan,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> So Với Cùng Kỳ</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Mục Tiêu</span>
            <div class="count green"style="color:#37474f">70%</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>Good </i> Cố Gắng Hơn !</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Bomb Hàng </span>
            <div class="count"style="color:black">123</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> So Với Cùng Kỳ</span>
           
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Khiếu Nại </span>
            <div class="count"style="color:#d50000 "><?php echo $complain ?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i>Available</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Việc Cần Làm</span>
            <div class="count red"style="color:#2962ff">8</div>
            <span class="count_bottom"><i class="green">4% </i> Lợi Nhuận</span>
          </div>
        </div>
        @endforeach
              </div>
            </div>
          </div>
        </div>

@endsection