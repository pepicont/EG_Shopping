

<?php 
/* Documento que contiene funciones frecuentemente utilizadas */

function consultaSQL($query){
  $link=mysqli_connect("localhost","root","","shopping") or die("Hubo un error al conectarse con la base de datos");
  $resultados=mysqli_query($link,$query);
  mysqli_close($link);
  return $resultados;


}

function mailExiste($email){
    $query = "SELECT * FROM usuarios WHERE nombreUsuario='$email' ";
    $vResultado = consultaSQL($query);
      $fila = mysqli_fetch_array($vResultado);
      if(mysqli_num_rows($vResultado) == 0) {
      return FALSE;}
      else{
        return TRUE;
      }


}

function existecookie(){
    if(isset($_COOKIE['mantenerSesionIniciada'])) {
        $_SESSION['usuario'] = $_COOKIE['usuario'];
        if($_COOKIE['tipoUsuario']=='cliente'){
          $_SESSION['tipoUsuario'] = $_COOKIE['tipoUsuario'];
          $_SESSION['categoriaCliente'] = $_COOKIE['categoriaCliente'];}
        return TRUE;
      }else{
        return FALSE;
      }
}


?>