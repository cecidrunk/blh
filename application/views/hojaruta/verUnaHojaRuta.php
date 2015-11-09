

<aside class="right-side">
   <!-- section header -->
   <section class="content-header">
      <h1>
         Ver una Hoja de Ruta
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
         <li><a href="#">Hoja de Ruta</a></li>
         <li class="active">Ver una hoja de ruta</li>
      </ol>
   </section>
   <!-- fin section header -->
   <!-- section body -->
   <section class="content-body">
      <div class="row">
         <div class="col-xs-12">
            <?php foreach ($unaHR as $value) :?>
            <form class="form-horizontal" role="form">
               <div class="form-group">
                  <label class="col-lg-2 control-label">Id HR</label>
                  <div class="col-lg-3">
                     <input class="form-control" id="idhr" disabled="" value="<?php echo $value->idHojaDeRuta?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg-2 control-label">F. de Creacion</label>
                  <div class="col-lg-3">
                     <input class="form-control" id="fcracion" disabled="" value="<?php echo $value->fechaCreacionHdR?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg-2 control-label">F. de Recorrido</label>
                  <div class="col-lg-3">
                     <input class="form-control" id="frecorrido" disabled="" value="<?php echo $value->fechaRecorrido?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg-2 control-label">F. de Efectivizacion</label>
                  <div class="col-lg-3">
                     <input class="form-control" id="fefectivizacion" disabled="" value="<?php echo $value->fechaEfectivizacion?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg-2 control-label">F. Ultima Modif</label>
                  <div class="col-lg-3">
                     <input class="form-control" id="fultmodif" disabled="" value="<?php echo $value->fechaUltModificacion?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg-2 control-label">Zona</label>
                  <div class="col-lg-3">
                     <input class="form-control" id="zona" disabled="" value="<?php echo $value->zona?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg-2 control-label">Chofer</label>
                  <div class="col-lg-3">
                     <input class="form-control" id="chofer" disabled="" value="<?php echo $value->chofer?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg-2 control-label">Asistente</label>
                  <div class="col-lg-3">
                     <input class="form-control" id="asistente" disabled="" value="<?php echo $value->asistente?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg-2 control-label">Obsservaciones</label>
                  <div class="col-lg-3">
                     <input class="form-control" id="observaciones" disabled="" value="<?php echo $value->observaciones?>">
                  </div>
               </div>
            </form>
            <?php endforeach ?>
         </div>
      </div>
   </section>
   <!-- fin section body -->
</aside>
<!-- /.right-side -->
