<?php
require_once "vue/Vue.php";
class vueAjoutLivre extends Vue {
	function affiche(){
	include "header.html";
        include "menu.php";
        echo '<div class="covered-img">';
        echo ' <div class="container">';
       
        echo "<form method='post' action='index.php?action=validLivre&id=".$_SESSION['token']."required'>";
        echo " <div class='form-group'>";
        echo " <div class='form-row'>";
        echo "<label class='col-md-3' for='titre'>Titre</label>";
        echo '<input id="nom" type="text" class="form-control" name="titre" placeholder="Entrer le titre" required>';
        echo '</div>';
        echo " <div class='form-row'>";
        echo "<label for='auteur'>Auteur</label>";
        echo '<input id="auteur" type="text" class="form-control" name="auteur" placeholder="Entrer l \'auteur" required>';
        echo '</div>';
        echo " <div class='form-row'>";
        echo "<label for='edition'>Edition</label>";
        echo '<input id="edition" type="text" class="form-control" name="edition" placeholder="Entrer l \'édition" required>';
        echo '</div>';
        echo " <div class='form-row'>";
        echo "<label for='info'>Information</label>";
        echo '<input id="info" type="text" class="form-control" name="auteur" placeholder="Entrer les informations du livre">';
        echo '</div>';
        echo " <div class='form-group'>";
       echo '<div class="form-check">';
       echo '<input class="form-check-input" type="checkbox" value="" id="ok" >';
       echo '<label class="form-check-label" for="ok">Le livre est il en bonne état?</label>';
       echo '</div>';
        echo '<button class="btn btn-primary" type="submit">Ajouter</button>';
        echo "</form>";
        echo '</div>';
        echo '</div>';
        echo '</div>';




include "footer.html";
        }	
	
}