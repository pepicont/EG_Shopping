

<?php 
/* Documento que contiene funciones frecuentemente utilizadas */



function consultaSQL($query){
  $local=true;
  if($local){
    $link=mysqli_connect("localhost","root","","shopping") or die("Hubo un error al conectarse con la base de datos");
  } else {
    $link=mysqli_connect("127.0.0.1:3306","u174220854_eg_shopping",'6qAGB$Hhtq&@ma+',"u174220854_shopping") or die("Hubo un error al conectarse con la base de datos");
  }
  
  $resultados = mysqli_query($link,$query) or die("Hubo un error con la transacción:".mysqli_error($link));
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
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
    if(isset($_COOKIE['mantenerSesionIniciada'])) {
        $_SESSION['usuario'] = $_COOKIE['usuario'];
        $_SESSION['tipoUsuario'] = $_COOKIE['tipoUsuario'];
        $_SESSION['idUsuario'] = $_COOKIE['idUsuario'];
        
        if($_COOKIE['tipoUsuario']=='cliente'){
          $_SESSION['categoriaCliente'] = $_COOKIE['categoriaCliente'];
        }
          return TRUE;
      }else{
        return FALSE;
      }
}
?>

