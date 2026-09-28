<?php

session_start();

$username = $_SESSION["username"] ?? "XYR";

?>
<?php

session_start();

if (
    !isset($_SESSION["logged_in"]) ||
    $_SESSION["logged_in"] !== true
) {
    header("Location: login.php");
    exit;
}

$dataFile = __DIR__ . "/portfolio_data.json";

$data = [];

if (file_exists($dataFile)) {

    $data = json_decode(
        file_get_contents($dataFile),
        true
    );

}

$profile =
    $data["profile"] ?? [];

$skills =
    $data["skills"] ?? [];

$missions =
    $data["missions"] ?? [];

$projects =
    $data["projects"] ?? [];

?>
</head>
<link rel="stylesheet" href="style.css">

<body>


    <!-- =================================================
         PROGRESS
    ================================================== -->

    <div
        class="scroll-progress"
        id="scrollProgress"
    ></div>


    <!-- =================================================
         WORLD BACKGROUND
    ================================================== -->

    <div class="world-background">

        <div class="sun"></div>

        <div class="cloud cloud-a"></div>
        <div class="cloud cloud-b"></div>
        <div class="cloud cloud-c"></div>
        <div class="cloud cloud-d"></div>


        <div class="mountain mountain-a"></div>
        <div class="mountain mountain-b"></div>
        <div class="mountain mountain-c"></div>


        <div class="floating-coin coin-a">
            🪙
        </div>

        <div class="floating-coin coin-b">
            🪙
        </div>

        <div class="floating-coin coin-c">
            🪙
        </div>


        <div class="floating-star star-a">
            ★
        </div>

        <div class="floating-star star-b">
            ★
        </div>

    </div>


    <!-- =================================================
         NAVBAR
    ================================================== -->

    <header class="navbar">


        <!-- BRAND -->

        <a
            href="#home"
            class="brand"
        >

            <span class="brand-mushroom">
                🍄
            </span>

            <span>
                PLAYER
                <strong>
                    01
                </strong>
            </span>

        </a>


        <!-- NAV -->

        <nav class="desktop-nav">

            <a href="#home">
                HOME
            </a>

            <a href="#about">
                PROFILE
            </a>

            <a href="#skills">
                SKILLS
            </a>

            <a href="#projects">
                PROJECTS
            </a>

            <a href="#games">
                GAMES
            </a>

        </nav>


        <!-- ACCOUNT -->

        <div class="nav-account">

            <a
                href="dashboard.php"
                class="login-button"
            >
                🍄 DASHBOARD
            </a>


            <a
                href="logout.php"
                class="logout-button"
            >
                🚪 LOGOUT
            </a>

        </div>


        <!-- ACTION -->

        <div class="nav-actions">


            <div class="nav-coin-counter">

                🪙

                <span id="navCoinScore">
                    0
                </span>

            </div>


            <button
                type="button"
                id="themeButton"
                class="icon-button"
                aria-label="Ganti tema"
                title="Ganti tema"
            >
                🌙
            </button>


            <button
                type="button"
                id="menuButton"
                class="icon-button mobile-menu-button"
                aria-label="Buka menu"
            >
                ☰
            </button>

        </div>

    </header>


    <!-- =================================================
         MOBILE MENU
    ================================================== -->

    <div
        class="mobile-menu"
        id="mobileMenu"
    >

        <a href="#home">
            🏠 HOME
        </a>

        <a href="#about">
            🍄 PROFILE
        </a>

        <a href="#skills">
            ⭐ SKILLS
        </a>

        <a href="#projects">
            🏰 PROJECTS
        </a>

        <a href="#games">
            🎮 GAMES
        </a>

        <a href="dashboard.php">
            🚀 DASHBOARD
        </a>

        <a href="logout.php">
            🚪 LOGOUT
        </a>

    </div>


    <!-- =================================================
         MAIN
    ================================================== -->

    <main>


        <!-- =================================================
             HERO
        ================================================== -->

        <section
            class="hero section-card reveal"
            id="home"
        >

            <div class="hero-left">


                <div class="level-badge">
                    WORLD 1-1
                </div>


                <p class="eyebrow">
                    WELCOME,
                    <?= htmlspecialchars($username) ?>
                    👋
                </p>


                <h1 class="hero-title">

                    I'M

                    <span>
                        XYR
                    </span>

                </h1>


                <h3>
    <?= htmlspecialchars($profile["role"] ?? "") ?>
