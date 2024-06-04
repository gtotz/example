<?php if(TEMPLATE_PARSIAL != 1){ header("HTTP/1.1 404 Not FOUND" ); exit(); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title;?>  - CakeZones</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="<?php echo SERVER_NAME;?>assets/img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo SERVER_NAME;?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo SERVER_NAME;?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SERVER_NAME;?>assets/css/style.css" rel="stylesheet">
</head>

<body>
<?php
    include_once "#include/component/topbar.php";
    include_once "#include/component/menu.php";
?>