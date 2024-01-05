document.addEventListener('DOMContentLoaded', function() {

    var currentURL = window.location.href;

        // Vérifier si l'URL se termine par "scoruche.php"
        if (!currentURL.endsWith("scoruche.php")) {
            // Si l'URL ne se termine pas par "scoruche.php", masquer l'élément avec la classe "videoContainer"
            var videoContainer = document.querySelector('.videoContainer');
            if (videoContainer) {
                videoContainer.style.display = 'none';
            }
        }
});