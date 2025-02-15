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
    <img src="../../../assets/img/solutions-imagen-sistemas2x.png" alt="" class="img-fluid w-100">
    <main class="container">


        <div class="row">
            <div class="col-2 d-flex justify-content-center align-items-center"><img class="solutions-icon" src="../../../assets/img/solutions-icon-sistemas.png" alt=""></div>
            <div class="col-10">
                <h1 class="titulo-md text-blue titulo-servicio">Diseño de Sistemas y <span>Material Educativo Innovador</span></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <p class="texto-base descripcion-servicio">
                    <span>Desarrollo de plataformas educativas LMS </span>personalizadas, desarrollo de plataformas de 
                    contenidos académicos interactivos y gamificados según necesidades y modelo pedagógico, 
                    aplicaciones móviles para la educación formal e informal.
                    <br>
                    <br>
                    • <span>Diseño de plataformas educativas virtuales personalizadas (LMS):</span> 
                    Sistemas intuitivos y escalables que facilitan la enseñanza y el aprendizaje online. 
                    <br>
                    <br>
                    • <span>Elaboración de materiales educativos digitales:</span> Contenidos interactivos y multimedia 
                    diseñados con metodologías pedagógicas modernas y personalizados. 
                    <br>
                    <br>
                    • <span>Capacitación para docentes y estudiantes:</span> Formación en el uso de herramientas 
                    tecnológicas aplicadas a educación.
                </p>
            </div>
        </div>

    </main>
    <?php
        //include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>

    <body>
</html>