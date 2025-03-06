<?php
// 1) CHECK IF THE SECTION IS VISIBLE (Sentence #47)
$number_sentence_visible = "56";
$res_sentence_visible = $mysqli1->query($sentencia . $number_sentence_visible);

while ($row_sentence_visible = $res_sentence_visible->fetch_assoc()) {
    $conditions_visible = str_replace('|', '\'', $row_sentence_visible['condiciones']);
    $sql_data_visible = $row_sentence_visible['campos'] . $row_sentence_visible['tablas'] . $conditions_visible;
}

$res_data_visible = $mysqli1->query($sql_data_visible);

// Only display content if the section is visible
while ($row_data_visible = $res_data_visible->fetch_assoc()) {

    // 2) FETCH UPCOMING EVENTS (Sentence #51)
    $number_sentence_events = "60";
    $res_sentence_events = $mysqli1->query($sentencia . $number_sentence_events);

    while ($row_sentence_events = $res_sentence_events->fetch_assoc()) {
        $conditions_events = str_replace('|', '\'', $row_sentence_events['condiciones']);
        $sql_data_events = $row_sentence_events['campos'] . $row_sentence_events['tablas'] . $conditions_events;
    }

    $res_data_events = $mysqli1->query($sql_data_events);

    // Main container
    $html_next_event = '<div class="col-7 m-auto my-10 d-flex flex-column">';
    $html_next_event .= '<div class="w-100 m-auto d-flex flex-column bg-bold-blue shadow">';
    $html_next_event .= '<div class="d-flex flex-column m-auto pt-5 pb-5">';
    $html_next_event .= '<h3 class="font-roboto-bold tx-white">' . $row_data_visible['titulo'] . '</h3>';
    $html_next_event .= '';

    // Loop through each upcoming event
    while ($row_data_events = $res_data_events->fetch_assoc()) {
        // Get event title and date
        $tituloEvento = htmlspecialchars($row_data_events['nombre'] ?? 'Evento sin título');
        $fechaEvento = htmlspecialchars($row_data_events['fecha_hora'] ?? '2025-12-31 00:00:00');
        $idEvento = $row_data_events['id'] ?? rand(1, 1000); // Unique ID fallback

        // Display event title
        $html_next_event .= '<h2 class="font-roboto-bold tx-orange">' . $tituloEvento . '</h2>';
        $html_next_event .= '<p class="special-paragraph tx-white">' . $row_data_visible['texto'] . '</p>';

        // Create a container for the countdown with a unique ID
        $countdownID = 'countdown-' . $idEvento;
        $html_next_event .= '<div id="' . $countdownID . '" class="d-flex gap-3 m-auto font-roboto-bold tx-color-bl my-2 fs-5">';
        $html_next_event .= '<div class="calendary-event bg-white tx-orange d-flex border-radius-20"> <h2 class="m-0" id="calendary-day"></h2></div>';
        $html_next_event .= '<div class="calendary-event bg-white tx-orange d-flex border-radius-20"> <h2 class="m-0" id="calendary-hour"></h2></div>';
        $html_next_event .= '<div class="calendary-event bg-white tx-orange d-flex border-radius-20"> <h2 class="m-0" id="calendary-min"></h2></div>';
        $html_next_event .= '<div class="calendary-event bg-white tx-orange d-flex border-radius-20"> <h2 class="m-0" id="calendary-sec"></h2></div>';
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
    $html_next_event .= '<button class="ms-auto me-5 mt-4 btn shadow h-auto tx-white btn-calendary fw-semibold" style="width:250px;">Más información</button>';
    $html_next_event .= '</div>';


}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_next_event;
        ?>
    </div>
</div>