<?php


class indexController extends Controller{
    private $_ind;

function __construct()
{
    parent::__construct();
    $this->_ind=$this->loadModel("index");
}

public function getnumerofarmacias()
{
    $numero=$this->_ind->numerofarmacias();
    $num=json_encode($numero);


    return $num;
    

}

public function getnumerofarmacos()
{
    $numerof=$this->_ind->numeromedicamentos();
    $numf=json_encode($numerof);


    return $numf;
    

}

public function getventasconfirmadas()
{
    $numerof=$this->_ind->numeroventas();
    $numv=json_encode($numerof);


    return $numv;
    

}




public function index()
{
$this->_view->num=$this->getnumerofarmacias();
$this->_view->numf=$this->getnumerofarmacos();
$this->_view->numv=$this->getventasconfirmadas();

$this->_view->renderizar('index');

}
 




}




?>