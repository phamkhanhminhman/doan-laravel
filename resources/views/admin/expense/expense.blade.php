@extends('layouts.admin')
@section('title', 'Nhập Kho')
@section('content')
<div class="right_col" role="main">
 <div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Chi phí phát sinh</h3>
    </div>
    <div class="title_right">
      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <!-- //START NHAP CHI PHI PHAT SINH ------------------------------------------------------------------------------->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <form action="{{url('admin/expense-insert')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
            @csrf
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên chi phí <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" name="expense_name" placeholder="Nhập tên chi phí" required="required" type="text">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số tiền <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="expense_cost" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nhập số tiền phát sinh">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <a href="/admin" class="btn btn-primary">Trở về</a>
                <button id="send" type="submit" class="btn btn-success">Thêm</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- //END NHAP CHI PHI PHAT SINH -------------------------------------------------------------------------------->
  
  <!-- //START TABLE CHI PHI PHAT SINH ----------------------------------------------------------------------------->
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
                <th>Tên chi phí</th>
                <th>Số tiền</th>
                <th>Ngày Tạo</th>
                <th>Ngày Sửa</th>
                <th>Tháng</th>
                <th>Năm</th>
                <th>Sửa</th>
                <th>Xóa</th>                        
              </tr>
            </thead>
            <tbody>
              @foreach ($expense as $p)
              <tr>
                <td>{{$p->id}}</td>
                <td>{{$p->expense_name}}</td>
                <td>{{$p->expense_cost}}</td>
                <td><?php echo date('d-m-Y H:m',strtotime("$p->created"));?></td>
                <td><?php echo date('d-m-Y H:m',strtotime("$p->updated"));?></td>
                <td><?php echo date('m',strtotime("$p->created"));?></td>
                <td><?php echo date('Y',strtotime("$p->created"));?></td>
                <td><a href="{{url('admin/expense-edit',$p->id)}}" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>
                <td><a href="{{url('admin/expense-delete',$p->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                  <i class="fa fa-close" ></i></a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- //START TABLE CHI PHI PHAT SINH ------------------------------------------------------------------------------>
</div>
</div>
</div>



@endsection