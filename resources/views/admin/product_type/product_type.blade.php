@extends('layouts.admin')
@section('title', 'Loại Sản Phẩm')
@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-cubes"></i> Loại Sản Phẩm </h3>
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
                    <a href="{{url('admin/product-type-add')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp Thêm Mới</a>
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
                        <th class="text-center">Ảnh</th>
                          <th>Mã Loại SP</th>
                          <th>Tên Loại SP</th>
                          <th>Tên Ngành</th>
                          <th>Giá Nhập</th>
                          <th>Giá Bán</th>
                          <th>Ghi Chú</th>
                          <th>Tồn Kho</th>
                          <th>Đã bán</th>
                          <th>Ngày Tạo</th>
                          <th>Cập Nhật</th>
                          <th>Sửa</th>
                          <th>Xóa</th>                        
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data_product_type as $p)   
                        <tr>


                        <td class="text-center"><img src="../{{$p->product_typeIMG}}" alt="AASD" width="80px" height="80px"></td>
                        <!-- <td class="text-center"><img src="https://via.placeholder.com/150" alt="" width="50px" height="50px"></td> -->
                          <td>{{$p->product_typeID}}</td>
                          <td>{{$p->product_typeName}}</td>
                          <td>{{$p->categoryID}}</td>
                          <td>{{$p->product_typeCost}}</td>
                          <td>{{$p->product_typeSell}}</td>
                          <td>{{$p->product_typeNote}}</td>
                          <td>{{$p->amount}}</td>
                          <td>{{$p->amount_sell}}</td>
                          <td><?php echo date('d-m-Y H:m',strtotime("$p->Created"));?></td>
                          <td><?php echo date('d-m-Y H:m',strtotime("$p->Updated"));?></td>
                          <td><a href="{{url('admin/product-type-edit',$p->product_typeID)}}" class="btn btn-warning"><i class="fa fa-pencil"></i></i></a></td>
                          <td><a href="{{url('admin/product-type-delete',$p->product_typeID)}}"  class="btn btn-danger"><i class="fa fa-close" onclick="return confirm('Are you sure?')"></i></a></td>
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