<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?></title>
    
    <?php
        if ($nivel == "raiz") {
            //<!-- BOOTSTRAP CSS -->
            echo '<link rel="stylesheet" href="assets/bookstores/bootstrap/css/bootstrap.css">';
            //<!-- FONTAWESOME CSS -->
            echo '<link rel="stylesheet" href="assets/bookstores/fontawesome/css/all.css">';
            //<!-- DATATABLE CSS -->
            echo '<link rel="stylesheet" href="assets/bookstores/datatable/datatables.css">';
            //<!-- SELECT2 CSS -->
            echo '<link rel="stylesheet" href="assets/bookstores/select2/css/select2.css">';
            //<!-- HOME CSS -->
            //echo '<link rel="stylesheet" href="assets/css/homeStyles.css">';
            echo '<link rel="stylesheet" href="assets/css/cristianStyles.css">';
            //<!-- SOLUTIONS CSS -->
            echo '<link rel="stylesheet" href="assets/css/solutionsStyles.css">';
            //<!-- CARTI CSS -->
            echo '<link rel="stylesheet" href="assets/css/cartiStyles.css">';
            //<!-- SmartMenus jQuery Bootstrap Addon CSS -->
            echo '<link href="assets/bookstores/smartmenus/addons/bootstrap-4/jquery.smartmenus.bootstrap-4.css" rel="stylesheet">';

            //<!-- Jquery JS  -->
            echo '<script src="assets/bookstores/jquery-3.7.1.min.js"></script>';
            //<!-- HomeJs  -->
            echo '<script src="assets/js/homeJs.js"></script>';
        }
        else if ($nivel == "uno") {
            //<!-- BOOTSTRAP CSS -->
            echo '<link rel="stylesheet" href="../assets/bookstores/bootstrap/css/bootstrap.css">';
            //<!-- FONTAWESOME CSS -->
            echo '<link rel="stylesheet" href="../assets/bookstores/fontawesome/css/all.css">';
            //<!-- DATATABLE CSS -->
            echo '<link rel="stylesheet" href="../assets/bookstores/datatable/datatables.css">';
            //<!-- SELECT2 CSS -->
            echo '<link rel="stylesheet" href="../assets/bookstores/select2/css/select2.css">';
            //<!-- HOME CSS -->
            //echo '<link rel="stylesheet" href="../assets/css/homeStyles.css">';
            echo '<link rel="stylesheet" href="../assets/css/cristianStyles.css">';
            //<!-- SOLUTIONS CSS -->
            echo '<link rel="stylesheet" href="../assets/css/solutionsStyles.css">';
            //<!-- CARTI CSS -->
            echo '<link rel="stylesheet" href="../assets/css/cartiStyles.css">';
            //<!-- SmartMenus jQuery Bootstrap Addon CSS -->
            echo '<link href="../assets/bookstores/smartmenus/addons/bootstrap-4/jquery.smartmenus.bootstrap-4.css" rel="stylesheet">';

            //<!-- Jquery JS  -->
            echo '<script src="../assets/bookstores/jquery-3.7.1.min.js"></script>';
            //<!-- HomeJs  -->
            echo '<script src="../assets/js/homeJs.js"></script>';
        }        
        else if ($nivel == "dos") {
            //<!-- BOOTSTRAP CSS -->
            echo '<link rel="stylesheet" href="../../assets/bookstores/bootstrap/css/bootstrap.css">';
            //<!-- FONTAWESOME CSS -->
            echo '<link rel="stylesheet" href="../../assets/bookstores/fontawesome/css/all.css">';
            //<!-- DATATABLE CSS -->
            echo '<link rel="stylesheet" href="../../assets/bookstores/datatable/datatables.css">';
            //<!-- SELECT2 CSS -->
            echo '<link rel="stylesheet" href="../../assets/bookstores/select2/css/select2.css">';
            //<!-- HOME CSS -->
            //echo '<link rel="stylesheet" href="../../assets/css/homeStyles.css">';
            echo '<link rel="stylesheet" href="../../assets/css/cristianStyles.css">';
            //<!-- SOLUTIONS CSS -->
            echo '<link rel="stylesheet" href="../../assets/css/solutionsStyles.css">';
            //<!-- CARTI CSS -->
            echo '<link rel="stylesheet" href="../../assets/css/cartiStyles.css">';
            //<!-- SmartMenus jQuery Bootstrap Addon CSS -->
            echo '<link href="../../assets/bookstores/smartmenus/addons/bootstrap-4/jquery.smartmenus.bootstrap-4.css" rel="stylesheet">';

            //<!-- Jquery JS  -->
            echo '<script src="../../assets/bookstores/jquery-3.7.1.min.js"></script>';
            //<!-- HomeJs  -->
            echo '<script src="../../assets/js/homeJs.js"></script>';
        }        
        else if ($nivel == "tres") {
            //<!-- BOOTSTRAP CSS -->
            echo '<link rel="stylesheet" href="../../../assets/bookstores/bootstrap/css/bootstrap.css">';
            //<!-- FONTAWESOME CSS -->
            echo '<link rel="stylesheet" href="../../../assets/bookstores/fontawesome/css/all.css">';
            //<!-- DATATABLE CSS -->
            echo '<link rel="stylesheet" href="../../../assets/bookstores/datatable/datatables.css">';
            //<!-- SELECT2 CSS -->
            echo '<link rel="stylesheet" href="../../../assets/bookstores/select2/css/select2.css">';
            //<!-- HOME CSS -->
            //echo '<link rel="stylesheet" href="../../../assets/css/homeStyles.css">';
            echo '<link rel="stylesheet" href="../../../assets/css/cristianStyles.css">';
            //<!-- SOLUTIONS CSS -->
            echo '<link rel="stylesheet" href="../../../assets/css/solutionsStyles.css">';
            //<!-- CARTI CSS -->
            echo '<link rel="stylesheet" href="../../../assets/css/cartiStyles.css">';
            //<!-- SmartMenus jQuery Bootstrap Addon CSS -->
            echo '<link href="../../../assets/bookstores/smartmenus/addons/bootstrap-4/jquery.smartmenus.bootstrap-4.css" rel="stylesheet">';

            //<!-- Jquery JS  -->
            echo '<script src="../../../assets/bookstores/jquery-3.7.1.min.js"></script>';
            //<!-- HomeJs  -->
            echo '<script src="../../../assets/js/homeJs.js"></script>';
        }        
    ?>
</head>