<?php

namespace App\Models;
use CodeIgniter\Model;

class Recurso extends Model
{
    protected $table      = 'recursos'; 
    protected $primaryKey = 'idrecurso';
    
    protected $allowedFields = [
        'idsubcategoria',   
        'ideditorial',     
        'tipo', 
        'titulo', 
        'apublicacion', 
        'isbn', 
        'numpaginas', 
        'rutaportada', 
        'rutarecurso', 
        'estado'
    ];
    
    protected $useTimestamps = true;
    protected $createdField  = 'creado';
    protected $updatedField  = 'modificado';
}