<?php
    include('../../../clases/ImageAttributeBuilder.php');
    include('../../../clases/GenerateQuery.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    $nivel = "tres";
    $page_title = "Encuesta Sede EEUU";
    include('../../../components/headMain.php');
?>
<body>
    <?php 
        $nivel = "tres";
        include('../../../components/navBar.php');
        //include('../../../components/botonFlotante.php');

        include('../components/encuestas/encuesta_eeuu.php');
        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>
<body>
    
</html>