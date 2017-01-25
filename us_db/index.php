<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <h1></h1>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
<?php 
	require_once('db.php');
	
	if(isset($_SESSION['logged_user'])) : ?>
		Autorized. Welcome <a href="logout.php">Exit</a>
		<?php if($_SESSION['logged_user']->root == 1) 
			{
				echo 'SuperUser: Activated<br>';
				
				$user = R::findAll('users');


				echo '<div class="container">
				  <h2>Table Users</h2>
				  <table class="table table-bordered">
				    <thead>
				    	<tr>
				    		<th>ID</th>
					    	<th>Login</th>
					    	<th>FirstName</th>
					    	<th>LastName</th>
					    	<th>Sex</th>
					    	<th>BirthDate</th>
					    	<th>Email</th>
					    	<th>Password</th>
					   		<th>CreateDate</th>
					    	<th>Root</th>
				    	</tr>
				    </thead>
				    <tbody>';

				    	$massOtherRepl = array("{", "\"", "}");
						$massOtherrepl1 = array(":", ",");

				    	for ($i = 1; isset($user[$i]); $i++) { 

							$string = str_replace($massOtherRepl, "", $user[$i]);
							$string = str_replace($massOtherrepl1, " ", $string);
							$massUser = explode(" ", $string);

							echo '<tr>';

					    	for ($j=1, $ji = -1; $j <= ceil(sizeof($massUser)/2); $j++)
					    	{
					    	
					    		echo '<td>'.$massUser[$ji+=2].'</td>';

					    	}

					    	echo '</tr>';
					    }

				echo '</tbody>
				  </table>
				</div>';
			} else
			{
				echo 'SuperUser: Not Activated';
			}
		?>
		
	<?php else : ?>
		<ul class="nav nav-pills">
		  <li class="active"><a href="#">Main</a></li>
		  <li><a href="login.php">Autorization</a></li>
		  <li><a href="signup.php">Registration</a></li>
		</ul>
	<?php endif ; ?>
</body>

<div class="navbar-fixed-bottom row-fluid">
    <div class="navbar-inner">
      	<div class="panel-footer ">
        Panel Footer
  		</div>
    </div>
</div>


</html>