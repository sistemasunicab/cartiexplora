<?php
    include('../../../clases/ImageAttributeBuilder.php');
    include('../../../clases/ButtonStylesBannerBuilder.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $nivel = "tres";
    include('../../../components/headMain.php');
?>

<body>
    <?php
        $nivel = "tres";
        //include('../../../components/navBar.php');
    ?>
    <img src="../../../assets/img/solutions-imagen-capacitacion2x.png" alt="" class="img-fluid w-100">
    <main class="container">
        <div class="row">
            <div class="col-2 d-flex justify-content-center align-items-center"><img class="solutions-icon" src="../../../assets/img/solutions-icon-capacitacion.png" alt=""></div>
            <div class="col-10">
                <h1 class="titulo-md text-blue titulo-servicio">Servicios de <span>capacitación con metodología virtual, e híbrida</span> en diferentes modalidades</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <ul class="ul-solutions">
                    <li>
                        <p class="texto-base descripcion-servicio">
                           <span>Capacitación en manejo de herramientas digitales para enseñanza
                            aprendizaje para docentes</span> a través de cursos, diplomados y seminarios prácticos ajustados a
                            las necesidades propias del grupo.
                        </p>

                    </li>
                    <li>
                        <p class="texto-base descripcion-servicio">
                            <span>Formación y transformación de liderazgo digital para implementar procesos de cambio digital
                            en los trabajadores</span> y asumir el crecimiento de sus organizaciones.
                        </p>
                    </li>
                </ul>
            </div>
        </div>

    </main>
    <?php
        //include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>

    <body>
</html>