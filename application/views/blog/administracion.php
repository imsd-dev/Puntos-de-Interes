<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Mantenedores</title>
    <link href='loguito.png' rel='shortcut icon' type='image/png'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
         body{
            background-color: #34495e;
            font-family: Arial;
         }
         h2{
            color: #ecf0f1;
            font-size: 38px;
            font-family: inherit;
            margin-top: 5px;
            margin-left:  20px;
            margin-bottom: 0px;
          
            font-weight: 700;
            line-height: 1.1;
         }
         #tutilo {
            color: #ecf0f1;
            font-size: 28px;
            margin-top: 5px;
            margin-left:  20px;
            font-weight: 700;
         }
         .colbox {
            margin-left: 0px;
            margin-right: 0px;
         }
         @media only screen and (max-width: 400px) {
          h2 {font-size :33px;}
          h4{font-size :19px;}
         }
         /*Estilos para pantallas mayor a 1578 pixeles. Para pantallas menores, usa diseño responsivo por defecto de cada clase*/
         @media only screen and (min-width: 1578px) {
          #divCate{
            width: 20%;
            
            float: left;
          }
          #divPuntos{
            width: 90%; 
            float: right;
            max-width: 1260px;
          }
         }

          @media only screen and (min-width: 400px) {
              #cerrarsesion{
                float: right;
              }

          }

    </style>
</head>

<body >
<!-- ************************************************* Titulos ****************************** -->
  <div class="container">
    <div class="row">            
       <div  class="form-group">
         <h2>Puntos de interés</h2>
         <h4 id="tutilo">Interfáz de administración</h4>   

       </div>        

    </div>
    
  </div>
  <hr/>

<!-- ************************************************* Menu de mantenedores ****************************** -->
 
  <div id="containerlogin" class="container" >
    <div  id="rowlogin" class="row"  >
      <div class="card bg-light text-dark" style="width: 100%" >
        <div class="card-body">
          <legend >Agregar mantenedor <a id="cerrarsesion" href="<?php echo base_url('index.php/puntos/logout');?>" class="btn btn-dark">Cerrar Sesión</a> 
             </legend> 
            <div class="btn-group btn-group-justified" role="group" style="width: 100%" aria-label="..."  >
              <div class="btn-group btn-group-lg " role="group" style="width: 100%">
                <a type="button" data-toggle="modal" data-target="#AgregarCategorias"  class="btn btn-warning btn-lg btn-block"   >Categorias</a>
              </div>
              <div class="btn-group btn-group-lg " style="width: 100%" role="group">
                <a  class="btn btn-primary btn-lg btn-block"  data-toggle="modal" data-target="#AgregarPuntos">Puntos</a>
              </div>
            </div>   
        </div>       
      </div>
    </div>
    <br>
    <?php
      if($this->session->flashdata('add_msg')){
      ?>
        <div class="alert alert-danger alert-dismissible fade show">
         <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php echo $this->session->flashdata('add_msg'); ?>
        </div>
      <?php   
        }
      ?>

      <?php
        if($this->session->flashdata('success_msg')){
      ?>
        <div class="alert alert-info alert-dismissible fade show">
         <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php echo $this->session->flashdata('success_msg'); ?>
        </div>
      <?php   
        }
      ?>


      <?php
        if($this->session->flashdata('error_msg')){
      ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php echo $this->session->flashdata('error_msg'); ?>
        </div>
      <?php   
        }
      ?>

  </div>
 <?php $nivel= $this->session->userdata('nivel'); ?>

<!-- ************************************************* Tabla de categorias ****************************** -->
  <div  class="container" id="divCate"  >
    <div class="table-responsive">
      <table class="table table-dark table-striped" AllowPaging="True" >
        <thead>
          <tr>
            <td>Categoria</td>
            <td></td>
          </tr>
        </thead>
        <tbody >
            <?php 
              if($categorias){
                foreach($categorias as $cat){
                  $cate = $cat->categoria;
                  $id= $cat->id;
            ?>  
              <tr>
                <td><?php echo $cat->categoria; ?></td>

                <td <?php if($nivel==1){echo 'hidden=""';}?> >
                  <a href="<?php echo base_url('index.php/puntos/editeCate/'.$id); ?>" class="btn btn-warning" <?php if($nivel==1){echo 'hidden=""';}?>>
                    <i class="material-icons">border_color</i></span></a>
                </td>
                <td>
                  <a <?php if($nivel==1||$nivel==2){echo 'hidden=""';}?>  href="<?php echo base_url('index.php/puntos/deleteCate/'.$cat->id); ?>" class="btn btn-danger" onclick="return confirm('¿Eliminar Registro? ');"><i class="material-icons">delete</i></a>
                </td>
              
              </tr>
            <?php
                }
              }
            ?>
        </tbody>
      </table>
    </div>
  </div>

