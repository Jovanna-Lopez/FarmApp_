<?php

class farmacoModel extends Model{
   
 
    function __contruct()
    {
        parent::__contruct();



    }


   

    public function insertarfarmaco($farmacia,$nombremedico,
    $nombrecomercial,$laboratorio,$estado,$peso,$volumen,$vencimiento,$tipo
    ,$precio,$delivery,$aplica,$precauciones,$reacciones,$interacciones,$image){
    $this->_db->prepare('insert into farmaco(nombre_medico,
    nombre_comercial,laboratorio,estado,peso,volumen,fecha_de_vencimiento,tipo,precio,aplicacion,delivery,precauciones,reacciones,interacciones,imagen,farmacia_id_farmacia)
    values(:nombremedico,:nombrecomercial,:laboratorio,:estado,:peso,:volumen
    ,:vencimiento,:tipo,:precio,:aplica,:delivery,:precauciones,:reacciones,:interacciones,:image,:farmacia)')->execute(array('nombremedico'=>$nombremedico,
    'nombrecomercial'=>$nombrecomercial,'laboratorio'=>$laboratorio,'estado'=>$estado
    ,'peso'=>$peso,'volumen'=>$volumen,'vencimiento'=>$vencimiento,'tipo'=>$tipo,'precio'=>$precio,'aplica'=>$aplica,'delivery'=>$delivery,'precauciones'=>$precauciones,'reacciones'=>$reacciones,'interacciones'=>$interacciones,'image'=>$image,'farmacia'=>$farmacia));
    }

    public function insertarimagen($farmacia,$nombremedico,$nombrecomercial,$laboratorio,$estado,$peso,$volumen,$vencimiento,$tipo,$cantidad,$precio,$aplica,$precauciones,$reacciones,$interacciones,$image){

        $this->_db->prepare('insert into farmaco(nombre_medico,nombre_comercial,laboratorio,estado,peso,volumen,fecha_de_vencimiento,tipo,cantidad,precio,aplicacion,precauciones,reacciones,interacciones,imagen,farmacia_id_farmacia)
        values(:nombremedico,:nombrecomercial,:laboratorio,:estado,:peso,:volumen,:vencimiento,:tipo,:cantidad,:precio,:aplica,:precauciones,:reacciones,:interacciones,:image,:farmacia)')->execute(array('nombremedico'=>$nombremedico,'nombrecomercial'=>$nombrecomercial,
        'laboratorio'=>$laboratorio,'estado'=>$estado,'peso'=>$peso,'volumen'=>$volumen,'vencimiento'=>$vencimiento,'tipo'=>$tipo,'cantidad'=>$cantidad,'precio'=>$precio,'aplica'=>$aplica,'precauciones'=>$precauciones,'reacciones'=>$reacciones,'interacciones'=>$interacciones,
        'image'=>$image,'farmacia'=>$farmacia));
        }

        public function actualizarfarmaco($idfarmaco,$farmaciaeditar,$nombremedicoA,
        $nombrecomercialA,$laboratorioA,$estadoA,$pesoA,$volumenA,$vencimientoA,$tipoA,$cantidadA
        ,$precioA,$aplicaA,$precaucionesA,$reaccionesA,$interaccionesA,$imageA){
        return $this->_db->prepare("update farmaco set
        nombre_medico=:nombremedicoA,nombre_comercial=:nombrecomercialA,
        laboratorio=:laboratorioA,estado=:estadoA,peso=:pesoA,
        volumen=:volumenA,fecha_de_vencimiento=:vencimientoA,tipo=:tipoA,cantidad=:cantidadA,
        precio=:precioA,aplicacion=:aplicaA,precauciones=:precaucionesA,reacciones=:reaccionesA,
        interacciones=:interaccionesA,imagen=:imageA,
        farmacia_id_farmacia=:farmaciaeditar where id_farmaco=:idfarmaco")
        ->execute(array('nombremedicoA'=>$nombremedicoA,
        'nombrecomercialA'=>$nombrecomercialA,'laboratorioA'=>$laboratorioA
        ,'estadoA'=>$estadoA,'pesoA'=>$pesoA
        ,'volumenA'=>$volumenA,'vencimientoA'=>$vencimientoA,'tipoA'=>$tipoA,'cantidadA'=>$cantidadA
        ,'precioA'=>$precioA,'aplicaA'=>$aplicaA,'precaucionesA'=>$precaucionesA,
        'reaccionesA'=>$reaccionesA,'interaccionesA'=>$interaccionesA,'imageA'=>$imageA
        ,'farmaciaeditar'=>$farmaciaeditar,
        'idfarmaco'=>$idfarmaco));
        }
        
            public function actualizarfarmaco2($idfarmaco,$farmaciaeditar,$nombremedicoA,
            $nombrecomercialA,$laboratorioA,$estadoA,$pesoA,$volumenA,$vencimientoA,$tipoA,$cantidadA
            ,$precioA,$aplicaA,$precaucionesA,$reaccionesA,$interaccionesA){
            return $this->_db->prepare("update farmaco set
            nombre_medico=:nombremedicoA,nombre_comercial=:nombrecomercialA,
            laboratorio=:laboratorioA,estado=:estadoA,peso=:pesoA,
            volumen=:volumenA,fecha_de_vencimiento=:vencimientoA,tipo=:tipoA,cantidad=:cantidadA,
            precio=:precioA,aplicacion=:aplicaA,precauciones=:precaucionesA,reacciones=:reaccionesA,
            interacciones=:interaccionesA,
            farmacia_id_farmacia=:farmaciaeditar where id_farmaco=:idfarmaco")
            ->execute(array('nombremedicoA'=>$nombremedicoA,
            'nombrecomercialA'=>$nombrecomercialA,'laboratorioA'=>$laboratorioA
            ,'estadoA'=>$estadoA,'pesoA'=>$pesoA
            ,'volumenA'=>$volumenA,'vencimientoA'=>$vencimientoA,'tipoA'=>$tipoA,'cantidadA'=>$cantidadA
            ,'precioA'=>$precioA,'aplicaA'=>$aplicaA,'precaucionesA'=>$precaucionesA,'reaccionesA'=>$reaccionesA,'interaccionesA'=>$interaccionesA
            ,'farmaciaeditar'=>$farmaciaeditar,
            'idfarmaco'=>$idfarmaco));
            }
        


    public function obtenerfarmaco(){
        return $this->_db->query("select *from farmaco")->fetchAll();
    }

    public function obtenerfarmacia(){
        return $this->_db->query("select * from farmacia")->fetchAll();
    }




public function borrarfarm($idfarmacoborrar){
    $this->_db->prepare('delete from farmaco where id_farmaco=:idfarmacoborrar')
    ->execute(array('idfarmacoborrar'=>$idfarmacoborrar));

}




}







?>