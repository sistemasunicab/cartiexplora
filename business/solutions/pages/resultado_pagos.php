<?php
    include('../../../clases/ImageAttributeBuilder.php');
    include('../../../clases/ButtonStylesBannerBuilder.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $nivel = "tres";
    $page_title = "Resultado Pagos";
    include('../../../components/headMainSolutions.php');
?>

<body>
    <?php
        $nivel = "tres";
        include('../../../components/navBarSolutions.php');
        //include('../components/transformacionDigital.php');
        // https://unicab.solutions/nus/business/solutions/ajax/registrar_pago_putdat.php?idevento=1&documento=123456&nombre=Gregory_Figueredo&valor=280000&estado=Pendiente&ref_epayco=320878260
    ?>

    <!--== Resultado Pagos Start ==-->
    <section id="page-title-areaxx">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
                    <div class="page-title-content">
                        <?php
							//https://secure.payco.co/restpagos/transaction/response.json?ref_payco=23611413&public_key=870fd53ee9274a76a62c34f434b09569
						?>
						<br/><h4 style="color: blue;">¡RESULTADO DE SU PAGO!</h4><hr>
						<h5>Estado de la transacción: <span id="respuesta"></span></h5><hr>
						<h4 style='color: blue;'>DETALLE DEL PAGO</h4><hr>
						<h5>Fecha: <span id="fecha"></span></h5>
						<h5>Referencia de pago: <span id="referencia"></span></h5>
						<h5>Valor: <span id="valor"></span></h5>
						<h5>Concepto: <span id="concepto"></span></h5>
						<h5>Factura: <span id="factura"></span></h5>
						<h5>Nombre pagador: <span id="nombrepagador"></span></h5>
						<h5>Autorización: <span id="autorizacion"></span></h5>
						<h5>Recibo: <span id="recibo"></span></h5>
						<h5>Banco: <span id="banco"></span></h5><hr>
						<h5>PIN: <span id="ref_epayco"></span></h5>
						<h5>Código proyecto: <span id="cod_proyecto"></span></h5>
						<h5>Descripción respuesta: <span id="desc_res"></span></h5><hr>
						<h6 style="color: red;">NOTA: Si la transacción fue por Baloto, Efecty, Punto Red, Red Servi o Gana; 
						tiene 5 días a partir de la fecha actual para utilizar el PIN y Código proyecto.</h6><hr><br>
						<!--<a href='pagos_payservices.php' class='btn btn-success smooth-scroll'>Realizar otro pago</a>-->
						<div id="btnvolver" class="col text-center" style="display: none;">
							<button id="btn-epayco" style="background-color: #42C3AE;" class="btn btn-info form-control" onclick="volver()">
								<h6 style="display: inline-block;" class="pr-3" >Volver</h6>
							</button>
						</div>
						<input type="hidden" id="rutacontinuar" />
						<input type="hidden" id="documentopago" />
						<input type="hidden" id="ref_epayco1" />
						<input type="hidden" id="estado" />
						<input type="hidden" id="valor1" />
						<input type="hidden" id="idevento" />
						<input type="hidden" id="nombrepagador1" />
						<br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Resultado Pagos Area End ==-->

    <?php
        //include('../../../components/footer.php');
        include('../../../components/footerSolutions.php');
        include('../../../components/bookstoresMain.php');
    ?>

    <body>
</html>