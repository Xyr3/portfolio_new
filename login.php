<?php

session_start();

/* =====================================================
   CEK SESSION
===================================================== */

if (
    isset($_SESSION["logged_in"]) &&
    $_SESSION["logged_in"] === true
) { 
    header("Location: dashboard.php");
    exit;
}


/* =====================================================
   LOGIN
===================================================== */

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    /*
        LOGIN UNTUK PROJECT SEKOLAH

        Username : xyr
        Password : 12345
    */

    if (
        $username === "xyr" &&
        $password === "12345"
    ) {

        session_regenerate_id(true);

        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $username;

        header("Location: dashboard.php");
        exit;

    } else {

        $error = "Username atau password salah!";

    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Login Player Portfolio XYR"
    >

    <title>🍄 Player Login - XYR</title>

    <link rel="stylesheet" href="dashboard.css">

</head>


<body class="mario-login">


    <!-- =================================================
         BACKGROUND
    ================================================== -->

    <div class="login-background">

        <div class="login-cloud cloud-1"></div>
        <div class="login-cloud cloud-2"></div>
        <div class="login-cloud cloud-3"></div>

        <div class="login-coin coin-1">
            🪙
        </div>

        <div class="login-coin coin-2">
            🪙
        </div>

        <div class="login-star star-1">
            ⭐
        </div>

        <div class="login-star star-2">
            ⭐
        </div>


        <!-- GROUND DECOR -->

        <div class="ground-pipe pipe-left">

            <div class="pipe-top"></div>
            <div class="pipe-body"></div>

        </div>


        <div class="ground-pipe pipe-right">

            <div class="pipe-top"></div>
            <div class="pipe-body"></div>

        </div>


        <div class="question-block block-one">
            ?
        </div>

        <div class="question-block block-two">
            ?
        </div>




        <div class="ground-coin coin-three">
            🪙
        </div>


        <div class="ground-bush bush-one"></div>
        <div class="ground-bush bush-two"></div>


        <div class="small-mushroom">
            🍄
        </div>


        <div class="flag-pole-login">

            <div class="flag-login">
                ⭐
            </div>

        </div>

    </div>


    <!-- =================================================
         LOGIN CARD
    ================================================== -->

    <main class="login-wrapper">

        <section class="login-card">


            <div class="login-mushroom">
                🍄
            </div>


            <div class="login-world">
                WORLD 0-1
            </div>


            <h1>
                PLAYER LOGIN
            </h1>


            <p class="login-subtitle">

                Masuk untuk melanjutkan
                perjalanan ke portfolio XYR.

            </p>


            <?php if ($error !== ""): ?>

                <div class="login-error">

                    ❌
                    <?= htmlspecialchars($error) ?>

                </div>

            <?php endif; ?>


            <form
                id="loginForm"
                method="POST"
                action="login.php"
            >


                <!-- USERNAME -->

                <div class="login-input-group">

                    <label for="username">
                        👤 USERNAME
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Masukkan username"
                        autocomplete="username"
                        required
                    >

                </div>


                <!-- PASSWORD -->

                <div class="login-input-group">

                    <label for="password">
                        🔑 PASSWORD
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >

                </div>


                <!-- LOGIN -->

                <button
                    type="submit"
                    class="mario-login-button"
                    id="loginButton"
                >
                    🍄 START GAME
                </button>

            </form>


            <!-- DEMO -->

            <div class="login-info">

                <span>
                    DEMO LOGIN
                </span>

                <strong>
                    xyr / 12345
                </strong>

            </div>


            <a
                href="login.php"
                class="login-reset"
            >
                🔄 RESET
            </a>


        </section>

    </main>


    <script src="dashboard.js"></script>

</body>

</html>