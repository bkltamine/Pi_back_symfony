<?php

namespace VeloBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Categorieevent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categorieevent controller.
 *
 */
class CategorieeventController extends Controller
{
    /**
     * Lists all categorieevent entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieevents = $em->getRepository('VeloBundle:Categorieevent')->findAll();
        $data = $this->get('jms_serializer')->serialize($categorieevents, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Creates a new categorieevent entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );
        $categorieevent = new Categorieevent();
        $categorieevent->setNomcategorie($input["nomcategorie"]);

        $em = $this->getDoctrine()->getManager();
        $em->persist($categorieevent);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($categorieevent, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Finds and displays a categorieevent entity.
     *
     */
    public function showAction(Categorieevent $categorieevent)
    {
        $data = $this->get('jms_serializer')->serialize($categorieevent, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Displays a form to edit an existing categorieevent entity.
     *
     */
    public function editAction(Request $request, Categorieevent $categorieevent)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );
        $categorieevent->setNomcategorie($input["nomcategorie"]);
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($categorieevent, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Deletes a categorieevent entity.
     *
     */
    public function deleteAction(Request $request, Categorieevent $categorieevent)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorieevent);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($categorieevent->getNomcategorie() . " is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

}
