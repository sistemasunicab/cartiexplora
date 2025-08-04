<!DOCTYPE html>
<html lang="en">
<?php
    $nivel = "tres";
    $page_title = "Directorio institucional";
    require('../../repositories/1cc2s4Org.php');
    include('../../../components/headMain.php');
    include('../../../clases/GenerateQuery.php');
    include('../../../clases/ImageAttributeBuilder.php');
    include('../../../clases/ButtonStylesBannerBuilder.php');
    require_once __DIR__ . '/../../../components/auxiliares.php'; 
?>
<body>
    
    <?php 
        $nivel = "tres";
        include('../../../components/navBar.php');
        include('../../../components/botonFlotante.php');

        include('../components/institutionalDirectory/directory.php'); 
        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>
</body>
</html>