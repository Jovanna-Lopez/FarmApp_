<?php


class eventoController extends Controller{
 private $_event;

function __construct()
{
    parent::__construct();
    $this->_event=$this->loadModel("evento");
}



public function verevento(){
    $fila=$this->_event->obtenerevento();
    $tabla='';
    for($i=0;$i<count($fila);$i++){
        $datos=json_encode($fila[$i]);
        $tabla.='
        <tr>
        <td><img src=Views/plantilla/assets/img/'.$fila[$i]['imagen_invit'].' class="img-thumbnail" width="50" height="40"></td>
        <td>'.$fila[$i]['id_evento'].'</td>
        <td>'.$fila[$i]['actividad'].'</td>
        <td>'.$fila[$i]['direccion'].'</td>
        <td>'.$fila[$i]['fecha'].'</td>
        <td>'.$fila[$i]['hora'].'</td>
        <td>'.$fila[$i]['encargado'].'</td>

        <td>'.$fila[$i]['farmacia_id_farmacia'].'</td>
        <td>
        <button data-evento=\''.$datos.'\' class="btn btn-info btn-circle btEditarevento" data-bs-toggle="modal" data-bs-target="#modaleventA" > <i class="fa fa-refresh"></i></button>
        <button data-borrarevento='.$fila[$i]['id_evento'].' class="btn btn-danger btn-circle btBorrarevento"> <i class="fas fa-trash"></i></button>




        </td>




        </tr>';
    }
    return $tabla;


}

public function index()
{
$this->_view->tabla=$this->verevento();

$fila=$this->_event->obtenerfarmacia();
$datos='<option value="0">Seleccione Farmacia</option>';

for($i=0;$i<count($fila);$i++)
$datos.='<option value="'.$fila[$i]['id_farmacia'].'">'.$fila[$i]['nombre'] .'</option>';
 
$this->_view->farmacias=$datos;


$this->_view->renderizar('evento');

}


public function insertarevento(){
    function upload_image()
{
 if(isset($_FILES["image_invitado"]))
 {
  $extension = explode('.', $_FILES['image_invitado']['name']);
  $new_name = rand() . '.' . $extension[1];
  $destination = './Views/plantilla/assets/img/' . $new_name;
  move_uploaded_file($_FILES['image_invitado']['tmp_name'], $destination);
  return $new_name;
 }
}
$imageE = '';
if($_FILES["image_invitado"]["name"] != '')
  {
   $imageE = upload_image();

   $this->_event->insertareven($this->getTexto('farmacia'),
   $this->getTexto('actividad'),$this->getTexto('direccionevent'),
   $this->getTexto('fecha'),$this->getTexto('hora'),
   $this->getTexto('encargado'),$imageE);
   echo $this->verevento();


   }

  }
  
  
  public function editarevento(){
    function editar_image()
{
 if(isset($_FILES["image_invitadoA"]))
 {
  $extension = explode('.', $_FILES['image_invitadoA']['name']);
  $new_name = rand() . '.' . $extension[1];
  $destination = './Views/plantilla/assets/img/' . $new_name;
  move_uploaded_file($_FILES['image_invitadoA']['tmp_name'], $destination);
  return $new_name;
 }
}
$imageEA = '';
if($_FILES["image_invitadoA"]["name"] != '')
  {
   $imageEA = editar_image();


   $this->_event->actualizarevento($this->getTexto('idevento'),
   $this->getTexto('farmaciaeditar'),
   $this->getTexto('actividadA'),$this->getTexto('direccioneventA'),
   $this->getTexto('fechaA'),$this->getTexto('horaA'),
   $this->getTexto('encargadoA'),$imageEA);
   echo $this->verevento();


   }
else{
   
    $this->_event->actualizarevento2($this->getTexto('idevento'),
    $this->getTexto('farmaciaeditar'),
    $this->getTexto('actividadA'),$this->getTexto('direccioneventA'),
    $this->getTexto('fechaA'),$this->getTexto('horaA'),
    $this->getTexto('encargadoA'));
    echo $this->verevento();
}

  }
   


public function editarevento2(){
    $this->_event->actualizarfarmaco($this->getTexto('idevento'),
    $this->getTexto('farmaciaup'),
    $this->getTexto('actividadA'),$this->getTexto('direccioneventA'),
    $this->getTexto('fechaA'),$this->getTexto('horaA'),
    $this->getTexto('encargadoA'));
    echo $this->verevento();
}

public function borrarevento(){
    $this->_event->borrarevento($this->getTexto('ideventoborrar'));

    echo $this->verevento();
}
}




?>