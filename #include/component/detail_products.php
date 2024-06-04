<?php if(TEMPLATE_PARSIAL != 1){ header("HTTP/1.1 404 Not FOUND" ); exit(); } ?>
<div class="container-fluid about py-5">
    <div class="container">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
            <h2 class="text-primary font-secondary">Menu & Pricing</h2>
            <h1 class="display-4 text-uppercase"><?php echo $data_cake['name_cake'];?></h1>
        </div>
        <div class="row gx-5">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="<?php echo SERVER_NAME.$data_cake['url_image'];?>" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6 pb-5">
                <?php echo $data_cake['description'];?>
            </div>
        </div>
    </div>
</div>