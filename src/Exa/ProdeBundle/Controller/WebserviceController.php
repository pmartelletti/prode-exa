<?php

namespace Exa\ProdeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class WebserviceController extends Controller
{
    public function marcarPartidoAction()
    {
        $partidos = $this->getDoctrine()->getRepository('ExaProdeBundle:Partido')->getPartidoByEquipos('Novanta', 'Newpi');
        foreach($partidos as $partido) {
            echo sprintf("%s - %s", $partido, $partido->getFecha());
        }
        exit;
    }
}

?>
