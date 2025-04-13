<?php
// 1) CHECK IF THE SECTION IS VISIBLE (Sentence #47)
$number_sentence_visible = "57";
$res_sentence_visible = $mysqli1->query($sentencia . $number_sentence_visible);

while ($row_sentence_visible = $res_sentence_visible->fetch_assoc()) {
    $conditions_visible = str_replace('|', '\'', $row_sentence_visible['condiciones']);
    $sql_data_visible = $row_sentence_visible['campos'] . $row_sentence_visible['tablas'] . $conditions_visible;
}

$res_data_visible = $mysqli1->query($sql_data_visible);

// Only display content if the section is visible
while ($row_data_visible = $res_data_visible->fetch_assoc()) {

    // 2) FETCH UPCOMING EVENTS (Sentence #51)
    $number_sentence_events = "65";
    $res_sentence_events = $mysqli1->query($sentencia . $number_sentence_events);

    while ($row_sentence_events = $res_sentence_events->fetch_assoc()) {
        $conditions_events = str_replace('|', '\'', $row_sentence_events['condiciones']);
        $sql_data_events = $row_sentence_events['campos'] . $row_sentence_events['tablas'] . $conditions_events;
    }

    $res_data_events = $mysqli1->query($sql_data_events);
    // Main container
    $html_next_event = '<div class="col-lg-8 col-md-8 col-sm-12 col-12 p-0 m-auto my-5 d-flex flex-column">';
    $html_next_event .= '<div class="w-100 m-auto d-flex flex-column bg-bold-blue shadow">';
    $html_next_event .= '<div class="col-10 d-flex flex-column m-auto pt-5 pb-5">';
    $html_next_event .= '<h4 class="font-roboto-bold tx-white">' . $row_data_visible['titulo'] . '</h4>';
    $html_next_event .= '';

    // Loop through each upcoming event
    while ($row_data_events = $res_data_events->fetch_assoc()) {
        // Get event title and date
        $tituloEvento = htmlspecialchars($row_data_events['nombre']);
        $fechaEvento = $row_data_events['fecha'];
        $horaEvento = $row_data_events['hora'];
        $fechaEvento = date('Y-m-d H:i:s', strtotime("$fechaEvento $horaEvento"));
        $idEvento = $row_data_events['id'] ?? rand(1, 1000); // Unique ID fallback

        // Display event title
        $html_next_event .= '<h3 class="font-roboto-bold tx-orange">' . $tituloEvento . '</h3>';
        $html_next_event .= '<p class="special-paragraph tx-white">' . $row_data_visible['texto'] . '</p>';

        // Create a container for the countdown with a unique ID
        $countdownID = 'countdown-' . $idEvento;
        $html_next_event .= '<div id="' . $countdownID . '" class="d-flex gap-3 justify-content-center font-roboto-bold my-2 fs-5">';
        $html_next_event .= '<div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20"> <h3 class="m-0" id="calendary-day"></h3></div>';
        $html_next_event .= '<div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20"> <h3 class="m-0" id="calendary-hour"></h3></div>';
        $html_next_event .= '<div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20"> <h3 class="m-0" id="calendary-min"></h3></div>';
        $html_next_event .= '<div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20"> <h3 class="m-0" id="calendary-sec"></h3></div>';
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
    $html_next_event .= '<button class="mx-auto mx-0 ms-md-auto me-md-5 mt-4 btn shadow h-auto tx-white btn-calendary fw-semibold" style="width:250px;">Más información</button>';
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