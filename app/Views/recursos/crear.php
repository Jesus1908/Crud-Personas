<?= $header; ?>
<style>
  .form-control:focus, .form-select:focus {
    background-color: aliceblue;
  }
</style>

<div class="container mt-2">
  <div class="my-2">
    <h4>Registro de Recursos</h4>
    <a href="<?= base_url("recursos"); ?>">Volver</a>
  </div>

  <form id="formRecurso" action="<?= base_url('recursos/guardar'); ?>" method="POST" enctype="multipart/form-data">
    <div class="card">
      <div class="card-body">

        <div class="row g-2">
          <div class="col-md-6 mb-2">
            <label for="titulo">Título del recurso</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required>
          </div>
          <div class="col-md-6 mb-2">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Ejemplo: 978-3-16-148410-0" required>
          </div>
        </div>

        <!-- Categoría, Subcategoría, Editorial -->
        <div class="row g-2">
          <div class="col-md-4 mb-2">
            <label for="idcategoria">Categoría</label>
            <select name="idcategoria" id="idcategoria" class="form-select" required>
              <option value="">Seleccione una categoría</option>
              <?php foreach($categorias as $cat): ?>
                <option value="<?= $cat['idcategoria']; ?>"><?= $cat['categoria']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-4 mb-2">
            <label for="idsubcategoria">Subcategoría</label>
            <select name="idsubcategoria" id="idsubcategoria" class="form-select" required>
              <option value="">Seleccione una subcategoría</option>
            </select>
          </div>
          <div class="col-md-4 mb-2">
            <label for="ideditorial">Editorial</label>
            <select name="ideditorial" id="ideditorial" class="form-select" required>
              <option value="">Seleccione una editorial</option>
              <?php foreach($editoriales as $edit): ?>
                <option value="<?= $edit['ideditorial']; ?>"><?= $edit['empresa']; ?> (<?= $edit['nacionalidad']; ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-4 mb-2">
            <label for="apublicacion">Año de publicación</label>
            <input type="number" class="form-control" id="apublicacion" name="apublicacion" min="1900" max="<?= date('Y'); ?>" required>
          </div>
          <div class="col-md-4 mb-2">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" class="form-select" required>
              <option value="">Seleccione un tipo</option>
              <option value="FISICO">Físico</option>
              <option value="DIGITAL">Digital</option>
            </select>
          </div>
          <div class="col-md-4 mb-2">
            <label for="numpaginas">Número de páginas</label>
            <input type="number" class="form-control" id="numpaginas" name="numpaginas" min="1" required>
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-6 mb-2">
            <label for="rutaportada">Portada</label>
            <input type="file" class="form-control" id="rutaportada" name="rutaportada" accept="image/*">
          </div>
          <div class="col-md-6 mb-2">
            <label for="rutarecurso">Archivo del recurso</label>
            <input type="file" class="form-control" id="rutarecurso" name="rutarecurso" accept=".pdf,.epub,.docx">
          </div>
        </div>

        <!-- Estado -->
        <div class="mb-2">
          <label for="estado">Estado</label>
          <select name="estado" id="estado" class="form-select" required>
            <option value="">Seleccione un estado</option>
            <option value="BUENO">Bueno</option>
            <option value="REGULAR">Regular</option>
            <option value="MALO">Malo</option>
          </select>
        </div>

      </div>

      <div class="card-footer text-end">
        <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href='<?= base_url('recursos'); ?>'">Cancelar</button>
        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const categoriaSelect = document.getElementById("idcategoria");
  const subcategoriaSelect = document.getElementById("idsubcategoria");

  // Cargar subcategorías cuando cambia la categoría
  categoriaSelect.addEventListener('change', function() {
    const idcategoria = this.value;
    
    subcategoriaSelect.innerHTML = '<option value="">Cargando subcategorías...</option>';
    
    if (!idcategoria) {
      subcategoriaSelect.innerHTML = '<option value="">Seleccione una categoría primero</option>';
      return;
    }

    fetch(`<?= base_url('recursos/getSubcategoriasByCategoria/') ?>${idcategoria}`)
      .then(response => response.json())
      .then(data => {
        subcategoriaSelect.innerHTML = '<option value="">Seleccione una subcategoría</option>';
        
        if (data && data.length > 0) {
          data.forEach(subcategoria => {
            subcategoriaSelect.innerHTML += `<option value="${subcategoria.idsubcategoria}">${subcategoria.subcategoria}</option>`;
          });
        } else {
          subcategoriaSelect.innerHTML = '<option value="">No hay subcategorías para esta categoría</option>';
        }
      })
      .catch(error => {
        console.error('Error:', error);
        subcategoriaSelect.innerHTML = '<option value="">Error al cargar subcategorías</option>';
      });
  });

  // Cargar subcategorías al iniciar si ya hay una categoría seleccionada
  if (categoriaSelect.value) {
    categoriaSelect.dispatchEvent(new Event('change'));
  }
});
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $footer; ?>