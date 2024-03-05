<section>
    <div class="mini-jeu-container">
        <div class="container">
            <a class="btn-mini-jeu hiddenOnMobile" href="competition.php?action=babSnake&id=<?php echo $_GET['id']; ?>"
               id="babSnake">
                <p>babSnake</p>
            </a>
            <a class="btn-mini-jeu" href="competition.php?action=hulkV45&id=<?php echo $_GET['id']; ?>">
                <p>Les45FoudroitLesHulk</p>
            </a>
        </div>
    </div>
</section>
<script>
    if (window.matchMedia('(pointer: fine)').matches) {
        const e = document.getElementById('babSnake');
        if (e) e.classList.remove('hiddenOnMobile');
    }
</script>