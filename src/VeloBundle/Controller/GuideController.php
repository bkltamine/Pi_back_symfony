<?php

namespace VeloBundle\Controller;

use DateTime;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Guide;
use VeloBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Guide controller.
 *
 */
class GuideController extends Controller
{
    /**
     * Lists all guide entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $guide = $em->getRepository('VeloBundle:Guide')->findAll();

        $data = $this->get('jms_serializer')->serialize($guide, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Creates a new guide entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $guide = new Guide();
        $guide->setNom($input["nom"]);
        $em = $this->getDoctrine()->getManager();

        $em->persist($guide);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($guide, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Finds and displays a guide entity.
     *
     */
    public function showAction( $guide)
    {
        $data = $this->get('jms_serializer')->serialize($guide, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }


    /**
     * Deletes a reservation entity.
     *
     */
    public function deleteAction(Request $request, Guide $guide)
    {
             $em = $this->getDoctrine()->getManager();
            $em->remove($guide);
            $em->flush();
        $data = $this->get('jms_serializer')->serialize($guide->getId(). "is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
    public function editAction(Request $request, Guide $guide)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $guide->setNom($input["nom"]);
        $em = $this->getDoctrine()->getManager();

        $em->flush();

        $data = $this->get('jms_serializer')->serialize($guide, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
