<?php
    $nivel = "dos";
	if ($nivel == "raiz") {
		require('repositories/1cc2s4Org.php');
	} else if ($nivel == "uno") {
		require('../repositories/1cc2s4Org.php');
	} else if ($nivel == "dos") {
		$nivel = "tres";
		require('../../repositories/1cc2s4Org.php');
	} else if ($nivel == "tres") {
		require('../../../repositories/1cc2s4Org.php');
	}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <style>
            .text-header {
                font-family: var(--roboto-regular); /* Usando la variable del CSS */
                color: var(--blue); /* Color representativo */
            }
            select {
                max-width: 100%;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            select option {
                white-space: normal; /* Permite que el texto del dropdown se ajuste dentro */
                word-wrap: break-word;
            }
            .containerzz {
                width: 90%;
                margin: 0 5%;
                justify-items: center;
                overflow-x: auto;
            }
            #graficaCard {
                width: 80%
            }
            .dataTables_wrapper {
                width: 100%;
                /*overflow-x: auto;*/
            }
            table.dataTable {
                width: 100% !important;
            }

            /* Sobrescribe los estilos que DataTables crea para su contenedor de scroll */
            div.dataTables_wrapper div.dataTables_scrollBody {
                width: 100% !important;
                min-width: 100% !important; /* Asegura que no se expanda más allá del 100% */
            }

            /* Fuerza el contenedor principal que DataTables crea */
            div.dataTables_wrapper {
                width: 100% !important;
                min-width: 100% !important;
            }

            /* Asegura que el contenedor de Bootstrap no interfiera */
            .table-responsive {
                overflow-x: auto !important; /* Fuerza el scroll horizontal */
                width: 100% !important;
                min-width: 100% !important;
            }

        </style>
    </head>
    <body class="bg-light">

        <header class="text-center mb-5 mt-5">
            <h1 class="text-primary">📊 Estadísticas de la Encuesta UNICAB VIRTUAL USA</h1>
        </header>

        <div class="containerzz py-4">
            <h3 class="text-center mb-4">Tabla participantes</h3>
            <!-- class="table table-bordered table-striped align-middle"  -->
            <div class="table-responsive mb-5">
                <table id="listParticipantes" class="table table-condensed table-striped display">
                    <thead class="">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Profesión</th>
                            <th>Embajador UNICAB</th>
                            <th>Infor. apertura UNICAB USA</th>
                            <th>Beneficio a familias UNICAB</th>
                            <th>Necesidad, recurso o servicio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT p.nombre, p.email, p.celular, p.profesion, r9.resultado AS resultado_9,
                                r11.resultado AS resultado_11, r6.resultado AS resultado_6, 
                                r10.resultado AS resultado_10
                            FROM tbl_encuesta_eeuu_participantes p LEFT JOIN tbl_encuesta_eeuu_resultados r9 
                                ON r9.id_participante = p.id AND r9.id_pregunta = 9
                            LEFT JOIN tbl_encuesta_eeuu_resultados r11 
                                ON r11.id_participante = p.id AND r11.id_pregunta = 11
                            LEFT JOIN tbl_encuesta_eeuu_resultados r6 
                                ON r6.id_participante = p.id AND r6.id_pregunta = 6
                            LEFT JOIN tbl_encuesta_eeuu_resultados r10 
                                ON r10.id_participante = p.id AND r10.id_pregunta = 10";
                            $res = $mysqli2->query($sql);
                            while ($row = $res->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['nombre']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['celular']}</td>
                                    <td>{$row['profesion']}</td>
                                    <td>{$row['resultado_9']}</td>
                                    <td>{$row['resultado_11']}</td>
                                    <td>{$row['resultado_6']}</td>
                                    <td>{$row['resultado_10']}</td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div>
                <form class="form-horizontal" action="https://unicab.org/bd_exportar_encuesta_eeuu_getdat.php"  method="POST" target="_blank">
                    <input type="submit" class="btn btn-primary" value="Exportar Encuesta" >
                </form>
            </div><br>

            <h3 class="text-center mb-3">Estadísticas por Tipo de pregunta y pregunta</h3>

            <div class="row justify-content-center mb-3">
                <div class="col-12 mb-2">
                    <select id="selectTipo" class="form-select">
                        <option value="">Seleccione Tipo</option>
                    </select>
                </div>
                <div class="col-12 mb-2">
                    <!--<select id="selectPregunta" class="form-select">
                        <option value="">Seleccione Pregunta</option>
                    </select>-->
                    <div id="contenedor-preguntas" class="preguntas-container"></div>
                </div>
            </div>

            <!-- Card de gráfica -->
            <div id="graficaCard" class="card mt-4 d-none">
                <div class="card-body">
                    <h5 class="card-title text-center">Resultados de la Pregunta</h5>
                    <canvas id="grafica"></canvas>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                //$('#listParticipantes').DataTable();
                $('#listParticipantes').DataTable({
                    responsive: false,
                    autoWidth: false,
                    scrollX: true, // agrega scroll horizontal si el contenido es muy ancho
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                    },
                    columnDefs: [
                        { targets: "_all", className: "dt-head-center dt-body-center" }
                    ]
                });
                $('#listParticipantes').DataTable().columns.adjust().draw();

                $("#search").keyup(function(){
                    _this = this;
                    // Show only matching TR, hide rest of them
                    $.each($("#listParticipantes tbody tr"), function() {
                        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                            $(this).hide();
                        else
                            $(this).show();
                    });
                });
            });

            const selectTipo = document.getElementById('selectTipo');
            //const selectPregunta = document.getElementById('selectPregunta');
            const contenedorPreguntas = document.getElementById('contenedor-preguntas');
            const canvas = document.getElementById('grafica');
            let chart;

            // Cargar tipos de pregunta
            fetch('../../org/ajax/obtener_tipos.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'}
            })
            //.then(r => r.json())
            .then(async r => {
                const text = await r.text(); // lee la respuesta como texto crudo
                console.log(text); // aquí verás lo que realmente devolvió el servidor
                try {
                    const data = JSON.parse(text); // intenta parsear a JSON
                    return data;
                } catch (e) {
                    //console.error("⚠️ La respuesta no es JSON válido:");
                    throw e; // lanza el error para que caiga en el catch
                }
            })
            .then(data => {
                if (data.success) {
                    data.tipos.forEach(tipo => {
                        const opt = document.createElement('option');
                        opt.value = tipo;
                        opt.textContent = tipo;
                        selectTipo.appendChild(opt);
                    });
                }
            });

            // Cargar preguntas según tipo
            selectTipo.addEventListener('change', () => {
                if (grafica instanceof Chart) {
                    grafica.destroy();
                }

                const data = { tipo: selectTipo.value };
                fetch('../../org/ajax/obtener_preguntas.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(data)
                })
                .then(r => r.json())
                .then(data => {
                    // Limpiar el contenedor antes de agregar nuevas preguntas
                    contenedorPreguntas.innerHTML = '';

                    if (data.success && Array.isArray(data.preguntas)) {
                        data.preguntas.forEach(p => {
                            // Crear el input tipo radio
                            const radio = document.createElement('input');
                            radio.type = 'radio';
                            radio.name = 'pregunta';
                            radio.value = p.id;
                            radio.id = `pregunta_${p.id}`;
                            radio.classList.add('form-check-input');

                            // Crear el label asociado
                            const label = document.createElement('label');
                            label.htmlFor = `pregunta_${p.id}`;
                            label.textContent = p.pregunta;
                            label.classList.add('form-check-label');

                            // Agrupar input + label en un div
                            const div = document.createElement('div');
                            div.classList.add('form-check');
                            div.appendChild(radio);
                            div.appendChild(label);

                            // Agregar al contenedor principal
                            contenedorPreguntas.appendChild(div);
                        });
                    } else {
                        contenedorPreguntas.innerHTML = '<p class="text-muted">No hay preguntas disponibles.</p>';
                    }
                })
                .catch(err => {
                    console.log('Error al cargar preguntas:', err);
                    contenedorPreguntas.innerHTML = '<p class="text-danger">Error al cargar preguntas.</p>';
                });
            });

            // Cargar gráfica según pregunta seleccionada
            document.addEventListener('change', e => {
                if (e.target && e.target.name === 'pregunta') {
                    const idPregunta = e.target.value;
                    mostrarGrafica(idPregunta);
                }
            });

            function mostrarGrafica(idPregunta) {
                fetch('../../org/ajax/obtener_estadisticas.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id_pregunta: idPregunta })
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        alert('Error al obtener datos: ' + data.error);
                        return;
                    }

                    const estadisticas = data.estadisticas;
                    console.log(estadisticas);
                    //const labels = estadisticas.map(e => e.resultado);
                    //const valores = estadisticas.map(e => e.cantidad);
                    const labels = data.estadisticas.lbls;
                    const valores = data.estadisticas.cantidades;

                    const ctx = document.getElementById('grafica').getContext('2d');
                    document.getElementById('graficaCard').classList.remove('d-none');

                    if (grafica instanceof Chart) {
                        grafica.destroy();
                    }

                    grafica = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                //label: 'Cantidad de respuestas',
                                label: data.estadisticas.pregunta,
                                data: valores,
                                /*backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderWidth: 1,
                                borderColor: 'rgba(54, 162, 235, 1)',*/
                                /*backgroundColor: [
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(54, 162, 235, 0.6)',
                                    'rgba(255, 206, 86, 0.6)',
                                    'rgba(255, 99, 132, 0.6)',
                                    'rgba(153, 102, 255, 0.6)'
                                ].slice(0, labels.length),*/
                                backgroundColor: [
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(75, 192, 192, 0.6)'
                                ].slice(0, labels.length),
                                borderColor: 'rgba(0,0,0,0.1)',
                                borderWidth: 1
                            }]
                        },
                        /*options: {
                            responsive: true,
                            scales: { y: { beginAtZero: true } }
                        }*/
                       options: {
                            responsive: true,
                            maintainAspectRatio: true, // mantiene proporciones en pantallas pequeñas
                            aspectRatio: 2.5, // menor valor = menos altura (ajusta entre 1.5 y 3)
                            layout: {
                                padding: { top: 0, bottom: 0, left: 5, right: 5 } // reduce espacios internos
                            },
                            scales: {
                                y: { 
                                    beginAtZero: true,
                                    ticks: { stepSize: 1 }
                                 }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: data.estadisticas.pregunta || '',
                                    font: { size: 16 }
                                },
                                legend: { display: false }
                            }
                        }
                    });
                })
                .catch(err => console.log('Error obteniendo estadísticas:', err));
            }
        </script>

    </body>
</html>