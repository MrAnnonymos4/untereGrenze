<?php
	session_start();
	if (isset($_POST["email"])) {
		$email = $_POST["email"];
	}
	if (isset($_POST["password"])) {
		$password = $_POST["password"];
	}
	if (isset($email) && isset($password)) {
        
        include_once("../model/user.php");
        $result = checkUserMailAndPassword($email, $password);
        if ($result > -1) {
			$userId = $result;
			$_SESSION["userId"] = $userId;
			echo "Weiterleitung funktioniert nicht";
            header("Location: ../index.php");
            echo "<br /><a href='../index.php'>Weiter</a>";
            exit();
		} else {
			echo "Wrong Credentials - Result: $result";
		}
	}


?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="login.css" rel="stylesheet">
        <title>Login - Planning Poker</title>
    </head>
    <body>
        <div class="container">
            <form class="form-signin" method="post" action="login.php">
                <h2 class="form-signin-heading">Einloggen</h2>
                <div class="form-group has-Error">
                    <label for="inputEmail" class="sr-only">Email Adresse</label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email Addresse" name="email" required autofocus>
                    <label for="inputPassword" class="sr-only">Passwort</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Passwort" name="password" required>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Einloggen</button>
                <p>
                    Noch nicht angemeldet?
                    <a class="btn btn-lg btn-block btn-info" href="register.php">Registrieren</a>
                </p>
            </form>
        </div> 
    </body>

</html>