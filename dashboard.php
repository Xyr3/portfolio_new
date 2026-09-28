<?php

session_start();

/* =====================================================
   CEK LOGIN
===================================================== */

if (
    !isset($_SESSION["logged_in"]) ||
    $_SESSION["logged_in"] !== true
) {
    header("Location: login.php");
    exit;
}


/* =====================================================
   DATA FILE
===================================================== */

$dataFile = __DIR__ . "/portfolio_data.json";


/* =====================================================
   HELPER
===================================================== */

function e($value)
{
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        "UTF-8"
    );
}


/* =====================================================
   DEFAULT DATA
===================================================== */

$defaultData = [

    "profile" => [

        "name" => "Christian Ronaldo",

        "role" => "Creative Developer",

        "location" => "Samarinda, Indonesia",

        "hobby" => "Mobile Legends",

        "bio" =>
            "Saya membuat website interaktif, interface menarik, dan project digital dengan sentuhan kreativitas.",

        "image" =>
            "Cuplikan layar 2026-08-27 113909.png"

    ],

    "skills" => [

        [
            "name" => "HTML",
            "level" => "LV.09",
            "description" => "Struktur website",
            "percentage" => 90,
            "icon" => "🌐"
        ],

        [
            "name" => "CSS",
            "level" => "LV.08",
            "description" => "Visual dan responsive design",
            "percentage" => 85,
            "icon" => "🎨"
        ],

        [
            "name" => "JAVASCRIPT",
            "level" => "LV.04",
            "description" => "Interaksi dan DOM",
            "percentage" => 28,
            "icon" => "⚡"
        ],

        [
            "name" => "UI / UX",
            "level" => "LV.01",
            "description" => "Interface dan pengalaman pengguna",
            "percentage" => 10,
            "icon" => "✏️"
        ]

    ],

    "missions" => [

        [
            "date" => "2026 — NOW",
            "title" => "Pendidikan",
            "description" => "SD 004, SMP 29, SMK TI Airlangga",
            "icon" => "🏫"
        ],

        [
            "date" => "2026",
            "title" => "Web Development",
            "description" => "Mulai membangun berbagai project website.",
            "icon" => "💻"
        ],

        [
            "date" => "2026",
            "title" => "UI / UX Exploration",
            "description" => "Mempelajari interface, layout, dan user experience.",
            "icon" => "🎨"
        ]

    ],

    "projects" => [

        [
            "world" => "WORLD 1",
            "title" => "Interactive Portfolio",
            "description" => "Portfolio website dengan animasi dan interaksi DOM.",
            "icon" => "🌐",
            "url" => "#"
        ],

        [
            "world" => "WORLD 2",
            "title" => "Mini Game Collection",
            "description" => "Kumpulan game sederhana berbasis JavaScript.",
            "icon" => "🎮",
            "url" => "#"
        ],

        [
            "world" => "WORLD 3",
            "title" => "Creative Experiment",
            "description" => "Eksperimen desain, coding, dan interaksi.",
            "icon" => "🚀",
            "url" => "#"
        ]

    ]

];


/* =====================================================
   LOAD DATA
===================================================== */

$data = $defaultData;

if (file_exists($dataFile)) {

    $json =
        file_get_contents(
            $dataFile
        );

    $decoded =
        json_decode(
            $json,
            true
        );

    if (
        is_array($decoded)
    ) {

        $data =
            array_replace_recursive(
                $defaultData,
                $decoded
            );

    }

}


/* =====================================================
   SAVE DATA
===================================================== */

$saveMessage = "";
$saveSuccess = false;


