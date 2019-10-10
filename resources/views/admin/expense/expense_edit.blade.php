@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><i class="fa fa-cube"></i> Sửa chi phí </h3>
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
					<div class="x_content">
						<div class="x_content">
							<form action="{{url('admin/expense-update')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
								@foreach ($data_expense as $p)
								@csrf
								<div class="item form-group">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input class="form-control col-md-7 col-xs-12" name="expense_id" value="{{$p->id}}" type="hidden">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên chi phí <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input class="form-control col-md-7 col-xs-12" name="expense_name" value="{{$p->expense_name}}" type="text">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số tiền <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="expense_cost" class="form-control col-md-7 col-xs-12" value="{{$p->expense_cost}}">
									</div>
								</div>
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-md-offset-3">
										<a class="btn btn-primary" href="{{url('admin/expense')}}">Trở Về</a>
										<button id="send" type="submit" class="btn btn-success">Sửa</button>
									</div>
								</div>
								@endforeach
							</form>	
						</div>
					</div>
				</div>
			</div>
		</div>
		@endsection