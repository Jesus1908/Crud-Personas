<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Recurso;

class RecursoController extends BaseController
{

  public function index(): string
  {
    $recurso = new Recurso();

    $datos['recursos'] = $recurso->orderBy('idrecurso', 'ASC')->findAll();

    //Solicitar las secciones: HEADER+FOOTER
    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');

    return view('recursos/index', $datos);
  }
/*
  public function crear(): string
  {
    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');

    return view('libros/crear', $datos);
  }*/
}