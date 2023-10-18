<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="NextGenerationDev">
        <title>Wedding, Wedding Planer & Event HTML Template</title>
        <!--Favicon img-->
        <link rel="shortcut icon" href="assets/img/favicon/favicon.png">
        <!--Bootstarp min css-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!--Bootstarp map css-->
        <link rel="stylesheet" href="assets/css/bootstrap.css.map">
        <!--Owl Carousel css-->
        <link rel="stylesheet" href="assets/css/owl.min.css">
        <!--Owl Carousel Theme css-->
        <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
        <!--All min css-->
        <link rel="stylesheet" href="assets/css/all.min.css">
        <!--Animate css-->
        <link rel="stylesheet" href="assets/css/animate.css">
        <!--Magnific popup css-->
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <!--Swiper min css-->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
        <!--main css-->
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
</body>

</html>

<?php
if (isset($_GET["page"])) {
    if (
        $_GET["pagina"] == "inicio" ||
        $_GET["pagina"] == "about" ||
        $_GET["pagina"] == "service" ||
        $_GET["pagina"] == "story" ||
        $_GET["pagina"] == "gallery" ||
        $_GET["pagina"] == "blog" ||
        $_GET["pagina"] == "blog-single" ||
        $_GET["pagina"] == "contact" ||
        $_GET["pagina"] == "event" ||
        $_GET["pagina"] == "service-single" ||
        $_GET["pagina"] == "login" ||
        $_GET["pagina"] == "register" ||
        $_GET["pagina"] == "data" ||
        $_GET["pagina"] == "exit"
    ) {

        include "pagina/" . $_GET["page"] . ".php";
    } else {
        include "pagina/error.php";
    }
} else {
    include "pagina/register.php";
}
