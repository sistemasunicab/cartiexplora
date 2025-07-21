<?php
    include('../../../clases/ImageAttributeBuilder.php');
    include('../../../clases/GenerateQuery.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    $nivel = "tres";
    $page_title = "Entrevistas";
    include('../../../components/headMain.php');
?>
<body>
    <?php 
        $nivel = "tres";
        include('../../../components/navBar.php');
        include('../../../components/botonFlotante.php');

        include('../components/entrevista/formularioEntrevista.php');
        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>  
<body>
    
</html>