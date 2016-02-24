<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1>
   Editar Usuario
  </h1>
  <ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>index.php/page/view/"><i class="fa fa-home"></i> Home</a></li>
  
   <li class="active">Editar Usuario </li>
  </ol>
 </section>
  <section class="content">
    <form id="formEditarUsuario" class="form-horizontal" data-toggle="validator"role="form" method="POST" 
    action="<?php echo base_url();?>index.php/clogin/editarUsuario" >
    <div class="container">
      <div style="display:none">
        <input name="idUsuario" value="<?php echo $unUsuario[0]->idUsuario?>">
      </div>
      <div class="form-group">
        <label class="col-lg-2">Nombre</label>
        <input class="col-lg-2" type="text" id="nombre" name="nombre" 
        value="<?php echo $unUsuario[0]->nombre; ?>" required>
      </div>
      <div class="form-group">
        <label class="col-lg-2">Apellido</label>
        <input class="col-lg-2" type="text" id="apellido" name="apellido" 
        value="<?php  echo $unUsuario[0]->apellido;?>" >
      </div>
      <div class="form-group">
        <label class="col-lg-2">Nombre de Usuario</label>
        <input class="col-lg-2" type="text" id="nomUsuario" name="nomUsuario" 
        value="<?php  echo $unUsuario[0]->nombreUsuario;?>" >
      </div>
      <div class="form-group">
        <label class="col-lg-2">Contraseña</label>
        <input class="col-lg-2" type="password" id="pass" name="pass" 
        value="<?php  echo $unUsuario[0]->password;?>" >
      </div>
      <div class="form-group">
        <label class="col-lg-2">Email</label>
        <input class="col-lg-2" type="text" id="email" name="email" 
        value="<?php  echo $unUsuario[0]->email;?>" >
      </div>
    </div>
  <div class="pull-right">
    <a class="btn btn-primary btn-md" href="javascript:window.history.back();">Volver</a>
    <button class="btn btn-success" id="bEditarUsuario" type="submit">Guardar Cambios Usuario</button>
  </div>
    </form>
  </section><!-- /.content -->

</aside><!-- /.right-side -->
<!-- llamado al js de hoja de ruta -->
<script src="<?php echo base_url();?>assets/internals/js/logininfo.js" type="text/javascript" charset="utf-8" async defer></script>

