<?php

class loginModel extends Model{


    function __contruct()
    {
        parent::__contruct();



    }


    public function obteneru($user){
        $sql = "SELECT * from usuario WHERE nombre_usuario = BINARY ?";
        $query = $this->_db->prepare($sql);
        $query->execute(array($user));
        $result = $query->fetch(PDO::FETCH_BOTH);
        return $result;
        
    }

    public function numerofarmacias(){
        return $this->_db->query("select * from farmacia")->rowCount();
    }
    

    public function numeroventas(){
        return $this->_db->query("select * from ventas")->rowCount();
    }

    public function numeromedicamentos(){
        return $this->_db->query("select * from farmaco")->rowCount();
    }

    public function obtenerprofesores(){
        return $this->_db->query("select * from docente")->fetchAll();
    }

    public function agregargrup($axo,$sec,$tur,$mod,$prof){
         $this->_db->prepare('insert into grupos(axo,seccion,turno,modalidad,docente_id_docente)
         values(:axo,:sec,:tur,:mod,:prof)')->execute
         (array('axo'=>$axo, 'sec'=>$sec, 'tur'=>$tur, 'mod'=>$mod, 'prof'=>$prof ));
     }


     public function actualizargrup($idg,$axou,$secu,$turu,$modu,$profu){
         return $this->_db->prepare("update grupos set axo=:axou,seccion=:secu,turno=:turu,
         modalidad=:modu,docente_id_docente=:profu where id_grupo=:idg")->execute(array(
            'axou'=>$axou, 'secu'=>$secu, 'turu'=>$turu, 'modu'=>$modu, 'profu'=>$profu, 'idg'=>$idg));
     }

     public function borrargrup($id_g){
         $this->_db->prepare('delete from grupos where id_grupo=:id_g')->execute(array('id_g'=>$id_g));
     }

    


}

