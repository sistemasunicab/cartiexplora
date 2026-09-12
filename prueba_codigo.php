<?php
// ============================================================
// CONFIGURACIÓN: Fecha objetivo de la cuenta regresiva
// ============================================================
//$fechaObjetivo = '2026-09-27 23:59:59';
//$timestampObjetivo = strtotime($fechaObjetivo) * 1000; // JS usa milisegundos

$fecha = "20260928";
$dt = DateTime::createFromFormat('Ymd', $fecha);

//Si tienes la extensión intl habilitada
$formatter = new IntlDateFormatter(
    'es_ES',
    IntlDateFormatter::LONG,  // formato largo
    IntlDateFormatter::NONE   // sin hora
);
$formatter->setPattern("dd 'de' MMMM"); // día + nombre del mes

echo ucfirst($formatter->format($dt));

$dt->modify('-1 day');
$dt->setTime(23, 59, 59);
$fechaObjetivo = $dt->format('Y-m-d H:i:s'); 
$timestampObjetivo = strtotime($fechaObjetivo) * 1000; // JS usa milisegundos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta regresiva</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #ffffff;        /* Fondo completamente blanco */
            color: #16224F;             /* Texto oscuro para contraste */
            padding: 20px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 10px;
            text-align: center;
            color: #16224F;
        }

        .fecha-objetivo {
            font-size: 1rem;
            color: #555;
            margin-bottom: 30px;
        }

        .countdown {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .caja {
            background: #16224F;        /* Azul oscuro solicitado */
            border-radius: 12px;
            padding: 20px 25px;
            min-width: 110px;
            text-align: center;
            color: #ffffff;             /* Texto blanco sobre fondo oscuro */
            box-shadow: 0 6px 15px rgba(22, 34, 79, 0.25);
        }

        .caja .numero {
            font-size: 3rem;
            font-weight: bold;
            line-height: 1;
        }

        .caja .etiqueta {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 8px;
            opacity: 0.9;
        }

        .finalizado {
            font-size: 1.5rem;
            background: #16224F;
            color: #ffffff;
            padding: 20px 40px;
            border-radius: 12px;
            display: none;
            box-shadow: 0 6px 15px rgba(22, 34, 79, 0.25);
        }

        @media (max-width: 500px) {
            .caja { min-width: 75px; padding: 15px; }
            .caja .numero { font-size: 2rem; }
        }
    </style>
</head>
<body>

    <h1>Esta oportunidad desaparecerá en</h1>
    <p class="fecha-objetivo">
        Objetivo: <?php echo htmlspecialchars($fechaObjetivo); ?>
    </p>

    <div class="countdown" id="countdown">
        <div class="caja">
            <div class="numero" id="dias">00</div>
            <div class="etiqueta">Días</div>
        </div>
        <div class="caja">
            <div class="numero" id="horas">00</div>
            <div class="etiqueta">Horas</div>
        </div>
        <div class="caja">
            <div class="numero" id="minutos">00</div>
            <div class="etiqueta">Minutos</div>
        </div>
        <div class="caja">
            <div class="numero" id="segundos">00</div>
            <div class="etiqueta">Segundos</div>
        </div>
    </div>

    <div class="finalizado" id="finalizado">
        🎉 ¡La fecha objetivo ha llegado! 🎉
    </div>

    <script>
        const fechaObjetivo = <?php echo $timestampObjetivo; ?>;

        const elDias     = document.getElementById('dias');
        const elHoras    = document.getElementById('horas');
        const elMinutos  = document.getElementById('minutos');
        const elSegundos = document.getElementById('segundos');
        const countdown  = document.getElementById('countdown');
        const finalizado = document.getElementById('finalizado');

        function actualizar() {
            const ahora = new Date().getTime();
            const diferencia = fechaObjetivo - ahora;

            if (diferencia <= 0) {
                countdown.style.display = 'none';
                finalizado.style.display = 'block';
                clearInterval(intervalo);
                return;
            }

            const dias    = Math.floor(diferencia / (1000 * 60 * 60 * 24));
            const horas   = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
            const segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

            elDias.textContent     = String(dias).padStart(2, '0');
            elHoras.textContent    = String(horas).padStart(2, '0');
            elMinutos.textContent  = String(minutos).padStart(2, '0');
            elSegundos.textContent = String(segundos).padStart(2, '0');
        }

        actualizar();
        const intervalo = setInterval(actualizar, 1000);
    </script>

</body>
</html>