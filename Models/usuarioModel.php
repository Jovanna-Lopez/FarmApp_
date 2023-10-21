<?php

class usuarioModel extends Model{
   
 
    function __contruct()
    {
        parent::__contruct();



    }


   

    public function insertarus($nombreU,$claveU,$privilegio){
        $hash=password_hash($claveU, PASSWORD_DEFAULT);
    $this->_db->prepare('insert into usuario(nombre_usuario,password,privilegio)
    values(:nombreU,:hash,:privilegio)')->execute(array(':nombreU'=>$nombreU,
    'hash'=>$hash,'privilegio'=>$privilegio));



    }

    public function editarusua($idusuario,$nombreusuarioA,$claveuA,$privilegioA){
        return $this->_db->prepare("update regente set
        nombre_usuario=:nombreusuarioA,password=:claveuA,privilegio=:privilegioA where id_usuario=:id_usuario")
        ->execute(array('nombreusuarioA'=>$nombreusuarioA,
        'claveuA'=>$claveuA,'privilegioA'=>$privilegioA,'id_usuario'=>$idusuario));
        }


    public function obtenerusuario(){
        return $this->_db->query("select *from usuario")->fetchAll();
    }

  




public function borrarusu($idusuario){
    $this->_db->prepare('delete from usuario where id_usuario=:id_usuario')
    ->execute(array('id_usuario'=>$idusuario));

}




}







?>