</h3>


                <p class="hero-text">

                    Saya membuat website interaktif,
                    interface menarik, dan project digital
                    dengan sentuhan kreativitas dan bermain game
                    seperti Mobile Legends,
                    Roblox, dan Free Fire.

                </p>


                <div class="hero-buttons">

                    <a
                        href="#projects"
                        class="game-button red"
                    >
                        🚩 LIHAT PROJECT
                    </a>


                    <a
                        href="#games"
                        class="game-button green"
                    >
                        🎮 MAIN GAME
                    </a>

                </div>


                <div class="scoreboard">


                    <div class="score-box">

                        <span>
                            PLAYER
                        </span>

                        <strong>
                            XYR
                        </strong>

                    </div>


                    <div class="score-box">

                        <span>
                            COINS
                        </span>

                        <strong id="heroCoinScore">
                            0
                        </strong>

                    </div>


                    <div class="score-box">

                        <span>
                            XP
                        </span>

                        <strong id="xpScore">
                            0
                        </strong>

                    </div>


                    <div class="score-box">

                        <span>
                            LEVEL
                        </span>

                        <strong id="levelScore">
                            01
                        </strong>

                    </div>


                </div>

            </div>


            <!-- PROFILE -->

            <div class="hero-right">

                <div class="profile-orbit orbit-one"></div>
                <div class="profile-orbit orbit-two"></div>


                <div class="profile-card">


                    <div class="profile-top-decoration">
                        ⭐
                    </div>


                    <div class="profile-photo-frame">

                        <div class="profile-photo">

                            <img
    src="<?= htmlspecialchars($profile["image"] ?? "") ?>"
    alt="Foto profil"
>


                            <div
                                id="profileFallback"
                                class="profile-fallback"
                            >
                                👨‍💻
                            </div>

                        </div>

                    </div>


                    <div class="profile-tag">
                        🍄 PLAYER ONLINE
                    </div>


    <h3>
    <?= htmlspecialchars($profile["name"] ?? "") ?>
</h3>

                    <h3>
    <?= htmlspecialchars($profile["location"] ?? "") ?>
</h3>

                </div>

            </div>

        </section>


        <!-- =================================================
             ABOUT
        ================================================== -->

        <section
            class="section-card reveal"
            id="about"
        >

            <div class="section-heading">

                <div class="section-icon">
                    🍄
                </div>

                <div>

                    <p>
                        CHARACTER SELECT
                    </p>

                    <h2>
                        PLAYER PROFILE
                    </h2>

                </div>

                <div class="heading-blocks">
                    🧱 🧱 🧱
                </div>

            </div>


            <div class="profile-grid">


                <article class="info-card">

                    <div class="info-icon red-icon">
                        👤
                    </div>

                    <span>
                        NAME
                    </span>

                    <h3>
                        Christian Ronaldo
                    </h3>

                 <p>
    <?= htmlspecialchars($profile["bio"] ?? "") ?>
</p>
                </article>


                <article class="info-card">

                    <div class="info-icon green-icon">
                        🎮
                    </div>

                    <span>
                        ROLE
                    </span>

                    <h3>
                        WEB DEVELOPER
                    </h3>

                    <p>
                        Fokus pada website
                        interaktif dan
                        user experience.
                    </p>

                </article>


                <article class="info-card">

                    <div class="info-icon blue-icon">
                        📍
                    </div>

                    <span>
                        LOCATION
                    </span>

                    <h3>
                        INDONESIA
                    </h3>

                    <p>
                        Samarinda,
                        Kalimantan Timur.
                    </p>

                </article>


                <article class="info-card">

                    <div class="info-icon yellow-icon">
                        ⭐
                    </div>

                 <h3>
    <?= htmlspecialchars($profile["hobby"] ?? "") ?>