<!-- ************************************************** Tabla de puntos ********************************** -->
  <div  class="container" id="divPuntos">
    <div class="table-responsive">
      <table class="table table-dark table-striped">
            <thead>
              <tr>
                <td>Lugar      </td>
                <td>Descripcion</td>
                <td>Coodenadas </td>
                <td>imagen     </td>
                <td>Categoria  </td>
              </tr>
            </thead>
            <tbody>
              <?php 

              if($blogs){
                foreach($blogs as $blogg){
                  $id= $blogg->id;
            ?>  

              <tr>

              <td><?php echo $blogg->nombre ; ?></td>
              <td><?php echo $blogg->descripcion ; ?></td>
              <td><?php echo $blogg->latitud.', '.$blogg->longitud ; ?></td>
              <td><?php echo $blogg->img ; ?></td>
              <td><?php echo $blogg->categoria ; ?></td>
              <td <?php if($nivel==1){echo 'hidden=""';}?> >

              <a href="<?php echo base_url('index.php/puntos/editeP/'.$id); ?>" class="btn btn-warning" <?php if($nivel==1){echo 'hidden=""';}?>><i class="material-icons">border_color</i></span></a>
         </td>
        <td>
              <a <?php if($nivel==1||$nivel==2){echo 'hidden=""';}?>  href="<?php echo base_url('index.php/puntos/deleteP/'.$id); ?>" class="btn btn-danger" onclick="return confirm('¿Eliminar Registro? ');"><i class="material-icons">delete</i></a>

              </td>

              </tr>

              <?php
                }
              }
            ?>
              
            </tbody>
        </table>
    </div>
  </div>

<!-- ************************************************** Modal Agregar Categoria ************************** -->
  <div class="modal fade" id="AgregarCategorias">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title">Agregar Categoria</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- body -->
        <form  action="<?php echo base_url('index.php/puntos/submitCate') ?>"  method="post">
          <div class="modal-body">
            <div class="form-group">
                  <label for="exampleInputEmail1">Categoria:</label>
                   <input type="text-dark" class="form-control" name="txt_categoria" required pattern="[a-zA-ZñÑ\s\W]+"
                    title=" Debe ser solo texto" >
                  <small id="emailHelp" class="form-text text-muted">Ingresa nombre de la categoria.</small>
                </div> 
          </div>

          <!-- footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- ************************************************** Modal Editar Categoria *************************** -->
  <?php
      if($this->session->flashdata('modificar')){
    ?>  
        <script type="text/javascript"> 
          $(document).ready(function() { 
             $("#EditarCategorias").modal("show");
          }); 
        </script>       
    <?php   
        }
  ?>
  <?php 
  if($blog!=null){          
  ?>  
  <div class="modal fade" id="EditarCategorias">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title">Agregar Categoria</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- body -->
        <form  action="<?php echo base_url('index.php/puntos/updateCate') ?>"  method="post">
          <div class="modal-body">
            <div class="form-group">
                  <input type="text" name="txtid" value="<?php echo $blog->id; ?>"  hidden="">
                  <label for="exampleInputEmail1">Categoria:</label>
                   <input type="text-dark" class="form-control" value="<?php echo $blog->categoria; ?>" name="txt_categoria" required pattern="[a-zA-ZñÑ\s\W]+"
                    title=" Debe ser solo texto" >
                  <small id="emailHelp" class="form-text text-muted">Ingresa nombre de la categoria.</small>
                </div> 
          </div>

          <!-- footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php 
    }
  ?>

