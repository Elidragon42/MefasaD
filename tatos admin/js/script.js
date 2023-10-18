function eliminarTarea(idTarea){

    if(confirm("Deseas eliminar la tarea?")){
        location.replace("modulos/borrar_tarea.php?id_tarea=" + idTarea);
    }

}
