<!--  /*
    *   Created by  :   pkmm - 2/3/2019 
    *   Updated by  :   pkmm - 4/3/2019 - VẼ BIỂU ĐỒ BẰNG CHARTJS
    *   Updated by  :   pkmm - 4/4/2019 - CLICK VÀO THÁNG ĐỂ SHOW RA ĐƠN VÀ REPORT THÁNG ĐÓ..
    *   Description :   Show ra doanh thu, lợi nhuân..., theo tháng
*/ -->
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
            <a href="{{url('admin')}}" class="site_title"><i class="fa fa-paw"></i> <span>{{ Session::get('name') }}</span></a>
          </div>

          <div class="clearfix"></div>
          <!-- SIDE BAR -->
          @includeIf('partials.admin_sidebar')
          <!-- SIDE BAR -->
        </div>
      </div>
      <!-- top navigation bar -->
      @includeIf('partials.admin_navbar')
      <!-- /top navigation bar -->
      <!-- page content -->

      <div class="right_col" role="main">
      <!-- <a href="{{url('admin/statistic')}}" class="btn btn-primary">Ngày</a> -->
      <a href="{{url('admin/statistic_month')}}" class="btn btn-primary">Tháng</a>
      <a href="{{url('admin/product-type-add')}}" class="btn btn-primary">Năm</a>
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3><i class="fa fa-line-chart"></i>&nbspBiểu đồ thống kê theo tháng</h3>
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
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
               <canvas id="myChart" width="80" height="20"></canvas>
               <div class="clearfix"></div>
             </div>
           </div>
         </div>
         <br>
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
                <h2><?php echo date('Y')?></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                  <thead>
                    <tr>
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
                     <td><a href="{{url('admin/statistic-month-order',$p->report_thang_id)}}">{{$p->report_thang_id}}</a></td>
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
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
   <!-- //VẼ BIỂU ĐỒ CHART BẰNG CÁCH GOI API TRONG STATISTIC_CONTROLLER---------------------------------------------------------- -->
   <script type="text/javascript">
    $(document).ready(function() {

       $.ajax({
        url:"{{ route('chart-month') }}",
        type: 'GET',
        dataType: 'json',
        data: {param1: 'value1'},
      })
      .done(function(data) {
        console.log("success");
        var thang = [];
        var doanhthu=[];
        var loinhuan=[];
        var tongvon=[];
        for (var i in data)
        {
          thang.push("Tháng "+data[i].report_thang_id);
          doanhthu.push(data[i].doanhthu);
          loinhuan.push(data[i].loinhuan);
          tongvon.push(data[i].tongvon);
        }
        var dataChart={
            labels: thang,
            datasets: [{
              label: 'Doanh thu',
              data: doanhthu,
              backgroundColor: ['rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)',],
              borderColor: [
              'rgba(255,99,132,1)','rgba(255,99,132,1)','rgba(255,99,132,1)','rgba(255,99,132,1)','rgba(255,99,132,1)','rgba(255,99,132,1)','rgba(255,99,132,1)','rgba(255,99,132,1)','rgba(255,99,132,1)','rgba(255,99,132,1)','rgba(255,99,132,1)','rgba(255,99,132,1)',
              ],
              borderWidth: 1
            },{
                 label: 'Lợi nhuận',
              data: loinhuan,
              backgroundColor: ['rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)',],
              borderColor: ['rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)',],
              borderWidth: 1  
            },{
                 label: 'Tổng vốn',
              data: tongvon,
              backgroundColor: ['rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)',],
              borderColor: ['rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)','rgba(12, 12, 235, 0.2)',],
              borderWidth: 1  
            }]
          };
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: dataChart,

          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero:true
                }
              }]
            }
          }
        });
      })
      .fail(function() {
      })
      .always(function() {
        console.log("complete");


      });

    });

  </script>
