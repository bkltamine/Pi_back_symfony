<?php

namespace VeloBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Bicyclette;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Bicyclette controller.
 *
 */
class BicycletteController extends Controller
{
    /**
     * Lists all bicyclette entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bicyclettes = $em->getRepository('VeloBundle:Bicyclette')->findAll();

        $data = $this->get('jms_serializer')->serialize($bicyclettes, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Creates a new bicyclette entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $bicyclette = new Bicyclette();
        $bicyclette->setModel($input["model"]);
        $bicyclette->setReference($input["reference"]);
        $bicyclette->setAge($input["age"]);
        $bicyclette->setPrixparheure($input["prixParHeure"]);
        $bicyclette->setIdstation($input["idstation"]);
        $em = $this->getDoctrine()->getManager();
        $em->persist($bicyclette);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($bicyclette, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Finds and displays a bicyclette entity
     *
     */
    public function showAction(Bicyclette $bicyclette)
    {
        $data = $this->get('jms_serializer')->serialize($bicyclette, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Displays a form to edit an existing bicyclette entity.
     *
     */
    public function editAction(Request $request, Bicyclette $bicyclette)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $bicyclette->setModel($input["model"]);
        $bicyclette->setReference($input["reference"]);
        $bicyclette->setAge($input["age"]);
        $em = $this->getDoctrine()->getManager();

        $em->flush();

        $data = $this->get('jms_serializer')->serialize($bicyclette, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Deletes a bicyclette entity.
     *
     */
    public function deleteAction(Request $request, Bicyclette $bicyclette)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($bicyclette);
            $em->flush();
        $data = $this->get('jms_serializer')->serialize($bicyclette->getReference()." id deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

}
