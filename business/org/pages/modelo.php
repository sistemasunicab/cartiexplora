<?php
    include('../../../clases/ImageAttributeBuilder.php');
    include('../../../clases/ButtonStylesBannerBuilder.php');
    include('../../../clases/FlexTitleLoader.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    $nivel = "tres";

    $page_title = "Nuestro Modelo UNICAB";
    include('../../../components/headMain.php');
?>
<body>
    <?php 
        $nivel = "tres";
        include('../../../components/navBar.php');
        include('../../../components/botonFlotante.php');

        
        include('../components/nuestroModelo.php');

        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>  
<body>
    
</html>