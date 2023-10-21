<?php 
class usuarioController extends Controller{
    private $_usu;
   
   function __construct()
   {
       parent::__construct();
       $this->_usu=$this->loadModel("usuario");
   }
   
   
   
   public function verusuario(){
       $fila=$this->_usu->obtenerusuario();
       $tabla='';
       for($i=0;$i<count($fila);$i++){
           $datos=json_encode($fila[$i]);
           $tabla.='
           <tr>
           <td>'.$fila[$i]['id_usuario'].'</td>
           <td>'.$fila[$i]['nombre_usuario'].'</td>
           <td>'.$fila[$i]['password'].'</td>
           <td>'.$fila[$i]['privilegio'].'</td>
          
   
           <td>
           <button data_usuario=\''.$datos.'\' class="btn btn-info btn-circle btEditarusuario" data-bs-toggle="modal" data-bs-target="#modalusuariou" > <i class="fa fa-refresh"></i></button>
           <button data_borrarusuario='.$fila[$i]['id_usuario'].' class="btn btn-danger btn-circle btBorrarusuario"> <i class="fas fa-trash"></i></button>
   
   
   
   
           </td>
   
   
   
   
           </tr>';
       }
       return $tabla;
   
   
   }
   
   public function index()
   {

    Sessiones::acceso('administrador');
   $this->_view->tabla=$this->verusuario();
  
   
   
   $this->_view->renderizar('usuario');
   
   
   }
   
   public function insertarusuario(){
       $this->_usu->insertarus($this->getTexto('nombreU'),
       $this->getTexto('claveU'),$this->getTexto('privilegio')); 
   
       echo $this->verusuario();
      
   }
   
   

   public function editarusua(){
       $this->_usu->editarusu($this->getTexto('idusuario'),
       $this->getTexto('nombreusuarioA'),$this->getTexto('claveuA'),$this->getTexto('privilegioA'));
   }
   
   public function borrarusuario(){
       $this->_usu->borrarusu($this->getTexto('idusu'));
       
       echo $this->verusuario();
   }
   
   
}
   
   
?>