if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["save_portfolio"])
) {


    /* =================================================
       PROFILE
    ================================================== */

    $profile = [

        "name" =>
            trim(
                $_POST["profile_name"] ?? ""
            ),

        "role" =>
            trim(
                $_POST["profile_role"] ?? ""
            ),

        "location" =>
            trim(
                $_POST["profile_location"] ?? ""
            ),

        "hobby" =>
            trim(
                $_POST["profile_hobby"] ?? ""
            ),

        "bio" =>
            trim(
                $_POST["profile_bio"] ?? ""
            ),

        "image" =>
            trim(
                $_POST["profile_image"] ?? ""
            )

    ];


    /* =================================================
       SKILLS
    ================================================== */

    $skills = [];

    $skillNames =
        $_POST["skill_name"] ?? [];

    $skillLevels =
        $_POST["skill_level"] ?? [];

    $skillDescriptions =
        $_POST["skill_description"] ?? [];

    $skillPercentages =
        $_POST["skill_percentage"] ?? [];

    $skillIcons =
        $_POST["skill_icon"] ?? [];


    foreach (
        $skillNames as $i => $skillName
    ) {

        $skillName =
            trim(
                $skillName
            );

        if (
            $skillName === ""
        ) {
            continue;
        }


        $percentage =
            intval(
                $skillPercentages[$i] ?? 0
            );

        $percentage =
            max(
                0,
                min(
                    100,
                    $percentage
                )
            );


        $skills[] = [

            "name" =>
                $skillName,

            "level" =>
                trim(
                    $skillLevels[$i] ?? ""
                ),

            "description" =>
                trim(
                    $skillDescriptions[$i] ?? ""
                ),

            "percentage" =>
                $percentage,

            "icon" =>
                trim(
                    $skillIcons[$i] ?? "⭐"
                )

        ];

    }


    /* =================================================
       MISSIONS
    ================================================== */

    $missions = [];

    $missionDates =
        $_POST["mission_date"] ?? [];

    $missionTitles =
        $_POST["mission_title"] ?? [];

    $missionDescriptions =
        $_POST["mission_description"] ?? [];

    $missionIcons =
        $_POST["mission_icon"] ?? [];


    foreach (
        $missionTitles as $i => $missionTitle
    ) {

        $missionTitle =
            trim(
                $missionTitle
            );

        if (
            $missionTitle === ""
        ) {
            continue;
        }


        $missions[] = [

            "date" =>
                trim(
                    $missionDates[$i] ?? ""
                ),

            "title" =>
                $missionTitle,

            "description" =>
                trim(
                    $missionDescriptions[$i] ?? ""
                ),

            "icon" =>
                trim(
                    $missionIcons[$i] ?? "⭐"
                )

        ];

    }


    /* =================================================
       PROJECTS
    ================================================== */

    $projects = [];

    $projectWorlds =
        $_POST["project_world"] ?? [];

    $projectTitles =
        $_POST["project_title"] ?? [];

    $projectDescriptions =
        $_POST["project_description"] ?? [];

    $projectIcons =
        $_POST["project_icon"] ?? [];

    $projectUrls =
        $_POST["project_url"] ?? [];


    foreach (
        $projectTitles as $i => $projectTitle
    ) {

        $projectTitle =
            trim(
                $projectTitle
            );

        if (
            $projectTitle === ""
        ) {
            continue;
        }


        $projects[] = [

            "world" =>
                trim(
                    $projectWorlds[$i] ?? ""
                ),

            "title" =>
                $projectTitle,

            "description" =>
                trim(
                    $projectDescriptions[$i] ?? ""
                ),

            "icon" =>
                trim(
                    $projectIcons[$i] ?? "🚀"
                ),

            "url" =>
                trim(
                    $projectUrls[$i] ?? "#"
                )

        ];

    }


    /* =================================================
       NEW DATA
    ================================================== */

    $data = [

        "profile" =>
            $profile,

        "skills" =>
            $skills,

        "missions" =>
            $missions,

        "projects" =>
            $projects

    ];


    /* =================================================
       WRITE JSON
    ================================================== */

    $result =
        file_put_contents(
            $dataFile,
            json_encode(
                $data,
                JSON_PRETTY_PRINT |
                JSON_UNESCAPED_UNICODE |
                JSON_UNESCAPED_SLASHES
            )
        );


    if (
        $result !== false
    ) {

        $saveMessage =
            "MISSION COMPLETE! DATA PORTFOLIO BERHASIL DISIMPAN.";

        $saveSuccess =
            true;

    } else {

        $saveMessage =
            "Gagal menyimpan data.";

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

    <title>🎮 XYR Control Center</title>

    <link
        rel="stylesheet"
        href="dashboard.css"
    >

</head>


<body>


<!-- =====================================================
     BACKGROUND
===================================================== -->

<div class="dashboard-bg">

    <div class="bg-cloud cloud-1"></div>
    <div class="bg-cloud cloud-2"></div>
    <div class="bg-cloud cloud-3"></div>

    <div class="bg-star star-1">★</div>
    <div class="bg-star star-2">★</div>
    <div class="bg-star star-3">★</div>

    <div class="bg-coin coin-1">🪙</div>
    <div class="bg-coin coin-2">🪙</div>

    <div class="bg-block block-1">?</div>
    <div class="bg-block block-2">?</div>

</div>


<!-- =====================================================
     LAYOUT
===================================================== -->

<div class="dashboard-layout">


    <!-- =================================================
         SIDEBAR
    ================================================== -->

    <aside class="sidebar">


        <div class="sidebar-logo">

            <div class="logo-icon">
                🍄
            </div>

            <div>

                <strong>
                    PLAYER
                </strong>

                <span>
                    CONTROL
                </span>

            </div>

        </div>


        <div class="player-mini">

            <div class="player-avatar">
                👨‍💻
            </div>

            <div>

                <strong>
                    <?= e($_SESSION["username"] ?? "xyr") ?>
                </strong>

                <small>
                    PLAYER ONLINE
                </small>

            </div>

            <div class="online-dot"></div>

        </div>


        <nav class="side-nav">


            <a
                href="#overview"
                class="side-link active"
            >

                <span>
                    🏠
                </span>

                OVERVIEW

            </a>


            <a
                href="#profileEditor"
                class="side-link"
            >

                <span>
                    🍄
                </span>

                PLAYER PROFILE

            </a>


            <a
                href="#skillsEditor"
                class="side-link"
            >

                <span>
                    🔥
                </span>

                MY SKILLS

            </a>


            <a
                href="#missionsEditor"
                class="side-link"
            >

                <span>
                    🗺️
                </span>

                MISSION HISTORY

            </a>


            <a
                href="#projectsEditor"
                class="side-link"
            >

                <span>
                    🏰
                </span>

                MY PROJECTS

            </a>

        </nav>


        <div class="sidebar-bottom">

            <a
                href="index.php"
                class="sidebar-button preview"
            >
                👀 VIEW PORTFOLIO
            </a>


            <a
                href="logout.php"
                class="sidebar-button logout"
            >
                🚪 LOGOUT
            </a>

        </div>


    </aside>


    <!-- =================================================
         MAIN
    ================================================== -->

    <main class="dashboard-main">


        <!-- =================================================
             TOPBAR
        ================================================== -->

        <header class="topbar">


            <div class="topbar-title">

                <small>
                    MUSHROOM KINGDOM / CONTROL ROOM
                </small>

                <h1>
                    PORTFOLIO DASHBOARD
                </h1>

            </div>


            <div class="topbar-stats">


                <div class="hud-stat">

                    <span>
                        🪙
                    </span>

                    <div>

                        <small>
                            COINS
                        </small>

                        <strong>
                            999
                        </strong>

                    </div>

                </div>


                <div class="hud-stat">

                    <span>
                        ⭐
                    </span>

                    <div>

                        <small>
                            XP
                        </small>

                        <strong>
                            85%
                        </strong>

                    </div>

                </div>


                <div class="hud-stat">

                    <span>
                        🏆
                    </span>

                    <div>

                        <small>
                            LEVEL
                        </small>

                        <strong>
                            09
                        </strong>

                    </div>

                </div>


            </div>

        </header>


        <?php if ($saveMessage !== ""): ?>

            <div
                class="toast-message <?= $saveSuccess ? "success" : "error" ?>"
            >

                <span>
                    <?= $saveSuccess ? "🎉" : "⚠️" ?>
                </span>

                <div>

                    <strong>
                        <?= e($saveMessage) ?>
                    </strong>

                    <?php if ($saveSuccess): ?>

                        <small>
                            Semua perubahan sudah masuk ke portfolio.
                        </small>

                    <?php endif; ?>

                </div>

            </div>

        <?php endif; ?>


        <!-- =================================================
             OVERVIEW
        ================================================== -->

        <section
            id="overview"
            class="overview-grid"
        >


            <div class="welcome-card">


                <div class="welcome-text">

                    <div class="world-badge">
                        WORLD 1-1
                    </div>


                    <h2>

                        READY,

                        <span>
                            <?= e($_SESSION["username"] ?? "PLAYER") ?>
                        </span>

                        ?

                    </h2>


                    <p>
                        Atur dunia portfolio kamu
                        dari satu tempat.
                    </p>


                    <div class="welcome-actions">

                        <button
                            type="button"
                            class="quick-button"
                            data-scroll="#profileEditor"
                        >
                            🍄 EDIT PROFILE
                        </button>


                        <button
                            type="button"
                            class="quick-button yellow"
                            data-scroll="#projectsEditor"
                        >
                            🏰 MANAGE PROJECT
                        </button>

                    </div>

                </div>


                <div class="welcome-character">
                    🍄
                </div>

            </div>


            <div class="preview-mini">

                <div class="preview-mini-top">

                    <span>
                        LIVE PREVIEW
                    </span>

                    <span class="live-dot">
                        ● LIVE
                    </span>

                </div>


                <div class="preview-mini-profile">

                    <div class="mini-avatar">
                        <?php

                        $image =
                            $data["profile"]["image"]
                            ?? "";

                        if (
                            $image !== "" &&
                            file_exists(
                                __DIR__ . "/" . $image
                            )
                        ):

                        ?>

                            <img
                                src="<?= e($image) ?>"
                                alt="Profile"
                            >

                        <?php else: ?>

                            👨‍💻

                        <?php endif; ?>

                    </div>


                    <div>

                        <strong
                            id="miniPreviewName"
                        >
                            <?= e(
                                $data["profile"]["name"]
                                ?? ""
                            ) ?>
                        </strong>

                        <span
                            id="miniPreviewRole"
                        >
                            <?= e(
                                $data["profile"]["role"]
                                ?? ""
                            ) ?>
                        </span>

                    </div>

                </div>


                <div class="mini-progress">

                    <div></div>

                </div>


                <div class="mini-preview-footer">

                    <span>
                        PROFILE
                    </span>

                    <span>
                        SKILLS
                    </span>

                    <span>
                        PROJECTS
                    </span>

                </div>

            </div>

        </section>


        <!-- =================================================
             EDIT FORM
        ================================================== -->

        <form
            method="POST"
            id="portfolioEditor"
        >

            <input
                type="hidden"
                name="save_portfolio"
                value="1"
            >


            <!-- =============================================
                 PROFILE
            ============================================== -->

            <section
                id="profileEditor"
                class="editor-panel"
            >


                <div class="panel-heading">


                    <div class="panel-heading-icon red">
                        🍄
                    </div>


                    <div>

                        <span>
                            CHARACTER CONFIG
                        </span>

                        <h2>
                            PLAYER PROFILE
                        </h2>

                    </div>


                    <div class="panel-tag">
                        WORLD 01
                    </div>

                </div>


                <div class="profile-editor-layout">


                    <div class="profile-avatar-editor">


                        <div class="avatar-preview">

                            <?php

                            if (
                                !empty(
                                    $data["profile"]["image"]
                                ) &&
                                file_exists(
                                    __DIR__ . "/" .
                                    $data["profile"]["image"]
                                )
                            ):

                            ?>

                                <img
                                    src="<?= e(
                                        $data["profile"]["image"]
                                    ) ?>"
                                    alt="Profile"
                                >

                            <?php else: ?>

                                👨‍💻

                            <?php endif; ?>

                        </div>


                        <div class="avatar-label">
                            PLAYER AVATAR
                        </div>


                        <input
                            type="text"
                            name="profile_image"
                            value="<?= e(
                                $data["profile"]["image"]
                                ?? ""
                            ) ?>"
                            placeholder="nama-file-gambar.png"
                        >

                    </div>


                    <div class="profile-fields">


                        <div class="field-block">

                            <label>
                                PLAYER NAME
                            </label>

                            <input
                                type="text"
                                name="profile_name"
                                id="profileName"
                                value="<?= e(
                                    $data["profile"]["name"]
                                    ?? ""
                                ) ?>"
                            >

                        </div>


                        <div class="field-block">

                            <label>
                                ROLE
                            </label>

                            <input
                                type="text"
                                name="profile_role"
                                id="profileRole"
                                value="<?= e(
                                    $data["profile"]["role"]
                                    ?? ""
                                ) ?>"
                            >

                        </div>


                        <div class="field-row">


                            <div class="field-block">

                                <label>
                                    LOCATION
                                </label>

                                <input
                                    type="text"
                                    name="profile_location"
                                    value="<?= e(
                                        $data["profile"]["location"]
                                        ?? ""
                                    ) ?>"
                                >

                            </div>


                            <div class="field-block">

                                <label>
                                    HOBBY
                                </label>

                                <input
                                    type="text"
                                    name="profile_hobby"
                                    value="<?= e(
                                        $data["profile"]["hobby"]
                                        ?? ""
                                    ) ?>"
                                >

                            </div>


                        </div>


                        <div class="field-block">

                            <label>
                                BIO
                            </label>

                            <textarea
                                name="profile_bio"
                                rows="5"
                            ><?= e(
                                $data["profile"]["bio"]
                                ?? ""
                            ) ?></textarea>

                        </div>


                    </div>


                </div>


            </section>


            <!-- =============================================
                 SKILLS
            ============================================== -->

            <section
                id="skillsEditor"
                class="editor-panel"
            >


                <div class="panel-heading">


                    <div class="panel-heading-icon yellow">
                        🔥
                    </div>


                    <div>

                        <span>
                            POWER-UP MENU
                        </span>

                        <h2>
                            MY SKILLS
                        </h2>

                    </div>


                    <button
                        type="button"
                        class="add-game-button"
                        id="addSkill"
                    >
                        + ADD POWER-UP
                    </button>

                </div>


                <div
                    id="skillsContainer"
                    class="card-editor-grid"
                >


                    <?php foreach (
                        $data["skills"] ?? []
                        as $skill
                    ): ?>

                        <article class="skill-editor-card">


                            <div class="skill-card-head">

                                <div
                                    class="skill-icon-edit"
                                >

                                    <input
                                        type="text"
                                        name="skill_icon[]"
                                        value="<?= e(
                                            $skill["icon"]
                                        ) ?>"
                                    >

                                </div>


                                <button
                                    type="button"
                                    class="delete-card"
                                >
                                    ×
                                </button>

                            </div>


                            <div class="field-block compact">

                                <label>
                                    SKILL NAME
                                </label>

                                <input
                                    type="text"
                                    name="skill_name[]"
                                    value="<?= e(
                                        $skill["name"]
                                    ) ?>"
                                    class="skill-live-name"
                                >

                            </div>


                            <div class="skill-two-fields">


                                <div class="field-block compact">

                                    <label>
                                        LEVEL
                                    </label>

                                    <input
                                        type="text"
                                        name="skill_level[]"
                                        value="<?= e(
                                            $skill["level"]
                                        ) ?>"
                                    >

                                </div>


                                <div class="field-block compact">

                                    <label>
                                        %
                                    </label>

                                    <input
                                        type="number"
                                        name="skill_percentage[]"
                                        min="0"
                                        max="100"
                                        value="<?= intval(
                                            $skill["percentage"]
                                        ) ?>"
                                        class="skill-percent-input"
                                    >

                                </div>


                            </div>


                            <div class="skill-editor-bar">

                                <span
                                    style="
                                        width:
                                        <?= intval(
                                            $skill["percentage"]
                                        ) ?>%;
                                    "
                                ></span>

                            </div>


                            <div class="field-block compact">

                                <label>
                                    DESCRIPTION
                                </label>

                                <input
                                    type="text"
                                    name="skill_description[]"
                                    value="<?= e(
                                        $skill["description"]
                                    ) ?>"
                                >

                            </div>


                        </article>

                    <?php endforeach; ?>


                </div>

            </section>


            <!-- =============================================
                 MISSIONS
            ============================================== -->

            <section
                id="missionsEditor"
                class="editor-panel"
            >


                <div class="panel-heading">


                    <div class="panel-heading-icon green">
                        🗺️
                    </div>


                    <div>

                        <span>
                            WORLD MAP
                        </span>

                        <h2>
                            MISSION HISTORY
                        </h2>

                    </div>


                    <button
                        type="button"
                        class="add-game-button green"
                        id="addMission"
                    >
                        + ADD MISSION
                    </button>

                </div>


                <div
                    id="missionsContainer"
                    class="mission-editor-list"
                >


                    <?php foreach (
                        $data["missions"] ?? []
                        as $mission
                    ): ?>

                        <article class="mission-editor-card">


                            <div class="mission-number">

                                <span>
                                    <?= e(
                                        $mission["icon"]
                                    ) ?>
                                </span>

                                <small>
                                    MISSION
                                </small>

                            </div>


                            <div class="mission-edit-content">


                                <div class="field-row">


                                    <div class="field-block">

                                        <label>
                                            DATE
                                        </label>

                                        <input
                                            type="text"
                                            name="mission_date[]"
                                            value="<?= e(
                                                $mission["date"]
                                            ) ?>"
                                        >

                                    </div>


                                    <div class="field-block">

                                        <label>
                                            TITLE
                                        </label>

                                        <input
                                            type="text"
                                            name="mission_title[]"
                                            value="<?= e(
                                                $mission["title"]
                                            ) ?>"
                                        >

                                    </div>


                                </div>


                                <div class="field-block">

                                    <label>
                                        DESCRIPTION
                                    </label>

                                    <textarea
                                        name="mission_description[]"
                                        rows="3"
                                    ><?= e(
                                        $mission["description"]
                                    ) ?></textarea>

                                </div>


                                <div class="field-block">

                                    <label>
                                        ICON
                                    </label>

                                    <input
                                        type="text"
                                        name="mission_icon[]"
                                        value="<?= e(
                                            $mission["icon"]
                                        ) ?>"
                                    >

                                </div>


                            </div>


                            <button
                                type="button"
                                class="delete-card mission-delete"
                            >
                                ×
                            </button>


                        </article>

                    <?php endforeach; ?>


                </div>

            </section>


            <!-- =============================================
                 PROJECTS
            ============================================== -->

            <section
                id="projectsEditor"
                class="editor-panel"
            >


                <div class="panel-heading">


                    <div class="panel-heading-icon blue">
                        🏰
                    </div>


                    <div>

                        <span>
                            HALL OF CREATIONS
                        </span>

                        <h2>
                            MY PROJECTS
                        </h2>

                    </div>


                    <button
                        type="button"
                        class="add-game-button blue"
                        id="addProject"
                    >
                        + ADD PROJECT
                    </button>

                </div>


                <div
                    id="projectsContainer"
                    class="project-editor-grid"
                >


                    <?php foreach (
                        $data["projects"] ?? []
                        as $project
                    ): ?>

                        <article class="project-editor-card">


                            <div
                                class="project-cover"
                            >

                                <input
                                    type="text"
                                    name="project_icon[]"
                                    value="<?= e(
                                        $project["icon"]
                                    ) ?>"
                                    class="project-icon-input"
                                >

                                <span>
                                    <?= e(
                                        $project["world"]
                                    ) ?>
                                </span>

                            </div>


                            <div class="project-edit-body">


                                <button
                                    type="button"
                                    class="delete-card"
                                >
                                    ×
                                </button>


                                <div class="field-block compact">

                                    <label>
                                        WORLD
                                    </label>

                                    <input
                                        type="text"
                                        name="project_world[]"
                                        value="<?= e(
                                            $project["world"]
                                        ) ?>"
                                    >

                                </div>


                                <div class="field-block compact">

                                    <label>
                                        PROJECT NAME
                                    </label>

                                    <input
                                        type="text"
                                        name="project_title[]"
                                        value="<?= e(
                                            $project["title"]
                                        ) ?>"
                                    >

                                </div>


                                <div class="field-block compact">

                                    <label>
                                        DESCRIPTION
                                    </label>

                                    <textarea
                                        name="project_description[]"
                                        rows="3"
                                    ><?= e(
                                        $project["description"]
                                    ) ?></textarea>

                                </div>


                                <div class="field-block compact">

                                    <label>
                                        PROJECT LINK
                                    </label>

                                    <input
                                        type="url"
                                        name="project_url[]"
                                        value="<?= e(
                                            $project["url"]
                                        ) ?>"
                                    >

                                </div>


                            </div>


                        </article>

                    <?php endforeach; ?>


                </div>

            </section>


            <!-- =============================================
                 SAVE AREA
            ============================================== -->

            <section class="save-panel">


                <div>

                    <span>
                        FINAL CHECKPOINT
                    </span>

                    <h2>
                        READY TO SAVE?
                    </h2>

                    <p>
                        Semua perubahan akan langsung
                        masuk ke portfolio.
                    </p>

                </div>


                <button
                    type="submit"
                    class="save-game-button"
                    id="saveButton"
                >
                    💾 SAVE WORLD
                </button>


            </section>


        </form>


    </main>

</div>


<script
    src="dashboard-editor.js"
></script>


</body>

</html>