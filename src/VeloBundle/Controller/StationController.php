<?php

namespace VeloBundle\Controller;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Station;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Station controller.
 *
 */
class StationController extends Controller
{
    /**
     * Lists all station entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stations = $em->getRepository('VeloBundle:Station')->findAll();

        $data = $this->get('jms_serializer')->serialize($stations, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Creates a new station entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $station = new Station();
        $station->setLieu($input["lieu"]);
        $station->setNomstation($input["nomstation"]);
        $em = $this->getDoctrine()->getManager();

        $em->persist($station);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($station, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Creates a new station entity.
     *
     */
    public function affectVeloStationAction(Request $request)
    {
        $idStation = $request->get('idStation');
        $idVelo = $request->get('idVelo');
        $station = $this->getDoctrine()->getRepository('VeloBundle:Station')->find($idStation);
        $velo = $this->getDoctrine()->getRepository('VeloBundle:Bicyclette')->find($idVelo);
        if (!$station || !$velo) {
            $data = $this->get('jms_serializer')->serialize("cannot affect", 'json');
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        } else {
            $velo->setIdstation($idStation);
            $em = $this->getDoctrine()->getManager();

            $em->persist($velo);
            $em->flush();

        }
        $data = $this->get('jms_serializer')->serialize($velo, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }


    /**
     * Finds and displays a station entity.
     *
     */
    public function showAction(Station $station)
    {
        $data = $this->get('jms_serializer')->serialize($station, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }


    /**
     * Displays a form to edit an existing station entity.
     *
     */
    public function editAction(Request $request, Station $station)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );

        $station->setLieu($input["lieu"]);
        $station->setNomstation($input["nomstation"]);
        $em = $this->getDoctrine()->getManager();

        $em->flush();

        $data = $this->get('jms_serializer')->serialize($station, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Deletes a station entity.
     *
     */
    public function deleteAction(Request $request, Station $station)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($station);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($station->getNomstation() . " is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    // pour afficher la list des velos de chaque station

    public function rechercheVeloParStationAction($id)
    {

        $station = $this->getDoctrine()->getRepository('VeloBundle:Bicyclette')->findByIdstation($id);


        $data = $this->get('jms_serializer')->serialize($station, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

}























