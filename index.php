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


          <script>

      document.addEventListener("DOMContentLoaded", function(){

          new FullCalendar.Draggable(document.getElementById('listaeventospredefinidos'), {
            itemSelector: '.fc-event',
            eventData: function(eventEl){
              return{
                  title: eventEl.innerText.trim()
              }
            }
          });

          $('.clockpicker').clockpicker();

          let calendario1 = new FullCalendar.Calendar(document.getElementById('Calendario1'),{
            droppable: true,
            height: 850,
            headerToolbar:{
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            editable: true,
            events: 'datoseventos.php?accion=listar',
            dateClick: function(info){
              limpiarFormulario();
              $('#BotonAgregar').show();
              $('#BotonModificar').hide();
              $('#BotonBorrar').hide();

              if (info.allDay) {
                $('#FechaInicio').val(info.dateStr);
                $('#FechaFin').val(info.dateStr);
              }else{
                let fechaHora = info.dateStr.split("T");
                $('#FechaInicio').val(fechaHora[0]);
                $('#FechaFin').val(fechaHora[0]);
                $('#HoraInicio').val(fechaHora[1].substring(0,5));
              }
              $("#FormularioEventos").modal('show');
            },
            eventClick: function(info) {
              $('#BotonAgregar').hide();
              $('#BotonModificar').show();
              $('#BotonBorrar').show();
              $('#Id').val(info.event.id);
              $('#Titulo').val(info.event.title);
              $('#Descripcion').val(info.event.extendedProps.descripcion);
              $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
              $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
              $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
              $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
              $('#ColorFondo').val(info.event.backgroundColor);
              $('#ColorTexto').val(info.event.textColor);
              $("#FormularioEventos").modal('show');
            },
            eventResize: function(info){
              $('#Id').val(info.event.id);
              $('#Titulo').val(info.event.title);
              $('#Descripcion').val(info.event.extendedProps.descripcion);
              $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
              $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
              $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
              $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
              $('#ColorFondo').val(info.event.backgroundColor);
              $('#ColorTexto').val(info.event.textColor);
              let registro = recuperarDatosFormulario();
              modificarRegistro(registro);
            },
            eventDrop: function(info){
              $('#Id').val(info.event.id);
              $('#Titulo').val(info.event.title);
              $('#Descripcion').val(info.event.extendedProps.descripcion);
              $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
              $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
              $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
              $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
              $('#ColorFondo').val(info.event.backgroundColor);
              $('#ColorTexto').val(info.event.textColor);
              let registro = recuperarDatosFormulario();
              modificarRegistro(registro);
            },
            drop: function(info){
              limpiarFormulario();
              $('#ColorFondo').val(info.draggedEl.dataset.colorfondo);
              $('#ColorTexto').val(info.draggedEl.dataset.colortexto);
              $('#Titulo').val(info.draggedEl.dataset.titulo);
              let fechaHora = info.dateStr.split("T");
              $('#FechaInicio').val(fechaHora[0]);
              $('#FechaFin').val(fechaHora[0]);
              if (info.allDay) {
                $('#HoraInicio').val(info.draggedEl.dataset.horainicio);
                $('#HoraFin').val(info.draggedEl.dataset.horafin);
              }else{
                $('#HoraInicio').val(fechaHora[1].substring(0,5));
                $('#HoraFin').val(moment(fechaHora[1].substring(0,5)).add(1,'hours'));
              }
              let registro = recuperarDatosFormulario();
              agregarEventoPredefinido(registro);
            }
          });

          calendario1.render();

          //Eventos de botones de la aplicacion
          $('#BotonAgregar').click(function(){
            let registro = recuperarDatosFormulario();
            agregarRegistro(registro);
            $('#FormularioEventos').modal('hide');
          });

          $('#BotonModificar').click(function(){
            let registro = recuperarDatosFormulario();
            modificarRegistro(registro);
            $('#FormularioEventos').modal('hide');
          });

          $('#BotonBorrar').click(function(){
            let registro = recuperarDatosFormulario();
            borrarRegistro(registro);
            $('#FormularioEventos').modal('hide');
          });

          $('#BotonEventosPredefinidos').click(function(){
            window.location = "eventospredefinidos.html";
          });


          //funciones para comunicarse con el servidor AJAX!
          function agregarRegistro(registro) {
            $.ajax({
              type: 'POST',
              url: 'datoseventos.php?accion=agregar',
              data: registro,
              success: function(msg){
                calendario1.refetchEvents();
              },
              error: function(error) {
                alert("Hubo un error al agregar el evento: " + error);
              }
            });
          }

          function modificarRegistro(registro){
            $.ajax({
              type: 'POST',
              url: 'datoseventos.php?accion=modificar',
              data: registro,
              success: function(msg){
                calendario1.refetchEvents();
              },
              error: function(error) {
                alert("Hubo un error al modificar el evento: " + error);
              }
            });
          }

          function borrarRegistro(registro){
            $.ajax({
              type: 'POST',
              url: 'datoseventos.php?accion=borrar',
              data: registro,
              success: function(msg){
                calendario1.refetchEvents();
              },
              error: function(error) {
                alert("Hubo un error al borrar el evento: " + error);
              }
            });
          }

          function agregarEventoPredefinido(registro){
            $.ajax({
              type: 'POST',
              url: 'datoseventos.php?accion=agregar',
              data: registro,
              success: function(msg){
                calendario1.removeAllEvents();
                calendario1.refetchEvents();
              },
              error: function(error) {
                alert("Hubo un error al agregar evento ep: " + error);
              }
            });
          }


          //funciones que interactuan con el FormularioEventos

          function limpiarFormulario(){
            $('#Id').val('');
            $('#Titulo').val('');
            $('#Descripcion').val('');
            $('#FechaFin').val('');
            $('#FechaInicio').val('');
            $('#HoraInicio').val('');
            $('#HoraFin').val('');
            $('#ColorFondo').val('#3788D8');
            $('#ColorTexto').val('#ffffff');
          }

          function recuperarDatosFormulario(){
            let registro = {
              id: $('#Id').val(),
              titulo: $('#Titulo').val(),
              descripcion: $('#Descripcion').val(),
              inicio: $('#FechaInicio').val() + ' ' + $('#HoraInicio').val(),
              fin: $('#FechaFin').val() + ' ' + $('#HoraFin').val(),
              colorfondo: $('#ColorFondo').val(),
              colortexto: $('#ColorTexto').val()
            }
            return registro;
          }

      });
          </script>


        </body>
</html>
