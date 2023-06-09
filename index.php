  <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="shortcut icon" href="img/icon.png" type="image/png">
    <meta charset="utf-8">
    <title>Sala de juntas SYC</title>

<!-- scripts CSS-->
<link rel="stylesheet" href="css/estilo.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/datatables.min.css">
<link rel="stylesheet" href="css/bootstrap-clockpicker.css">
<link rel="stylesheet" href="fullcalendar/main.css">

<!-- scripts JS-->
<script src="js/jquery-3.7.0.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/datatables.min.js"></script>
<script src="js/bootstrap-clockpicker.js"></script>
<script src="js/moment-with-locales.js"></script>
<script src="fullcalendar/main.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  </head>
  <body>

<div class="container-fluid">
    <section class="content-header">


          <p></p>
          <nav class="navbar navbar-expand-lg navbar-light white " style="padding:0rem 1rem; maximo_ancho_menu; z-index:600" >
            <a class="navbar-brand" href="https://subastasycomercio.com"><img src="img/logo-syc.png" class="img-fluid"  alt="subas"></a>
        </nav>
    <h1>
      Sistema sala de junta

      <small>Panel de control</small>
    </h1>
    <h6>
      Calendario de <strong> <?php echo $_SESSION['usuario']; ?> </strong>
      <small style="float:right"> <a href="logout.php">Cerrar Sesion</a> </small>
    </h6>
      </section>

      <div class="row">
              <div class="col-10">
                <div id="Calendario1" style="border: 1px solid #000; padding:2px"></div>
              </div>
              <div class="col-2">
                <div id="external-events" style="margin-bottom:1em; height:350px; border: 1px solid #000; overflow: auto; padding:1em">
                  <h4 class="text-center">Eventos predefinidos</h4>
                  <div id="listaeventospredefinidos">

                    
                     ?>

                  </div>
                </div>
                <hr>
                <div class="" style="text-align:center">
                  <button type="button" id="BotonEventosPredefinidos" class="btn btn-success">
                    Administrar eventos predefinidos
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Formulario de Eventos -->
          <div class="modal fade" id="FormularioEventos" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                  </button>
                </div>

                <div class="modal-body">
                  <input type="hidden" id="Id">

                  <div class="form-row">
                    <div class="form-group col-12">
                      <label for="">Titulo del Evento:</label>
                      <input type="text" id="Titulo" class="form-control" placeholder="">
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Fecha de inicio:</label>
                      <div class="input-group" data-autoclose="true">
                        <input type="date" id="FechaInicio" value="" class="form-control">
                      </div>
                    </div>
                    <div class="form-group col-md-6" id="TituloHoraInicio">
                      <label>Hora de inicio:</label>
                      <div class="input-group clockpicker" data-autoclose="true">
                        <input type="text" id="HoraInicio" value="" class="form-control" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="">Fecha de fin:</label>
                      <div class="input-group" data-autoclose="true">
                        <input type="date" id="FechaFin" class="form-control" value="">
                      </div>
                    </div>
                    <div class="form-group col-md-6" id="TituloHoraFin">
                      <label for="">Hora de fin:</label>
                      <div class="input-group clockpicker" data-autoclose="true">
                        <input type="text" id="HoraFin" class="form-control" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  <div class="form-row">
                    <label for="">Descripcion:</label>
                    <textarea id="Descripcion" class="form-control" rows="3"></textarea>
                  </div>
                  <div class="form-row">
                    <label for="">Color de fondo:</label>
                    <input type="color" value="#3788D8" id="ColorFondo" class="form-control" style="height:36px;">
                  </div>
                  <div class="form-row">
                    <label for="">Color de texto:</label>
                    <input type="color" value="#ffffff" id="ColorTexto" class="form-control" style="height:36px;">
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" id="BotonAgregar" class="btn btn-success">Agregar</button>
                  <button type="button" id="BotonModificar" class="btn btn-success">Modificar</button>
                  <button type="button" id="BotonBorrar" class="btn btn-success">Borrar</button>
                  <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                </div>

              </div>
            </div>
          </div>


         </body>
</html>
