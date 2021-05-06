<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="section">
		<div class="container">
		    <div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
			          	<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<form action="login.php" method="post">
										<div class="center-wrap">
											<div class="section text-center">
												<h4 class="mb-4 pb-3">Log In</h4>
												<div class="form-group">
													<input type="text" name="username" 
													class="form-style" 
													placeholder="Your Username" 
													id="username" 
													autocomplete="none">
													<i class="input-icon uil uil-user"></i>
												</div>	
												<div class="form-group mt-2">
													<input type="password" name="password" 
													class="form-style" 
													placeholder="Your Password" 
													id="password" autocomplete="none">
													<i class="input-icon uil uil-lock-alt"></i>
												</div>
												<button type="submit" class="btn mt-4"><a>submit</a></button>
												<p class="mb-0 mt-4 text-center">
													<a href="#" class="link">Forgot your password?</a>
												</p>
											</div>
										</div>
									</form>
			      				</div>
								<div class="card-back">
									<form action="signup.php" method="post">
										<div class="center-wrap">
											<div class="section text-center">
												<h4 class="mb-4 pb-3">Sign Up</h4>
												<div class="form-group">
													<input type="text" name="nama" 
													class="form-style" 
													placeholder="Your name" 
													id="nama" 
													autocomplete="none">
													<i class="input-icon uil uil-user"></i>
												</div>	
												<div class="form-group mt-2">
													<input type="text" name="username" 
													class="form-style" 
													placeholder="Your Username" 
													id="username" 
													autocomplete="none">
													<i class="input-icon uil uil-user"></i>
												</div>
												<div class="form-group mt-2">
													<input type="password" name="password" 
													class="form-style" 
													placeholder="Your Password" 
													id="password" 
													autocomplete="none">
													<i class="input-icon uil uil-lock-alt"></i>
												</div>
												<div class="form-group mt-2"disabled>
													<select class="form-style" name="level" id="level">
														<option value="Pelanggan">Pelanggan</option>
													</select>
													<i class="input-icon uil uil-robot"></i>
												</div>
												<button type="submit" name="simpan" class="btn mt-4"><a>submit</a></button>
											</div>
										</div>
									</form>
			      				</div>
			      			</div>
			      		</div>
			      	</div>
		      	</div>
	      	</div>
	    </div>
	</div>
</body>
</html>
