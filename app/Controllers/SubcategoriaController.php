<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Subcategoria;

class SubcategoriaController extends BaseController
{
    public function getSubcategoriasByCategoria($idcategoria = "")
    {
        $this->response->setContentType('application/json');

        if (empty($idcategoria)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID de categoría no proporcionado'
            ]);
        }

        $subcategoriaModel = new Subcategoria();

        $listaSubcategorias = $subcategoriaModel
                                ->where('idcategoria', $idcategoria)
                                ->orderBy('subcategoria', 'ASC')
                                ->findAll();

        return $this->response->setJSON($listaSubcategorias);
    }
}
