<?php
    include('../../../clases/ImageAttributeBuilder.php');
    include('../../../clases/ButtonStylesBannerBuilder.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $nivel = "tres";
    $page_title = "Pago Online";
    include('../../../components/headMainSolutions.php');
?>

<body>
    <?php
        $nivel = "tres";
        include('../../../components/navBarSolutions.php');
        //include('../components/transformacionDigital.php');
        
        $fecha = $_REQUEST['fecha'];
        $valor = $_REQUEST['valorCurso'];
        $referencia = $_REQUEST['referencia'];
        $idEvento = $_REQUEST['idEvento'];
    ?>

    <!-- CONTENIDO PRINCIPAL -->
    <main>
        <section class="contentzz">
            <div class="section-title-pagos">
                <div class="container">
                    <div class="row align-items-center justify-content-center my-2">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-1"></div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                            <span class="h2-pagos">Pago a través de ePayco</span>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                            <img class="img-fluid h2-icon-pagos" src="https://unicab.org/homeunicabpro/assets/img/pagos/statement.png" alt="statement-icon">
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-1"></div>
                    </div>
                </div>
            </div>

            <div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <label for="selmediopago">MEDIO DE PAGO  (Efectivo --> Baloto, Efecty, Punto Red, Red Servi, Gana, etc...)</label>
                            <select id="selmediopago" class="validar form-control select">
                                <option value="NA" selected>Seleccione medio de pago</option>
                                <option value="E">Efectivo</option>
                                <option value="P">PSE</option>
                                <option value="P6">PSE menor 60000</option>
                                <option value="TC">Tarjeta de crédito</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="txtano">* Fecha</label>
                            <input type="text" id="txtano" class="form-control validar" value="<?php echo $fecha; ?>" readonly required/>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="txtvalor">* Valor a pagar</label><br/>
                            <input type="text" id="txtvalor" class="form-control validar" value="<?php echo $valor; ?>" readonly required/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="txtref">* Referencia de pago</label>
                            <input type="text" id="txtref" class="form-control validar" value="<?php echo $referencia; ?>" readonly required/>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-12">
                            <label><strong>DATOS DE QUIEN PAGA</strong></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="txtnom">* Nombre de quien paga</label><br/>
                            <input type="text" id="txtnom" class="form-control validar campoFormulario" onkeyup="validarCampo(this, 'Nombre de quien paga', 'texto', 1, 'btnPagarCurso');" required/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="txtidentif">* Número de identificación</label><br/>
                            <input type="text" id="txtidentif" class="form-control validar campoFormulario" onkeyup="validarCampo(this, 'Número de identificación', 'numero', 1, 'btnPagarCurso');" required/>
                        </div>
                    </div><br>

                    <input type="hidden" id="idEvento" name="idEvento" value="<?php echo $idEvento; ?>">

                    <div class="row">
                        <div class="col-12">
                            <button id="btnPagarCurso" class="btn btn-success" onclick="callEpayco()">Hacer pago por Epayco</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-danger" role="alert" id="alert">
                <p>⚠️<span>: </span><label id="pdesc"></label>
                <input type="hidden" class="alert alert-danger" style="width: 20px" id="txtvacio" value="0"></p>
            </div>
        </section>
    </main><br>

    <?php
        //include('../../../components/footer.php');
        include('../../../components/footerSolutions.php');
        include('../../../components/bookstoresMain.php');
    ?>

    <body>
</html>