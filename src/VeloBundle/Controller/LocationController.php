<?php

namespace VeloBundle\Controller;

use DateTime;
use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Location controller.
 *
 */
class LocationController extends Controller
{
    /**
     * Lists all location entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locations = $em->getRepository('VeloBundle:Location')->findAll();
        $data = $this->get('jms_serializer')->serialize($locations, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Creates a new location entity.
     *
     */
    public function newAction(Request $request)
    {

        $input = json_decode(
            $request->getContent(),
            true
        );

        $location = new Location();

        $location->setIduser($input["iduser"]);
        $location->setDatedebut(new \DateTime($input["datedebut"]));
        $location->setDuree($input["duree"]);
        $location->setIdbicyclette($input["idbicyclette"]);
        $em = $this->getDoctrine()->getManager();
        $em->persist($location);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($location, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Finds and displays a location entity.
     *
     */
    public function showAction(Location $location)
    {
        $data = $this->get('jms_serializer')->serialize($location, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Displays a form to edit an existing location entity.
     *
     */
    public function editAction(Request $request, Location $location)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $location->setIduser($input["iduser"]);
        $location->setDatedebut(new \DateTime($input["datedebut"]));
        $location->setDuree($input["duree"]);
        $location->setIdbicyclette($input["idbicyclette"]);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($location, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Deletes a location entity.
     *
     */
    public function deleteAction(Request $request, Location $location)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($location);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($location->getId() . " is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * calcul prix location
     *
     */
    public function calculAction(Request $request)
    {
        $idVelo=$request->get('idVelo');
        $nbHeur=$request->get('nbHeur');
        $velo=$this->getDoctrine()->getRepository('VeloBundle:Bicyclette')->find($idVelo);
        if($velo){
            $prixParHeur=$velo->getPrixParHeure();
            $result=$nbHeur*$prixParHeur;
            return  new Response($result);

        }else {
            $data = $this->get('jms_serializer')->serialize("Velo not Found", 'json');
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }



    }

}
