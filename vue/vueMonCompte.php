<?php

require_once "vue/Vue.php";
class vueMonCompte extends Vue
{
    function affiche()
    {
        include("header.html");
        if (isset($_GET['error']) && $_GET['error'] == "login") {
            echo "<p>Votre session a expirée</p>";
        }
        include("auth.html");
        include("footer.html");
    }
}
