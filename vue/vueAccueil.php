<?php
include_once "vue/Vue.php";
class vueAccueil extends Vue {
	
function affiche(){

include "header.html";
include "menu.php";

echo '<div class="covered-img">';
echo ' <div class="container">';
echo '<p class="lead"><p>Bienvenue '.$_SESSION['nom'].'!</p>';
echo "<p class='font-italic'> Cette application web va permettre de nous familiariser avec :<p>";
echo '<ul class=\'font-italic\'>';
echo ' <li><a href="https://openclassrooms.com/fr/courses/4670706-adoptez-une-architecture-mvc-en-php/4678736-comment-fonctionne-une-architecture-mvc" target="_blank">l \'architecture MVC (Modèle Vue Controller)</a></li>';
echo ' <li><a href="https://www.php.net/" target="_blank">PHP</a></li>';
echo ' <li><a href="https://phpunit.readthedocs.io/en/9.5/" target="_blank">Les tests unitaires (PHPUNIT)</a></li>';
echo ' <li><a href="https://www.php.net/manual/fr/book.pdo.php" target="_blank">PDO (PHP DATA OBJECT)</a></li>';
echo ' <li><a href="https://www.pierre-giraud.com/bootstrap-apprendre-cours/" target="_blank">BootStrap</a></li>';
echo ' <li><a href="https://jquery.com/" target="_blank">JQuery</a></li>';
echo ' <li><a href="https://developer.mozilla.org/fr/docs/Web/Guide/AJAX" target="_blank">Ajax</a></li>';
echo ' <li><a href="https://firebase.google.com/" target="_blank">L\' API Firebase</a></li>';
echo '</ul>';

echo '</div>';
echo '</div>';

include "footer.html";
 }
}