<?php
require_once("../connexion/conx.php");
session_start();
$sessionId = $_SESSION['user_id'];
$query = "SELECT * FROM user_form WHERE id = $sessionId";
$result = mysqli_query($conn, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($conn);
    exit;
}

// Check user type and set text accordingly
$userType = $user['user_type'];
if ($userType == "user") {
    $userTypeText = "Student";
} elseif ($userType == "instructor") {
    $userTypeText = "Professor";
} elseif ($userType == "admin") {
    $userTypeText = "Admin";
} else {
    // Default to user type if not recognized
    $userTypeText = $userType;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="fonts/remixicon.css">
    <style>
        /* ===== =====  Poppins Google Font  ===== =====  */
        @import url("https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i");

        /* ===== =====>>  Universal Selector  <<===== =====  */
        * {
            padding: 0;
            margin: 0;
            font-size: 14px;
            font-family: sans-serif;
            list-style: none;
            text-decoration: none;
            font-family: "Poppins", sans-serif;
        }

        /* ===== =====>>  Body Font Size  <<===== =====  */
        html {
            font-size: 10px;
        }

        /* ===== =====>> Css Variables  <<===== =====  */
        :root {
            /* =====>>  Font Color  <<===== */
            --f1-color: #fff;
            --f2-color: #000;
            --f3-color: rgba(0, 0, 0, 0.8);
            --f4-color: rgba(0, 0, 0, 0.6);
            --f5-color: #0099cc;
            --f6-color: #88cee6;

            /* =====>>  Background Color  <<===== */
            --bg1-color: #fff;
            --bg2-color: #000;
            --bg3-color: #33ccff;
            --bg4-color: #33cc33;
            --bg5-color: #0099cc;
            --bg6-color: rgba(0, 0, 0, 0.4);
            --bg7-color: rgba(0, 0, 0, 0.2);
            --glass-bg: linear-gradient(to right bottom,
                    rgba(255, 255, 255, 0.5),
                    rgba(255, 255, 255, 0.3));
            --C-lg-bg: linear-gradient(45deg, #ff3399, #ff9933);

            /* ===== =====>>  Font Size  <<===== =====  */
            --xxxl-fs: 2.2rem;
            --xxl-fs: 1.8rem;
            --xl-fs: 1.6rem;
            --l-fs: 1.4rem;
            --m-fs: 1.2rem;
            --s-fs: 1.1rem;
            --xs-fs: 1rem;

            /* =====>>  Margin  <<===== */
            --m-2-5: 2.5rem;
            --m-1-8: 1.8rem;
            --m-1-5: 1.5rem;
            --m-0-6: 0.6rem;
            --m-0-5: 0.5rem;
            --m-0-3: 0.3rem;

            /* =====>>  Padding  <<===== */
            --p-2-5: 2.5rem;
            --p-1-5: 1.5rem;
            --p-1-0: 1rem;
            --p-0-8: 0.8rem;
            --p-0-5: 0.5rem;
            --p-0-4: 0.4rem;
            --p-0-3: 0.3rem;
        }

        /* ===== =====>>  Body Css  <<===== =====  */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* ===== =====>>  Body Main-Background Css  <<===== =====  */
        .main_bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url(bg.png);
            background-position: left;
            z-index: -1;
            filter: blur(10px);
        }

        /* ===== =====>>  Main-Container Css  <<===== =====  */
        .container {
            position: relative;
            display: grid;
            grid-template-columns: 1fr 2fr;
            grid-template-areas:
                "header header"
                "userProfile userDetails"
                "work_skills timeline_about"
                "work_skills timeline_about";
            width: 85%;
            height: 90vh;
            background: var(--glass-bg);
            padding: var(--p-1-5);
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.5), 0 0 25px rgba(0, 0, 0, 0.08);
        }

        /* ===== =====>>  Container Cards Grid-Area Css Start  <<===== =====  */
        header {
            grid-area: header;
        }

        .userProfile {
            grid-area: userProfile;
        }

        .work_skills {
            grid-area: work_skills;
        }

        .userDetails {
            grid-area: userDetails;
        }

        .timeline_about {
            grid-area: timeline_about;
        }

        /* ===== =====>>  Container Cards Css  <<===== =====  */
        .container .card {
            background: var(--glass-bg);
            backdrop-filter: blur(3rem);
            border-radius: 0.5rem;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
            padding: var(--p-1-5);
        }

        /* ===== =====>>  Container Header/Navbar Css  <<===== =====  */
        .container header {
            padding: 0 var(--p-2-5);
        }

        .container header .brandLogo {
            display: flex;
            align-items: center;
        }

        .container header .brandLogo figure img {
            width: 3.5rem;
            height: 3.5rem;
        }

        .container header .brandLogo span {
            font-size: var(--xl-fs);
            font-weight: 700;
            margin-left: var(--m-0-5);
        }

        /* ===== =====>>  User Main-Profile Css Start  <<===== ===== */
        .container .userProfile {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            background: none;
            backdrop-filter: none;
            box-shadow: none;
        }

        .container .userProfile .profile figure img {
            width: 18rem;
            height: 18rem;
            border-radius: 50%;
        }

        /* ===== =====>>  Work & Skills Css Start  <<===== ===== */
        .container .work_skills {
            padding: var(--p-1-5);
        }

        .work_skills .work .heading,
        .work_skills .skills .heading {
            position: relative;
            font-size: var(--xs-fs);
            color: rgba(0, 0, 0, 0.6);
            text-transform: uppercase;
            margin-bottom: var(--m-1-5);
        }

        .work_skills .work .heading::before,
        .work_skills .skills .heading::before {
            content: "";
            position: absolute;
            bottom: 0;
            right: 0;
            height: 0.1rem;
            width: 88%;
            background: var(--bg6-color);
        }

        .work_skills .work .primary,
        .work_skills .work .secondary {
            position: relative;
        }

        .work_skills .work .primary h1,
        .work_skills .work .secondary h1 {
            font-size: var(--l-fs);
            color: var(--f3-color);
            margin-bottom: var(--m-0-6);
        }

        .work_skills .work .primary span,
        .work_skills .work .secondary span {
            position: absolute;
            top: 0;
            right: 3rem;
            font-weight: 700;
            font-size: var(--s-fs);
            color: var(--f5-color);
            background: #e6f2ff;
            padding: var(--p-0-4) var(--p-1-0);
            border-radius: 0.4rem;
        }

        .work_skills .work .primary p,
        .work_skills .work .secondary p {
            margin-bottom: var(--m-1-8);
            font-size: var(--m-fs);
            color: rgba(0, 0, 0, 0.6);
            line-height: 1.6rem;
        }

        /* =====>>  Skills Bars Css  <<===== */
        .work_skills .skills ul li {
            position: relative;
            font-size: var(--m-fs);
            line-height: 1.8rem;
            margin: var(--m-0-5);
            color: var(--f2-color);
            font-weight: 500;
        }

        .work_skills .skills ul li::before {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            margin: auto;
            height: 0.2rem;
            background: var(--bg3-color);
            animation: skills 8s linear infinite;
            animation-delay: calc(-2s * var(--i));
        }

        @keyframes skills {
            0% {
                width: 50%;
                filter: hue-rotate(180deg);
            }

            50% {
                width: 0;
            }

            100% {
                width: 50%;
                filter: hue-rotate(0);
            }
        }

        /* ===== =====>>  User Details Css Start  <<===== ===== */
        .userDetails {
            position: relative;
            padding: var(--p-1-5) var(--p-2-5);
        }

        .userDetails .userName h1 {
            font-size: var(--xxxl-fs);
        }

        .userDetails .userName .map {
            position: absolute;
            top: 2.5rem;
            left: 18.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .userDetails .userName .map .ri {
            margin-right: var(--m-0-3);
            font-size: var(--m-fs);
        }

        .userDetails .userName .map span {
            font-size: var(--s-fs);
            color: var(--f3-color);
            font-weight: 700;
        }

        .userDetails .userName p {
            font-size: var(--m-fs);
            font-weight: 700;
            color: var(--f5-color);
            margin-bottom: var(--m-1-8);
        }

        .userDetails .rank {
            position: relative;
            margin-bottom: var(--m-1-8);
        }

        .userDetails .rank .heading {
            font-size: var(--xs-fs);
            color: var(--f4-color);
            text-transform: uppercase;
            margin-bottom: var(--m-0-6);
        }

        .userDetails .rank span {
            font-size: var(--xxl-fs);
            font-weight: 700;
        }

        .userDetails .rank .rating {
            position: absolute;
            top: 2.7rem;
            left: 3.5rem;
        }

        .userDetails .rank .rating .rate {
            color: var(--f5-color);
            font-size: var(--l-fs);
        }

        .userDetails .rank .rating .underrate {
            color: var(--f6-color);
        }

        .userDetails .btns ul,
        .userDetails .btns ul li {
            display: flex;
            align-items: center;
        }

        .userDetails .btns ul li {
            margin-right: var(--m-2-5);
            border-radius: 0.5rem;
        }

        .userDetails .btns ul li .ri {
            margin-right: var(--m-0-5);
            font-size: var(--xl-fs);
        }

        .userDetails .btns ul li a {
            font-size: var(--l-fs);
            color: var(--f2-color);
            font-weight: 500;
        }

        .userDetails .btns ul .active {
            background: #e6f2ff;
            padding: var(--p-0-5) var(--p-1-5);
        }

        .userDetails .btns ul .active a,
        .userDetails .btns ul .active .ri {
            color: var(--f5-color);
        }

        /* ===== =====>>  Timeline & About Css Start  <<===== ===== */
        .timeline_about {
            padding: var(--p-2-5);
        }

        .timeline_about .tabs ul {
            position: relative;
            display: flex;
            align-items: center;
            margin-bottom: var(--m-2-5);
        }

        .timeline_about .tabs ul::before {
            content: "";
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 1px;
            background: var(--bg7-color);
        }

        .timeline_about .tabs ul li {
            position: relative;
            display: flex;
            align-items: center;
            margin-right: var(--m-2-5);
            padding-bottom: var(--p-0-8);
            cursor: pointer;
        }

        .timeline_about .tabs ul li span {
            font-size: var(--l-fs);
            font-weight: 500;
        }

        .timeline_about .tabs ul li .ri {
            margin-right: var(--m-0-5);
        }

        .timeline_about .tabs ul .active::before {
            content: "";
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 2px;
            background: var(--bg5-color);
        }

        .timeline_about .contact_info .heading,
        .timeline_about .basic_info .heading {
            font-size: var(--xs-fs);
            color: var(--f4-color);
            text-transform: uppercase;
            margin-bottom: var(--m-1-5);
        }

        .timeline_about .contact_info ul,
        .timeline_about .basic_info ul {
            margin-bottom: var(--m-1-5);
        }

        .timeline_about .contact_info ul li,
        .timeline_about .basic_info ul li {
            display: flex;
            margin: var(--m-0-5) 0;
        }

        .timeline_about .contact_info ul li h1,
        .timeline_about .basic_info ul li h1 {
            font-weight: 500;
            font-size: var(--m-fs);
            min-width: 12rem;
        }

        .timeline_about .contact_info ul li span,
        .timeline_about .basic_info ul li span {
            font-size: var(--m-fs);
        }

        .timeline_about .contact_info ul .phone span,
        .timeline_about .contact_info ul .email span,
        .timeline_about .contact_info ul .site span {
            color: var(--f5-color);
        }

        @media screen and (max-width: 1024px) {
            html {
                font-size: 9px;
            }
        }

        @media screen and (max-width: 900px) {
            html {
                font-size: 8px;
            }
        }

        @media screen and (max-width: 768px) {
            html {
                font-size: 10px;
            }

            /* ===== =====>>  Container Css Start  <<===== ===== */
            .container {
                grid-template-columns: 1fr;
                grid-template-areas:
                    "header"
                    "userProfile"
                    "userDetails"
                    "work_skills"
                    "timeline_about";
                overflow-x: hidden;
                overflow-y: inherit;
                padding: 0;
                width: 90%;
                height: 100%;
                box-shadow: none;
            }

            /* ===== =====>>  Container Card Css Start  <<===== ===== */
            .container .card {
                backdrop-filter: none;
            }

            .userDetails {
                margin-bottom: 3rem;
            }

            .container::before,
            .container::after {
                display: none;
            }

            /* ===== =====>>  Header/Navbar Css Start  <<===== ===== */
            .container header {
                padding: 2.5rem;
            }
        }

        @media screen and (max-width: 500px) {
            .container {
                width: 100%;
                overflow: initial;
            }
        }

        @media screen and (max-width: 350px) {
            .main_bg {
                animation: none;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <?php

        $image = $user["pp"];
        ?>
        <section class="userProfile card">
            <div class="profile">
                <figure> <img src="img/<?php echo $image; ?>" title="<?php echo $image; ?>">
                </figure>
            </div>
        </section>




        <section class="userDetails card">
            <div class="userName">
                <h1 class="name"><?php echo $user['uname']; ?></h1>
                <div class="map">
                    <i class="ri-map-pin-fill ri"></i>
                    <span><?php echo $user['adresse']; ?></span>
                </div>
                <p><?php echo $userTypeText; ?></p>
            </div>

            <section class="timeline_about card">
                <div class="tabs">
                    <ul>


                        <li class="about active">
                            <i class="ri-user-3-fill ri"></i>
                            <span>About</span>
                        </li>
                    </ul>
                </div>

                <div class="contact_Info">
                    <h1 class="heading">Contact Information</h1>
                    <ul>
                        <li class="phone">
                            <h1 class="label">Phone:</h1>
                            <span class="info"><?php echo $user['phone']; ?></span>
                        </li>

                        <li class="address">
                            <h1 class="label">Address:</h1>
                            <span class="info"><?php echo $user['adresse']; ?></span>
                        </li>

                        <li class="email">
                            <h1 class="label">E-mail:</h1>
                            <span class="info"><?php echo $user['email']; ?></span>
                        </li>

                        <li class="site">
                            <h1 class="label">Status:</h1>
                            <span class="info"><?php echo $user['status']; ?></span>
                        </li>
                    </ul>
                </div>

                <div class="basic_info">
                    <h1 class="heading">Basic Information</h1>
                    <ul>
                        <li class="birthday">
                            <h1 class="label">Birthday:</h1>
                            <span class="info"><?php echo $user['birthday']; ?></span>
                        </li>

                        <li class="sex">
                            <h1 class="label">Gender:</h1>
                            <span class="info"><?php echo $user['gender']; ?></span>

                        <li class="level">
                            <h1 class="label">Level:</h1>
                            <span class="info"><?php echo $user['level']; ?></span>
                        </li>
                        </li>
                    </ul>
                </div>
                <div class="btns">
                    <ul>
                        <!-- Add the anchor tag for the button -->
                        <li><a href="user_profile.php" style="color: orange;"><i class="ri-arrow-left-line ri"></i>Update Profile </a></li>

                    </ul>
                </div>
            </section>
    </div>

</body>

</html>