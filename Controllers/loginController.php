<?php

class loginController extends Controller{
    private $_log;

    function __construct(){
        parent::__construct();
        $this->_log=$this->loadModel("login");
    }

    public function getnumerofarmacias()
{
    $numero=$this->_log->numerofarmacias();
    $num=json_encode($numero);


    return $num;
    

}

public function getnumerofarmacos()
{
    $numerof=$this->_log->numeromedicamentos();
    $numf=json_encode($numerof);


    return $numf;
    

}


    public function index(){


        if($this->getTexto('validar')==1)
        {
        
            $datos=$this->_log->obteneru($this->getTexto('user')); 
            $pass=$this->getTexto('pass');


            if(password_verify($this->getTexto('pass'),$datos["password"]))
            {
                Sessiones::setClave('rol',$datos["privilegio"]);
                Sessiones::setClave('autenticado',true);
                Sessiones::setClave('usuario',$datos["nombre_usuario"]);
                Sessiones::setClave('id_usuario',$datos["id_usuario"]);
                $this->redireccionar('index');
            }
            else
            $this->_view->mensaje=' <div class="alert alert-danger" role="alert">
            <center>  Usuario y/o Clave Incorrecta! </center>
          </div>'; 
            
        }
        $this->_view->num=$this->getnumerofarmacias();
$this->_view->numf=$this->getnumerofarmacos();

        $this->_view->renderizar('index');
        
    }

    public function salir()
    {
        Sessiones::salir();
        $this->redireccionar('index');
    }

}