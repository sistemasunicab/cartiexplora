<?php
$html_next_event = '';

// 1) Comprobamos si la sección es visible (sentencia #57)
$rowsVisible = obtenerFilas($mysqli1, $sentencia, 57);

if (!empty($rowsVisible)) {
    foreach ($rowsVisible as $row_data_visible) {
        // 2) Obtenemos los eventos próximos (sentencia #65)
        $rowsEvents = obtenerFilas($mysqli1, $sentencia, 65);

        // Contenedor principal
        $html_next_event  = '<div class="next-events-container col-lg-8 col-md-12 col-sm-12 col-12 p-0 mx-auto d-flex flex-column">';
        $html_next_event .= '  <div class="w-100 m-auto d-flex flex-column bg-bold-blue shadow">';
        $html_next_event .= '    <div class="col-10 d-flex flex-column m-auto pt-5 pb-5">';

        // Título fijo
        $html_next_event .= '      <h4-calendario class="mb-3 font-roboto-bold tx-white">'
                          . $row_data_visible['titulo'] .
                          '</h4-calendario>';

        if (empty($rowsEvents)) {
            $html_next_event .= '      <p-calendario class="tx-white text-center py-5">No hay eventos próximos</p-calendario>';
        } else {
            // Iniciamos el carrusel
            $html_next_event .= '
            <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
              <ol class="carousel-indicators">';
            foreach ($rowsEvents as $i => $_) {
                $html_next_event .= '
                <li data-bs-target="#eventCarousel" data-bs-slide-to="' . $i . '"'
                                  . ($i === 0 ? ' class="active"' : '') . '></li>';
            }
            $html_next_event .= '
              </ol>
              <div class="mb-5 carousel-inner">';

            // Slides
            foreach ($rowsEvents as $i => $row) {
                $tituloEvento = $row['nombre'];
                $fechaIso     = date('c', strtotime($row['fecha'] . ' ' . $row['hora']));
                $descEvento   = $row['descripcion'];
                $idEvento     = 'evt' . ($row['id'] ?? rand(1000, 9999));

                $html_next_event .= '
                <div class="carousel-item' . ($i === 0 ? ' active' : '') . '">
                  <div class="d-flex flex-column event-item mb-4">
                    <h3-calendario class="font-roboto-bold tx-orange mb-2">'
                      . $tituloEvento .
                    '</h3-calendario>
                    <p-calendario id="info-evento-' . $idEvento . '" class="tx-white mb-2">'
                      . $descEvento .
                    '</p-calendario>
                    <div class="countdown-container d-flex gap-3 justify-content-center 
                                font-roboto-bold my-2 fs-5"
                         data-fecha="' . $fechaIso . '"
                         id="countdown-' . $idEvento . '">
                      <div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20">
                        <h3-calendario class="m-0 countdown-day">0</h3-calendario>
                      </div>
                      <div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20">
                        <h3-calendario class="m-0 countdown-hour">0</h3-calendario>
                      </div>
                      <div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20">
                        <h3-calendario class="m-0 countdown-min">0</h3-calendario>
                      </div>
                      <div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20">
                        <h3-calendario class="m-0 countdown-sec">0</h3-calendario>
                      </div>
                    </div>
                  </div>
                </div>';
            }

            // Cerramos carrusel (sin botones prev/next)
            $html_next_event .= '
              </div>
            </div>';
        }

        $html_next_event .= '    </div>'; // cierra col-10
        $html_next_event .= '  </div>';   // cierra bg-bold-blue
        $html_next_event .= '  <button class="mx-auto mx-0 ms-lg-auto me-lg-5 mt-4 btn shadow h-auto tx-white btn-calendary fw-semibold" style="width:250px;">Más información</button>';
        $html_next_event .= '</div>';     // cierra next-events-container
    }
}
?>
<div class="container-fluid my-ws mx-0 p-0">
    <div class="row m-0 p-0">
        <?= $html_next_event ?>
    </div>
</div>
