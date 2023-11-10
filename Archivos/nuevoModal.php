<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
</button>


<div class="modal fade" id="nuevoModal" tabindex="-1" role="dialog" 
aria-labelledby="nuevoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nuevoModalLabel"> Insertar Politicos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <div class="modal-body">
        <form action="guarda.php" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="nombre" class="form-label"> Nombre:</label>
                <input type="text"  name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label"> Apellido:</label>
                <input type="text"  name="apellido" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="cargo" class="form-label"> Cargo:</label>
                <input type="text"  name="cargo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nacimiento" class="form-label"> Fecha de Nacimiento:</label>
                <input type="date"  name="nacimiento" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="educacion" class="form-label"> Educacion:</label>
                <input type="text"  name="educacion" class="form-control" required>
            </div>

           <div class="mb-3">
                <label for="partido" class="form-label"> Partido:</label>
                <select name="partido" class="form-control" required>
                    <option value="">Seleccionar...</option>
                        <?php while ($row_partido = $partidoss->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?= $row_partido['id']; ?>"><?= $row_partido['nombre']; ?></option>
        
                        <?php } ?>
                </select>
            </div>
              
            </div>
 

            <div class="mb-3 mx-auto text-center">
    <label for="biografia" class="form-label">Biografía:</label>
    <div class="col-12">
        <textarea name="biografia" class="form-control" rows="3" style="width: 100%;" required></textarea>
    </div>
</div>
            <div class="mb-3">
                 <label for="imagen" class="form-label">Seleccionar imagen:</label>
                 <input type="file" name="imagen" class="form-control" accept="image/jpg" required>
            </div>

            <div class="">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary"><i class="fa-solid
             fa-floppy-disk"></i>Guadar registro</button>
            </div>


        </form>  
  </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>