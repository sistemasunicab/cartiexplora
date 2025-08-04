<?php 
 include('../../../clases/ImageAttributeBuilder.php');
 include('../../../clases/ButtonStylesBannerBuilder.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $nivel = "tres";
    $page_title = "Sobre Nosotros";
    include('../../../components/headMain.php');
    require_once __DIR__ . '/../../../components/auxiliares.php'; 
?>
<body>
    
    <?php 
        $nivel = "tres";
        include('../../../components/navBar.php');
        include('../../../components/botonFlotante.php');

        include('../components/aboutUs/aboutUsUnicab.php'); 
        include('../components/aboutUs/aboutUsImageOne.php');
        include('../components/aboutUs/aboutUsEducation.php'); 
        include('../components/aboutUs/aboutUsImageTwo.php'); 
        include('../components/aboutUs/aboutUsInfo.php');
        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>
</body>
</html>