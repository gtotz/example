<?php if(TEMPLATE_PARSIAL != 1){ header("HTTP/1.1 404 Not FOUND" ); exit(); } ?>
<div class="container-fluid about py-5">
    <div class="container">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
            <h2 class="text-primary font-secondary">Menu & Pricing</h2>
            <h1 class="display-4 text-uppercase">Explore Our Cakes</h1>
        </div>
        <div class="tab-class text-center">
            <ul class="nav nav-pills d-inline-flex justify-content-center bg-dark text-uppercase border-inner p-4 mb-5">
                <?php
                    $no_cake = 1;
                    foreach ($arr_group_cake as $key => $value) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link text-white <?php if($no_cake == 1) echo "active";?>" data-bs-toggle="pill" href="#tab-<?php echo $no_cake;?>"><?php echo $key;?></a>
                    </li>
                <?php
                        $no_cake++;
                    }
                ?>
            </ul>
            <div class="tab-content">
                <?php
                    $no_cake = 1;
                    foreach ($arr_group_cake as $key => $value) {
                        $ck_active = NULL;
                        if($no_cake == 1){
                            $ck_active = "active";
                        }

                        $data_cake = $value;
                        echo '<div id="tab-'.$no_cake.'" class="tab-pane fade show p-0 '.$ck_active.'">';
                        echo '  <div class="row g-3">';
                        foreach($data_cake AS $dc){
                            echo '      <div class="col-lg-6">';
                            echo '          <div class="d-flex h-100">';
                            echo '              <div class="flex-shrink-0">';
                            echo '                  <img class="img-fluid" src="'.SERVER_NAME.$dc['url_image'].'" alt="" style="width: 150px; height: 85px;">';
                            echo '                  <h4 class="bg-dark text-primary p-2 m-0">$'.number_format($dc['price'],2,'.').'</h4>';
                            echo '              </div>';
                            echo '              <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4">';
                            echo '                  <h5 class="text-uppercase"><a href="'.SERVER_NAME.'menu-pricing/'.$dc['id'].'-'.$lib->seo_title($dc['name_cake']).'" alt="'.$dc['name_cake'].'" title="'.$dc['name_cake'].'">'.$dc['name_cake'].'</a></h5>';
                            echo '                  <span>'.$lib->potong_text($dc['description'],100,true).'</span>';
                            echo '              </div>';
                            echo '          </div>';
                            echo '      </div>';
                        }
                        echo '  </div>';
                        echo '</div>';
                        $no_cake++;
                    }
                ?>
            </div>
        </div>
    </div>
</div>