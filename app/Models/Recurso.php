<?php

namespace App\Models;
use CodeIgniter\Model;

class Recurso extends Model{

    protected $table      = 'vw_recursos';   
    protected $primaryKey = 'idrecurso';     

    protected $allowedFields = [
        'idrecurso',
        'categoria',
        'subcategoria',
        'editorial',
        'tipo',
        'titulo',
        'apublicacion',
        'isbn',
        'numpaginas',
        'rutaportada',
        'rutarecurso',
        'estado',
        'creado',
        'modificado'
    ];
}
