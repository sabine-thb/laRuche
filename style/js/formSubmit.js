// AMELIO-2 — Feedback visuel pendant les soumissions de formulaire
// Désactive le bouton submit au moment de l'envoi pour éviter les double-soumissions

document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('submit', function (e) {
        var form = e.target;
        var submitBtn = form.querySelector('[type="submit"]');

        if (!submitBtn) return;

        submitBtn.disabled = true;
        submitBtn.classList.add('btn-chargement');

        if (submitBtn.tagName === 'INPUT') {
            submitBtn.value = 'Chargement...';
        } else {
            submitBtn.textContent = 'Chargement...';
        }
    });
});
