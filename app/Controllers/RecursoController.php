<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Recurso;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Editorial;

class RecursoController extends BaseController
{
public function index(): string
{
    $recursoModel = new \App\Models\Recurso();
    
    $datos['recursos'] = $recursoModel->select('recursos.*, categorias.categoria, subcategorias.subcategoria, editoriales.empresa as editorial, editoriales.nacionalidad')
    ->join('subcategorias', 'recursos.idsubcategoria = subcategorias.idsubcategoria')
    ->join('categorias', 'subcategorias.idcategoria = categorias.idcategoria')
    ->join('editoriales', 'recursos.ideditorial = editoriales.ideditorial')
    ->orderBy('recursos.idrecurso', 'ASC')
    ->findAll();

    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');

    return view('recursos/index', $datos);
}

    // Método para mostrar el formulario de creación
    public function crear(): string
    {
        $categoria = new Categoria();
        $editorial = new Editorial();

        $datos = [
            'categorias' => $categoria->orderBy('categoria', 'ASC')->findAll(),
            'editoriales' => $editorial->orderBy('empresa', 'ASC')->findAll(),
            'header' => view('Layouts/header'),
            'footer' => view('Layouts/footer')
        ];

        return view('recursos/crear', $datos);
    }

    // Método para obtener subcategorías por categoría (AJAX)
    public function getSubcategoriasByCategoria($idcategoria)
    {
        $subcategoria = new Subcategoria();
        $subcategorias = $subcategoria->where('idcategoria', $idcategoria)
                                          ->orderBy('subcategoria', 'ASC')
                                          ->findAll();

        return $this->response->setJSON($subcategorias);
    }

    public function guardar()
    {
        $recurso = new Recurso();;
    
        $idsubcategoria = $this->request->getPost('idsubcategoria');
    
        // Preparar datos para insertar
        $datos = [
            'idsubcategoria' => $this->request->getPost('idsubcategoria'),
            'ideditorial' => $this->request->getPost('ideditorial'),
            'tipo' => $this->request->getPost('tipo'),
            'titulo' => $this->request->getPost('titulo'),
            'apublicacion' => $this->request->getPost('apublicacion'),
            'isbn' => $this->request->getPost('isbn'),
            'numpaginas' => $this->request->getPost('numpaginas'),
            'estado' => $this->request->getPost('estado')
        ];

        // Manejar la subida de archivos (portada y recurso)
        $portada = $this->request->getFile('rutaportada');
        $recursoFile = $this->request->getFile('rutarecurso');

        if ($portada && $portada->isValid() && !$portada->hasMoved()) {
            $nuevoNombrePortada = $portada->getRandomName();
            $portada->move(ROOTPATH . 'public/uploads/portadas', $nuevoNombrePortada);
            $datos['rutaportada'] = 'uploads/portadas/' . $nuevoNombrePortada;
        }

        if ($recursoFile && $recursoFile->isValid() && !$recursoFile->hasMoved()) {
            $nuevoNombreRecurso = $recursoFile->getRandomName();
            $recursoFile->move(ROOTPATH . 'public/uploads/recursos', $nuevoNombreRecurso);
            $datos['rutarecurso'] = 'uploads/recursos/' . $nuevoNombreRecurso;
        }

        // Insertar en la base de datos
        $recurso->insert($datos);

        $session = session();
        $session->setFlashdata('mensaje', 'Recurso creado exitosamente');

        return redirect()->to('/recursos');
    }

}