<!-- ************************************************** Modal Agregar Puntos ***************************** -->
  <div class="modal fade" id="AgregarPuntos">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title">Agregar Puntos</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- body -->
        <form  action="<?php echo base_url('index.php/puntos/submitP') ?>"  method="post" >
          <div class="modal-body">

              <div class="form-group"  >

                <div class="form-group">
                  <label for="exampleInputEmail1">Nombre:</label>
                   <input type="text-dark" class="form-control" name="txt_nombre" required pattern="[a-zA-ZñÑ\s\W]+"
                     title=" Debe ser solo texto" >
                  <small  class="form-text text-muted">Ingresa nombre del lugar.</small>
                </div>              
                <div class="form-group">
                  <label for="exampleInputEmail1">Descripcion:</label>
                   <input type="text-dark" class="form-control" name="txt_descripcion" required pattern="[a-zA-ZñÑ\s\W]+"
                    title=" Debe ser solo texto" >           
                  <small  class="form-text text-muted">Ingresa descripcion del lugar o direccion.</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Latitud:</label>
                   <input type="text-dark" class="form-control" name="txt_latitud" required >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Latitud:</label>
                   <input type="text-dark" class="form-control" name="txt_longitud" required >
                </div>
               
                <div class="form-group">
                  <label for="exampleInputEmail1">Imagen del marcador:</label>
                    <input type="text-dark" class="form-control" name="txt_imagen" required >
                  <!--
                       <form id="subirImg" name="subirImg" enctype="multipart/form-data" method="post" action="">
                        <input type="hidden"  name="MAX_FILE_SIZE" value="2000000" />
                        <input type="file" class="btn btn-secondary" name="imagen" id="imagen" />
                       
                        </form>
                  -->
                </div>
            <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->

               <div class="form-group">
                  <label for="sel1">Categoria:</label>
                  <select class="form-control" name="txt_categoria">
                    <option>Selecciona una categoria</option>  
                  <?php
                  if($categorias){

                   foreach($categorias as $cat){ ?>  
                     <option style=" font-size: 20px;"  value="<?php echo $cat->id;?>"> <?php echo $cat->categoria; ?></option>           
                 <?php } 
                       } ?>   
                  </select>
                </div> 

            <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
              </div> 
          </div>
          <!-- footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>

      </div>
    </div>
  </div>

<!-- ************************************************** Modal Editar Puntos ****************************** -->
 <?php
      if($this->session->flashdata('modificar')){
    ?>  
        <script type="text/javascript"> 
          $(document).ready(function() { 
             $("#EditarPuntos").modal("show");
          }); 
        </script>       
    <?php   
        }
  ?>
  <?php 
  if($blogp!=null){          
  ?>  
 <div class="modal fade" id="EditarPuntos">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title">Agregar Puntos</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- body -->
        <form  action="<?php echo base_url('index.php/puntos/updateP') ?>"  method="post" >
          <div class="modal-body">

              <div class="form-group"  >

                <div class="form-group">
                    <input type="text" name="txtid" value="<?php echo $blogp->id; ?>"  hidden="">
                  <label for="exampleInputEmail1">Nombre:</label>
                   <input type="text-dark" class="form-control" value="<?php echo $blogp->nombre; ?>" name="txt_nombre" required pattern="[a-zA-ZñÑ\s\W]+"
                     title=" Debe ser solo texto" >
                  <small  class="form-text text-muted">Ingresa nombre del lugar.</small>
                </div>              
                <div class="form-group">
                  <label for="exampleInputEmail1">Descripcion:</label>
                   <input type="text-dark" class="form-control" value="<?php echo $blogp->descripcion; ?>" name="txt_descripcion" required pattern="[a-zA-ZñÑ\s\W]+"
                    title=" Debe ser solo texto" >           
                  <small  class="form-text text-muted">Ingresa descripcion del lugar o direccion.</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Latitud:</label>
                   <input type="text-dark" class="form-control" value="<?php echo $blogp->latitud; ?>" name="txt_latitud" required >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Latitud:</label>
                   <input type="text-dark" class="form-control" value="<?php echo $blogp->longitud; ?>" name="txt_longitud" required >
                </div>
               
                <div class="form-group">
                  <label for="exampleInputEmail1">Imagen del marcador:</label>
                    <input type="text-dark" class="form-control" value="<?php echo $blogp->img; ?>" name="txt_imagen" required >
                  <!--
                       <form id="subirImg" name="subirImg" enctype="multipart/form-data" method="post" action="">
                        <input type="hidden"  name="MAX_FILE_SIZE" value="2000000" />
                        <input type="file" class="btn btn-secondary" name="imagen" id="imagen" />
                       
                        </form>
                            categoria  
                  -->
                </div>
            <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->

               <div class="form-group">
                  <label for="sel1">Categoria:</label>
                  <select class="form-control" name="txt_categoria">
                    <option>Selecciona una categoria</option>  
                  <?php
                  $dat= $blogp->categoria;
                  if($categorias){                                            
                   foreach($categorias as $cat){ ?>  
                     <option style=" font-size: 20px;" <?php if($dat== $cat->id){echo "selected";} ?> value="<?php echo $cat->id;?>"> <?php echo $cat->categoria; ?></option>           
                 <?php } 
                       } ?>   
                  </select>
                </div> 

            <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
              </div> 
          </div>
          <!-- footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>

      </div>
    </div>
  </div>












  <?php 
      }
    ?>
</body>

