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
        include('../../../components/botonFlotante.php');

        include('../components/calendary/calendarioAcademico.php'); 
        include('../components/calendary/calendarioProximoEvento.php'); 
        include('../components/calendary/comunicados.php'); 
        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>
</body>
</html>