</h3>

                    <p>
                        Need jungle / EXP?
                        Just call me.
                    </p>

                </article>


            </div>

        </section>


        <!-- =================================================
             SKILLS
        ================================================== -->

        <section
            class="section-card reveal"
            id="skills"
        >

            <div class="section-heading">

                <div class="section-icon">
                    🔥
                </div>

                <div>

                    <p>
                        POWER-UP MENU
                    </p>

                    <h2>
                        MY SKILLS
                    </h2>

                </div>

                <div class="heading-blocks">
                    ? ? ?
                </div>

            </div>


           <div class="skills-grid">

    <?php foreach ($skills as $skill): ?>

        <article class="skill-card">

            <div class="skill-header">

                <span class="skill-icon">
                    <?= htmlspecialchars(
                        $skill["icon"] ?? "⭐"
                    ) ?>
                </span>

                <span class="skill-level">
                    <?= htmlspecialchars(
                        $skill["level"] ?? ""
                    ) ?>
                </span>

            </div>


            <h3>
                <?= htmlspecialchars(
                    $skill["name"] ?? ""
                ) ?>
            </h3>


            <p>
                <?= htmlspecialchars(
                    $skill["description"] ?? ""
                ) ?>
            </p>


            <div class="skill-bar">

                <span
                    style="
                        width:
                        <?= intval(
                            $skill["percentage"] ?? 0
                        ) ?>%;
                    "
                ></span>

            </div>


            <strong>
                <?= intval(
                    $skill["percentage"] ?? 0
                ) ?>%
            </strong>

        </article>

    <?php endforeach; ?>

</div>
        </section>


        <!-- =================================================
             TIMELINE
        ================================================== -->

        <section class="section-card reveal">

            <div class="section-heading">

                <div class="section-icon">
                    🗺️
                </div>

                <div>

                    <p>
                        WORLD MAP
                    </p>

                    <h2>
                        MISSION HISTORY
                    </h2>

                </div>

            </div>


           <div class="mission-list">

    <?php foreach ($missions as $mission): ?>

        <article class="mission">

            <div class="mission-marker">

                <?= htmlspecialchars(
                    $mission["icon"] ?? "⭐"
                ) ?>

            </div>


            <div class="mission-content">

                <small>

                    <?= htmlspecialchars(
                        $mission["date"] ?? ""
                    ) ?>

                </small>


                <h3>

                    <?= htmlspecialchars(
                        $mission["title"] ?? ""
                    ) ?>

                </h3>


                <p>

                    <?= htmlspecialchars(
                        $mission["description"] ?? ""
                    ) ?>

                </p>

            </div>


            <div class="mission-badge">
                TASK
            </div>

        </article>

    <?php endforeach; ?>

