<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>Login/Signup</title>
	<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="css/loginstylesheet.css">
	<script src="js/reg_loginformvalidation.js"> </script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="background-color: #e3f2fd;">
	<div class="wrapper">
		<div class="title-text">
			<div class="title login">
				Login Form
			</div>
			<div class="title signup">
				Signup Form
			</div>
		</div>
		<div class="form-container">
			<div class="slide-controls">
				<input type="radio" name="slide" id="login" checked>
				<input type="radio" name="slide" id="signup">
				<label for="login" class="slide login">Login</label>
				<label for="signup" class="slide signup">Signup</label>
				<div class="slider-tab"></div>
			</div>
			<div class="form-inner">
				<form method='post' action="credentialController.php" class="login" onSubmit="return checkLoginInputs();">
					<div class="field">
						<input type="text" name="email" onkeyup="checkMAIL(this.value, 'loginemail')" placeholder="Email Address" required>
					</div>
					<span id='loginemail'></span>
					<div class="field">
						<input name="password" onkeyup="checkPWD(this.value,'login_pwd_msg')" type="password" placeholder="Password" required>
						<div id="login_pwd_msg" class="form-text">5-16 alphanumeric characters</div>
					</div>
					<input type='hidden' name='JSEnabled' value='false'>
					<div class="signup-link" style="color:red;">
						<?php
						if (isset($error)) {
							echo $error;
						}
						?>
					</div>
					<div class="field btn" style="margin-top:25px;">
						<div class="btn-layer"></div>
						<input type="submit" name='submit' value="Login">
					</div>

				</form>
				<form method='post' action="credentialController.php" onSubmit="return checkRegistrationInputs();" class="signup">
					<div>
						<div class="field">
							<input type="text" name='name' placeholder="Name" onkeyup="checkFN(this.value)" size='50' required>
							<span id='name_msg'></span>
						</div>
						<div class="field">
							<input type="text" name='email' placeholder="Email Address" onkeyup="checkMAIL(this.value, 'registrationemail')" size='20' required>
							<span id='registrationemail'></span>
						</div>
						<div class="field">
							<input type="password" name='password' placeholder="Password" onkeyup="checkPWD(this.value,'reg_pwd_msg')" required>
							<span id='reg_pwd_msg'></span>
						</div>
						<div class="field">
							<input type="password" name='confirm_password' placeholder="Confirm password" onkeyup="confirmPWD(this.value)" required>
							<span id='cfmpwd_msg'></span>
						</div>


					</div>
					<input type='hidden' name='JSEnabled' value='false'>
					<div class="field btn">
						<div class="btn-layer"></div>
						<?php
						if (isset($error2))
							echo "<script>alert('" . $error2 . "');</script>";
						?>
						<input type="submit" name='submit' value="Signup">
					</div>
				</form>

			</div>
		</div>
	</div>
	<script>
		//this page is used for the animation togglig of login and signup page
		//it is also used to show the address fields if the usertype is selected as owner

		//by default ownerr fields are not displayed
		document.getElementsByName('ownerFields').forEach(function(element) {
			element.style.display = 'none';
		});

		//below is for styling
		const loginText = document.querySelector(".title-text .login");
		const loginForm = document.querySelector("form.login");
		const loginBtn = document.querySelector("label.login");
		const signupBtn = document.querySelector("label.signup");
		signupBtn.onclick = (() => {
			loginForm.style.marginLeft = "-50%";
			loginText.style.marginLeft = "-50%";
		});
		loginBtn.onclick = (() => {
			loginForm.style.marginLeft = "0%";
			loginText.style.marginLeft = "0%";
			//dont display ownerFields when in loginForm otherwise form will be too long (remove the below loop and check)
			document.getElementsByName('ownerFields').forEach(function(element) {
				element.style.display = 'none';
			});

		});

		//checkbox toggle
		function toggleAdditionalDetails() {
			var radioButton = document.getElementsByName('userType')[0];
			var ownerFields = document.getElementsByName('ownerFields');

			if (radioButton.checked && radioButton.value == 'owner') {
				ownerFields.forEach(function(element) {
					element.style.display = 'block';
				});
				document.getElementsByName('street_address')[0].required = true;
				document.getElementsByName('latitude')[0].required = true;
				document.getElementsByName('longitude')[0].required = true;
				document.getElementsByName('rate')[0].required = true;
			} else {
				ownerFields.forEach(function(element) {
					element.style.display = 'none';
				});
				document.getElementsByName('street_address')[0].required = false;
				document.getElementsByName('latitude')[0].required = false;
				document.getElementsByName('longitude')[0].required = false;
				document.getElementsByName('rate')[0].required = false;
			}


		}
	</script>
</body>

</html>