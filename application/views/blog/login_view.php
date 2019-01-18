
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Inicio de sesión</title>
    <link href="<?php echo base_url('flat/dist/css/flat-ui.css') ?>" rel="stylesheet">
    <link href='loguito.png' rel='shortcut icon' type='image/png'>
<!--<link href="docs/assets/css/demo.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="asset/css/style.css" /> 
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">-->
     <style type="text/css">
     body{

          background-color: #34495e;
          font-family: Arial;
     }
     h2{
          color: #ecf0f1;
          font-size: 38px;
     }
     h4 {
          color: #ecf0f1;
          font-size: 28px;
     }
     .colbox {
          margin-left: 0px;
          margin-right: 0px;
     }
     @media screen and (min-width: 400px) {

          #containerlogin{
            width: 80%;
           float: right;

          }

          #rowlogin{
            width: 70%;
          }
     }
        @media screen and (max-width: 400px) {

           h2 {
               
               font-size :33px;
          }
          h4{
               font-size :19px;
          }
     }


     </style>
    
</head>
<body >
<div class="container" >
     <div class="row">
          
             <div  class="form-group">
               <h2>Puntos de interés</h2>
               <h4>Ingrese Sesión para entrar al sitio</h4>
          
          </div>
     </div>
</div>
<hr/>

<div id="containerlogin" class="container" >
     <div  id="rowlogin" class="row"  >
          <div class="col-lg-4 col-sm-4 well btn_info" style="width: 100%">
          <?php 
          $attributes = array("class" => "form-horizontal", "id" => "loginform", "name" => "loginform");
          echo form_open(base_url('index.php/puntos/admin'), $attributes);?>
          <fieldset>
               <legend>Iniciar Sesión</legend>
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
                    <label for="txt_username" class="control-label">Nombre de usuario</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_username" name="txt_username" placeholder="" type="text"  value="<?php echo set_value('txt_username'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_username'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
               <label for="txt_password" class="control-label">Contraseña</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_password" name="txt_password" placeholder="" type="password" value="<?php echo set_value('txt_password'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_password'); ?></span>
               </div>
               </div>
               </div>
                            
               <div class="form-group">
               <div class="col-lg-12 col-sm-12 text-center">
                    <input id="btn_login " name="btn_login" type="submit" class="btn btn-inverse" value="Iniciar Sesion" />
               </div>
               </div>
               
                
          </fieldset>

          <?php echo form_close(); ?>
          <?php echo $this->session->flashdata('msg'); ?>
          <?php //echo $this->session->flashdata('err'); ?>
          </div>
     </div>
</div>
</body>

</html>