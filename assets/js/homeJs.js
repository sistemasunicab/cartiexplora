$(function () {
    $(".select2").select2();
});

// Inscripciones abiertas form
$(document).ready(function () {
    $("#myForm").on("submit", function (e) {

        e.preventDefault();

        let nombre = $("#nombre").val();
        let email = $("#correo").val();
        let asunto = $("#asunto").val();
        let mensaje = $("#mensaje").val();
        let subscribe = $("#checkbox").is(":checked");

        const data = {
            nombre: nombre,
            email: email,
            asunto: asunto,
            mensaje: mensaje,
            subscribe: subscribe,
        };

        $.ajax({
            url: "../../cartiexplora/ajax/formInscripcionesAbiertas.php",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.status === "success") {
                    $("#successMessage").fadeIn().delay(3000).fadeOut();
                    $("#myForm")[0].reset();
                } else {
                    $("#errorMessage").fadeIn().delay(3000).fadeOut();
                }
            },
            error: function (response) {
                $("#errorMessage").fadeIn().delay(3000).fadeOut();
            },
        });
    });
});
