<?php 
 include('../../../clases/ImageAttributeBuilder.php');
 include('../../../clases/ButtonStylesBannerBuilder.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $nivel = "tres";
    $page_title = "Estados financieros";
    include('../../../components/headMain.php');
?>
<body>
    
    <?php 
        $nivel = "tres";
        include('../../../components/navBar.php');
        include('../components/estadosFinancieros/estadosFinancieros_1.php');
        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>
</body>
</html>