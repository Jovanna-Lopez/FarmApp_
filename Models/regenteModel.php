<?php

class regenteModel extends Model{
   
 
    function __contruct()
    {
        parent::__contruct();



    }


   

    public function insertarreg($nom,$apell,$sex,$tel,$corr,$nombreu,$clave){
    $this->_db->prepare('insert into regente(nombres,apellidos,sexo,telefono,correo,nombre_usuario,clave)
    values(:nom,:apell,:sex,:tel,:corr,:nombreu,:clave)')->execute(array('nom'=>$nom,
    'apell'=>$apell,'sex'=>$sex,'tel'=>$tel,'corr'=>$corr
    ,'nombreu'=>$nombreu,'clave'=>$clave));

    $priv="regente";
    $this->_db->prepare('insert into usuario(nombre_usuario,password,privilegio)
    values(:nombreu,:clave,:priv)')->execute(array('nombreu'=>$nombreu,
    'clave'=>$clave,'priv'=>$priv));


    }


    public function editareg($idr,$nombu,$apellu,$sexu,$telu,$corru,$nombreup,$claveu){
    return $this->_db->prepare("update regente set
    nombres=:nombu,apellidos=:apellu,sexo=:sexu,telefono=:telu,correo=:corru,nombre_usuario=:nombreup,
    clave=:claveu where id_regente=:idr")
    ->execute(array('nombu'=>$nombu,
    'apellu'=>$apellu,'sexu'=>$sexu,'telu'=>$telu,'corru'=>$corru,'nombreup'=>$nombreup,'claveu'=>$claveu,'idr'=>$idr));
    }



    public function obtenerregente(){
        return $this->_db->query("select *from regente")->fetchAll();
    }

  




public function borrareg($idreg){
    $this->_db->prepare('delete from regente where id_regente=:idreg')
    ->execute(array('idreg'=>$idreg));

}




}







?>