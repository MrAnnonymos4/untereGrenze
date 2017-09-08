<?php
    session_start();
    $mail = $_POST["email"];
    $name = $_POST["name"];
    $firstPassword = $_POST["firstPassword"];
    $secondPassword = $_POST["secondPassword"];
    
    $showPasswordError = false;
    $showEmailError = false;
    if (isset($mail)) {
        if ($firstPassword != $secondPassword) {
           $showPasswordError = true;
        } else {
            include("../database/databaseConnection.php");
            $sql = "SELECT * FROM user WHERE email = '$mail'";
            $result = $connection->query($sql);
            
            if ($result->num_rows == 0) {
                $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$mail', '$firstPassword')";
                $result = $connection->query($sql);
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $mail;
                $_SESSION["id"] = $connection->insert_id;
                //header("Location: http://google.de");
                //die();
            } else {
                $showEmailError = true;
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <link href="login.css" rel="stylesheet">
        <title>Registrieren</title>
        <script type="text/javascript">
            function showError(anObjectId) {
                $("." + anObjectId).addClass("has-error");
            }
        </script>
    </head>
    <body>
        <div class="container">
            <form class="form-signin" method="post" action="register.php">
                <h2 class="form-signin-heading">Registrieren</h2>
                <div class="form-group emailGroup">
                    <label class="control-label" for="inputEmail">E-Mail:</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailText" placeholder="E-Mail Adresse" required>
                    <span id="emailText" class="help-block errorSpan">E-Mail Adresse schon vergeben</span>
                </div>
                <div class="form-group">
                    <label class="control-label" for="inputName">Name:</label>
                    <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" required>
                </div>
                <div class="form-group passwordGroup">
                    <label class="control-label" for="inputPassword">Passwort:</label>
                    <input type="password" class="form-control" id="inputPassword" name="firstPassword" aria-describedby="helpBlock2" placeholder="Passwort" required>
                    <span class="help-block errorSpan">Passwörter stimmen nicht überein</span>
                </div>
                <div class="form-group passwordGroup">
                    <label class="control-label" for="repeatInputPassword">Passwort erneut eingeben:</label>
                    <input type="password" class="form-control" id="repeatInputPassword" name="secondPassword" aria-describedby="helpBlock2" placeholder="Passwort" required>
                    <span class="help-block errorSpan">Passwörter stimmen nicht überein</span>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Registrieren</button>
            </form>
        </div> 
    </body>

    <?php
        if ($showPasswordError) echo "<script>showError('passwordGroup');</script>";
        if ($showEmailError) echo "<script>showError('emailGroup');</script>";
    ?>
</html>