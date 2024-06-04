<?php
    include_once "#include/cnf.php";
    include_once "#include/#class/load.php";

    use App\frontPage;
    use App\liblary;
    $fg = new frontPage();
    $lib = new liblary();

    $chef = $fg->select_chef("*","WHERE `status` = 1", "ORDER BY full_name ASC", NULL);
    $cake = $fg->select_cake("*","WHERE `status` = 1", "ORDER BY name_cake ASC", NULL);

    $arr_group_cake = array_reduce($cake, function ($result, $item) {
        $result[$item['type']][] = $item;
        return $result;
    }, array());
    
    $current_menu = "home";
    $current_sub_menu = NULL;
    $title = "Home";

    include_once "#include/component/header.php";
    include_once "#include/component/slide.php";
    include_once "#include/component/about.php";
    include_once "#include/component/facts_start.php";
    include_once "#include/component/products.php";
    include_once "#include/component/service.php";
    include_once "#include/component/team.php";
    include_once "#include/component/offer.php";
    include_once "#include/component/testimonial.php";
    include_once "#include/component/footer.php";
?>