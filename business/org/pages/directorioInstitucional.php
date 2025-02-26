<?php 
 include('../../../clases/ImageAttributeBuilder.php');
 include('../../../clases/ButtonStylesBannerBuilder.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $nivel = "tres";
    $page_title = "Directorio institucional";
    include('../../../components/headMain.php');
?>
<body>
    
    <?php 
        $nivel = "tres";
        include('../../../components/navBar.php');
    ?>

    <?php 
        $nivel = 'tres';
        include('../components/institutionalDirectory/directory.php'); 
    ?>

    <?php 
        $nivel = "tres";
        include('../../../components/bookstoresMain.php');
    ?>
</body>
</html>