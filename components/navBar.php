<?php
?>

<style>
    /* Estilos para la navbar */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #333;
        color: white;
        padding: 10px 20px;
        position: relative;
    }

    .navbar .brand {
        display: flex;
        align-items: center;
    }

    .navbar .brand img {
        height: 40px;
        margin-right: 10px;
    }

    .navbar .menu {
        display: flex;
        gap: 20px;
    }

    .navbar .menu a {
        color: white;
        text-decoration: none;
        cursor: pointer;
    }

    .navbar .menu a:hover {
        text-decoration: underline;
    }

    /* Estilos para las secciones desplegables */
    .dropdown {
        position: absolute;
        background-color: white;
        border: 1px solid #ddd;
        padding: 15px;
        width: 300px;
        display: none;
        /* Ocultas por defecto */
        z-index: 1000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }


    .dropdown.active {
        display: block;
        /* Mostrar cuando está activo */
    }

    .dropdown h3 {
        margin-top: 0;
    }

    .dropdown ul {
        list-style-type: none;
        padding: 0;
    }

    .dropdown ul li {
        margin: 5px 0;
    }

    .dropdown ul li a {
        text-decoration: none;
        color: #333;
    }

    .dropdown ul li a:hover {
        text-decoration: underline;
    }
</style>

<div class="navbar">
    <div class="brand">
        <img src="logo.png" alt="Logo de UNICAB">
        <span>UNICAB</span>
    </div>
    <div class="menu">
        <a href="#" onclick="showDropdown('menu1', event)">Colegio UNICAB Virtual</a>
        <a href="#" onclick="showDropdown('menu2', event)">CARTI Explora</a>
        <a href="#" onclick="showDropdown('menu3', event)">UNICAB Solutions</a>
        <a href="#" onclick="showDropdown('menu4', event)">Admisiones</a>
    </div>
</div>

<!-- Secciones desplegables -->
<div id="menu1" class="dropdown">
    <h3>Colegio UNICAB Virtual</h3>
    <ul>
        <li><a href="#">Enlace 1</a></li>
        <li><a href="#">Enlace 2</a></li>
        <li><a href="#">Enlace 3</a></li>
    </ul>
</div>

<div id="menu2" class="dropdown">
    <h3>CARTI Explora</h3>
    <ul>
        <li><a href="#">Enlace 1</a></li>
        <li><a href="#">Enlace 2</a></li>
        <li><a href="#">Enlace 3</a></li>
    </ul>
</div>

<div id="menu3" class="dropdown">
    <h3>UNICAB Solutions</h3>
    <ul>
        <li><a href="#">Enlace 1</a></li>
        <li><a href="#">Enlace 2</a></li>
        <li><a href="#">Enlace 3</a></li>
    </ul>
</div>

<div id="menu4" class="dropdown">
    <h3>Admisiones</h3>
    <ul>
        <li><a href="#">Enlace 1</a></li>
        <li><a href="#">Enlace 2</a></li>
        <li><a href="#">Enlace 3</a></li>
    </ul>
</div>

<script>
    function showDropdown(menuId, event) {
        // Ocultar todos los dropdowns
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => dropdown.classList.remove('active'));

        // Mostrar el dropdown correspondiente
        const dropdown = document.getElementById(menuId);
        if (dropdown) {
            // Obtener las coordenadas del enlace clicado
            const rect = event.target.getBoundingClientRect();
            dropdown.style.left = `${rect.left}px`; // Ajustar la posición horizontal
            dropdown.style.top = `${rect.bottom}px`; // Ajustar la posición vertical
            dropdown.classList.add('active');
        }
    }


    // Cerrar los menús al hacer clic fuera de ellos
    window.onclick = function (event) {
        if (!event.target.closest('.navbar')) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => dropdown.classList.remove('active'));
        }
    };
</script>