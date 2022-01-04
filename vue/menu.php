<?php


echo '<div class="container">';

echo '<nav class="navbar navbar-expand-lg navbar-light" style="background-color: transparent ">';
echo '<ul class="nav justify-content-center">';
echo '  <li class="nav-item"><a class="nav-link" href="index.php?action=accueil&id='.$_SESSION["token"].'">Accueil</a></li>';
echo '<li class="nav-item"><a class="nav-link" href="index.php?action=ajoutLivre&id='.$_SESSION["token"].'">Ajouter un livre</a></li>';
echo '<li class="nav-item"><a class="nav-link" href="index.php?action=allLivre&id='.$_SESSION["token"].'">Liste des livres</a></li>';
echo '  <li class="nav-item"><a class="nav-link" href="index.php?action=gestionLivre&id='.$_SESSION["token"].'">Gdstion des livres</a></li>';
echo '  <li class="nav-item"><a class="nav-link" href="index.php?action=moncompte&id='.$_SESSION["token"].'">Mon Compte</a></li>';
echo '  <li class="nav-item"><a class="nav-link " href="index.php">Déconnexion</a></li>';
echo '</ul>';
echo '</nav>';


?>