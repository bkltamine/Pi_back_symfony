<?php

namespace VeloBundle\Controller;

use DateTime;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Guide;
use VeloBundle\Entity\Lignecommande;
use VeloBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Guide controller.
 *
 */
class LignecommandeController extends Controller
{
    /**
     * Lists all guide entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ligneCommande = $em->getRepository('VeloBundle:Lignecommande')->findAll();

        $data = $this->get('jms_serializer')->serialize($ligneCommande, 'json');
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

        $ligneCommande = new Lignecommande();
        $ligneCommande->setIdequipement($input["idequipement"]);
        $ligneCommande->setPrixunitaire($input["prixunitaire"]);
        $em = $this->getDoctrine()->getManager();

        $em->persist($ligneCommande);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($ligneCommande, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Finds and displays a guide entity.
     *
     */
    public function showAction( $ligneCommande)
    {
        $data = $this->get('jms_serializer')->serialize($ligneCommande, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }


    /**
     * Deletes a reservation entity.
     *
     */
    public function deleteAction(Request $request, Lignecommande $ligneCommande)
    {
             $em = $this->getDoctrine()->getManager();
            $em->remove($ligneCommande);
            $em->flush();
        $data = $this->get('jms_serializer')->serialize($ligneCommande->getId(). "is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
    public function editAction(Request $request, Lignecommande $ligneCommande)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $ligneCommande->setIdequipement($input["idequipement"]);
        $ligneCommande->setPrixunitaire($input["prixunitaire"]);
        $em = $this->getDoctrine()->getManager();

        $em->flush();

        $data = $this->get('jms_serializer')->serialize($ligneCommande, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
