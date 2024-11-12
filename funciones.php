

<?php 
/* Documento que contiene funciones frecuentemente utilizadas */



function consultaSQL($query){
  $local=true;
  if($local){
    $link=mysqli_connect("localhost","root","","u174220854_shopping") or die("Hubo un error al conectarse con la base de datos");
  } else {
    $link=mysqli_connect("127.0.0.1:3306","u174220854_eg_shopping",'6qAGB$Hhtq&@ma+',"u174220854_shopping") or die("Hubo un error al conectarse con la base de datos");
  }
  
  $resultados = mysqli_query($link,$query) or die("Hubo un error con la transacción:".mysqli_error($link));
  mysqli_close($link);
  return $resultados;
}



function mailExiste($email){
    $query = "SELECT * FROM usuarios WHERE nombreUsuario='$email'";
    $vResultado = consultaSQL($query);
      
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

function actualizarNovedades(){
  
$query= "SELECT * FROM novedades WHERE estado='activa' AND fechaHasta<'".date('Y-m-d')."'";
$rta=consultaSQL($query);
if(mysqli_num_rows($rta)>0){
  while($fila=mysqli_fetch_array($rta)){
    $query2="UPDATE novedades SET estado='inactiva' WHERE cod='".$fila['cod']."'";
    $rta2= consultaSQL($query2);
  }
  }
  }


function actualizarDescuentos(){
  
  $query= "SELECT * FROM promociones WHERE estadoPromo='activa' AND fechaHasta<'".date('Y-m-d')."'";
  $rta=consultaSQL($query);
  if(mysqli_num_rows($rta)>0){
    while($fila=mysqli_fetch_array($rta)){
      $query2="UPDATE promociones SET estadoPromo='inactiva' WHERE cod='".$fila['cod']."'";
      $rta2= consultaSQL($query2);
    }
  
  }
  }
?>

