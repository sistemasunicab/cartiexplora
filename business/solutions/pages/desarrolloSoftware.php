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
    <img src="../../../assets/img/solutions-imagen-desarrollo2x.png" alt="" class="img-fluid w-100">
    <main class="container">

        <div class="row">
            <div class="col-1"></div>
            <div class="col-2 d-flex justify-content-center align-items-center"><img class="solutions-icon" src="../../../assets/img/solutions-icon-desarrollo.png" alt=""></div>
            <div class="col-8">
                <h1 class="titulo-md text-blue titulo-servicio">Diseño y Desarrollo de <span>Software</span></h1>
            </div>
            <div class="col-1"></div>
        </div>
        <div class="row">
        <div class="col-1"></div>
            <div class="col-2"></div>
            <div class="col-8">
              
            <ul class="ul-solutions">
                    <li>
                        <p class="texto-base descripcion-servicio">
                            <span>Programas para empresas:</span> Diseñamos herramientas que ayudan a organizar mejor las actividades de un negocio,
                            como llevar inventarios, gestionar ventas o coordinar proyectos.
                        </p>

                    </li>
                    <li>
                        <p class="texto-base descripcion-servicio">
                            <span>Soluciones a la medida:</span> Si tienes una idea o necesidad específica, creamos un software
                            personalizado para resolverla, ya sea en educación, producción, comercialización,
                            logística, gerencia o cualquier área.
                        </p>

                    </li>
                    <li>
                        <p class="texto-base descripcion-servicio">
                            <span>Tecnología moderna:</span> Usamos lo mejor en tecnología
                            para que el software sea rápido, eficiente y fácil de usar.
                        </p>

                    </li>
                    <li>
                        <p class="texto-base descripcion-servicio">
                            <span>Desarrollo desde cero:</span> Hacemos programas únicos,
                            diseñados exclusivamente para ti, asegurando que cumplan exactamente con lo que buscas y
                            en código puro.
                        </p>

                    </li>
                </ul>
             
            </div>
            <div class="col-1"></div>
        </div>

    </main>
    <?php
        //include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>

    <body>
</html>