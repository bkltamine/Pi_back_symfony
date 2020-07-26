<?php

namespace VeloBundle\Controller;

use DateTime;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Commande;
use VeloBundle\Entity\Guide;
use VeloBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Guide controller.
 *
 */
class CommandeController extends Controller
{
    /**
     * Lists all guide entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commande = $em->getRepository('VeloBundle:Commande')->findAll();

        $data = $this->get('jms_serializer')->serialize($commande, 'json');
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

        $commande = new Commande();
        $commande->setTotal($input["total"]);
        $commande->setIduser($input["iduser"]);
        $em = $this->getDoctrine()->getManager();

        $em->persist($commande);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($commande, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Finds and displays a guide entity.
     *
     */
    public function showAction( $commande)
    {
        $data = $this->get('jms_serializer')->serialize($commande, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }


    /**
     * Deletes a reservation entity.
     *
     */
    public function deleteAction(Request $request, Commande $commande)
    {
             $em = $this->getDoctrine()->getManager();
            $em->remove($commande);
            $em->flush();
        $data = $this->get('jms_serializer')->serialize($commande->getId(). "is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
    public function editAction(Request $request, Guide $commande)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $commande->setTotal($input["total"]);
        $em = $this->getDoctrine()->getManager();

        $em->flush();

        $data = $this->get('jms_serializer')->serialize($commande, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
