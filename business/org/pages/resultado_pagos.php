<?php
    include('../../../clases/ImageAttributeBuilder.php');
    //include('../../../clases/ButtonStylesBannerBuilder.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $nivel = "tres";
    $page_title = "Resultado Pagos";
    include('../../../components/headMain.php');
?>

<body>
    <?php
        $nivel = "tres";
        include('../../../components/navBar.php');
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
						<h5>Documento pagador: <span id="documentopagador"></span></h5>
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
        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>

		<script>
			function getQueryParam(param) {
			location.search.substr(1)
				.split("&")
				.some(function(item) { // returns first occurence and stops
				return item.split("=")[0] == param && (param = item.split("=")[1])
				})
			return param
			}
			$(document).ready(function() {
			//llave publica del comercio

			//Referencia de payco que viene por url
			var ref_payco = getQueryParam('ref_payco');
			//Url Rest Metodo get, se pasa la llave y la ref_payco como paremetro
			var urlapp = "https://secure.epayco.co/validation/v1/reference/" + ref_payco;

			$.get(urlapp, function(response) {
				
				if (response.success) {
					//console.log(response);
					if (response.data.x_cod_response == 1) {
						//Codigo personalizado
						$("#respuesta").addClass("aceptada");
					}
					//Transaccion Rechazada
					if (response.data.x_cod_response == 2) {
						$("#respuesta").addClass("rechazada");
					}
					//Transaccion Pendiente
					if (response.data.x_cod_response == 3) {
						$("#respuesta").addClass("pendiente");
					}
					//Transaccion Fallida
					if (response.data.x_cod_response == 4) {
						
					}

					$('#fecha').html(response.data.x_transaction_date);
					$('#respuesta').html(response.data.x_response);
					$('#referencia').text(response.data.x_extra1_epayco);
					$('#motivo').text(response.data.x_response_reason_text);
					$('#recibo').text(response.data.x_transaction_id);
					$('#banco').text(response.data.x_bank_name);
					$('#autorizacion').text(response.data.x_approval_code);
					$('#factura').text(response.data.x_id_invoice);
					$('#concepto').text(response.data.x_description);
					$('#ref_epayco').text(response.data.x_ref_payco);
					$('#nombrepagador').text(response.data.x_customer_name + ' ' + response.data.x_customer_lastname);
					$('#documentopagador').text(response.data.x_customer_document);
					if(response.data.x_bank_name == "GANA") {
						var cod_proyecto = 242;
					}
					else if(response.data.x_bank_name == "EFECTY") {
						var cod_proyecto = 111992;
					}
					else if(response.data.x_bank_name == "BALOTO") {
						var cod_proyecto = 950715;
					}
					else if(response.data.x_bank_name == "PUNTO RED") {
						var cod_proyecto = 110342;
					}
					else if(response.data.x_bank_name == "RED SERVI") {
						var cod_proyecto = 761;
					}
					else if(response.data.x_bank_name == "SURED") {
							var cod_proyecto = 'MR0382';
						}
					else {
						var cod_proyecto = "";
					}
					$('#cod_proyecto').text(cod_proyecto);
					$('#desc_res').text(response.data.x_response_reason_text);
					$('#valor').text(response.data.x_amount + ' ' + response.data.x_currency_code);

				} else {
					alert("Error consultando la información");
				}
			});

			});
		</script>
    <body>
</html>