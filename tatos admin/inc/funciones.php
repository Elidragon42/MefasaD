<?php

function mostrarMensaje(){
    if(isset($_SESSION['mensaje'])){
        echo '<div id="mensaje">';
        echo '<p>'.$_SESSION['mensaje'].'</p>';
        echo '</div>';
        $_SESSION['mensaje'] = null;
        $_SESSION['validacion'] = null;
    }
}