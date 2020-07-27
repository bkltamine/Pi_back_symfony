<?php

namespace VeloBundle\Controller;

use DateTime;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Event;
use VeloBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reservation controller.
 *
 */
class ReservationController extends Controller
{
    /**
     * Lists all reservation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservations = $em->getRepository('VeloBundle:Reservation')->findAll();

        $data = $this->get('jms_serializer')->serialize($reservations, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Creates a new reservation entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('VeloBundle:Event')->findOneBy(array("id" => $input["idevent"]));
        $res = $em->getRepository('VeloBundle:Reservation')->findOneBy(array("idevent" => $input["idevent"], "iduser" => $input["iduser"]));
        if  ($event->getNbparticipant() > 0) {
            $reservation = new Reservation();

            $reservation->setIduser($input["iduser"]);
            $reservation->setIdevent($input["idevent"]);
            $event->setNbrpalcesreserv($input["nbrpalcesreserv"]);
            $em->flush();
            $em->persist($reservation);
            $em->flush();

            $data = $this->get('jms_serializer')->serialize($reservation, 'json');
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        } else {
            $data = $this->get('jms_serializer')->serialize("cannot participate", 'json');
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }
    }

    /**
     * Finds and displays a reservation entity.
     *
     */
    public function showAction(Reservation $reservation)
    {
        $data = $this->get('jms_serializer')->serialize($reservation, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Deletes a reservation entity.
     *
     */
    public function deleteAction(Request $request, Reservation $reservation)
    {
             $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush();
        $data = $this->get('jms_serializer')->serialize($reservation->getId(). "is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
