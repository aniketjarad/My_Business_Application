<?php
//session_start();
if(isset($_SESSION['emp_code'])){
	print_r($_SESSION['emp_code']);
	header("Location: /home/");
}
?>
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<form id="login-form" class="login100-form validate-form" action="" method="post">
				<span class="login100-form-title p-b-43">
					Login to continue
				</span>

				<div id="email_div" class="wrap-input100 validate-input" data-validate = "Valid email is required: example@abc.xyz">
					<input id="email" class="input100" type="text" name="email">
					<span class="focus-input100"></span>
					<span class="label-input100">Email</span>
				</div>
				
				
				<div class="wrap-input100 validate-input" data-validate="Password is required">
					<input class="input100" type="password" name="pass-key" id="pass">
					<span class="focus-input100"></span>
					<span class="label-input100">Password</span>
				</div>

				<div class="flex-sb-m w-full p-t-3 p-b-32">
					<div>
						<a href="/home/forgotpassword/" class="txt1">
							Forgot Password ?
						</a>
					</div>
					<div>
						<a href="/user/signup/" class="txt1">
							Not a user ? Register here 
						</a>
					</div>
				</div>
				<div id="hide" class="wrap-input50">
					
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn">
						Login
					</button>
				</div>
			</form>

			<div class="login100-more" style="background-image: url('/public/img/bg-01.jpg');">
				<center><h2 style="margin-top:15%;text-align: center; width: 75%">Welcome to My Business Application</h2></center>
			</div>
		</div>
	</div>
</div>