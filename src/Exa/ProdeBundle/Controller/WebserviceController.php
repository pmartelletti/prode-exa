<?php

namespace Exa\ProdeBundle\Controller;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Symfony\Component\DependencyInjection\ContainerAware;


class WebserviceController extends ContainerAware
{
    
    /**
     * @Soap\Method("crearpartidos")
     * @Soap\Param("equipo1", phpType = "string")
     * @Soap\Param("equipo2", phpType = "string")
     * @Soap\Param("num_fecha", phpType = "string")
     * @Soap\Param("liga", phpType = "string")
     * @Soap\Result(phpType = "boolean")
     */
    public function crearPartidosAction($equipo1, $equipo2, $num_fecha, $liga)
    {
        $response = $this->container->get('importing_matches')->createPartido($equipo1, $equipo2, $num_fecha, $liga);
        return $this->container->get('besimple.soap.response')->setReturnValue($response);
    }
    
    /**
     * @Soap\Method("actualizarresultados")
     * @Soap\Param("equipo1", phpType = "string")
     * @Soap\Param("equipo2", phpType = "string")
     * @Soap\Param("num_fecha", phpType = "string")
     * @Soap\Param("liga", phpType = "string")
     * @Soap\Param("goles1", phpType = "string")
     * @Soap\Param("goles2", phpType = "string")
     * @Soap\Result(phpType = "boolean")
     */
    public function actualizarResultados($equipo1, $equipo2, $num_fecha, $liga, $goles1, $goles2) {
        $response = $this->container->get('importing_matches')->actualizarResultado($equipo1, $equipo2, $num_fecha, $liga, $goles1, $goles2);
        return $this->container->get('besimple.soap.response')->setReturnValue($response);
    }
    
    /**
     * @Soap\Method("calcularganadores")
     * @Soap\Param("liga", phpType = "string")
     * @Soap\Result(phpType = "boolean")
     */
    public function calcularGanadores($liga) {
        $response = $this->container->get('importing_matches')->calcularganadores($liga);
        return $this->container->get('besimple.soap.response')->setReturnValue($response);
    }
    
    
    
    
}

?>
