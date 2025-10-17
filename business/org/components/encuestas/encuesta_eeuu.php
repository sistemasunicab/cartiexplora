<?php
    // PHP para el manejo del formulario (Ejemplo básico, se puede expandir)
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <style>
            .form-section {
                border-left: 5px solid #fe9100; /* Color de ejemplo, puedes ajustarlo */
                padding-left: 15px;
                margin-bottom: 30px;
            }
            .form-check-inline .form-check-input {
                margin-right: 5px;
            }
            .text-header {
                font-family: var(--roboto-regular); /* Usando la variable del CSS */
                color: var(--blue); /* Color representativo */
            }
        </style>
    </head>
    <body>

        <div class="container my-5">
            
            <header class="text-center mb-5">
                <h1 class="text-header">ENCUESTA DE INTERÉS PARA FAMILIAS UNICAB</h1><br>
                <p class="lead"><strong>Expansión Internacional desde Estados Unidos - UNICAB VIRTUAL USA</strong></p><br>
                <p><strong>Estimadas familias UNICABISTAS:</strong></p>                
            </header>

            <section>
                <p>
                    Nuestro colegio virtual, con más de 18 años de experiencia brindando educación de calidad, humanista e innovadora, 
                    se proyecta en una nueva etapa hacia una expansión más global. Estamos planeando abrir una <strong>sede operativa en Estados 
                    Unidos</strong> que nos permita seguir ofreciendo educación de calidad con el modelo ECOSISTEMA UNICAB a más estudiantes en Colombia, 
                    EE.UU. y otros países del mundo, bajo estándares internacionales y con la posibilidad de integrar el sistema 
                    <strong>K-12</strong> (se refiere a la educación primaria y secundaria, desde el jardín hasta el 12.º grado, que es el último año 
                    de la educación antes del ingreso a la universidad).
                </p><br>
                <p>
                    Este proyecto <strong>no requiere vivir en EE.UU.</strong>, ya que el servicio seguirá siendo 100% virtual, legalmente 
                    constituido y con todos los beneficios que ya conocen.
                </p><br>
                <p>
                    Queremos conocer tu opinión para orientar esta propuesta. Esta encuesta tomará entre 4 y 6 minutos 
                    responderla. Agradecemos su generosa participación.
                </p>
                <hr>
            </section>

            <!--<form method="POST" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="encuesta_eeuu">-->
            <form method="POST" action="" id="encuesta_eeuu">

                <div class="form-section">
                    <h3 class="mb-4 tx-blue text-start">DATOS BÁSICOS</h3>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <label for="nombre" class="form-label">* Nombre y apellido</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="email" class="form-label">* Correo electrónico</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="celular" class="form-label">* Número celular (WhatsApp)</label>
                            <input type="text" class="form-control" id="celular" name="celular" required>
                        </div>
                        <div class="col-12">
                            <label for="profesion" class="form-label">¿Cuál es tu profesión u ocupación actual? (Nos ayudará a identificar alianzas y perfiles de apoyo)</label>
                            <input type="text" class="form-control" id="profesion" name="profesion" placeholder="Opcional...">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12 mb-4">
                            <p>Acepto Términos y condiciones según lo establecido en la Ley 1581 de 2012 en Colombia (Tratamiento de datos).</p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="acepta_terminos" id="terminos_si" value="Si" required>
                                <label class="form-check-label" for="terminos_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="acepta_terminos" id="terminos_no" value="No">
                                <label class="form-check-label" for="terminos_no">No</label>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label">1. ¿Cuánto tiempo lleva vinculada tu familia al Colegio UNICAB Virtual?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tiempo_vinculacion" id="tiempo_menos1" value="a|Menos de 1 año" required>
                                <label class="form-check-label" for="tiempo_menos1">Menos de 1 año</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tiempo_vinculacion" id="tiempo_1a3" value="b|1 a 3 años">
                                <label class="form-check-label" for="tiempo_1a3">1 a 3 años</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tiempo_vinculacion" id="tiempo_mas3" value="c|Más de 3 años">
                                <label class="form-check-label" for="tiempo_mas3">Más de 3 años</label>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-4">
                            <label class="form-label">2. ¿Cuál es tu relación con UNICAB?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="relacion_unicab" id="relacion_padre" value="a|Padre // Madre de estudiante actual" onclick="toggleOtroRelacion(false)" required>
                                <label class="form-check-label" for="relacion_padre">Padre | Madre de estudiante actual</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="relacion_unicab" id="relacion_familiar" value="b|Acudiente o familiar cercano" onclick="toggleOtroRelacion(false)">
                                <label class="form-check-label" for="relacion_familiar">Acudiente o familiar cercano</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="relacion_unicab" id="relacion_egresado" value="c|Soy egresado(a) o acudiente de egresado(a)" onclick="toggleOtroRelacion(false)">
                                <label class="form-check-label" for="relacion_egresado">Soy egresado(a) o acudiente de egresado(a)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="relacion_unicab" id="relacion_otro" value="d|Otro" onclick="toggleOtroRelacion(true)">
                                <label class="form-check-label" for="relacion_otro">Otro (especificar):</label>
                            </div>
                            <div id="otro_relacion_input" style="display:none;">
                                <input type="text" class="form-control" name="otra_relacion" id="otra_relacion" placeholder="Especifique su relación">
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label">3. ¿Dónde resides actualmente?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pais_residencia" id="colombia" value="a|Colombia" onclick="toggleOtraResidencia(false)" required>
                                <label class="form-check-label" for="colombia">Colombia</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pais_residencia" id="eeuu" value="b|Estados Unidos" onclick="toggleOtraResidencia(false)">
                                <label class="form-check-label" for="eeuu">Estados Unidos</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pais_residencia" id="pais_otro" value="c|Otro" onclick="toggleOtraResidencia(true)">
                                <label class="form-check-label" for="pais_otro">Otro</label>
                            </div>
                            <div id="otra_residencia_input" style="display:none;">
                                <input type="text" class="form-control" name="otra_residencia" id="otra_residencia" placeholder="Especifique su residencia">
                            </div>
                        </div>
                    </div>
                    
                </div>

                <hr>
                <div class="form-section">
                    <h3 class="mb-4 tx-blue text-start">PERCEPCIÓN DEL PROYECTO</h3>
                    <div class="row g-3 mb-3">
                        <div class="col-12 mb-4">
                            <label class="form-label">4. ¿Qué tan importante te parece que UNICAB expanda su alcance desde EE.UU. como sede internacional? <br>(Escala de 1 a 5, siendo 1 poco relevante y 5 altamente relevante)</label>
                            <div class="d-flex justify-content-between flex-wrap">
                                <?php 
                                    $opcion = "";
                                    for ($i = 1; $i <= 5; $i++): 
                                        if ($i == 1) $opcion = "a|";
                                        if ($i == 2) $opcion = "b|";
                                        if ($i == 3) $opcion = "c|";
                                        if ($i == 4) $opcion = "d|";
                                        if ($i == 5) $opcion = "e|";
                                ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="expansion_eeuu" id="expansion_eeuu_<?php echo $i; ?>" value="<?php echo $opcion.$i; ?>" required>
                                        <label class="form-check-label" for="expansion_eeuu_<?php echo $i; ?>"><?php echo $i; ?></label>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label">5. ¿Estarías dispuesto/a a matricular a tu hijo o hijos en UNICAB USA con la garantía de calidad, el modelo pedagógico y la validez legal? <br>(Escala de 1 a 5, siendo 1 poco relevante y 5 altamente relevante)</label>
                            <div class="d-flex justify-content-between flex-wrap">
                                <?php 
                                    $opcion = "";
                                    for ($i = 1; $i <= 5; $i++): 
                                        if ($i == 1) $opcion = "a|";
                                        if ($i == 2) $opcion = "b|";
                                        if ($i == 3) $opcion = "c|";
                                        if ($i == 4) $opcion = "d|";
                                        if ($i == 5) $opcion = "e|"; 
                                ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="disposicion_matricula" id="matricula_<?php echo $i; ?>" value="<?php echo $opcion.$i; ?>" required>
                                        <label class="form-check-label" for="matricula_<?php echo $i; ?>"><?php echo $i; ?></label>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-4">
                            <label for="beneficios" class="form-label">6. ¿Qué beneficios te parece que podría traer este nuevo proyecto a las familias UNICAB (Colombia y el exterior)?</label>
                            <textarea class="form-control" id="beneficios" name="beneficios" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="form-section">
                    <h3 class="mb-4 tx-blue text-start">RECOMENDACIÓN Y PARTICIPACIÓN</h3>
                    <div class="row g-3 mb-3">
                        <div class="col-12 mb-4">
                            <label class="form-label">7. ¿Conoces familias fuera de Colombia que podrían beneficiarse de una educación virtual como la de UNICAB?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="conoce_familias" id="familias_muchas" value="a|Muchas" required>
                                <label class="form-check-label" for="familias_muchas">Muchas</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="conoce_familias" id="familias_algunas" value="b|Algunas">
                                <label class="form-check-label" for="familias_algunas">Algunas</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="conoce_familias" id="familias_ninguna" value="c|Ninguna">
                                <label class="form-check-label" for="familias_ninguna">Ninguna</label>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label">8. ¿Qué tan dispuesto estarías a recomendar UNICAB USA? (De 1 a 5, siendo 1 nada dispuesto y 5 muy dispuesto)</label>
                            <div class="d-flex justify-content-between flex-wrap">
                                <?php 
                                    $opcion = "";
                                    for ($i = 1; $i <= 5; $i++): 
                                        if ($i == 1) $opcion = "a|";
                                        if ($i == 2) $opcion = "b|";
                                        if ($i == 3) $opcion = "c|";
                                        if ($i == 4) $opcion = "d|";
                                        if ($i == 5) $opcion = "e|"; 
                                ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="disposicion_recomendar" id="recomendar_<?php echo $i; ?>" value="<?php echo $opcion.$i; ?>" required>
                                        <label class="form-check-label" for="recomendar_<?php echo $i; ?>"><?php echo $i; ?></label>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label">9. ¿Te gustaría colaborar como “Embajador UNICAB” para difundir el proyecto internacional?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="embajador" id="embajador_si" value="a|Sí, me encantaría apoyar" required>
                                <label class="form-check-label" for="embajador_si">Sí, me encantaría apoyar</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="embajador" id="embajador_talvez" value="b|Tal vez, quiero más información">
                                <label class="form-check-label" for="embajador_talvez">Tal vez, quiero más información</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="embajador" id="embajador_no" value="c|No">
                                <label class="form-check-label" for="embajador_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="form-section">
                    <h3 class="mb-4 tx-blue text-start">EXPECTATIVAS Y NECESIDADES</h3>
                    <div class="row g-3 mb-3">
                        <div class="col-12 mb-4">
                            <label for="necesidades" class="form-label">10. ¿Hay alguna necesidad, recurso o servicio que UNICAB 
                                debería considerar para atender de manera efectiva a las familias que residen en otros países, 
                                garantizando una experiencia educativa adaptada a sus expectativas y contexto cultural?</label>
                            <textarea class="form-control" id="necesidades" name="necesidades" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="form-section">
                    <h3 class="mb-4">SEGUIMIENTO Y CONTACTO</h3>
                    <div class="row g-3 mb-3">
                        <div class="col-12 mb-4">
                            <label class="form-label">11. ¿Deseas recibir información oficial sobre la apertura de UNICAB USA?</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="recibir_info" id="info_si" value="a|Sí" required>
                                <label class="form-check-label" for="info_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="recibir_info" id="info_no" value="b|No por ahora">
                                <label class="form-check-label" for="info_no">No por ahora</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-2 col-md-6 mx-auto mt-5">
                    <button type="submit" class="btn btn-lg inscripciones-btn">Enviar Encuesta</button>
                </div>

            </form>

            <footer class="mt-5 p-3 text-muted border-top">
                <p><small><strong>Confidencialidad:</strong><br> Esta encuesta es de carácter informativo y no compromete a ninguna decisión. 
                    Toda la información será tratada con confidencialidad y solo se usará para fines institucionales.</small></p>
            </footer>

        </div>

        <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
        <script>
            function toggleOtroRelacion(mostrar) {
                const inputDiv = document.getElementById('otro_relacion_input');
                const inputField = inputDiv.querySelector('input');
                
                if (mostrar) {
                    inputDiv.style.display = 'block';
                    inputField.setAttribute('required', 'required'); // Hacer el input obligatorio si se elige 'Otro'
                } else {
                    inputDiv.style.display = 'none';
                    inputField.removeAttribute('required'); // No es obligatorio si se elige otra opción
                    inputField.value = ''; // Limpiar el valor si se deselecciona 'Otro'
                }
            }

            function toggleOtraResidencia(mostrar) {
                const inputDiv = document.getElementById('otra_residencia_input');
                const inputField = inputDiv.querySelector('input');
                
                if (mostrar) {
                    inputDiv.style.display = 'block';
                    inputField.setAttribute('required', 'required'); // Hacer el input obligatorio si se elige 'Otro'
                } else {
                    inputDiv.style.display = 'none';
                    inputField.removeAttribute('required'); // No es obligatorio si se elige otra opción
                    inputField.value = ''; // Limpiar el valor si se deselecciona 'Otro'
                }
            }
            
            // Inicialmente, verificar si la página se cargó con "Otro" seleccionado (útil si hay errores de validación)
            document.addEventListener('DOMContentLoaded', function() {
                const otroRadio = document.getElementById('relacion_otro');
                if (otroRadio && otroRadio.checked) {
                    toggleOtroRelacion(true);
                }

                const otraResidencia = document.getElementById('pasi_otro');
                if (otraResidencia && otraResidencia.checked) {
                    toggleOtraResidencia(true);
                }

                const form = document.getElementById('encuesta_eeuu');
                const submitButton = form.querySelector('button[type="submit"]');

                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Detiene el envío normal del formulario
                    
                    submitButton.disabled = true;
                    submitButton.textContent = 'Enviando...';

                    const formData = new FormData(form);
                    const data = {};
                    
                    // Recolectar datos y preparar el objeto JSON
                    for (let [key, value] of formData.entries()) {
                        // Manejar la relación UNICAB y el campo 'otra_relacion'
                        if (key === 'relacion_unicab' && value !== 'd|Otro') {
                            // Si no es "Otro", almacenamos el valor del radio button
                            data[key] = value;
                        } else if (key === 'relacion_unicab' && value === 'd|Otro') {
                            // Si es "Otro", almacenamos 'Otro' y esperamos el campo 'otra_relacion'
                            data[key] = value;
                        } else if (key === 'otra_relacion') {
                            // Solo almacenamos el valor del input si existe
                            data[key] = value;
                        } else {
                            data[key] = value;
                        }

                        // Manejar la residencia y el campo 'otra_residencia'
                        if (key === 'pais_residencia' && value !== 'c|Otro') {
                            // Si no es "Otro", almacenamos el valor del radio button
                            data[key] = value;
                        } else if (key === 'pais_residencia' && value === 'c|Otro') {
                            // Si es "Otro", almacenamos 'Otro' y esperamos el campo 'otra_residencia'
                            data[key] = value;
                        } else if (key === 'otra_residencia') {
                            // Solo almacenamos el valor del input si existe
                            data[key] = value;
                        } else {
                            data[key] = value;
                        }
                    }
                    
                    // Si el radio button 'Otro' fue seleccionado, usamos el valor del input 'otra_relacion' como la respuesta final
                    /*if (data.relacion_unicab === 'Otro' && data.otra_relacion) {
                        data.relacion_unicab = data.otra_relacion;
                    }
                    // Eliminar el campo extra si no se usó
                    delete data.otra_relacion;

                    // Si el radio button 'Otro' fue seleccionado, usamos el valor del input 'otra_residencia' como la respuesta final
                    if (data.pais_residencia === 'Otro' && data.otra_residencia) {
                        data.pais_residencia = data.otra_residencia;
                    }
                    // Eliminar el campo extra si no se usó
                    delete data.otra_residencia;*/
                    console.log(data);

                    // Configuración del fetch para enviar datos JSON
                    fetch('../../org/ajax/registro_encuesta_eeuu.php', { // RUTA AL ARCHIVO PHP EN SU SERVIDOR
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    //.then(response => response.json())
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
                    .then(result => {
                        submitButton.disabled = false;
                        submitButton.textContent = 'Enviar Encuesta';
                        
                        // Mostrar mensaje de éxito o error
                        if (result.success) {
                            alert('✅ ' + result.message);
                            form.reset(); // Limpiar el formulario al terminar
                        } else {
                            alert('❌ Error: ' + result.message);
                        }
                    })
                    .catch(error => {
                        submitButton.disabled = false;
                        submitButton.textContent = 'Enviar Encuesta';
                        alert('❌ Error de conexión con el servidor. Por favor, inténtelo de nuevo.');
                        console.log('Error:', error);
                    });
                });
            });

        </script>
    </body>
</html>