$(document).ready(function() {
    $('.select2').select2();
});

function cambiarImagenBlog(objeto, ruta) {
    const imagen = objeto.querySelector('img')
    if (imagen) {
        imagen.src = ruta;
    }
}

function restaurarImagenBlog(objeto, ruta) {
    const imagen = objeto.querySelector('img')
    if (imagen) {
        imagen.src = ruta;
    }
}
