// somescript.js

document.addEventListener("DOMContentLoaded", function() {
    var navItems = document.querySelectorAll(".mobile-bottom-nav__item");
    navItems.forEach(function(item) {
        item.addEventListener("click", function() {
            navItems.forEach(function(navItem) {
                navItem.classList.remove("mobile-bottom-nav__item--active");
            });
            this.classList.add("mobile-bottom-nav__item--active");
        });
    });
});
