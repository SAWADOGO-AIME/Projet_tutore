document.addEventListener("DOMContentLoaded", function() {
    const toggleMenu = document.querySelector(".toggle_menu");
    const navMenu = document.querySelector(".nav ul");

    toggleMenu.addEventListener("click", function() {
        navMenu.classList.toggle("active");
        toggleMenu.classList.toggle("active");

        if (toggleMenu.classList.contains("active")) {
            toggleMenu.innerHTML = `<div class="close_icon"></div>`;
        } else {
            toggleMenu.innerHTML = `
                <div class="menu_icon"></div>
                <div class="menu_icon"></div>
                <div class="menu_icon"></div>`;
        }
    });
});