</div>

        </section>


        <!-- =================================================
             PROJECTS
        ================================================== -->

        <section
            class="section-card reveal"
            id="projects"
        >

            <div class="section-heading">

                <div class="section-icon">
                    🏰
                </div>

                <div>

                    <p>
                        HALL OF CREATIONS
                    </p>

                    <h2>
                        MY PROJECTS
                    </h2>

                </div>

            </div>


            <div class="projects-grid">


                <article class="project-card">

                    <div class="project-art red-art">
                        🌐
                    </div>

                    <div class="project-body">

                        <div class="project-world">
                            WORLD 1
                        </div>

                        <h3>
                            Interactive Portfolio
                        </h3>

                        <p>
                            Portfolio website
                            dengan animasi
                            dan interaksi DOM.
                        </p>

                        <a
                            href="portfolio.php"
                            class="project-link"
                        >
                            VIEW PROJECT →
                        </a>

                    </div>

                </article>


                <article class="project-card">

                    <div class="project-art green-art">
                        🎮
                    </div>

                    <div class="project-body">

                        <div class="project-world">
                            WORLD 2
                        </div>

                        <h3>
                            Mini Game Collection
                        </h3>

                        <p>
                            Kumpulan game sederhana
                            berbasis JavaScript.
                        </p>

                        <a
                            href="http://127.0.0.1:5500/pertemuan%2014/Game.HTML"
                            class="project-link"
                        >
                            PLAY PROJECT →
                        </a>

                    </div>

                </article>


                <article class="project-card">

                    <div class="project-art blue-art">
                        🚀
                    </div>

                    <div class="project-body">

                        <div class="project-world">
                            WORLD 3
                        </div>

                        <h3>
                            Creative Experiment
                        </h3>

                        <p>
                            Eksperimen desain,
                            coding, dan interaksi.
                        </p>

                        <a
                            href="#"
                            class="project-link"
                        >
                            VIEW PROJECT →
                        </a>

                    </div>

                </article>


            </div>

        </section>


        <!-- =================================================
             GAMES
        ================================================== -->

        <section
            class="section-card games-section reveal"
            id="games"
        >

            <div class="section-heading">

                <div class="section-icon">
                    🎮
                </div>

                <div>

                    <p>
                        BONUS WORLD
                    </p>

                    <h2>
                        MINI GAME ZONE
                    </h2>

                </div>

                <div class="heading-blocks">
                    🪙 ⭐ 🍄
                </div>

            </div>


            <div class="games-grid">


                <!-- MEMORY -->

                <article class="game-container">

                    <div class="game-top">

                        <div>

                            <span class="game-number">
                                GAME 01
                            </span>

                            <h3>
                                🍄 MEMORY POWER-UP
                            </h3>

                        </div>

                        <div class="game-reward">
                            +5 🪙
                        </div>

                    </div>


                    <p class="game-description">
                        Cari semua pasangan
                        item Mushroom Kingdom.
                    </p>


                    <div
                        class="memory-board"
                        id="memoryBoard"
                    ></div>


                    <p
                        class="game-message"
                        id="memoryMessage"
                    >
                        Buka dua kartu!
                    </p>


                    <button
                        id="memoryReset"
                        class="small-button"
                    >
                        🔄 RESET GAME
                    </button>

                </article>


                <!-- MAZE -->

                <article class="game-container">

                    <div class="game-top">

                        <div>

                            <span class="game-number">
                                GAME 02
                            </span>

                            <h3>
                                🏰 BRICK CASTLE MAZE
                            </h3>

                        </div>

                        <div class="game-reward">
                            +10 🪙
                        </div>

                    </div>


                    <p class="game-description">
                        Lewati semua brick
                        dan temukan Castle.
                    </p>


                    <div
                        class="maze"
                        id="maze"
                    ></div>


                    <div class="maze-controls">

                        <button data-move="up">
                            ▲
                        </button>

                        <div>

                            <button data-move="left">
                                ◀
                            </button>

                            <button data-move="down">
                                ▼
                            </button>

                            <button data-move="right">
                                ▶
                            </button>

                        </div>

                    </div>


                    <p
                        class="game-message"
                        id="mazeMessage"
                    >
                        Gunakan tombol
                        atau Arrow Keys.
                    </p>


                    <button
                        id="mazeReset"
                        class="small-button"
                    >
                        🔄 RESET MAZE
                    </button>

                </article>


                <!-- MATH -->

                <article class="game-container">

                    <div class="game-top">

                        <div>

                            <span class="game-number">
                                GAME 03
                            </span>

                            <h3>
                                🪙 COIN MATH
                            </h3>

                        </div>

                        <div class="game-reward">
                            +3 🪙
                        </div>

                    </div>


                    <p class="game-description">
                        Jawab soal matematika
                        untuk mendapatkan coin.
                    </p>


                    <div class="math-game">

                        <div
                            id="mathQuestion"
                            class="math-question"
                        >
                            5 + 3 = ?
                        </div>


                        <input
                            id="mathAnswer"
                            type="number"
                            placeholder="Jawaban kamu"
                            autocomplete="off"
                        >


                        <button
                            id="mathSubmit"
                            class="game-button yellow"
                        >
                            CHECK ANSWER ⭐
                        </button>


                        <p
                            class="game-message"
                            id="mathMessage"
                        ></p>


                        <div class="math-score-box">

                            <span>
                                CORRECT ANSWERS
                            </span>

                            <strong id="mathScore">
                                0
                            </strong>

                        </div>

                    </div>

                </article>


            </div>

        </section>


        <!-- =================================================
             LEVEL
        ================================================== -->

        <section
            class="section-card level-section reveal"
        >

            <div class="level-header">

                <div>

                    <small>
                        PLAYER PROGRESS
                    </small>

                    <h2>
                        NEXT LEVEL
                    </h2>

                </div>

                <strong id="progressPercent">
                    0%
                </strong>

            </div>


            <div class="level-bar">

                <span
                    id="progressBar"
                ></span>

            </div>


            <p>
                Kumpulkan coin dan selesaikan
                game untuk mendapatkan XP.
            </p>

        </section>


    </main>


    <!-- =================================================
         FINAL FOOTER
    ================================================== -->

    <footer class="final-mario-footer">

        <div class="final-sky">

            <div class="final-sun"></div>

            <div class="final-cloud cloud-one"></div>
            <div class="final-cloud cloud-two"></div>
            <div class="final-cloud cloud-three"></div>

            <div class="sky-star star-one">
                ★
            </div>

            <div class="sky-star star-two">
                ★
            </div>

        </div>


        <div class="final-mountains">

            <div class="final-mountain mountain-one"></div>
            <div class="final-mountain mountain-two"></div>
            <div class="final-mountain mountain-three"></div>

        </div>


        <div class="castle-stage">

            <div class="big-castle-tower">

                <div class="tower-roof">

                    <div class="tower-top-star">
                        ★
                    </div>

                </div>

                <div class="tower-wall">

                    <div class="tower-window">
                        ✦
                    </div>

                </div>

            </div>


            <div class="big-castle-main">


                <div class="big-main-roof">

                    <div class="roof-mushroom">
                        🍄
                    </div>

                </div>


                <div class="castle-flag">

                    <div class="flag-pole"></div>

                    <div class="indonesia-flag">

                        <span class="flag-red"></span>
                        <span class="flag-white"></span>

                    </div>

                </div>


                <div class="castle-top-circle">
                    ★
                </div>


                <div class="castle-title">

                    <span>
                        FINAL WORLD
                    </span>

                    <h2>
                        THANK YOU!
                    </h2>

                    <p>
                        Mission complete
                    </p>

                </div>


                <div class="castle-door">

                    <div class="door-arch"></div>

                    <div class="door-panel">

                        <div class="door-knob"></div>

                    </div>

                </div>


            </div>


            <div class="big-castle-tower">

                <div class="tower-roof">

                    <div class="tower-top-star">
                        ★
                    </div>

                </div>

                <div class="tower-wall">

                    <div class="tower-window">
                        ✦
                    </div>

                </div>

            </div>

        </div>


        <div class="final-player">

            <div class="player-shadow"></div>

            <div class="player-sprite">
                🍄
            </div>

            <div class="player-label">
                PLAYER 01
            </div>

        </div>


        <div class="finish-marker">

            <div class="marker-pole"></div>

            <div class="marker-flag">
                <span></span>
                <span></span>
            </div>

        </div>


        <div class="final-ground">

            <div class="grass-top">

                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>

            </div>


            <div class="dirt-ground">

                <div class="dirt-pattern"></div>

            </div>

        </div>


        <div class="final-footer-info">

            <div class="footer-identity">

                <div class="footer-avatar">
                    ⭐
                </div>

                <div>

                    <h3>
                        XYR
                    </h3>

                    <p>
                        Creative Developer
                    </p>

                </div>

            </div>


            <div class="footer-navigation">

                <a href="#home">
                    HOME
                </a>

                <a href="#about">
                    PROFILE
                </a>

                <a href="#skills">
                    SKILLS
                </a>

                <a href="#projects">
                    PROJECTS
                </a>

                <a href="#games">
                    GAMES
                </a>

            </div>


            <div class="footer-socials">

                <a href="#">
                    GH
                </a>

                <a
                    href="https://www.instagram.com/cr_christian_ronaldo3399/"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    IG
                </a>

                <a href="#">
                    LI
                </a>

                <a href="#">
                    ✉
                </a>

            </div>


            <div class="footer-message">

                <p>
                    Terima kasih sudah menjelajahi
                    seluruh dunia portfolio guweh.
                </p>

                <strong>
                    LIKE YA KALO SUKA! ⭐
                </strong>

            </div>


            <div class="footer-bottom">

                <span>
                    🇮🇩 Made in Indonesia
                </span>

                <span>
                    © 2026 PLAYER 01
                </span>

                <span>
                    HTML • CSS • JavaScript • PHP
                </span>

            </div>

        </div>

    </footer>


    <script src="script.js"></script>

</body>

</html>