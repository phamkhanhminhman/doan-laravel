@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Quản Lý Ngành Hàng </h3>
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
                    <!-- <h2>Button Example <small>Users</small></h2> -->
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
                          <th class="text-center">Hình Ảnh</th>
                          <th>Mã Ngành</th>
                          <th>Ngành Hàng</th>
                          <th>Ghi Chú</th>
                          <th>Ngày Tạo</th>
                          <th>Ngày Sửa</th>
                          
                          <th>Sửa</th>
                          <th>Xóa</th>                        
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data_category as $p)   
                        <tr>
                          <td class="text-center"><img src="https://via.placeholder.com/150" alt="" width="50px" height="50px"></td>
                          <td>{{$p->categoryID}}</td>
                          <td>{{$p->categoryName}}</td>
                          <td>{{$p->categoryNote}}</td>
                          <td>{{$p->Created}}</td>
                          <td>{{$p->Updated}}</td>
                          
                          <td><a href="" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                          <td><a href="" class="btn btn-warning"><i class="fa fa-close"></i></a></td>
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