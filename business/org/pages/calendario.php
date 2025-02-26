<?php 
 include('../../../clases/ImageAttributeBuilder.php');
 include('../../../clases/ButtonStylesBannerBuilder.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $nivel = "tres";
    $page_title = "Calendario";
    include('../../../components/headMain.php');
?>
<body>
    
    <?php 
        $nivel = "tres";
        include('../../../components/navBar.php');
    ?>

    <?php 
        $nivel = 'tres';
        include('../components/calendary/calendarioAcademico.php'); 
    ?>
    <?php 
        $nivel = 'tres';
        include('../components/calendary/calendarioProximoEvento.php'); 
    ?>
    <?php 
        $nivel = 'tres';
        include('../components/calendary/comunicados.php'); 
    ?>

    <?php 
        $nivel = "tres";
        include('../../../components/bookstoresMain.php');
    ?>
</body>
</html>