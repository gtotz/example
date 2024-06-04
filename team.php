<?php
    include_once "#include/cnf.php";
    include_once "#include/#class/load.php";

    use App\frontPage;
    use App\liblary;
    $fg = new frontPage();
    $lib = new liblary();

    $chef = $fg->select_chef("*","WHERE `status` = 1", "ORDER BY full_name ASC", NULL);

    $current_menu = "team";
    $current_sub_menu = NULL;
    $title = "Team";

    include_once "#include/component/header.php";
    include_once "#include/component/team.php";
    include_once "#include/component/footer.php";
?>