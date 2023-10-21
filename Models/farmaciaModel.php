<?php

class farmaciaModel extends Model{
   
 
    function __contruct()
    {
        parent::__contruct();



    }


   

    public function insertarfarm($duexo,$nombre,$registro,
    $direccion,$latitud,$longitud,$telefono,$abierto,$cierre,$delivery,$image){
    $this->_db->prepare('insert into farmacia(nombre,
    registro,direccion,latitud,longitud,telefono,hora_abre,hora_cierre,delivery,imagen_farm,regente_id_regente)
    values(:nombre,:registro,:direccion,:latitud,:longitud,:telefono
    ,:hora_abre,:hora_cierre,:delivery,:image,:duexo)')->execute(array('nombre'=>$nombre,
    'registro'=>$registro,'direccion'=>$direccion,'latitud'=>$latitud
    ,'longitud'=>$longitud
    ,'telefono'=>$telefono,'hora_abre'=>$abierto,'hora_cierre'=>$cierre,'delivery'=>$delivery,'image'=>$image,'duexo'=>$duexo));
    }
    public function insertarfarm2($duexo,$nombre,$registro,
    $direccion,$latitud,$longitud,$telefono,$abierto,$cierre,$delivery){
    $this->_db->prepare('insert into farmacia(nombre,
    registro,direccion,latitud,longitud,telefono,hora_abre,hora_cierre,delivery,regente_id_regente)
    values(:nombre,:registro,:direccion,:latitud,:longitud,:telefono
    ,:abierto,:cierre,:delivery,:duexo)')->execute(array('nombre'=>$nombre,
    'registro'=>$registro,'direccion'=>$direccion,'latitud'=>$latitud
    ,'longitud'=>$longitud
    ,'telefono'=>$telefono,'abierto'=>$abierto,'cierre'=>$cierre,'delivery'=>$delivery,'duexo'=>$duexo));
    }

    public function numerofarmacias(){
        return $this->_db->query("select * from farmacia")->rowCount();
    }
    public function numeromedicamentos(){
        return $this->_db->query("select * from farmaco")->rowCount();
    }

   public function insertarimagen($duexo,$nombre,$registro,
    $direccion,$latitud,$longitud,$telefono,$abierto,$cierre,$imagenf){
    $this->_db->prepare('insert into farmacia(nombre,
    registro,direccion,latitud,longitud,telefono,hora_abre,hora_cierre,imagen_farm,regente_id_regente)
    values(:nombre,:registro,:direccion,:latitud,:longitud,:telefono
    ,:hora_abre,:hora_cierre,:imagen_farm:duexo)')->execute(array('nombre'=>$nombre,
    'registro'=>$registro,'direccion'=>$direccion,'latitud'=>$latitud
    ,'longitud'=>$longitud
    ,'telefono'=>$telefono,'hora_abre'=>$abierto,'hora_cierre'=>$cierre,'imagen_farm'=>$imagenf,'duexo'=>$duexo));
    }    

 

    public function actualizarfar($idfarm,$duexoup,$nombreup,$registroup,
    $direccionup,$latitudup,$longitudup,$telefonoup,$abiertoup,$cierreup,$deliveryu,$imageA){
    return $this->_db->prepare("update farmacia set
    nombre=:nombreup,registro=:registroup,direccion=:direccionup,latitud=:latitudup,
    longitud=:longitudup,telefono=:telefonoup,hora_abre=:abiertoup,
    hora_cierre=:cierreup,delivery=:deliveryu,imagen_farm=:imageA,regente_id_regente=:duexoup where id_farmacia=:idfarm")
    ->execute(array('nombreup'=>$nombreup,
    'registroup'=>$registroup,'direccionup'=>$direccionup,'latitudup'=>$latitudup
    ,'longitudup'=>$longitudup,'telefonoup'=>$telefonoup,'abiertoup'=>$abiertoup,'cierreup'=>$cierreup,'deliveryu'=>$deliveryu,'imageA'=>$imageA,'duexoup'=>$duexoup,'idfarm'=>$idfarm));
    }
    public function actualizarfar2($idfarm,$duexoup,$nombreup,$registroup,
    $direccionup,$latitudup,$longitudup,$telefonoup,$abiertoup,$cierreup,$deliveryu){
    return $this->_db->prepare("update farmacia set
    nombre=:nombreup,registro=:registroup,direccion=:direccionup,latitud=:latitudup,
    longitud=:longitudup,telefono=:telefonoup,hora_abre=:abiertoup,
    hora_cierre=:cierreup,delivery=:deliveryu,regente_id_regente=:duexoup where id_farmacia=:idfarm")
    ->execute(array('nombreup'=>$nombreup,
    'registroup'=>$registroup,'direccionup'=>$direccionup,'latitudup'=>$latitudup
    ,'longitudup'=>$longitudup,'telefonoup'=>$telefonoup,'abiertoup'=>$abiertoup,'cierreup'=>$cierreup,'deliveryu'=>$deliveryu,'duexoup'=>$duexoup,'idfarm'=>$idfarm));
    }




    public function obtenerfarm(){
        return $this->_db->query("select *from farmacia")->fetchAll();
    }

    public function obteneregente(){
        return $this->_db->query("select *from regente")->fetchAll();
    }

public function borrarfarm($idfarmacia){
    $this->_db->prepare('delete from farmacia where id_farmacia=:idfarmacia')
    ->execute(array('idfarmacia'=>$idfarmacia));

}




}







?>