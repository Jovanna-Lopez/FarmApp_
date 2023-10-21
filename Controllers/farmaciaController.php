<?php


class farmaciaController extends Controller{
 private $_farm;

function __construct()
{
    parent::__construct();
    $this->_farm=$this->loadModel("farmacia");
}

public function getnumerofarmacias()
{
    $numero=$this->_farm->numerofarmacias();
    $num=json_encode($numero);


    return $num;
    

}

public function getnumerofarmacos()
{
    $numerof=$this->_farm->numeromedicamentos();
    $numf=json_encode($numerof);


    return $numf;
    

}




public function verfarmacia(){
    $fila=$this->_farm->obtenerfarm();
    $tabla='';
    for($i=0;$i<count($fila);$i++){
        $datos=json_encode($fila[$i]);
        $tabla.='
        <tr>
        <td><img src=Views/plantilla/assets/img/'.$fila[$i]['imagen_farm'].' class="img-thumbnail" width="50" height="40"></td>
        <td>'.$fila[$i]['id_farmacia'].'</td>
        <td>'.$fila[$i]['nombre'].'</td>
        <td>'.$fila[$i]['registro'].'</td>
        <td>'.$fila[$i]['direccion'].'</td>
        <td>'.$fila[$i]['latitud'].'</td>
        <td>'.$fila[$i]['longitud'].'</td>
        <td>'.$fila[$i]['telefono'].'</td>
        <td>'.$fila[$i]['hora_abre'].'</td>
        <td>'.$fila[$i]['hora_cierre'].'</td>
        <td>'.$fila[$i]['delivery'].'</td>
        <td>'.$fila[$i]['regente_id_regente'].'</td>
        <td>
        <button data-farmacia=\''.$datos.'\' class="btn btn-info btn-circle btEditarfarmacia" data-bs-toggle="modal" data-bs-target="#modalfarmup" > <i class="fa fa-refresh"></i></button>
        <button data-borrarfarmacia='.$fila[$i]['id_farmacia'].' class="btn btn-danger btn-circle btBorrarfarmacia"> <i class="fas fa-trash"></i></button>




        </td>




        </tr>';
    }
    return $tabla;


}

public function index()
{
    $this->_view->num=$this->getnumerofarmacias();
    $this->_view->numf=$this->getnumerofarmacos();

$this->_view->tabla=$this->verfarmacia();

$fila=$this->_farm->obteneregente();
$datos='<option value="0">Seleccione Regente</option>';

for($i=0;$i<count($fila);$i++)
$datos.='<option value="'.$fila[$i]['id_regente'].'">'.$fila[$i]['nombres'] .'</option>';
 
$this->_view->duexo=$datos;


$this->_view->renderizar('farmacia');

}

public function insertarfarmacia(){
    function upload_image()
    {
        if(isset($_FILES["farm_image"]))
        {
         $extension = explode('.', $_FILES['farm_image']['name']);
         $new_name = rand() . '.' . $extension[1];
         $destination = './Views/plantilla/assets/img/' . $new_name;
         move_uploaded_file($_FILES['farm_image']['tmp_name'], $destination);
         return $new_name;
        }
       }
       $image = '';
       if($_FILES["farm_image"]["name"] != '')
         {
          $image = upload_image();

    $this->_farm->insertarfarm($this->getTexto('duexo'),$this->getTexto('nombre'),
    $this->getTexto('registro'),$this->getTexto('direccion'),
    $this->getTexto('latitud'),$this->getTexto('longitud'),
    $this->getTexto('telefono'),$this->getTexto('abierto'),
    $this->getTexto('cierre'),$this->getTexto('delivery'),$image);


    echo $this->verfarmacia();
      }
      else{
   
        $this->_farm->insertarfarm2($this->getTexto('duexo'),$this->getTexto('nombre'),
    $this->getTexto('registro'),$this->getTexto('direccion'),
    $this->getTexto('latitud'),$this->getTexto('longitud'),
    $this->getTexto('telefono'),$this->getTexto('abierto'),
    $this->getTexto('cierre'),$this->getTexto('delivery'));

    
        echo $this->verfarmacia();
    }


}

public function editarfarmacia(){
    function editar_image()
{
 if(isset($_FILES["farm_imageA"]))
 {
  $extension = explode('.', $_FILES['farm_imageA']['name']);
  $new_name = rand() . '.' . $extension[1];
  $destination = './Views/plantilla/assets/img/' . $new_name;
  move_uploaded_file($_FILES['farm_imageA']['tmp_name'], $destination);
  return $new_name;
 }
}
$imageA = '';
if($_FILES["farm_imageA"]["name"] != '')
  {
   $imageA = editar_image();

    $this->_farm->actualizarfar($this->getTexto('idfarm'),$this->getTexto('duexoup'),$this->getTexto('nombreup'),
    $this->getTexto('registroup'),$this->getTexto('direccionup'),
    $this->getTexto('latitudup'),$this->getTexto('longitudup'),
    $this->getTexto('telefonoup'),$this->getTexto('abiertoup'),
    $this->getTexto('cierreup'),$this->getTexto('deliveryu'),$imageA);

    echo $this->verfarmacia();
  }else{
   
    $this->_farm->actualizarfar2($this->getTexto('idfarm'),$this->getTexto('duexoup'),$this->getTexto('nombreup'),
    $this->getTexto('registroup'),$this->getTexto('direccionup'),
    $this->getTexto('latitudup'),$this->getTexto('longitudup'),
    $this->getTexto('telefonoup'),$this->getTexto('abiertoup'),
    $this->getTexto('cierreup'),$this->getTexto('deliveryu'));

    echo $this->verfarmacia();
}
}

public function borrarfarmacia(){
    $this->_farm->borrarfarm($this->getTexto('idfarmacia'));
    echo $this->verfarmacia();
}




}




?>