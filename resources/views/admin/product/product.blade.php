@extends('layouts.admin')
@section('title', 'Loại Sản Phẩm')
@section('content')
<div class="right_col" role="main" ng-app="myProduct" ng-controller="MyProduct">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><i class="fa fa-tag"></i> Sản Phẩm </h3>
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
            <a href="{{url('admin/product-add')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp Thêm Mới</a>
            <a href="{{url('admin/product-instock')}}" class="btn btn-primary">Tồn kho</a>
            <a href="{{url('admin/product-done')}}" class="btn btn-primary">Đã bán</a>
            <a href="{{url('sendo/update-product')}}" class="btn btn-primary">Đồng Bộ Sản Phẩm</a>
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
                  <th class="text-center">Tên Loại Sản Phẩm</th>
                  <th class="text-center">Tên Sản Phẩm</th>
                  <th class="text-center">ID Sản Phẩm</th>
                  <th class="text-center">Tồn Kho</th>                         
                  <th class="text-center">Giá Nhập</th>
                  <th class="text-center">Giá Bán</th>
                  <!-- <th class="text-center">Ngày Tạo</th> -->
                  <th class="text-center">Cập Nhật</th>
                  <th class="text-center">Ghi Chú</th>
                  <th class="text-center">Sửa</th>
                  <!-- <th class="text-center">Xóa</th>                         -->
                </tr>
              </thead>
              <tbody>
                @foreach ($data_product as $p)   
                <tr>
                  <!-- <td class="text-center"><img src="../{{$p->productImage}}" alt="AASD" width="80px" height="80px"></td> -->
                  <td class="text-center"><a href="{{$p->productLink}}"><img src="{{$p->productImage}}" alt="AASD" width="80px" height="80px"></a></td> 
                  <td><a href="{{url('admin/variation',$p->productSKU)}}">{{$p->productSKU}}</a></td>
                  <td class="text-center" width="15%;">{{$p->productName}}</td>
                  <td>{{$p->productID}}</td>
                  <td>{{$p->stockQuantity}}</td>
                  <td>{{$p->productCost}}</td>
                  <td>{{$p->productSell}}</td>
                  <!-- <td><?php echo date('d-m-Y H:m',strtotime("$p->Created"));?></td> -->
                  <td><?php echo date('d-m-Y H:m',strtotime("$p->Updated"));?></td>

                  <td>{{$p->productStatus}}</td>
                  <td><a href="{{url('admin/product-edit',$p->productID)}}" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>
                  <!-- <td><a href="{{url('admin/product-delete',$p->productID)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-close"></i></a></td> -->
                  
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
<script src="{{asset('assets/js/product.js')}}"></script>
@endsection