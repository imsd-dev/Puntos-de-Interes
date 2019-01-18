<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa</title>
    <link href='loguito.png' rel='shortcut icon' type='image/png'>
    <link href="<?php echo base_url('flat/dist/css/flat-ui.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script>
        window.onload=function() {
              initMap();    
        }
    </script>

    <style type="text/css">

            body{
              background-color: #34495e;
              font-family: Arial;
            }
            
            h2{
              color: #ecf0f1;
              font-size: 38px;
              margin-top: 5px;
              margin-left:  20px;
              margin-bottom: 0px;
              font-weight: 700;
              line-height: 1.1;
            }
            hr {
                margin-top: 0rem;
                margin-bottom: 0rem;
                border: 2;
            }
            h4 {
              color: #ecf0f1;
              font-size: 28px;
              margin-left: 20px;
            }

            .colbox {
              margin-left: 0px;
              margin-right: 0px;
            } 

            #lbl{font-size: 18px;}
     
            @media only screen and (min-width: 1564px) {
                #lbl{font-size: 18px;}
             }

            @media only screen and (min-width: 310px) {
              
              #buscador {
                max-width: 2140px;
                float: left;
              } 

            }

            @media only screen and (max-width: 400px) {
                h2 {
                  font-size :33px;
                }
                h4{ text-align: center;
                    font-size :25px;
                }
            }

          

            #buscador, #mapa{
              max-width: 2140px;
               
             }    

             @media only screen and (min-height: 800px) {
             
             #mapCanvas {
               height: 850px; width: 100%;
             } 

             }

             @media only screen and (max-height: 790px) {
             
             #mapCanvas {
               height: 600px; width: 100%;
             } 

             }

    </style>

</head>
<body>
    <div class="container" >
        <div class="row">
            <div  class="form-group">
               <h2>Puntos de interés</h2>
               <h4>¿Que está buscando?</h4>
            </div>
        </div>
    </div>
<hr/>
    <div class="container" id="buscador" > 
          <div id="containerbuscador" > 
            <div class="p-2 mb-2 bg-light text-dark rounded" >
                <form  method="post">
                    <fieldset> 
                      <div class="row colbox">                                 
                           <div class="col-lg-10 col-sm-10 ">

                                <select class="btn btn-inverse dropdown-toggle" style=" font-size: 20px;" name="selectcate" id="tcate" onchange="this.form.submit()">
                                  <option style=" font-size: 20px;"  >Selecciona una categoria</option>                            
                                  <?php
                                  $dat= $dato;
                                   if($categorias){                                            
                                    foreach($categorias as $cat){ ?>  
                                      <option style=" font-size: 20px;" <?php if($dat==$cat->id ) {
                                       echo "selected";
                                      }  ?> value="<?php echo $cat->id;?>"> <?php echo $cat->categoria; ?></option>           
                                  <?php } 
                                        } ?>                                          
                                </select>
                           </div>
                       </div> 
                    </fieldset>
                </form>
            </div>
          </div>  
    </div>
    <div class="container" id="mapa">          
<!--****** Codigo de incializacion y edicion del mapa ****** -->            
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDstcD13yoat5r7T7KrBvQpRUL-qce3OcM"></script>

<script>
  //
 
  function initMap() {
      var map;
      var bounds = new google.maps.LatLngBounds();
      var mapOptions = {
        mapTypeId: 'roadmap',
        zoom: 14,
        center: {lat: -33.6334227 , lng: -71.6112497}
          
      };              
      // Mostrar el mapa en el div que se espesifica 
      map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
      map.setTilt(50);
      // Atributos de los marcadores (Latitud y longitud)
      var markers = [ 
          <?php 
            if($blogs){
                foreach($blogs as $blogg){?>  
              [<?php echo "'".$blogg->nombre."'";  ?>,<?php echo $blogg->latitud; ?>,<?php echo $blogg->longitud; ?>,<?php echo "'Img/".$blogg->img."'"; ?>,<?php echo $blogg->categoria; ?> ],  

            <?php  } }  ?>
      ];           
      // Contenido de la ventana de informacion 
      var infoWindowContent = [
          <?php 
            if($blogs){
              foreach($blogs as $blogg){?> 
          ['<div style="float:left; padding-right: 10px;"><img width="300px" height="200px" alt="" src="Img/<?php echo $blogg->img; ?>"> </div> '+ ' <div class="info_content">'+'<h3> <?php echo $blogg->nombre; ?> </h3>'+'<p>  <?php echo $blogg->descripcion; ?>  </p>'+'</div>'],
          <?php }} ?>
      ]; 
      // Agregar varios marcadores al mapa
      var infoWindow = new google.maps.InfoWindow(), marker, i;   
      // lugar de cada marcador  
      for( i = 0; i < markers.length; i++ ) {
          
          //Asignar icono por categoria 
          p = null;
          categoria = markers[i][4];
          switch (categoria) {
                        case 2:
                            p = 'Img/iconos/munici.png';
                            break;
                        case 3:
                            p = 'Img/iconos/supermerc.png';
                            break;    
                        case 4:
                            p = 'Img/iconos/pago.png';
                            break;
                        case 5:
                            p = 'Img/iconos/entret.png';
                            break;
                        case 6:
                            p = 'Img/iconos/bencina.png';
                            break;
                        case 7:
                            p = 'Img/iconos/farmacia.png';
                            break;
                        case 8:
                            p = 'Img/iconos/recreacion.png';
                            break;
                        case 8:
                            p = 'Img/iconos/rest.png';
                            break;
                        case 9:
                            p = 'Img/iconos/police2.png';
                            break;
                        case 11:
                            p = 'Img/iconos/munici.png';
                            break;
                        case 12:
                            p = 'Img/iconos/supermerc.png';
                            break;
                        case 13:
                            p = 'Img/iconos/tiendas.png';
                            break;
                        case 14:
                            p = 'Img/iconos/iglesia.png';
                            break;
      }

          //Posicion del marcador
          var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
         
          bounds.extend(position);

          marker = new google.maps.Marker({            
              position: position,
              map: map,
              title: markers[i][0] ,
              icon : {
                    url: p,
                    scaledSize: new google.maps.Size(35, 35), // tamaño escala
                    origin: new google.maps.Point(0, 0), // origen
                    anchor: new google.maps.Point(0, 32), // anchor
              } 
          });
          
          // agregar ventana de  informacion al marcador  
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {
                 
                  infoWindow.setContent(infoWindowContent[i][0]);
                  infoWindow.open(map, marker);
              }
          })(marker, i));

         
          map.fitBounds(bounds);
      }
      // centrar el mapa donde estan los marcadores boundaries
          //map.fitBounds(bounds);

      // Cambiar el nivel del zoom
      /*var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
          this.setZoom(12);
          google.maps.event.removeListener(boundsListener);
      });
*/

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude

            };
            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Mi ubicación');
          var markers = new google.maps.Marker({
              position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
              map: map,
              title: "Usted está aquí."

          });
          //infoWindow.setContent('Location found.');
          var infoWindowContents = ['</div> '+ '<div class="info_content">'+'<h3>  Mi ubicación </h3>'+'<p>  </p>'+'</div>']; 

            //infoWindow.open(map);
            map.setCenter(pos);

          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }


  }

   function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }


  // Cargar funcion para inciar el mapa
  //google.maps.event.addDomListener(window, 'load', initMap);
</script>
<!-- ************* --> 
      <div  id="mapCanvas" ></div>                              
    </div>

</html>