<?php

class ventasModel extends Model{
   
 
    function __contruct()
    {
        parent::__contruct();



    }


   

    public function insertarfarm($duexo,$nombre,$registro,
    $direccion,$latitud,$longitud,$telefono,$abierto,$cierre){
    $this->_db->prepare('insert into farmacia(nombre,
    registro,direccion,latitud,longitud,telefono,hora_abre,hora_cierre,regente_id_regente)
    values(:nombre,:registro,:direccion,:latitud,:longitud,:telefono
    ,:hora_abre,:hora_cierre,:duexo)')->execute(array('nombre'=>$nombre,
    'registro'=>$registro,'direccion'=>$direccion,'latitud'=>$latitud
    ,'longitud'=>$longitud
    ,'telefono'=>$telefono,'hora_abre'=>$abierto,'hora_cierre'=>$cierre,'duexo'=>$duexo));
    }
 

    public function actualizarfar($idfarm,$duexoup,$nombreup,$registroup,
    $direccionup,$latitudup,$longitudup,$telefonoup,$abiertoup,$cierreup){
    return $this->_db->prepare("update farmacia set
    nombre=:nombreup,registro=:registroup,direccion=:direccionup,latitud=:latitudup,
    longitud=:longitudup,telefono=:telefonoup,hora_abre=:abiertoup,
    hora_cierre=:cierreup,regente_id_regente=:duexoup where id_farmacia=:idfarm")
    ->execute(array('nombreup'=>$nombreup,
    'registroup'=>$registroup,'direccionup'=>$direccionup,'latitudup'=>$latitudup
    ,'longitudup'=>$longitudup
    ,'telefonoup'=>$telefonoup,'abiertoup'=>$abiertoup,'cierreup'=>$cierreup,'duexoup'=>$duexoup,'idfarm'=>$idfarm));
    }



    public function obtenerventas(){
        return $this->_db->query("select *from ventas")->fetchAll();
    }

    public function obteneregente(){
        return $this->_db->query("select *from regente")->fetchAll();
    }

public function confir($idconfirmar){
    $this->_db->prepare('delete from compras where id_compras=:idconfirmar')
    ->execute(array('idconfirmar'=>$idconfirmar));

}




}







?>