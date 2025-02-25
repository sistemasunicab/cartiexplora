
/*Inicio java Script para el componente Navbar*/
document.addEventListener('DOMContentLoaded', () => {
    const listenersMedium = new Map(); // Mapa para almacenar referencias a los listeners
    const listenersLarge = new Map(); // Mapa para almacenar referencias a los listeners

    function resetStyles() {
        document.querySelectorAll('.hover').forEach(element => {
            element.classList.remove('hover');
        });
    }

    function removeEventListeners(map) {
        map.forEach((eventMap, element) => {
            eventMap.forEach((listener, event) => {
                element.removeEventListener(event, listener);
            });
        });
        map.clear();
    }

    function initDropdownHandlers() {
        resetStyles();
        if (window.innerWidth > 768 && !isMobileDevice()) {
            const navItems = document.querySelectorAll('.nav-item');

            navItems.forEach(item => {
                const menuItem = item.querySelector('.menu-item p');
                const dropdown = item.querySelector('.dropdown');
                const dropdownItems = dropdown ? dropdown.querySelectorAll('.dropdown-item') : [];
                const dropdownContainer = item.querySelector('.dropdown-container');

                // Función para verificar si el mouse está en un elemento específico
                const isMouseInElement = (element) => {
                    return element && element.matches(':hover'); // Verifica si el mouse está sobre el elemento
                };

                // Función para manejar mouseenter
                const handleMouseEnterItem = () => {
                    if (dropdown) {
                        dropdownContainer.classList.add('hover');
                        menuItem.classList.add('hover');
                        dropdown.classList.add('hover');
                    }
                };

                // Función para manejar mouseleave
                const handleMouseLeaveItem = () => {
                    if (dropdown) {
                        const isInDropdown = isMouseInElement(dropdown);
                        const isInAnyDropdown2 = Array.from(dropdownItems).some(dropdownItem => {
                            const submenuId = dropdownItem.id;
                            const dropdown2 = document.querySelector(`#${submenuId.replace('.', '\\.')}_dropdown`);
                            return isMouseInElement(dropdown2);
                        });

                        if (!isInDropdown && !isInAnyDropdown2) {
                            dropdownContainer.classList.remove('hover');
                            menuItem.classList.remove('hover');
                            dropdown.classList.remove('hover');

                            dropdownItems.forEach(dropdownItem => {
                                const dropdown2 = document.querySelector(`#${dropdownItem.id.replace('.', '\\.')}_dropdown`);
                                if (dropdown2) {
                                    dropdown2.classList.remove('hover');
                                }
                            });
                        }
                    }
                };

                // Agregar los listeners al elemento principal
                item.addEventListener('mouseenter', handleMouseEnterItem);
                item.addEventListener('mouseleave', handleMouseLeaveItem);

                // Almacenar los listeners en el mapa
                if (!listenersLarge.has(item)) {
                    listenersLarge.set(item, new Map());
                }
                const eventMap = listenersLarge.get(item);
                eventMap.set('mouseenter', handleMouseEnterItem);
                eventMap.set('mouseleave', handleMouseLeaveItem);

                // Manejar los submenús (dropdown2)
                dropdownItems.forEach(dropdownItem => {
                    const submenuId = dropdownItem.id;
                    const dropdown2 = document.querySelector(`#${submenuId.replace('.', '\\.')}_dropdown`);

                    if (dropdown2) {
                        const handleMouseEnterDropdownItem = () => {
                            dropdownItem.classList.add('hover');
                            dropdown2.classList.add('hover');
                        };

                        const handleMouseLeaveDropdownItem = () => {
                            if (!isMouseInElement(dropdown2)) {
                                dropdownContainer.classList.remove('hover');
                                dropdownItem.classList.remove('hover');
                                dropdown2.classList.remove('hover');
                            }
                        };

                        const handleMouseEnterDropdown2 = () => {
                            dropdown2.classList.add('hover');
                        };

                        const handleMouseLeaveDropdown2 = () => {
                            dropdownContainer.classList.remove('hover');
                            dropdown2.classList.remove('hover');
                            dropdownItem.classList.remove('hover');
                        };

                        // Agregar listeners
                        dropdownItem.addEventListener('mouseenter', handleMouseEnterDropdownItem);
                        dropdownItem.addEventListener('mouseleave', handleMouseLeaveDropdownItem);
                        dropdown2.addEventListener('mouseenter', handleMouseEnterDropdown2);
                        dropdown2.addEventListener('mouseleave', handleMouseLeaveDropdown2);

                        // Guardar las referencias
                        if (!listenersLarge.has(dropdownItem)) {
                            listenersLarge.set(dropdownItem, new Map());
                        }
                        const eventMapDropdownItem = listenersLarge.get(dropdownItem);
                        eventMapDropdownItem.set('mouseenter', handleMouseEnterDropdownItem);
                        eventMapDropdownItem.set('mouseleave', handleMouseLeaveDropdownItem);

                        if (!listenersLarge.has(dropdown2)) {
                            listenersLarge.set(dropdown2, new Map());
                        }
                        const eventMapDropdown2 = listenersLarge.get(dropdown2);
                        eventMapDropdown2.set('mouseenter', handleMouseEnterDropdown2);
                        eventMapDropdown2.set('mouseleave', handleMouseLeaveDropdown2);
                    }
                });
            });

        }
        else {
            const navItems = document.querySelectorAll('.nav-item');

            navItems.forEach(item => {
                let actualDisplayedDropdown2 = null;
                const menuItem = item.querySelector('.menu-item p');
                const dropdown = item.querySelector('.dropdown');
                const dropdownItems = dropdown ? dropdown.querySelectorAll('.dropdown-item') : [];
                const dropdownContainer = item.querySelector('.dropdown-container');

                if (menuItem) {
                    // Función identificable para el menú principal
                    const toggleMenu = () => {
                        if (dropdown) {
                            const isOpen = menuItem.classList.contains('hover');
                            if (!isOpen) {
                                // Ocultar todos los dropdownContainer abiertos
                                document.querySelectorAll('.menu-item p.hover').forEach(element => {
                                    element.classList.remove('hover');
                                });

                                document.querySelectorAll('.dropdown-container.hover').forEach(element => {
                                    element.classList.remove('hover');
                                    const childDropdown = element.querySelector('.dropdown.hover');
                                    const childDropdown2 = element.querySelector('.dropdown2.hover');
                                    if (childDropdown) childDropdown.classList.remove('hover');
                                    if (childDropdown2) childDropdown2.classList.remove('hover');
                                });
                                // Mostrar el dropdown actual
                                dropdownContainer.classList.add('hover');
                                menuItem.classList.add('hover');
                                dropdown.classList.add('hover');
                            } else {
                                // Ocultar el dropdown actual
                                dropdownContainer.classList.remove('hover');
                                menuItem.classList.remove('hover');
                                dropdown.classList.remove('hover');
                                if (actualDisplayedDropdown2) {
                                    actualDisplayedDropdown2.classList.remove('hover');
                                }
                            }
                        }
                    };

                    // Agregar listener y guardar referencia
                    menuItem.addEventListener('click', toggleMenu);
                    if (!listenersMedium.has(menuItem)) {
                        listenersMedium.set(menuItem, new Map());
                    }
                    const eventMap = listenersMedium.get(menuItem);
                    eventMap.set('click', toggleMenu);
                }

                // Manejar los submenús (dropdown2)
                dropdownItems.forEach(dropdownItem => {
                    const submenuId = dropdownItem.id;
                    const dropdown2 = document.querySelector(`#${submenuId.replace('.', '\\.')}_dropdown`);

                    if (dropdown2) {
                        // Función identificable para submenús
                        const toggleSubmenu = () => {
                            const isOpen = dropdown2.classList.contains('hover');
                            if (!isOpen) {
                                if (actualDisplayedDropdown2) {
                                    actualDisplayedDropdown2.classList.remove('hover');
                                }
                                menuItem.classList.add('hover');
                                dropdownContainer.classList.add('hover');
                                if (window.innerWidth < 768) dropdown.classList.remove('hover');
                                dropdown2.classList.add('hover');
                                actualDisplayedDropdown2 = dropdown2;
                            }
                        };

                        // Agregar listener y guardar referencia
                        dropdownItem.addEventListener('click', toggleSubmenu);
                        if (!listenersMedium.has(dropdownItem)) {
                            listenersMedium.set(dropdownItem, new Map());
                        }
                        const eventMap = listenersMedium.get(dropdownItem);
                        eventMap.set('click', toggleSubmenu);
                    }
                });
            });

        }

    }

    // Escuchar el cambio de tamaño de la ventana
    function handleResize() {
        console.log('resize');
        removeEventListeners(listenersMedium);
        removeEventListeners(listenersLarge);
        initDropdownHandlers();
    }

    window.addEventListener('resize', handleResize);
    window.addEventListener('orientationchange', handleResize);

    function isMobileDevice() {
        const userAgent = navigator.userAgent || navigator.vendor || window.opera;
        return /android|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(userAgent);
    }

    // Inicialización inicial
    initDropdownHandlers();

});

