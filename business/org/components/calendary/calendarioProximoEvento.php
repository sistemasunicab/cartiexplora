<?php
// 1) CHECK IF THE SECTION IS VISIBLE (Sentence #47)
$number_sentence_visible = "47";
$res_sentence_visible = $mysqli1->query($sentencia . $number_sentence_visible);

while ($row_sentence_visible = $res_sentence_visible->fetch_assoc()) {
    $conditions_visible = str_replace('|', '\'', $row_sentence_visible['condiciones']);
    $sql_data_visible = $row_sentence_visible['campos'] . $row_sentence_visible['tablas'] . $conditions_visible;
}

$res_data_visible = $mysqli1->query($sql_data_visible);

// Only display content if the section is visible
while ($row_data_visible = $res_data_visible->fetch_assoc()) {

    // 2) FETCH UPCOMING EVENTS (Sentence #51)
    $number_sentence_events = "51";
    $res_sentence_events = $mysqli1->query($sentencia . $number_sentence_events);

    while ($row_sentence_events = $res_sentence_events->fetch_assoc()) {
        $conditions_events = str_replace('|', '\'', $row_sentence_events['condiciones']);
        $sql_data_events = $row_sentence_events['campos'] . $row_sentence_events['tablas'] . $conditions_events;
    }

    $res_data_events = $mysqli1->query($sql_data_events);

    // Main container
    $html_next_event = '<div class="w-60 m-auto m-block-15 d-flex flex-column">';
    $html_next_event .= '<div class="w-100 m-auto d-flex flex-column bg-bold-blue shadow">';
    $html_next_event .= '<div class="d-flex flex-column w-80 m-auto pt-5 pb-5">';
    $html_next_event .= '<h3 class="font-roboto-bold tx-color-wh">' . $row_data_visible['titulo'] . '</h3>';
    $html_next_event .= '';

    // Loop through each upcoming event
    while ($row_data_events = $res_data_events->fetch_assoc()) {
        // Get event title and date
        $tituloEvento = htmlspecialchars($row_data_events['nombre_evento'] ?? 'Evento sin título');
        $fechaEvento  = htmlspecialchars($row_data_events['fecha_hora'] ?? '2025-12-31 00:00:00');
        $idEvento     = $row_data_events['id'] ?? rand(1, 1000); // Unique ID fallback

        // Display event title
        $html_next_event .= '<h2 class="font-roboto-bold tx-color-or">' . $tituloEvento . '</h2>';
        $html_next_event .= '<p class="special-paragraph tx-color-wh">' . $row_data_visible['texto'] . '</p>';

        // Create a container for the countdown with a unique ID
        $countdownID = 'countdown-' . $idEvento;
        $html_next_event .= '<div id="' . $countdownID . '" class="d-flex gap-3 m-auto font-roboto-bold tx-color-bl my-2 fs-5">';
        $html_next_event .= '<div class="bg-white calendary-event"> <h2 id="calendary-day"></h2></div>';
        $html_next_event .= '<div class="bg-white calendary-event"> <h2 id="calendary-hour"></h2></div>';
        $html_next_event .= '<div class="bg-white calendary-event"> <h2 id="calendary-min"></h2></div>';
        $html_next_event .= '<div class="bg-white calendary-event"> <h2 id="calendary-sec"></h2></div>';
        $html_next_event .= '</div>';
        $html_next_event .= '
            <script>
                var fechaEvento = "' . $fechaEvento . '";
                var countdownID = "' . $countdownID . '";
            </script>
        ';
    
    }
    $html_next_event .= '</div>';
    $html_next_event .= '</div>';
    $html_next_event .= '<button class="ml-auto mr-10 mt-4 btn shadow h-auto tx-color-wh btn-calendary fw-semibold" style="width:250px;">Más información</button>';
    $html_next_event .= '</div>';
    echo $html_next_event;

} 
?>
