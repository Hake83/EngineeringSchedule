<!DOCTYPE html>
<html>
  <head><title>An Example Form</title>
  <link rel="stylesheet" type="text/css" href="MyStyle.css"></link>

   <script type="text/javascript">
		function validate(form)
		{
			fail =  validateForename(form.forename.value)
			fail += validateSurname(form.surname.value)
			fail += validateUsername(form.username.value)
			fail += validatePassword(form.password.value)
			fail += validateAge(form.age.value)
			fail += validateEmail(form.email.value)
			
			if (fail =="") return true
			else { alert(fail); return false}
		}
   </script>
   <noscript>
	  Your browser doesn't support or has disabled javascript
   </noscript>
  </head>

<body>
	<a href="http://google.com" style="color:green;">Visit Google</a>
		<table class = "signup" border="0" cellpadding="2"
		cellspacing="5" bgcolor="#eeeeee">
			<th colspan="2" align = "center">Signup Form</th>
			<form method="post" action="adduser.php" 
			onsubmit="return validate(this)">
				<tr><td>Forename</td>
				<td><input type="text" maxlength="32" name="forename">
				</td></tr>

				<tr><td>Surname</td>
				<td><input type="text" maxlength="32" name="surname">
				</td></tr>

				<tr><td>Username</td>
				<td><input type="text" maxlength="16" name="username">
				</td></tr>

				<tr><td>Password</td>
				<td><input type="text" maxlength="12" name="password">
				</td></tr>

				<tr><td>Age</td>
				<td><input type="text" maxlength="3" name="age">
				</td></tr>

				<tr><td>Email</td>
				<td><input type="text" maxlength="64" name="email">
				</td></tr>

				<tr><td colspan="2" align="center">
				<input type="submit" value="Signup"></td></tr>

			</form>
		</table>
</body>
</html>