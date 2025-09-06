<?php

namespace App\Models;
use CodeIgniter\Model;

class Subcategoria extends Model
{
    protected $table      = 'subcategorias';
    protected $primaryKey = 'idsubcategoria';
    protected $allowedFields = ['subcategoria', 'idcategoria'];

    public function getByCategoria($idcategoria)
    {
        return $this->where('idcategoria', $idcategoria)
                    ->orderBy('subcategoria', 'ASC')
                    ->findAll();
    }
}