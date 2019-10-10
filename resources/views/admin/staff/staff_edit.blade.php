<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('assets/admin/login/images/icons/favicon.ico')}}"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/login/vendor/bootstrap/css/bootstrap.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/login/vendor/animate/animate.css')}}">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/login/vendor/css-hamburgers/hamburgers.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/login/vendor/select2/select2.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/login/css/main.css')}}">
	<!--===============================================================================================-->
</head>
<body>	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('assets/admin/login/images/img-01.png')}}" alt="IMG">
				</div>
				<form class="login100-form validate-form" action="{{url('admin/staff-update')}}"  method="post">
					@foreach ($staff as $p)
					@csrf
					<span class="login100-form-title">
						Edit 
					</span>
					<input  type="hidden" name="id" value="{{$p->id}}">
					<div class="wrap-input100 validate-input">
						<label for="">Name</label>
						<input class="input100" type="text" name="name" value="{{$p->name}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						</span>
					</div>
					<div class="wrap-input100 validate-input">
						<label for="">Address</label>
						<input class="input100" type="text" name="address" value="{{$p->address}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						</span>
					</div>
					<div class="wrap-input100 validate-input" >
						<label for="">Age</label>
						<input class="input100" type="number" name="age" value="{{$p->age}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						</span>
					</div>
					<div class="wrap-input100 validate-input" >
						<label for="">Tel</label>
						<input class="input100" type="number" name="tel" value="{{$p->tel}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Update Account
						</button>
					</div>
					@endforeach
				</form>
			</div>
		</div>
	</div>
	
	

	
	<!--===============================================================================================-->	
	<script src="{{asset('assets/admin/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('assets/admin/login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('assets/admin/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('assets/admin/login/vendor/select2/select2.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('assets/admin/login/vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="{{asset('assets/admin/login/js/main.js')}}"></script>

</body>
</html>