@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="right_col" role="main" ng-app="myDashBoard" ng-controller="myDashBoard">
        <!-- top tiles -->
        <div class="row tile_count">
          @foreach($report_thang_hientai as $r)
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top" ><i class="fa fa-user" ></i> Doanh Thu</span>
            <div class="count" style="color:#ff7043" ><?php echo number_format($r->doanhthu,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><?php echo round($doanhthu_up);?>% </i> So Với Tháng Trước</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Lợi Nhuận</span>
            <div class="count" style="color:#00c853"><?php echo number_format($r->loinhuan,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php echo round($loinhuan_up);?>% </i> So Với Tháng Trước</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Tổng Đơn Hàng</span>
            <div class="count green" style="color:#aa00ff"><?php echo number_format($r->tongsodonhang,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php echo round($tongsodonhang_up);?>% </i> So Với Tháng Trước</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i>  Tồn Kho </span>
            <div class="count"style="color:#795548"><?php echo $tonkho ?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i>Available</span>
           
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Đơn Chưa Hoàn Thành</span>
            <div class="count"style="color:#ff3d00"><?php echo number_format($r->tongsodonchuahoanthanh,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Available</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Tiền Hàng Đóng Băng</span>
            <div class="count"style="color:#37474f"><?php echo number_format($r->tiendongbang,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>update sau% </i> So Với Tháng Trước</span>
          </div>
  
        </div>
        <!-- /top tiles -->
        <div class="row tile_count">
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i>Tổng Vốn </span>
            <div class="count red"style="color:#e91e63"><?php echo number_format($r->tongvon,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><?php echo round($tongvon_up);?>% </i> So Với Tháng Trước</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i>Tiền hàng đã bán</span>
            <div class="count blue"style="color:#ff9100"><?php echo number_format($r->tienhangdaban,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> Available</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Chi Phí</span>
            <div class="count green"style="color:#37474f"><?php echo number_format($r->chiphi,0,",",".");?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>Good </i> Cố Gắng Hơn !</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Mục Tiêu </span>
            <div class="count"style="color:black"><?php echo $r->tongsobombhang?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> Available</span>
           
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Bomb Hàng </span>
            <div class="count"style="color:#d50000 ">0$</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Available</span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Khiếu Nại</span>
            <div class="count red"style="color:#2962ff">8</div>
            <span class="count_bottom"><i class="green">4% </i> Available</span>
          </div>
        </div>
          @endforeach
        <br />

        <div class="row">


          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>Loại Sản Phẩm Bán Chạy</h2>
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
                <h4>Bán chạy nhất trong tháng này</h4>
                @foreach ($product as $pa)  
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>{{$pa->product_typeName}}</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$pa->amount_sell}}">
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>{{$pa->amount_sell}} sp</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                @endforeach

            

              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden">
              <div class="x_title">
                <h2>Kênh Bán Hàng Hiệu Quả</h2>
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
                <table class="" style="width:100%">
                  <tr>
                    <th style="width:37%;">
                      <p>Top 5</p>
                    </th>
                    <th>
                      <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                        <p class="">Device</p>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <p class="">Progress</p>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                    </td>
                    <td>
                      <table class="tile_info">
                        <tr>
                          <td>
                            <p><i class="fa fa-square red"></i>Sendo </p>
                          </td>
                          <td>80%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square green"></i>Shopee </p>
                          </td>
                          <td>10%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square purple"></i>Tiki </p>
                          </td>
                          <td>0%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square blue"></i>Facebook </p>
                          </td>
                          <td>5%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square aero"></i>Cửa Hàng </p>
                          </td>
                          <td>5%</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>


          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>Quick Settings</h2>
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
                <div class="dashboard-widget-content">
                  <ul class="quick-list">
                    <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                    </li>
                    <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                    </li>
                    <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                    <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                    </li>
                    <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                    <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                    </li>
                    <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                    </li>
                  </ul>

                  <div class="sidebar-widget">
                    <h4>Profile Completion</h4>
                    <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                    <div class="goal-wrapper">
                      <span id="gauge-text" class="gauge-value pull-left">0</span>
                      <span class="gauge-value pull-left">%</span>
                      <span id="goal-text" class="goal-value pull-right">100%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>


        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Lịch sử hoạt động <a href="{{url('admin/history')}}" class="btn btn-success">Chi tiết</a> </h2>
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
                <div class="dashboard-widget-content">

                  <ul class="list-unstyled timeline widget">
                    @foreach ($history as $p)   
                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                            <p>{{$p->name}}</p>
                          </h2>
                          <div class="byline">
                            <span>{{$p->created}}</span> by <a>{{$p->user}}</a>
                          </div>
                          <p class="excerpt"></a>
                          </p>
                        </div>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-8 col-sm-8 col-xs-12">

            <div class="row">


              <!-- Start to do list -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Task</h2>
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

                    <div class="">
                      <ul class="to_do">
                        <li>
                          <p>
                            <input type="checkbox" class="flat">Hoàn thiện dần trang dashboard </p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> add edit delete loại sản phẩm</p>
                            </li>
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Fix database</p>
                              </li>
                              <li>
                                <p>
                                  <input type="checkbox" class="flat"> Fix middleware</p>
                                </li>
                                <li>
                                  <p>
                                    <input type="checkbox" class="flat"> Fix controller</p>
                                  </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- End to do list -->

                                <!-- start of weather widget -->
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="x_panel">
                                    <div class="x_title">
                                      <h2>Daily weather</h2>
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
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="temperature"><b><?php echo date("m/d/y")?></b>, <?php date_default_timezone_set("asia/ho_chi_minh"); echo date("h:i")?>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-4">
                                          <div class="weather-icon">
                                            <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                                          </div>
                                        </div>
                                        <div class="col-sm-8">
                                          <div class="weather-text">
                                            <h2>Đà Nẵng <br><i>Partly Cloudy Day</i></h2>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">
                                        <div class="weather-text pull-right">
                                          <h3 class="degrees">23</h3>
                                        </div>
                                      </div>

                                      <div class="clearfix"></div>

                                      <div class="row weather-days">
                                        <div class="col-sm-2">
                                          <div class="daily-weather">
                                            <h2 class="day">Mon</h2>
                                            <h3 class="degrees">25</h3>
                                            <canvas id="clear-day" width="32" height="32"></canvas>
                                            <h5>15 <i>km/h</i></h5>
                                          </div>
                                        </div>
                                        <div class="col-sm-2">
                                          <div class="daily-weather">
                                            <h2 class="day">Tue</h2>
                                            <h3 class="degrees">25</h3>
                                            <canvas height="32" width="32" id="rain"></canvas>
                                            <h5>12 <i>km/h</i></h5>
                                          </div>
                                        </div>
                                        <div class="col-sm-2">
                                          <div class="daily-weather">
                                            <h2 class="day">Wed</h2>
                                            <h3 class="degrees">27</h3>
                                            <canvas height="32" width="32" id="snow"></canvas>
                                            <h5>14 <i>km/h</i></h5>
                                          </div>
                                        </div>
                                        <div class="col-sm-2">
                                          <div class="daily-weather">
                                            <h2 class="day">Thu</h2>
                                            <h3 class="degrees">28</h3>
                                            <canvas height="32" width="32" id="sleet"></canvas>
                                            <h5>15 <i>km/h</i></h5>
                                          </div>
                                        </div>
                                        <div class="col-sm-2">
                                          <div class="daily-weather">
                                            <h2 class="day">Fri</h2>
                                            <h3 class="degrees">28</h3>
                                            <canvas height="32" width="32" id="wind"></canvas>
                                            <h5>11 <i>km/h</i></h5>
                                          </div>
                                        </div>
                                        <div class="col-sm-2">
                                          <div class="daily-weather">
                                            <h2 class="day">Sat</h2>
                                            <h3 class="degrees">26</h3>
                                            <canvas height="32" width="32" id="cloudy"></canvas>
                                            <h5>10 <i>km/h</i></h5>
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <!-- end of weather widget -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /page content -->

@endsection