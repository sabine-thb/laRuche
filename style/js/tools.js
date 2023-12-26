function confirmerRefusezUser(nom,id) {
    // Utilisez la fonction confirm pour afficher une boîte de dialogue
    const confirmation = confirm("Êtes-vous sûr de vouloir refusez " + nom + " ?");

    // Si l'utilisateur clique sur "OK", la page sera redirigée
    if (confirmation) {
        window.location.href = "admin.php?action=refuser&id=" + id;
    }
}