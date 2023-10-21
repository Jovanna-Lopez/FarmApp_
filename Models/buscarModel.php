<?php

class buscarModel extends Model{
   
 
    function __contruct()
    {
        parent::__contruct();



    }

 
   

    public function obtenerdatos(){
        return $this->_db->query("select * from farmacia")->fetchAll();
    }

    public function obtenerlaboratorios(){
        return $this->_db->query("select distinct laboratorio from farmaco")->fetchAll();
    }

    public function obtenerestado(){
        return $this->_db->query("select distinct estado from farmaco")->fetchAll();
    }

    public function obtenerdelivery(){
        return $this->_db->query("select distinct delivery from farmacia")->fetchAll();
    }

    public function insertarcompra($idfarmaco,$nombrecompra,$cantidadcompra,$numerocompra,$direccioncompra,$costo,$fecha,$hora,$image){

        $this->_db->prepare('insert into compras(farmaco_id_farmaco,nombre_y_apellido_comprador,cantidad_compra,telefono_comprador,direccion_entrega,costo,fecha_solicitud,hora_solicitud,imagen)
        values(:idfarmaco,:nombrecompra,:cantidadcompra,:numerocompra,:direccioncompra,:costo,:fecha,:hora,:image)')->execute(array('idfarmaco'=>$idfarmaco,'nombrecompra'=>$nombrecompra,'cantidadcompra'=>$cantidadcompra,'numerocompra'=>$numerocompra,'direccioncompra'=>$direccioncompra,'costo'=>$costo,'fecha'=>$fecha,'hora'=>$hora,'image'=>$image));          
}
    

    
    public function numeromedicamentos(){
        return $this->_db->query("select * from farmaco")->rowCount();
    }

    public function buscarfarmaco($bus){
        if(mb_strlen($bus) == 0){

        }
        else{
        $parametro='%'.$bus.'%';
       
        $stmt=$this->_db->prepare("SELECT *FROM farmaco inner join farmacia on (farmacia_id_farmacia = id_farmacia) WHERE nombre_medico like :parametro");
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


    public function filtrado($buscar,$laboratorio,$estados,$delive){
        if($laboratorio !==0 && $estados !=="" ){

                $parametro='%'.$buscar.'%';
       
                $stmt=$this->_db->prepare("SELECT *FROM farmaco inner join farmacia on (farmacia_id_farmacia = id_farmacia) WHERE nombre_medico like :parametro and laboratorio=:laboratorio and estado=:estados");
                $stmt->execute(array(':parametro'=>$parametro,':laboratorio'=>$laboratorio,':estados'=>$estados));
                $contar=$stmt->rowCount();  
                    $count=$stmt->fetchAll();
                    return $count;
            } 
            elseif($laboratorio !==0){
                $parametro='%'.$buscar.'%';
       
                $stmt=$this->_db->prepare("SELECT *FROM farmaco inner join farmacia on (farmacia_id_farmacia = id_farmacia) WHERE nombre_medico like :parametro and laboratorio=:laboratorio");
                $stmt->execute(array(':parametro'=>$parametro,':laboratorio'=>$laboratorio));
                $contar=$stmt->rowCount();  
                    $count=$stmt->fetchAll();
                    return $count;
                
    

            }

            elseif(!empty($laboratorio) && !empty($delive) ){
                $parametro='%'.$buscar.'%';
       
                $stmt=$this->_db->prepare("SELECT *FROM farmaco inner join farmacia on (farmacia_id_farmacia = id_farmacia) WHERE nombre_medico like :parametro and laboratorio=:laboratorio and delivery=:delive");
                $stmt->execute(array(':parametro'=>$parametro,':laboratorio'=>$laboratorio,':delive'=>$delive));
                $contar=$stmt->rowCount();  
                    $count=$stmt->fetchAll();
                    return $count;
                
    

            }







        
    }   

    public function limpiarfiltrado($buscar){
        if(mb_strlen($buscar) == 0){

        }
        else{
        $parametro='%'.$buscar.'%';
       
        $stmt=$this->_db->prepare("SELECT *FROM farmaco inner join farmacia on (farmacia_id_farmacia = id_farmacia) WHERE nombre_medico like :parametro");
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