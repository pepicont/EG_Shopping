

<?php 
/* Documento que contiene funciones frecuentemente utilizadas */


function mailExiste($email){
    include("conexiones/conexion.inc");
    $query = "SELECT * FROM usuarios WHERE nombreUsuario='$email' ";
    $vResultado = mysqli_query($link, $query) or die (mysqli_error($link));
      $fila = mysqli_fetch_array($vResultado);
      if(mysqli_num_rows($vResultado) == 0) {
      return FALSE;}
      else{
        return TRUE;
      }
}

function existecookie(){
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
    if(isset($_COOKIE['mantenerSesionIniciada'])) {
        $_SESSION['usuario'] = $_COOKIE['usuario'];
        $_SESSION['tipoUsuario'] = $_COOKIE['tipoUsuario'];
        if($_COOKIE['tipoUsuario']=='cliente'){
          $_SESSION['categoriaCliente'] = $_COOKIE['categoriaCliente'];}
          return TRUE;
      }else{
        return FALSE;
      }
}
?>