document.addEventListener("DOMContentLoaded", () => {
    const menuButton = document.querySelector('#menu-button');
    menuButton.addEventListener('click', () => {
        const menu = document.getElementById("menuDisplay");
        if (!menu.classList.contains('hover')) {
            menu.classList.add('hover');
        } else {
            menu.classList.remove('hover');
        }
    });
});
/*Fin java Script para el componente Navbar*/


document.addEventListener("DOMContentLoaded", function () {
    (function () {
        // Check that our required global variables exist
        if (typeof fechaEvento === "undefined" || typeof countdownID === "undefined") {
            console.error("Global variables 'fechaEvento' and/or 'countdownID' are not defined.");
            return;
        }

        var targetDate = new Date(fechaEvento).getTime();
        var countdownElem = document.getElementById(countdownID);

        if (!countdownElem) return; // Ensure the element exists

        var interval = setInterval(function () {
            var now = new Date().getTime();
            var distance = targetDate - now;

            if (distance < 0) {
                clearInterval(interval);
                countdownElem.innerHTML = "¡El evento ya inició o ha finalizado!";
                return;
            }

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            let day = document.getElementById("calendary-day");
            day.innerHTML = days;
            let hour = document.getElementById("calendary-hour");
            hour.innerHTML = hours;
            let min = document.getElementById("calendary-min");
            min.innerHTML = minutes;
            let sec = document.getElementById("calendary-sec");
            sec.innerHTML = seconds;
        }, 1000);
    })();
});
document.addEventListener("DOMContentLoaded", function () {
    // Selecciona todos los botones con la clase .btn-route
    const botonesVer = document.querySelectorAll('.btn-route');

    botonesVer.forEach((boton) => {
        boton.addEventListener('click', function () {
            const rutaArchivo = this.getAttribute('data-ruta');
            console.log(rutaArchivo);
            // Crear un enlace invisible y forzar la descarga
            const link = document.createElement('a');
            link.href = rutaArchivo;
            link.setAttribute('download', rutaArchivo.split('/').pop()); // Obtiene el nombre del archivo
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });
});
