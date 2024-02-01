<?php
// Supposons que vous avez déjà obtenu votre classement depuis la base de données
// Exemple simulé (remplacez cela par vos résultats réels)
$classement = [
    ['position' => 1, 'nom' => 'Utilisateur 1', 'points' => 100],
    ['position' => 2, 'nom' => 'Utilisateur 2', 'points' => 85],
    // Ajoutez d'autres entrées de classement ici...
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Classement</title>
</head>

<body>

<div class="container mt-5">
    <h2>Classement</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Points</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($classement as $joueur) : ?>
            <tr>
                <th scope="row"><?php echo $joueur['position']; ?></th>
                <td><?php echo $joueur['nom']; ?></td>
                <td><?php echo $joueur['points']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>

</html>
