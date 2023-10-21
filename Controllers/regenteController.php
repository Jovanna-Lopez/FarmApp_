<?php


class regenteController extends Controller{
 private $_reg;

function __construct()
{
    parent::__construct();
    $this->_reg=$this->loadModel("regente");
}



public function verregente(){
    $fila=$this->_reg->obtenerregente();
    $tabla='';
    for($i=0;$i<count($fila);$i++){
        $datos=json_encode($fila[$i]);
        $tabla.='
        <tr>
        <td>'.$fila[$i]['id_regente'].'</td>
        <td>'.$fila[$i]['nombres'].'</td>
        <td>'.$fila[$i]['apellidos'].'</td>
        <td>'.$fila[$i]['sexo'].'</td>
        <td>'.$fila[$i]['telefono'].'</td>
        <td>'.$fila[$i]['correo'].'</td>
        <td>'.$fila[$i]['nombre_usuario'].'</td>
        <td>'.$fila[$i]['clave'].'</td>
       

        <td>
        <button data-regente=\''.$datos.'\' class="btn btn-info btn-circle btEditarregente" data-bs-toggle="modal" data-bs-target="#modaleditarregente" > <i class="fa fa-refresh"></i></button>
        <button data-borraregente='.$fila[$i]['id_regente'].' class="btn btn-danger btn-circle btBorrarregente"> <i class="fas fa-trash"></i></button>




        </td>




        </tr>';
    }
    return $tabla;


}

public function index()
{
    Sessiones::acceso('administrador');
$this->_view->tabla=$this->verregente();



$this->_view->renderizar('regente');


}

public function insertarregente(){
    $this->_reg->insertarreg($this->getTexto('nomb'),
    $this->getTexto('apell'),$this->getTexto('sex'),
    $this->getTexto('tel'),$this->getTexto('corr'),
    $this->getTexto('nombreu'),
    $this->getTexto('clave'));


    echo $this->verregente();
   
}


public function editaregente(){
    $this->_reg->editareg($this->getTexto('idr'),
    $this->getTexto('nombu'),$this->getTexto('apellu'),$this->getTexto('sexu'),$this->getTexto('telu')
    ,$this->getTexto('corru'),$this->getTexto('nombreup'),$this->getTexto('claveu'));

    echo $this->verregente();
}


public function borraregente(){
    $this->_reg->borrareg($this->getTexto('idreg'));
    echo $this->verregente();
}


}




?>