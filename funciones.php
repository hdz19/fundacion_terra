<?php
function EVENT_BITACORA($id_usuario,$id_objeto,$accion,$descripcion){
        //CONEXION A LA BASE DE DATOS
        $Date1 = date('Y-m-d');
        $conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
        $bitacora = mysqli_query($conexion, "INSERT INTO tbl_ms_bitacora
                (id_usuario, id_objeto, fecha, accion, descripcion) values
                 ('$id_usuario','$id_objeto','$Date1','$accion','$descripcion')");

        return $bitacora->num_rows; 
}