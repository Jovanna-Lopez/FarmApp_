<?php


class farmacoController extends Controller{
 private $_farmaco;

function __construct()
{
    parent::__construct();
    $this->_farmaco=$this->loadModel("farmaco");
}



public function verfarmaco(){
    $fila=$this->_farmaco->obtenerfarmaco();
    $tabla='';
    for($i=0;$i<count($fila);$i++){
        $datos=json_encode($fila[$i]);
        $tabla.='
        <tr>
        <td><img src=Views/plantilla/assets/img/'.$fila[$i]['imagen'].' class="img-thumbnail" width="50" height="40"></td>
        <td>'.$fila[$i]['nombre_medico'].'</td>
        <td>'.$fila[$i]['nombre_comercial'].'</td>
        <td>'.$fila[$i]['laboratorio'].'</td>
        <td>'.$fila[$i]['estado'].'</td>
        <td>'.$fila[$i]['peso'].'</td>
        <td>'.$fila[$i]['volumen'].'</td>
        <td>'.$fila[$i]['fecha_de_vencimiento'].'</td>
        <td>'.$fila[$i]['tipo'].'</td>
        <td>'.$fila[$i]['cantidad'].'</td>
        <td>'.$fila[$i]['precio'].'</td>
        <td>'.$fila[$i]['aplicacion'].'</td>
        <td>'.$fila[$i]['precauciones'].'</td>
        <td>'.$fila[$i]['reacciones'].'</td>
        <td>'.$fila[$i]['interacciones'].'</td>
        <td>'.$fila[$i]['id_farmaco'].'</td>
        <td>'.$fila[$i]['farmacia_id_farmacia'].'</td> 

        <td>
        <button data-farmacos=\''.$datos.'\' class="btn btn-info btn-circle btEditarfarmaco" data-bs-toggle="modal" data-bs-target="#modalactualizarfarmacos" > <i class="fa fa-refresh"></i></button>
        <button data-borrarfarmaco='.$fila[$i]['id_farmaco'].' class="btn btn-danger btn-circle btBorrarfarmaco"> <i class="fas fa-trash"></i></button>




        </td>





        </tr>';
    }
    return $tabla;


}

public function index()
{
$this->_view->tabla=$this->verfarmaco();
$fila=$this->_farmaco->obtenerfarmacia();
$datos='<option value="0">Seleccione Farmacia</option>';

for($i=0;$i<count($fila);$i++)
$datos.='<option value="'.$fila[$i]['id_farmacia'].'">'.$fila[$i]['nombre'] .'</option>';
 
$this->_view->farmacias=$datos;


$this->_view->renderizar('farmaco');


}



public function insertarfarmaco(){
    function upload_image()
{
 if(isset($_FILES["user_image"]))
 {
  $extension = explode('.', $_FILES['user_image']['name']);
  $new_name = rand() . '.' . $extension[1];
  $destination = './Views/plantilla/assets/img/' . $new_name;
  move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
  return $new_name;
 }
}
$image = '';
if($_FILES["user_image"]["name"] != '')
  {
   $image = upload_image();

   $this->_farmaco->insertarimagen($this->getTexto('farmacia'),$this->getTexto('nombremedico'),$this->getTexto('nombrecomercial'),
   $this->getTexto('laboratorio'),$this->getTexto('estado'),
   $this->getTexto('peso'),$this->getTexto('volumen'),
   $this->getTexto('vencimiento'),$this->getTexto('tipo'),$this->getTexto('cantidad'),$this->getTexto('precio'),$this->getTexto('aplica'),$this->getTexto('precauciones'),$this->getTexto('reacciones'),$this->getTexto('interacciones'),$image);
   echo $this->verfarmaco();
   }

  }
  
  
  
  public function editarfarmaco(){
    function editar_image()
{
 if(isset($_FILES["user_imageA"]))
 {
  $extension = explode('.', $_FILES['user_imageA']['name']);
  $new_name = rand() . '.' . $extension[1];
  $destination = './Views/plantilla/assets/img/' . $new_name;
  move_uploaded_file($_FILES['user_imageA']['tmp_name'], $destination);
  return $new_name;
 }
}
$imageA = '';
if($_FILES["user_imageA"]["name"] != '')
  {
   $imageA = editar_image();


   $this->_farmaco->actualizarfarmaco($this->getTexto('idfarmaco'),
   $this->getTexto('farmaciaeditar'),
   $this->getTexto('nombremedicoA'),$this->getTexto('nombrecomercialA'),
   $this->getTexto('laboratorioA'),$this->getTexto('estadoA'),
   $this->getTexto('pesoA'),$this->getTexto('volumenA'),
   $this->getTexto('vencimientoA'),$this->getTexto('tipoA'),$this->getTexto('cantidadA')
   ,$this->getTexto('precioA'),$this->getTexto('aplicaA'),
   $this->getTexto('precaucionesA'),$this->getTexto('reaccionesA'),$this->getTexto('interaccionesA'),$imageA);
   echo $this->verfarmaco();


   }
else{
   
    $this->_farmaco->actualizarfarmaco2($this->getTexto('idfarmaco'),
    $this->getTexto('farmaciaeditar'),
    $this->getTexto('nombremedicoA'),$this->getTexto('nombrecomercialA'),
    $this->getTexto('laboratorioA'),$this->getTexto('estadoA'),
    $this->getTexto('pesoA'),$this->getTexto('volumenA'),
    $this->getTexto('vencimientoA'),$this->getTexto('tipoA'),$this->getTexto('cantidadA')
    ,$this->getTexto('precioA'),$this->getTexto('aplicaA'),
    $this->getTexto('precaucionesA'),$this->getTexto('reaccionesA'),$this->getTexto('interaccionesA'));
    echo $this->verfarmaco();
}

  }
   


public function editarfarmaco2(){
    $this->_farmaco->actualizarfarmaco($this->getTexto('idfarmaco'),
    $this->getTexto('farmaciaup'),
    $this->getTexto('nombremedicoA'),$this->getTexto('nombrecomercialA'),
    $this->getTexto('laboratorioA'),$this->getTexto('estadoA'),
    $this->getTexto('pesoA'),$this->getTexto('volumenA'),
    $this->getTexto('vencimientoA'),$this->getTexto('tipoA'),
    $this->getTexto('descripcionA'));

    echo $this->verfarmaco();
}

public function borrarfarmaco(){
    $this->_farmaco->borrarfarm($this->getTexto('idfarmacoborrar'));

    echo $this->verfarmaco();
}





}




?>