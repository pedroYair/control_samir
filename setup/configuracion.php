<?php
    // credenciales de conexion

    $usuario = "root";
    $clave = "";
    $bd = "control_samir";
    $host = "localhost";

    $cnx = @mysqli_connect( $host, $usuario, $clave, $bd);

    if($cnx)
    {
        mysqli_set_charset( $cnx, 'utf8mb4' );
        echo "Conectado a la bd $bd";
    }

    
    session_start();

    // verifica que el usuario tenga el nivel de administrador para hacer cambios en el panel de control
    function verificar_seguridad($nivel = "administrador")
    {
        return $_SESSION['NIVEL'] == $nivel;
    }
    
    //para asegurar la bd de ataques por inyeccion sql
    function escape($valor)
    {
        global $cnx; // porque esta variable no se le pasa a la funcion escape como argumento sino que lo toma de fuera
        return mysqli_real_escape_string($cnx, $valor);
    }
?>