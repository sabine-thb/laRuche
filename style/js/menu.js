document.addEventListener('DOMContentLoaded', function () {
    var hamburger = document.getElementById('hamburger');
    var navbar = document.getElementById('navbar');

    if (!hamburger || !navbar) return;

    hamburger.addEventListener('click', function () {
        hamburger.classList.toggle('open');
        navbar.classList.toggle('open');
    });

    // Fermer le menu au clic en dehors
    document.addEventListener('click', function (e) {
        if (!hamburger.contains(e.target) && !navbar.contains(e.target)) {
            hamburger.classList.remove('open');
            navbar.classList.remove('open');
        }
    });

    // Fermer le menu après avoir cliqué sur un lien
    navbar.querySelectorAll('.linkNavbar').forEach(function (link) {
        link.addEventListener('click', function () {
            hamburger.classList.remove('open');
            navbar.classList.remove('open');
        });
    });
});
