<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="<?= BASE_URL ?>">
        <img src="<?=PLANTILLA?>assets/img/logo_FarmApp.jpg" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">FarmApp</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="<?= BASE_URL ?>index">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-home text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Inicio</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?= BASE_URL ?>mapa">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-square-pin text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Mapa</span>
          </a>
        </li>
        <?php
if(Sessiones::getVista('administrador')){
?>

        <li class="nav-item">
          <a class="nav-link " href="<?= BASE_URL ?>usuario">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-user text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Usuario</span>
          </a>
        </li>

       
        <li class="nav-item">
          <a class="nav-link " href="<?= BASE_URL ?>regente">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-user text-sm opacity-10" style="color:#17a2b8 "></i>
            </div>
            
            <span class="nav-link-text ms-1">Regente</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?= BASE_URL ?>farmacia">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-shop text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Farmacia</span>
          </a>
        </li>
      

         <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-medkit  text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Farmacos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Farmaco:</h6>
                        <a class="collapse-item" href="<?= BASE_URL ?>farmaco">Agregrar Farmacos <in class="fa fa-plus text-info"></i></a>
                        <a class="collapse-item" href="<?= BASE_URL ?>solicitud">Solicitudes de Compras <span class="fa fa-cart-shopping" style="color:#17a2b8"></span> </a>
                        <a class="collapse-item" href="<?= BASE_URL ?>ventas">Ventas <i class="fa fa-handshake text-success"></i></a>
                    </div>
                </div> 
            </li>
            <?php } ?>

        <li class="nav-item">
          <a class="nav-link " href="<?= BASE_URL ?>buscar">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-search text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Buscar</span>
          </a>
        </li>    
        <?php 
        if(Sessiones::getVista('administrador')){
?>
 
        <li class="nav-item">
          <a class="nav-link " href="<?= BASE_URL ?>evento">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-calendar text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Evento</span>
          </a>
        </li>
        <?php } ?>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Acceder</h6>
        </li>
        <?php
    if(Sessiones::getClave('autenticado'))
    echo '
      <li class="nav-item">
        <a class="nav-link" href=" '.BASE_URL.'login/salir">
        <i class="fas fa-fw fa-cog"></i>
          <span>Salir</span></a>
      </li>';
      else
      echo '
      <li class="nav-item">
        <a class="nav-link" href=" '.BASE_URL.'login">
        <i class="fas fa-fw fa-cog"></i>
          <span>Ingresar</span></a>
      </li>';

      ?>




      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          
          <h6 class="font-weight-bolder text-white mb-0">Bienvenido
          <?php
                  if(Sessiones::getClave('usuario'))
                    echo Sessiones::getClave('usuario');
                    else
                    echo 'Invitado';
                  ?>
                   
          </h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <form class="form-inline" method="post" action="#">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" id="busquedas" class="form-control" placeholder="Buscar farmaco aqui..">
            </div>
            </form>
           
            <div id="suggestions">
              
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
         
            <?php
    if(Sessiones::getClave('autenticado'))
    echo '
    <li class="nav-item d-flex align-items-center">
    <a href=" '.BASE_URL.'login/salir" class="nav-link text-white font-weight-bold px-0">
      <i class="fa fa-user me-sm-1"></i>
      <span class="d-sm-inline d-none">Salir</span>
    </a>
  </li>';
      else
      echo '
      <li class="nav-item d-flex align-items-center">
    <a href=" '.BASE_URL.'login" class="nav-link text-white font-weight-bold px-0">
      <i class="fa fa-user me-sm-1"></i>
      <span class="d-sm-inline d-none">Ingresar</span>
    </a>
  </li>
          ';

      ?>





            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
           
          </ul>
        </div>
      </div>
    </nav>
     <!-- End Navbar -->
     <div class="container-fluid py-4">
