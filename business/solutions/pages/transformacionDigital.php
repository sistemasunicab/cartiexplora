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
    <img src="../../../assets/img/solutions-imagen-transformacion2x.png" alt="" class="img-fluid w-100">
    <main class="container">
        <div class="row">
            <div class="col-2 d-flex justify-content-center align-items-center"><img class="solutions-icon" src="../../../assets/img/solutions-icon-transformacion.png" alt=""></div>
            <div class="col-10">
                <h1 class="titulo-md text-blue titulo-servicio">Capacitación en <span>Transformación Digital</span></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <ul class="ul-solutions">
                    <li>
                        <p class="texto-base descripcion-servicio">
                            Formación en el uso e implementación de <span>herramientas digitales avanzadas para potenciar procesos
                            de enseñanza-aprendizaje</span> en instituciones educativas y empresas productivas.
                        </p>

                    </li>
                    <li>
                        <p class="texto-base descripcion-servicio">
                            <span>Talleres prácticos y personalizados para la adopción efectiva de 
                            tecnologías emergentes,</span>
                            diseñados según las necesidades específicas de cada organización.
                        </p>

                    </li>
                    <li>
                        <p class="texto-base descripcion-servicio">
                            Programas de <span>capacitación en competencias digitales,</span> enfocados en empoderar a docentes,
                            estudiantes y empleados para enfrentar los retos del entorno digital actual.
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