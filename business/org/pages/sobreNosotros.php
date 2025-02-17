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
?>
<body>
    
    <?php 
        $nivel = "tres";
        include('../../../components/navBar.php');
    ?>

    <?php 
        $nivel = 'tres';
        include('../components/aboutUs/aboutUsUnicab.php'); 
    ?>

    <?php 
        $nivel = 'tres';
        include('../components/aboutUs/aboutUsImageOne.php'); 
    ?>
    
    <?php 
        $nivel = 'tres';
        include('../components/aboutUs/aboutUsEducation.php'); 
    ?>
    
    <?php 
        $nivel = 'tres';
        include('../components/aboutUs/aboutUsImageTwo.php'); 
    ?>
      
    <?php 
        $nivel = 'tres';
        include('../components/aboutUs/aboutUsInfo.php'); 
    ?>
    
    <?php 
        $nivel = "tres";
        include('../../../components/bookstoresMain.php');
    ?>
</body>
</html>