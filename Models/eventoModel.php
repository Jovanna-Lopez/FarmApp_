<?php

class eventoModel extends Model{
   
 
    function __contruct()
    {
        parent::__contruct();



    }


   

    public function insertareven($farmacia,$actividad,
    $direccionevent,$fecha,$hora,$encargado,$imagenE){
    $this->_db->prepare('insert into evento(actividad,
    direccion,fecha,hora,encargado,imagen_invit,farmacia_id_farmacia)
    values(:actividad,:direccionevent,:fecha,:hora,:encargado,:imagenE,:farmacia)')
    ->execute(array('actividad'=>$actividad,
    'direccionevent'=>$direccionevent,'fecha'=>$fecha,'hora'=>$hora
    ,'encargado'=>$encargado,'imagenE'=>$imagenE,'farmacia'=>$farmacia));
    }

    public function insertarimagen($farmacia,$actividad,
    $directevent,$fecha,$hora,$encargado,$imagenE){
    $this->_db->prepare('insert into evento(actividad,
    direccion,fecha,hora,encargado,imagen_invit,farmacia_id_farmacia)
    values(:actividad,:direccionevent,:fecha,:hora,:encargado,:imagenE,:farmacia)')
    ->execute(array('actividad'=>$actividad,
    'directevent'=>$directevent,'fecha'=>$fecha,'hora'=>$hora
    ,'encargado'=>$encargado,'imagenE'=>$imagenE,'farmacia'=>$farmacia));
    }
public function actualizarvento($idevento,$farmaciaeditar,$actividadA,
$direccioneventA,$fechaA,$horaA,$encargadoA,$imageEA){
return $this->_db->prepare("update evento set
actividad=:actividadA,direccion=:direccioneventA,
fecha=:fechaA,hora=:horaA,encargado=:encargadoA,
imagen_invit=:imageEA,
farmacia_id_farmacia=:farmaciaeditar where id_evento=:idevento")
->execute(array('actividadA'=>$actividadA,
'direccioneventA'=>$direccioneventA,'fechaA'=>$fechaA
,'horaA'=>$horaA,'encargadoA'=>$encargadoA,'imageEA'=>$imageEA
,'farmaciaeditar'=>$farmaciaeditar,
'idevento'=>$idevento));
}

public function actualizarevento2($idevento,$farmaciaeditar,$actividadA,
$direccioneventA,$fechaA,$horaA,$encargadoA){
return $this->_db->prepare("update evento set
actividad=:actividadA,direccion=:direccioneventA,
fecha=:fechaA,hora=:horaA,encargado=:encargadoA,
farmacia_id_farmacia=:farmaciaeditar where id_evento=:idevento")
->execute(array('actividadA'=>$actividadA,
'direccioneventA'=>$direccioneventA,'fechaA'=>$fechaA
,'horaA'=>$horaA,'encargadoA'=>$encargadoA,'farmaciaeditar'=>$farmaciaeditar,
'idevento'=>$idevento));
}



    public function obtenerevento(){
        return $this->_db->query("select *from evento")->fetchAll();
    }

    public function obtenerfarmacia(){
        return $this->_db->query("select * from farmacia")->fetchAll();
    }




public function borrarevento($ideventoborrar){
    $this->_db->prepare('delete from evento where id_evento=:ideventoborrar')
    ->execute(array('ideventoborrar'=>$ideventoborrar));

}




}







?>