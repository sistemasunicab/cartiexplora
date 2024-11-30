
/*Inicio java Script para el componente Navbar*/

document.addEventListener('DOMContentLoaded', () => {
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

        // Mostrar dropdown al entrar el mouse
        item.addEventListener('mouseenter', () => {
            if (dropdown) {
                menuItem.classList.add('hover');
                dropdown.style.display = 'flex';
                dropdown.style.flexDirection = 'column';
            }
        });

        // Ocultar dropdown al salir del nav-item
        item.addEventListener('mouseleave', () => {
            if (dropdown) {
                // Verifica si el mouse está dentro del dropdown o de algún dropdown2 antes de ocultar
                const isInDropdown = isMouseInElement(dropdown);
                const isInAnyDropdown2 = Array.from(dropdownItems).some(dropdownItem => {
                    const submenuId = dropdownItem.id;
                    const dropdown2 = document.querySelector(`#${submenuId.replace('.', '\\.')}_dropdown`);
                    return isMouseInElement(dropdown2);
                });

                if (!isInDropdown && !isInAnyDropdown2) {
                    menuItem.classList.remove('hover');
                    dropdown.style.display = 'none';

                    // Ocultar dropdown2
                    dropdownItems.forEach(dropdownItem => {
                        const dropdown2 = document.querySelector(`#${dropdownItem.id.replace('.', '\\.')}_dropdown`);
                        if (dropdown2) {
                            dropdown2.style.display = 'none';
                        }
                    });
                }
            }
        });

        // Mostrar dropdown2 al pasar sobre un dropdown-item
        dropdownItems.forEach(dropdownItem => {
            const submenuId = dropdownItem.id;
            const dropdown2 = document.querySelector(`#${submenuId.replace('.', '\\.')}_dropdown`);

            if (dropdown2) {
                dropdownItem.addEventListener('mouseenter', () => {
                    if (dropdown2) {
                        dropdownItem.classList.add('hover');
                        dropdown2.style.display = 'flex';
                    }
                });

                dropdownItem.addEventListener('mouseleave', () => {
                    if (!isMouseInElement(dropdown2)) {
                        dropdownItem.classList.remove('hover');
                        dropdown2.style.display = 'none';
                    }
                });

                // Asegurar que el mouse dentro del dropdown2 mantenga su visibilidad
                dropdown2.addEventListener('mouseenter', () => {
                    dropdown2.style.display = 'flex';
                });

                dropdown2.addEventListener('mouseleave', () => {
                    dropdown2.style.display = 'none';
                    dropdownItem.classList.remove('hover');
                });
            }
        });
    });
});

/*Fin java Script para el componente Navbar*/