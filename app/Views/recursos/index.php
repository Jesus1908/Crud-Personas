<?= $header; ?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold text-primary">
      <i class="bi bi-journal-bookmark-fill"></i> Lista de Recursos
    </h3>
    <a href="<?= base_url("recursos/crear"); ?>" class="btn btn-sm btn-success shadow-sm">
      <i class="bi bi-plus-circle"></i> Registrar
    </a>
  </div>

  <div class="table-responsive shadow-sm rounded">
    <table class="table table-hover table-bordered align-middle text-center">
      <thead class="table-primary">
        <tr>
          <th>#</th>
          <th>Categoría</th>
          <th>Subcategoría</th>
          <th>Editorial</th>
          <th>Tipo</th>
          <th>Título</th>
          <th>Año Publicación</th>
          <th>ISBN</th>
          <th>N° Páginas</th>
          <th>Portada</th>
          <th>Recurso</th>
          <th>Estado</th>
          <th>Creado</th>
          <th>Modificado</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">

        <?php foreach($recursos as $recurso): ?>
        <tr>
          <td class="fw-semibold"><?= $recurso['idrecurso'] ?></td>
          <td><?= $recurso['categoria'] ?></td>
          <td><?= $recurso['subcategoria'] ?></td>
          <td><?= $recurso['editorial'] ?></td>
          <td>
            <span class="badge bg-<?= $recurso['tipo'] == 'DIGITAL' ? 'info' : 'secondary' ?>">
              <?= $recurso['tipo'] ?>
            </span>
          </td>
          <td class="text-start"><?= $recurso['titulo'] ?></td>
          <td><?= $recurso['apublicacion'] ?></td>
          <td><?= $recurso['isbn'] ?></td>
          <td><?= $recurso['numpaginas'] ?></td>
          <td>
            <img src="<?= base_url("uploads/") ?><?= $recurso['rutaportada'] ?>" 
                 alt="Portada" class="img-thumbnail rounded shadow-sm" style="width: 70px; height: auto;">
          </td>
          <td>
            <?php if($recurso['tipo'] == 'DIGITAL'): ?>
              <a href="<?= base_url("uploads/") ?><?= $recurso['rutarecurso'] ?>" 
                 target="_blank" class="btn btn-sm btn-outline-primary">
                Ver
              </a>
            <?php else: ?>
              <span class="text-muted">No aplica</span>
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
          <td><small class="text-muted"><?= $recurso['creado'] ?></small></td>
          <td><small class="text-muted"><?= $recurso['modificado'] ?></small></td>
        </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
</div>

<?= $footer; ?>

