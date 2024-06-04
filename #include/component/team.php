<?php if(TEMPLATE_PARSIAL != 1){ header("HTTP/1.1 404 Not FOUND" ); exit(); } ?>
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
            <h2 class="text-primary font-secondary">Team Members</h2>
            <h1 class="display-4 text-uppercase">Our Master Chefs</h1>
        </div>
        <div class="row g-5">
            <?php
                foreach($chef AS $cf){
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?php echo SERVER_NAME.$cf['url_image'];?>" alt="">
                            <div class="team-overlay w-100 h-100 position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center">
                                <div class="d-flex align-items-center justify-content-start">
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="bg-dark border-inner text-center p-4">
                            <h4 class="text-uppercase text-primary"><?php echo $cf['full_name']?></h4>
                            <p class="text-white m-0"><?php echo $cf['jobs']?></p>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>