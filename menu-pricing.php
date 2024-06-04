<?php
    include_once "#include/cnf.php";
    include_once "#include/#class/load.php";

    use App\frontPage;
    use App\liblary;
    $fg = new frontPage();
    $lib = new liblary();

    $id = isset($_GET['id-detail']) ? $_GET['id-detail'] : NULL;

    if(empty($id)){
        $cake = $fg->select_cake("*","WHERE `status` = 1", "ORDER BY name_cake ASC", NULL);

        $arr_group_cake = array_reduce($cake, function ($result, $item) {
            $result[$item['type']][] = $item;
            return $result;
        }, array());

        $current_menu = "menu-pricing";
        $current_sub_menu = NULL;
        $title = "Menu & Pricing";

        include_once "#include/component/header.php";
        include_once "#include/component/products.php";
        include_once "#include/component/offer.php";
        include_once "#include/component/footer.php";
    }else{
        $id = $lib->filterA($id);
        $exp_id = explode("-", $id);
        $id = $exp_id[0];
        if(!is_numeric($id)){
            header('Location: '.SERVER_NAME);
		    exit(0);
        }

        $data_cake = $fg->cake_byid($id);
        if(empty($data_cake)){
            header('Location: '.SERVER_NAME);
		    exit(0);
        }
       
        $current_menu = "menu-pricing";
        $current_sub_menu = NULL;
        $title = $data_cake['name_cake'];

        include_once "#include/component/header.php";
        include_once "#include/component/detail_products.php";
        include_once "#include/component/offer.php";
        include_once "#include/component/footer.php";
    }
?>