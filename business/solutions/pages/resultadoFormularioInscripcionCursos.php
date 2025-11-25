<?php
    include('../../../clases/ImageAttributeBuilder.php');
    include('../../../clases/ButtonStylesBannerBuilder.php');

    $data_recibida = json_decode($_POST['respuesta_json'], true);
    $a = 5;
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $nivel = "tres";
    $page_title = "Capacitación en Transformación Digital";
    include('../../../components/headMainSolutions.php');
?>

<body>
    <?php
        $nivel = "tres";
        include('../../../components/navBarSolutions.php');
        //include('../components/transformacionDigital.php');
    ?>

    <!--== Resultado Inscripción Curso Start ==-->
    <section id="page-title-areaxx">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
                    <div class="page-title-content">
                        <?php
							//https://secure.payco.co/restpagos/transaction/response.json?ref_payco=23611413&public_key=870fd53ee9274a76a62c34f434b09569
						?>
						<br/><h4 style="color: blue;">¡RESULTADO DE SU INSCRIPCIÓN AL CURSO!</h4>
						<hr>
						<h5>Proceso: <span id="proceso"><?php echo $data_recibida['insert']; ?></span></h5>
						<h5>Resultado correo: <span id="correo"><?php echo $data_recibida['respuesta_correo']; ?></span></h5>
						<h5>Correo enviado a: <span id="correo"><?php echo $data_recibida['email']; ?></span></h5><br>
						<!--<a href='pagos_payservices.php' class='btn btn-success smooth-scroll'>Realizar otro pago</a>-->
						<div id="btnvolver" class="col text-center" >
							<a href="transformacionDigital.php" class="btn-circulares-costos form-control"><h6 style="display: inline-block;" class="pr-3" >Volver</h6></a>
						</div>
						<br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Resultado Inscripción Curso End ==-->

    <?php
        //include('../../../components/footer.php');
        include('../../../components/footerSolutions.php');
        include('../../../components/bookstoresMain.php');
    ?>

    <body>
</html>