<?php

namespace VeloBundle\Controller;

use DateTime;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Equipement;
use VeloBundle\Entity\Guide;
use VeloBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Guide controller.
 *
 */
class EquipementController extends Controller
{
    /**
     * Lists all guide entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipement = $em->getRepository('VeloBundle:Equipement')->findAll();

        $data = $this->get('jms_serializer')->serialize($equipement, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Creates a new equipement entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $equipement = new Equipement();
        $equipement->setNom($input["nom"]);
        $equipement->setCouleur($input["couleur"]);
        $equipement->setPrix($input["prix"]);
        $em = $this->getDoctrine()->getManager();

        $em->persist($equipement);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($equipement, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Finds and displays a guide entity.
     *
     */
    public function showAction( $equipement)
    {
        $data = $this->get('jms_serializer')->serialize($equipement, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }


    /**
     * Deletes a reservation entity.
     *
     */
    public function deleteAction(Request $request, Equipement $equipement)
    {
             $em = $this->getDoctrine()->getManager();
            $em->remove($equipement);
            $em->flush();
        $data = $this->get('jms_serializer')->serialize($equipement->getId(). "is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
    public function editAction(Request $request, Equipement $equipement)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $equipement->setNom($input["nom"]);
        $equipement->setCouleur($input["couleur"]);
        $equipement->setPrix($input["prix"]);        $em = $this->getDoctrine()->getManager();

        $em->flush();

        $data = $this->get('jms_serializer')->serialize($equipement, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
