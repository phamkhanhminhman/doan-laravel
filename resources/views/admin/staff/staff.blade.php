@extends('layouts.admin')
@section('title', 'Nhân sự')
@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-cubes"></i> Nhân viên </h3>
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
                    <a href="{{url('admin/signup')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp Đăng ký</a>
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
                          <th>Username</th>
                          <th>Tên</th>
                          <th>Tuổi</th>
                          <th>Địa chỉ</th>
                          <th>Số điện thoại</th>
                          <th>Ảnh</th>
                          <th>Ngày Tạo</th>
                          <th>Cập Nhật</th>
                          <th>Sửa</th>
                          <th>Xóa</th>                        
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($staff as $p)   
                        <tr>
                          <td>{{$p->id}}</td>
                          <td>{{$p->user_name}}</td>
                          <td>{{$p->name}}</td>
                          <td>{{$p->age}}</td>
                          <td>{{$p->address}}</td>
                          <td>{{$p->tel}}</td>             
                          <td><img src="" alt="" width="80px" height="80px"></td>
                          <td><?php echo date('d-m-Y H:m',strtotime("$p->Created"));?></td>
                          <td><?php echo date('d-m-Y H:m',strtotime("$p->Updated"));?></td>
                          <td><a href="{{url('admin/staff-edit', $p->id)}}" class="btn btn-warning"><i class="fa fa-pencil"></i></i></a></td>
                          <td><a href="{{url('admin/staff-delete', $p->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-close" ></i></a></td>
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