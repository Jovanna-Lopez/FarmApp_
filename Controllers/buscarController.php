<?php


class buscarController extends Controller{
private $_bus;

function __construct()
{
    parent::__construct();
    $this->_bus=$this->loadModel("buscar");
}

public function obtenerlaboratorios()
{ 
    $fila=$this->_bus->obtenerlabs();
    for($i=0;$i<count($fila);$i++){
        $datos=json_encode($fila);
        
    } 
    return $datos;
    

}

public function obtenerestado()
{ 
    $fila=$this->_bus->obteneresta();
    for($i=0;$i<count($fila);$i++){
        $estad=json_encode($fila);
        
    } 
    return $estad;
    

}

public function obtenerdelivery()
{ 
    $fila=$this->_bus->obtenerdelivery();
    for($i=0;$i<count($fila);$i++){
        $deliv=json_encode($fila);
        
    } 
    return $deliv;
    

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
       $this->_bus->insertarcompra($this->getTexto('idfarmaco'),$this->getTexto('nombrecompra'),$this->getTexto('cantidadcompra'),$this->getTexto('numerocompra'),$this->getTexto('direccioncompra'),$this->getTexto('costo'),$fecha,$hora,$image);    
       }

    
 
}
public function getnumerofarmacos()
{
    $numerof=$this->_map->numeromedicamentos();
    $numf=json_encode($numerof);


    return $numf;
    

}



public function index()
{
    $fila=$this->_bus->obtenerlaboratorios();
    $datos='<option value="0">Seleccione</option>';
    for($i=0;$i<count($fila);$i++)
    $datos.='<option value="'.$fila[$i]['laboratorio'].'">'.$fila[$i]['laboratorio'] .'</option>';
     
    $this->_view->laboratorio=$datos;

    $fila=$this->_bus->obtenerestado();
    $estad='<option value="">Seleccione</option>';
    for($i=0;$i<count($fila);$i++)
    $estad.='<option value="'.$fila[$i]['estado'].'">'.$fila[$i]['estado'] .'</option>';
     
    $this->_view->estado=$estad;

    $fila=$this->_bus->obtenerdelivery();
    $deliv='<option value="">Seleccione</option>';
    for($i=0;$i<count($fila);$i++)
    $deliv.='<option value="'.$fila[$i]['delivery'].'">'.$fila[$i]['delivery'] .'</option>';
     
    $this->_view->delivery=$deliv;


$this->_view->renderizar('buscar');

}


public function busqueda(){
    $fila=$this->_bus->buscarfarmaco($this->getTexto('bus'));
    if(is_array($fila)){
    $tabla='';
    for($i=0;$i<count($fila);$i++){
        $datos=json_encode($fila[$i]);
        $tabla.='
        <tr>
        <td><img src=Views/plantilla/assets/img/'.$fila[$i]['imagen'].' class="img-thumbnail" width="50" height="40"></td>
        <td>'.$fila[$i]['nombre_medico'].'</td>
        <td>'.$fila[$i]['laboratorio'].'</td>
        <td>'.$fila[$i]['precio'].'</td>
        <td>'.$fila[$i]['nombre'].'</td>
        <td>'.$fila[$i]['aplicacion'].'</td>

        <td>
        <button data-verbus=\''.$datos.'\' class="btn btn-info btverinfobus" data-bs-toggle="modal" data-bs-target="#modalinfobus">
                        <span class="fa fa-plus"></span>
             Más 
			</button>
             </td>

        </tr>';
    }
    echo $tabla;

}
else{
   
 

}
  

  

}

public function filtro(){
    $fila=$this->_bus->filtrado($this->getTexto('buscar'),$this->getTexto('laboratorio'),$this->getTexto('estados'),$this->getTexto('delive'));
    if(is_array($fila)){
    $tabla='';
    for($i=0;$i<count($fila);$i++){
        $datos=json_encode($fila[$i]);
        $tabla.='
        <tr>
        <td><img src=Views/plantilla/assets/img/'.$fila[$i]['imagen'].' class="img-thumbnail" width="50" height="40"></td>
        <td>'.$fila[$i]['nombre_medico'].'</td>
        <td>'.$fila[$i]['laboratorio'].'</td>
        <td>'.$fila[$i]['precio'].'</td>
        <td>'.$fila[$i]['nombre'].'</td>
        <td>'.$fila[$i]['aplicacion'].'</td>

        <td>
        <button data-verbus=\''.$datos.'\' class="btn btn-info btverinfo" data-bs-toggle="modal" data-bs-target="#modalinfo">
                        <span class="fa fa-plus"></span>
             Más 
			</button>
        </td>

        </tr>';
    }
    echo $tabla;

}
else{
   
 

}
  

  

}

public function limpiarfiltro(){
    $fila=$this->_bus->limpiarfiltrado($this->getTexto('buscar'));
    if(is_array($fila)){
    $tabla='';
    for($i=0;$i<count($fila);$i++){
        $datos=json_encode($fila[$i]);
        $tabla.='
        <tr>
        <td><img src=Views/plantilla/assets/img/'.$fila[$i]['imagen'].' class="img-thumbnail" width="50" height="40"></td>
        <td>'.$fila[$i]['nombre_medico'].'</td>
        <td>'.$fila[$i]['laboratorio'].'</td>
        <td>'.$fila[$i]['precio'].'</td>
        <td>'.$fila[$i]['nombre'].'</td>
        <td>'.$fila[$i]['aplicacion'].'</td>

        <td>
        <button data-d=\''.$datos.'\' class="btn btn-info btn-circle btEditarD" data-toggle="modal" data-target="#actualizarD" > <i class="fas fa-refresh"></i></button>
        <button data-borrarD='.$fila[$i]['nombre_medico'].' class="btn btn-danger btn-circle btBorrarD"> <i class="fas fa-trash"></i></button>
        </td>

        </tr>';
    }
    echo $tabla;

}
else{
   
 

}
  

  

}


}




?>