<?php


class mapaController extends Controller{
private $_map;

function __construct()
{
    parent::__construct();
    $this->_map=$this->loadModel("mapa");
}

public function getubicacion()
{
    $fila=$this->_map->obtenerdatos();
    for($i=0;$i<count($fila);$i++){
        $datos=json_encode($fila);
        
    } 
    return $datos;
    

}
public function getnumerofarmacias()
{
    $numero=$this->_map->numerofarmacias();
    $num=json_encode($numero);


    return $num;
    

}


public function compra()
{

    function upload_image()
    {
     if(isset($_FILES["receta"]))
     {
      $extension = explode('.', $_FILES['receta']['name']);
      $new_name = rand() . '.' . $extension[1];
      $destination = './Views/plantilla/assets/img/' . $new_name;
      move_uploaded_file($_FILES['receta']['tmp_name'], $destination);
      return $new_name;
     }
    }
    $image = '';
    if($_FILES["receta"]["name"] != '')
      {
       $image = upload_image();
    $fecha=date("Y-m-d");
    date_default_timezone_set('America/Managua');
    $hora=date("H:i:s");
       $this->_map->insertarcompra($this->getTexto('idfarmaco'),$this->getTexto('nombrecompra'),$this->getTexto('cantidadcompra'),$this->getTexto('numerocompra'),$this->getTexto('direccioncompra'),$this->getTexto('costo'),$fecha,$hora,$image);    
       }

    
 
}
public function getnumerofarmacos()
{
    $numerof=$this->_map->numeromedicamentos();
    $numf=json_encode($numerof);


    return $numf;
    

}


public function busquedas(){
    $fila=$this->_map->buscarfarmacias($this->getTexto('busq'));
    if(is_array($fila)){
    $tabla='';
    for($i=0;$i<count($fila);$i++){
        $datos=json_encode($fila[$i]);
        $tabla.='
        <div><a class="suggest-element"

        <tr>
        Nombre: 
        <td>'.$fila[$i]['nombre_medico'].'</td>
        Precio: 
        <td>'.$fila[$i]['precio'].'</td>
        Farmacia: 
        <td>'.$fila[$i]['nombre'].'</td>
        <td>
        <button data-ver=\''.$datos.'\' class="btn btn-info btverinfo" data-bs-toggle="modal" data-bs-target="#modalinfo">
                        <span class="fa fa-plus"></span>
             Más 
				
			</button>
        
        </td>

        </tr>
        </a></div>';
    }
    echo $tabla;

}

  


}



public function index()
{
$this->_view->datos=$this->getubicacion();
$this->_view->num=$this->getnumerofarmacias();
$this->_view->numf=$this->getnumerofarmacos();
$this->_view->renderizar('mapa');

}





}




?>