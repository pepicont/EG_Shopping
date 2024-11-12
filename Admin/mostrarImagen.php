<?php 
include("../funciones.php");

if (!empty($_GET['codLocal']) && is_numeric($_GET['codLocal'])) {
    $codLocal = intval($_GET['codLocal']); // Asegúrate de que es un entero
    $query = "SELECT imagen FROM locales WHERE codLocal = $codLocal";
    $resultado = consultaSQL($query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_array($resultado);
        $imagen = $fila['imagen'];

        if ($imagen) {
            // Verifica el tipo MIME de la imagen
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_buffer($finfo, $imagen);
            finfo_close($finfo);

            header("Content-Type: $mime_type");
            echo $imagen;
        } else {
            // Manejar el caso en que no se encuentre la imagen
            header("Content-Type: text/plain");
            echo "Imagen no encontrada.";
        }
    } else {
        // Manejar el caso en que no se encuentre el registro
        header("Content-Type: text/plain");
        echo "Registro no encontrado.";
    }
} else {
    // Manejar el caso en que no se proporcione codLocal o no sea numérico
    header("Content-Type: text/plain");
    echo "Código de local no proporcionado o no válido.";
}
?>