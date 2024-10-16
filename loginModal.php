<!-- Modal de inicio de sesión -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content card shadow-lg border-0 rounded-lg mt-5">
        <div class="modal-header modal-header bg-primary text-white">
          <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="login.php" method="post">
            <div class="form-group">
              <label for="inputUsuario">Usuario</label>
              <input type="text" class="form-control" id="inputUsuario" name="inputUsuario" required>
            </div>
            <div class="form-group">
              <label for="inputPassword">Contraseña:</label>
              <input type="password" class="form-control" id="inputPassword" name="inputPassword" required>
              <input type="checkbox" id="verPassw" class="mt-3"> <span class="small color-text-aux posicion-aux" >Ver contraseña</span> 
            </div>
            <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
              <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            </div>
          </form>
        </div>
        <div class="modal-footer text-center py-3"></div>
      </div>
  </div>
</div>
