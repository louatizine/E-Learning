<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" type="png" href="images/icon/logo.PNG">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Comaptible" content="IE=edge">
    <title>iTeam E-Learning</title>
    <meta name="desciption" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:500&display=swap');
        @import url('https://fonts.googleapis.com/css?family=Dancing+Script&display=swap');
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #FFF;
            font-family: 'Open Sans', sans-serif;
        }



        /*SCROLLING TEXT*/
        .marqu {
            text-align: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            padding: 10px;
        }

        .marqu img {
            width: 200px;
            height: 50px;
            margin-right: 30px;
            padding-right: 20px;
        }




        /* partenir div */
        .title-container {
            color: #08304E;
            font-family: 'Arial', sans-serif;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-top: 50px;
        }

        .line {

            height: 3px;
            width: 300px;
            background-color: #85152E;
            margin: 0 10px;
        }

        .title-text {
            padding: 0 20px;
            font-size: 40px;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="img/icon.png" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
<?php include("repite/header.php"); ?>





    <!-- Sliding Information -->
    <div class="title-container">
        <div class="line"></div>
        <div class="title-text">Nos partenaires</div>
        <div class="line"></div>
    </div>
    <marquee style=" margin-bottom: 20px;" direction="left" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="20">
        <div class="marqu">
            <img src="images/partener/200-2001206_cisco-cisco-high-res-logo.png" alt="">
            <img src="images/partener/microsoft-80659_1280.png" alt="">
            <img src="images/partener/Oracle-Logo.png" alt="">
            <img src="images/partener/png-clipart-vmware-logo-icons-logos-emojis-tech-companies.png" alt="">
        </div>
    </marquee>


    <?php include("repite/footer.php"); ?>


</body>

</html>