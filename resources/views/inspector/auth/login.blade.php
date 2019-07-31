
<!DOCTYPE html>
<html>
<head>
<title>login Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" href="http://wtj.qatardigitaldirectory.com/theme/css/style.css">
</head>
<body class="login_bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center"><div class="admin_logo"><img src="{{asset('assets/img/logo25.png')}}" /></div></div>
		</div>
		
		<form class="form-horizontal" role="form" method="POST" action="{{ url('/inspector/login') }}">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="login_screen">
					<div class="row">
						<div class="col-md-offset-1 col-md-10">
							<h1 class="Posthed" style="padding:0 25px 50px 25px;">Sign In</h1>
						</div>
					</div>
					<div class="row">
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<div class="col-md-offset-1 col-md-10">						
						
                            <label for="email">E-Mail Address</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>
						</div>						
					</div>
					
					
					
					<div class="row">
						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<div class="col-md-offset-1 col-md-10">
                            <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
						    </div>
                        </div>
					</div>
					<div class="row">
						
						<div class="form-group">
                            <div class="col-md-offset-1 col-md-5">
                                <button style="width: 170px;height: 40px;background: #E86850;font-family: Raleway;font-style: normal;font-weight: bold;line-height: normal;font-size: 14px;text-transform: uppercase;color: #FFFFFF;" type="submit" class="btn btn-primary">
                                    LOGIN
                                </button>
							</div>
							
							<!-- <div class="col-md-5 text-right text-xs-left">
                                <a class="btn btn-link" href="{{ url('/inspector/password/reset') }}">
                                    Forgot Your Password?
                                </a>
							</div> -->
                        </div>
						
						
						
					</div>
						
					<div class="row">
						<div class="col-md-12 hidden-xs height250" >
							
						</div>						
					</div>
						
					</div>
				</div>
			</div>
		
		</form>
		
		
		</div>
		

</body>
	
	<style>
		.Posthed{
			font-size:30px;
		}
		.admin_logo{
			padding:150px 0 0 0;
		}
		
		.admin_logo img{
			 width: auto;
     		max-width: auto;
			display: inline-block;
		}
		.login_bg{
			 background: url("{{asset('assets/img/background.jpg')}}") no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			
		}
		
		.login_screen{
			background:#FFF;
			border-radius:10px 10px 0 0;
			padding:20px;
			position:relative;
			top:100px;
			-webkit-box-shadow: 4px -6px 101px -19px rgba(87,15,27,1);
-moz-box-shadow: 4px -6px 101px -19px rgba(87,15,27,1);
box-shadow: 4px -6px 101px -19px rgba(87,15,27,1);
		}
		
		.height250{
			height:180px;
		}
		
		
		@media (min-width: 200px) and (max-width: 480px) {
		 .text-xs-left{
			 text-align:left;
		 }
		 
		 
	} 
		
	</style>	
	
	
	
</html>


