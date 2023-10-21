<?php


class ventasController extends Controller{
 private $_ven;

function __construct()
{
    parent::__construct();
    $this->_ven=$this->loadModel("ventas");
}



public function verventas(){
    $fila=$this->_ven->obtenerventas();
    $tabla='';
    for($i=0;$i<count($fila);$i++){
        $datos=json_encode($fila[$i]); 
        $tabla.='
        <tr>
        <td><img src=Views/plantilla/assets/img/'.$fila[$i]['imagen'].' class="img-thumbnail" width="50" height="40"></td>
        <td>'.$fila[$i]['nombre_y_apellido_comprador'].'</td>
        <td>'.$fila[$i]['cantidad_vendida'].'</td>
        <td>'.$fila[$i]['telefono_comprador'].'</td>
        <td>'.$fila[$i]['monto_venta'].'</td>
        <td>'.$fila[$i]['direccion_entrega'].'</td>
        <td>'.$fila[$i]['fecha_solicitud'].'</td>
        <td>'.$fila[$i]['hora_solicitud'].'</td>
       
        <td>
        <button data-confirmar='.$fila[$i]['id_venta'].' class="btn btn-info btn-circle btconfirmarcompra"> <i class="fa fa-print"></i></button>
        
    



        </td>




        </tr>';
    }
    return $tabla;


}

public function index()
{
$this->_view->tabla=$this->verventas();
$this->_view->renderizar('ventas');

}

public function insertarfarmacia(){
    $this->_farm->insertarfarm($this->getTexto('duexo'),$this->getTexto('nombre'),
    $this->getTexto('registro'),$this->getTexto('direccion'),
    $this->getTexto('latitud'),$this->getTexto('longitud'),
    $this->getTexto('telefono'),$this->getTexto('abierto'),
    $this->getTexto('cierre'));


    echo $this->verfarmacia();
   
}

public function editarfarmacia(){
    $this->_farm->actualizarfar($this->getTexto('idfarm'),$this->getTexto('duexoup'),$this->getTexto('nombreup'),
    $this->getTexto('registroup'),$this->getTexto('direccionup'),
    $this->getTexto('latitudup'),$this->getTexto('longitudup'),
    $this->getTexto('telefonoup'),$this->getTexto('abiertoup'),
    $this->getTexto('cierreup'));

    echo $this->verfarmacia();
}

public function confirmar(){
    $this->_soli->confir($this->getTexto('idconfirmar'));
    echo $this->vercompras();
}




}




?>