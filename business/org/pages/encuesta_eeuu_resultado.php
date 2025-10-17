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

        //include('../components/encuestas/encuesta_eeuu_resultado.php');
        include('../components/encuestas/encuesta_eeuu_resultado_f.php');
        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>
    <!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
    <script type="text/javascript" src="https://unicab.org/registro/docenteunicab/updreg/js/Chart.bundle.min.js"></script>
    <!--<script type="text/javascript" src="https://unicab.org/registro/js/jquery.dataTables.min.js"></script>-->
    <script src="https://unicab.solutions/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<body>
    
</html>