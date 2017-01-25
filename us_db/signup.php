<?php 
	require_once('db.php');

$data = $_POST;
if(isset($data['do_signup']))
{
	$errors = array();
	if($data['login'] == '')
	{
		$errors[] = 'Uncorrect login!';
	}

	if($data['email'] == '')
	{
		$errors[] = "Uncorrect Email!";
	}

	if($data['password'] == '')
	{
		$errors[] = "Uncorrect password!";
	}

	if($data['password'] != $data['passwordReplace'])
	{
		$errors[] = "Passwords do not match!";
	}

	if(R::count('users', "login = ?", array($data['login'])) > 0)
	{
		$errors[] = 'User exist';
	}

	if(R::count('users', "email = ?", array($data['email'])) > 0)
	{
		$errors[] = 'Email exist';
	}

	if(empty($errors))
	{
		$user = R::dispense('users');
		$user->login = $data['login'];
		$user->firstName = @$data['FirstName'];
		$user->lastName = @$data['LastName'];
		$user->sex = @$data['sex'];
		$user->birthDate = @$data['BirthDate'];
		$user->email = $data['email'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
		$user->create_date = date("d-m-Y");
;
		$user->root = 0;
		R::store($user);
		echo '<div style="color: green;">Sucsess!!!</div><hr>';
		header('Location: index.php');
	} else 
	{
		echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
	}
}

?>
<h1>Please Sign Up</h1>
<form action="signup.php" method="POST">
	<p>
		<p><strong>Login</strong></p>
		<input type="text" name="login" value="<?php echo @$data['login'];?>">
	</p>

	<p>
		<p><strong>FirstName</strong></p>
		<input type="text" name="FirstName" value="<?php echo @$data['FirstName'];?>">
	</p>

	<p>
		<p><strong>LastName</strong></p>
		<input type="text" name="LastName" value="<?php echo @$data['LastName'];?>">
	</p>

	<p><strong>Change sex</strong></p>
	<input type="radio" name="sex" value="man" checked> Male
  	<input type="radio" name="sex" value="woman"> Femalew

  	<p><strong>Change birth date</strong></p>
  	<input type="date" name="BirthDate" value="<?php echo @$data['BirthDate'];?>">

	<p>
		<p><strong>Email</strong></p>
		<input type="email" name="email" value="<?php echo @$data['email'];?>">
	</p>

	<p>
		<p><strong>Password</strong></p>
		<input type="password" name="password" value="<?php echo @$data['password'];?>">
	</p>

	<p>
		<p><strong>Confirm Password</strong></p>
		<input type="password" name="passwordReplace" value="<?php echo @$data['passwordReplace'];?>">
	</p>

	<p>
		<button type="submit" name="do_signup">Register</button>
		<button><a href="index.php">Return</a></button>	
	</p>
</form>