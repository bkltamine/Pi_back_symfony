<?php

namespace VeloBundle\Controller;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Destination;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Destination controller.
 *
 */
class DestinationController extends Controller
{
    /**
     * Lists all destination entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $destinations = $em->getRepository('VeloBundle:Destination')->findAll();
        $data = $this->get('jms_serializer')->serialize($destinations, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Creates a new destination entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $destination = new Destination();
        $destination->setRegion($input["region"]);
        $destination->setDelegation($input["delegation"]);
        $em = $this->getDoctrine()->getManager();

        $em->persist($destination);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($destination, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Finds and displays a destination entity.
     *
     */
    public function showAction(Destination $destination)
    {
        $data = $this->get('jms_serializer')->serialize($destination, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Displays a form to edit an existing destination entity.
     *
     */
    public function editAction(Request $request, Destination $destination)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $destination->setRegion($input["region"]);
        $destination->setDelegation($input["delegation"]);
        $em = $this->getDoctrine()->getManager();

        $em->flush();

        $data = $this->get('jms_serializer')->serialize($destination, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Deletes a destination entity.
     *
     */
    public function deleteAction(Request $request, Destination $destination)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($destination);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($destination->getRegion() . " is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

}
