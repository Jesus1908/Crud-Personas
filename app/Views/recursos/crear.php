<?= $header; ?>
<style>
  .form-control:focus, .form-select:focus {
    background-color: aliceblue;
  }
  .form-text {
    font-size: 0.8rem;
    color: #6c757d;
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
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required maxlength="255">
            <div class="form-text">Máximo 255 caracteres</div>
          </div>
          <div class="col-md-6 mb-2">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Ejemplo: 978-3-16-148410-0" required maxlength="20">
            <div class="form-text">Máximo 20 caracteres (con o sin guiones)</div>
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
            <div class="form-text">Desde 1900 hasta <?= date('Y'); ?></div>
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
            <input type="number" class="form-control" id="numpaginas" name="numpaginas" min="1" max="5000" required>
            <div class="form-text">Mínimo 1 página, máximo 5000</div>
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-6 mb-2">
            <label for="rutaportada">Portada</label>
            <input type="file" class="form-control" id="rutaportada" name="rutaportada" accept="image/jpeg,image/png,image/jpg">
            <div class="form-text">Formatos: JPG, PNG. Máx. 2MB</div>
          </div>
          <div class="col-md-6 mb-2">
            <label for="rutarecurso">Archivo del recurso</label>
            <input type="file" class="form-control" id="rutarecurso" name="rutarecurso" accept=".pdf,.epub,.docx">
            <div class="form-text">Formatos: PDF, EPUB, DOCX. Máx. 10MB</div>
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
        <button class="btn btn-sm btn-outline-secondary" type="button" onclick="confirmarCancelacion()">Cancelar</button>
        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const categoriaSelect = document.getElementById("idcategoria");
  const subcategoriaSelect = document.getElementById("idsubcategoria");
  const formulario = document.getElementById("formRecurso");
  const tipoSelect = document.getElementById("tipo");
  const archivoRecurso = document.getElementById("rutarecurso");
  const portadaInput = document.getElementById("rutaportada");
  const isbnInput = document.getElementById("isbn");
  const paginasInput = document.getElementById("numpaginas");

  function validarISBN(isbn) {
    return isbn.length <= 20;
  }

  function validarArchivo(archivo, maxSizeMB, tiposPermitidos) {
    if (!archivo.files[0]) return true; 
    
    const file = archivo.files[0];
    const extension = file.name.split('.').pop().toLowerCase();
    const sizeMB = file.size / (1024 * 1024);
    
    if (sizeMB > maxSizeMB) {
      return `El archivo excede el tamaño máximo de ${maxSizeMB}MB`;
    }
    
    if (!tiposPermitidos.includes('.' + extension)) {
      return `Formato no permitido. Use: ${tiposPermitidos.join(', ')}`;
    }
    
    return true;
  }

  tipoSelect.addEventListener('change', function() {
    const tipo = this.value;
    
    if (tipo === 'FISICO') {
      archivoRecurso.disabled = true;
      archivoRecurso.required = false;
      archivoRecurso.value = '';
      
      portadaInput.disabled = false;
      portadaInput.required = true;
      
    } else if (tipo === 'DIGITAL') {
      archivoRecurso.disabled = false;
      archivoRecurso.required = true;
      
      portadaInput.disabled = true;
      portadaInput.required = false;
      portadaInput.value = '';
    }
  });

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

  formulario.addEventListener('submit', function(e) {
    e.preventDefault();
    if (!validarISBN(isbnInput.value)) {
      Swal.fire({
        icon: 'error',
        title: 'ISBN inválido',
        text: 'El ISBN no puede exceder los 20 caracteres',
        confirmButtonText: 'Entendido'
      });
      isbnInput.focus();
      return;
    }

    if (paginasInput.value < 1 || paginasInput.value > 5000) {
      Swal.fire({
        icon: 'error',
        title: 'Número de páginas inválido',
        text: 'El número de páginas debe estar entre 1 y 5000',
        confirmButtonText: 'Entendido'
      });
      paginasInput.focus();
      return;
    }

    const tipo = tipoSelect.value;

    if (tipo === 'FISICO') {
      const validacionPortada = validarArchivo(portadaInput, 2, ['.jpg', '.jpeg', '.png']);
      if (validacionPortada !== true) {
        Swal.fire({
          icon: 'error',
          title: 'Error en la portada',
          text: validacionPortada,
          confirmButtonText: 'Entendido'
        });
        return;
      }
    } else if (tipo === 'DIGITAL') {
      const validacionArchivo = validarArchivo(archivoRecurso, 10, ['.pdf', '.epub', '.docx']);
      if (validacionArchivo !== true) {
        Swal.fire({
          icon: 'error',
          title: 'Error en el archivo',
          text: validacionArchivo,
          confirmButtonText: 'Entendido'
        });
        return;
      }
    }

    const camposRequeridos = formulario.querySelectorAll('[required]');
    let camposVacios = [];
    
    camposRequeridos.forEach(campo => {
      if (!campo.value.trim() && !campo.disabled) {
        camposVacios.push(campo.previousElementSibling.textContent.trim());
      }
    });
    
    if (camposVacios.length > 0) {
      Swal.fire({
        icon: 'warning',
        title: 'Campos incompletos',
        html: 'Por favor complete los siguientes campos:<br><strong>' + camposVacios.join(', ') + '</strong>',
        confirmButtonText: 'Entendido'
      });
      return;
    }

    // Confirmar envío del formulario
    Swal.fire({
      title: '¿Confirmar registro?',
      text: '¿Está seguro de guardar este recurso?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        formulario.submit();
      }
    });
  });

  // Validación del ISBN
  isbnInput.addEventListener('blur', function() {
    if (this.value && !validarISBN(this.value)) {
      Swal.fire({
        icon: 'warning',
        title: 'ISBN inválido',
        text: 'El ISBN no puede exceder los 20 caracteres',
        confirmButtonText: 'Entendido'
      });
    }
  });

  if (categoriaSelect.value) {
    categoriaSelect.dispatchEvent(new Event('change'));
  }

  if (tipoSelect.value) {
    tipoSelect.dispatchEvent(new Event('change'));
  }
});

function confirmarCancelacion() {
  Swal.fire({
    title: '¿Cancelar registro?',
    text: 'Los datos no guardados se perderán',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, cancelar',
    cancelButtonText: 'Continuar editando'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = '<?= base_url('recursos') ?>';
    }
  });
}
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $footer; ?>