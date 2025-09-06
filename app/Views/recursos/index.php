<?= $header; ?>

<div class="container mt-4">
  <!-- Título centrado -->
  <div class="row mb-3">
    <div class="col text-center">
      <h3 class="fw-bold text-primary">
        <i class="bi bi-journal-bookmark-fill"></i> Lista de Recursos
      </h3>
    </div>
  </div>

  <div class="table-responsive shadow-sm rounded">
    <table class="table table-hover table-bordered align-middle text-center">
      <thead class="table-primary">
        <tr>
          <th>#</th>
          <th>Título</th>
          <th>Categoría</th>
          <th>Subcategoría</th>
          <th>Editorial</th>
          <th>Tipo</th>
          <th>Año</th>
          <th>ISBN</th>
          <th>Páginas</th>
          <th>Portada</th>
          <th>Recurso</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">

        <?php foreach($recursos as $recurso): ?>
        <tr>
          <td class="fw-semibold"><?= $recurso['idrecurso'] ?></td>
          <td class="text-start"><?= $recurso['titulo'] ?></td>
          <td><?= $recurso['categoria'] ?></td>
          <td><?= $recurso['subcategoria'] ?></td>
          <td><?= $recurso['editorial'] ?></td>
          <td>
            <span class="badge bg-<?= $recurso['tipo'] == 'DIGITAL' ? 'info' : 'secondary' ?>">
              <?= $recurso['tipo'] ?>
            </span>
          </td>
          <td><?= $recurso['apublicacion'] ?></td>
          <td><small><?= $recurso['isbn'] ?></small></td>
          <td><?= $recurso['numpaginas'] ?></td>
          
          <!-- COLUMNA PORTADA -->
          <td>
            <?php if(!empty($recurso['rutaportada'])): ?>
              <img src="<?= base_url($recurso['rutaportada']) ?>" 
                   alt="Portada" class="img-thumbnail rounded shadow-sm" style="width: 70px; height: 100px; object-fit: cover;">
            <?php else: ?>
              <span class="text-muted small">Sin portada</span>
            <?php endif; ?>
          </td>
          
          <!-- COLUMNA RECURSO -->
          <td>
            <?php if(!empty($recurso['rutarecurso'])): ?>
              <a href="<?= base_url($recurso['rutarecurso']) ?>" 
                 target="_blank" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-download"></i> Descargar
              </a>
            <?php else: ?>
              <span class="text-muted small">No disponible</span>
            <?php endif; ?>
          </td>
          
          <td>
            <span class="badge 
              <?php 
                if($recurso['estado'] == 'BUENO') echo 'bg-success';
                elseif($recurso['estado'] == 'REGULAR') echo 'bg-warning text-dark';
                else echo 'bg-danger';
              ?>">
              <?= $recurso['estado'] ?>
            </span>
          </td>
        </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

  <!-- Botón Registrar centrado usando Bootstrap -->
  <div class="row mt-4">
    <div class="col text-center">
      <a href="<?= base_url("recursos/crear"); ?>" class="btn btn-success shadow-sm">
        <i class="bi bi-plus-circle"></i> Registrar Nuevo Recurso
      </a>
    </div>
  </div>
</div>

<?= $footer; ?>