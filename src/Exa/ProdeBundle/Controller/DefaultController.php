<?php

namespace Exa\ProdeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Exa\ProdeBundle\Form\Type\TarjetaApuestasFormType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $usuario = $this->getUser();
        $fecha = $this->getDoctrine()->getRepository("ExaProdeBundle:Fecha")->getFechaForLiga($usuario->getEquipo()->getLiga());
        $tarjetaApuestas = $this->get('tarjeta_apuestas_usuario')->getPreparedTarjetaApuesta($usuario, $fecha);
        $form = $this->createForm(new TarjetaApuestasFormType(), $tarjetaApuestas);
        // guardar los cambios si la request viene del POST
        if ($this->getRequest()->isMethod('POST')) {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($tarjetaApuestas);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Su apuesta fue enviada correctamente! Recuerde que tiene tiempo de modificarla hasta que empiece la veda');

            } else $this->get('session')->getFlashBag()->add('error', 'Error al enviar su apuesta! Intentelo nuevamente.');
        }
        // mostrar el formulario
        return $this->render('ExaProdeBundle:Default:home.html.twig', array("form" => $form->createView() , 'fecha' => $fecha));
    }
    
    public function userPositionsAction() {
        $usuario = $this->getUser();
        $fecha = $this->getDoctrine()->getRepository("ExaProdeBundle:Fecha")->getFechaForLiga($usuario->getEquipo()->getLiga(), false);
        $posicion = $this->get('posiciones_usuario')->getPosicionUsuario($usuario, $fecha);
        $posicion_torneo = empty($fecha) ? null : $this->get('posiciones_usuario')->getPosicionUsuario($usuario, null, $fecha->getLiga());
        return $this->render(
                'ExaProdeBundle:Default:posiciones_usuario.html.twig',
                array('posicion_fecha' => $posicion, 'posicion_torneo' => $posicion_torneo,  'fecha' => $fecha)
                
            );
    }
    
    public function apuestasAnterioresAction() {
        $usuario = $this->getUser();
        $apuestas = $this->getDoctrine()->getRepository('ExaProdeBundle:TarjetaApuestas')->getPastTarjetasUsuario($usuario);
        return $this->render(
                'ExaProdeBundle:Default:apuestas_anteriores.html.twig',
                array('Tapuestas' => $apuestas)
        );
    }
    
    public function rankingAction($type) {
        $posiciones = $this->get('posiciones_usuario')->getPosicionesParaTodasLigas($type);
        $template = $type == "fecha" ? "ExaProdeBundle:Default:ranking_jugadores.html.twig" :
            "ExaProdeBundle:Default:ranking_jugadores_torneo.html.twig";
        //echo "<pre>";
        //var_dump(gettype($posiciones[0][0][0]->getFecha())); exit;
        //echo "</pre>";
        //var_dump(get_class($posiciones[0][0][0])); exit;
        return $this->render(
                $template,
                array('tipo' => $type, 'posiciones' => $posiciones)
        );
    }
    
}
