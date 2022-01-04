<?php
include_once "vue/Vue.php";
class vueAuthentification extends Vue {

public function affiche(){
include("headerAuth.html");
if(isset($_GET['error']) &&$_GET['error']=="login" ){echo "<p>Votre session a expirée</p>";}
include("auth.html");

include("footer.html");
}
}
?>