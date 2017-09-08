<!DOCTYPE html>
<html lang="de">
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="login.css" rel="stylesheet">
        <title>Login</title>
    </head>
    <body>
        <div class="container">

            <form class="form-signin">
                <h2 class="form-signin-heading">Einloggen</h2>
                <label for="inputEmail" class="sr-only">Email Adresse</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Passwort</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Passwort" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Einloggen</button>
                <p>
                    Noch nicht angemeldet?
                    <a class="btn btn-lg btn-block btn-info" href="register.php">Registrieren</a>
                </p>
            </form>
        </div> 
    </body>

</html>