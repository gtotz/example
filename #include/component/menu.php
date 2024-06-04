<?php if(TEMPLATE_PARSIAL != 1){ header("HTTP/1.1 404 Not FOUND" ); exit(); } ?>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
    <a href="<?php echo SERVER_NAME;?>" class="navbar-brand d-block d-lg-none">
        <h1 class="m-0 text-uppercase text-white"><i class="fa fa-birthday-cake fs-1 text-primary me-3"></i>CakeZone</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto mx-lg-auto py-0">
            <a href="<?php echo SERVER_NAME;?>" class="nav-item nav-link <?php if($current_menu == 'home') echo 'active';?>">Home</a>
            <a href="<?php echo SERVER_NAME;?>about" class="nav-item nav-link <?php if($current_menu == 'about') echo 'active';?>">About Us</a>
            <a href="<?php echo SERVER_NAME;?>menu-pricing" class="nav-item nav-link <?php if($current_menu == 'menu-pricing') echo 'active';?>">Menu & Pricing</a>
            <a href="<?php echo SERVER_NAME;?>team" class="nav-item nav-link <?php if($current_menu == 'team') echo 'active';?>">Master Chefs</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?php if($current_menu == 'pages') echo 'active';?>" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu m-0">
                    <a href="<?php echo SERVER_NAME;?>service" class="dropdown-item <?php if($current_sub_menu == 'service') echo 'active';?>">Our Service</a>
                    <a href="<?php echo SERVER_NAME;?>testimonial" class="dropdown-item <?php if($current_sub_menu == 'testimonial') echo 'active';?>">Testimonial</a>
                </div>
            </div>
            <a href="<?php echo SERVER_NAME;?>contact" class="nav-item nav-link <?php if($current_menu == 'contact') echo 'active';?>">Contact Us</a>
        </div>
    </div>
</nav>