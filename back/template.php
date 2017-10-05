<html>
	<body>
		<br><br>
		<center>
			<br><br><strong>Login</strong><br><br>
			<form method="POST">
				<?php
				if(isset($msg)){
					echo "<br><b>$msg</b><br><br>";					
				}
				?>
				<input type="text" name="login">
				<br><br>
				<input type="password" name="senha">
				<br><br>
				<input type="submit" value="Login" 
				name="btnLogin">
			
			</form>
		
		</center>
	</body>
</html>
