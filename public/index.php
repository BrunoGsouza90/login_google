<?php

    use App\Library\Authenticate;
    use App\Library\GoogleClient;

    require "../vendor/autoload.php";

    $googleClient = new GoogleClient();
    
    $googleClient->init();

    $authorized = $googleClient->authorized();

                    echo "<pre>";

                    print_r($authorized["data"]);

                echo "</pre>";

                die();

    if($authorized["status"]) {

        $auth = new Authenticate();
        
        $auth->authGoogle($authorized["data"]);

    }

    $authUrl = $googleClient->generateAuthLink();

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login/Google</title>

</head>

<body>
    
    <h1>Login/Google</h1>

    <form action="" method="POST">

        <div>

            <label for="email">Email: </label>
            <input type="email" name="email" id="email">

        </div>

        <br>

        <div>

            <label for="password">Password: </label>
            <input type="password" name="password" id="password">

        </div>

        <br>

        <div>

            <button type="submit">Enter</button>

        </div>

        <br>

        <a href="<?= $authUrl; ?>">Login with Google</a>

    </form>

</body>

</html>