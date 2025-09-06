<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Distrito;

class DistritoController extends BaseController
{
    public function getDistritosByProvincia($idprovincia = "")
    {  
        $this->response->setContentType('application/json');

        if (empty($idprovincia)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID de provincia no proporcionado'
            ]);
        }

        $distritoModel = new Distrito();

        $listaDistritos = $distritoModel
                            ->where('idprovincia', $idprovincia)
                            ->orderBy('distrito', 'ASC')
                            ->findAll();

        return $this->response->setJSON($listaDistritos);
    }
}
