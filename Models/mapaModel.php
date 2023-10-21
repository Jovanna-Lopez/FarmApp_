<?php

class mapaModel extends Model{
   
 
    function __contruct()
    {
        parent::__contruct();


 
    }

    public function insertarcompra($idfarmaco,$nombrecompra,$cantidadcompra,$numerocompra,$direccioncompra,$costo,$fecha,$hora,$image){

        $this->_db->prepare('insert into compras(farmaco_id_farmaco,nombre_y_apellido_comprador,cantidad_compra,telefono_comprador,direccion_entrega,costo,fecha_solicitud,hora_solicitud,imagen)
        values(:idfarmaco,:nombrecompra,:cantidadcompra,:numerocompra,:direccioncompra,:costo,:fecha,:hora,:image)')->execute(array('idfarmaco'=>$idfarmaco,'nombrecompra'=>$nombrecompra,'cantidadcompra'=>$cantidadcompra,'numerocompra'=>$numerocompra,'direccioncompra'=>$direccioncompra,'costo'=>$costo,'fecha'=>$fecha,'hora'=>$hora,'image'=>$image));          
}
 
    public function obtenerdatos(){
        return $this->_db->query("select * from farmacia")->fetchAll();
    }

    public function numerofarmacias(){
        return $this->_db->query("select * from farmacia")->rowCount();
    }
    public function numeromedicamentos(){
        return $this->_db->query("select * from farmaco")->rowCount();
    }

    public function buscarfarmacias($busq){
        if(mb_strlen($busq) == 0){

        }
        else{
        $parametro='%'.$busq.'%';
       
        $stmt=$this->_db->prepare("SELECT *FROM farmaco inner join farmacia on (farmacia_id_farmacia = id_farmacia)
         WHERE nombre_medico like :parametro");
        $stmt->execute(array(':parametro'=>$parametro));
        $contar=$stmt->rowCount();  
      
        if($contar==0)
        {
         echo "<span id='prueba' estado='false' style='color:brown;'> <strong>Oh no!</strong> Farmaco no encontrado !!!</span>";
        }
        else
        {
            $count=$stmt->fetchAll();
            return $count;
        }

       
          
           


    }
    }

    




}







?>