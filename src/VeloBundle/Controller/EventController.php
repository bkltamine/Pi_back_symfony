<?php

namespace VeloBundle\Controller;

use DateTime;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{
    /**
     * Lists all event entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('VeloBundle:Event')->findAll();


        $data = $this->get('jms_serializer')->serialize($events, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );
        $event = new Event();
        $event->setDuree($input["duree"]);
        $event->setDatedebut(new DateTime($input["datedebut"]));
        $event->setIduser($input["iduser"]);
        $event->setNbparticipant($input["nbparticipant"]);
        $event->setTitre($input["titre"]);
        $event->setIdcategorie($input["idcategorie"]);
        $event->setDescription($input["description"]);
        $event->setIddestination($input["iddestination"]);
        $event->setIdguide($input["idguide"]);

        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($event, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Event $event)
    {
        $data = $this->get('jms_serializer')->serialize($event, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }


    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, Event $event)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );
        $event->setDuree($input["duree"]);
        $event->setDatedebut(new DateTime($input["datedebut"]));
        $event->setIduser($input["iduser"]);
        $event->setNbparticipant($input["nbparticipant"]);
        $event->setTitre($input["titre"]);
        $event->setIdcategorie($input["idcategorie"]);
        $event->setDescription($input["description"]);
        $event->setIddestination($input["iddestination"]);
        $event->setIdguide($input["idguide"]);

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($event, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Event $event)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($event->getTitre() . " is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
    public  function bestDestinationAction(Request $request){
        $em = $this->getDoctrine()->getManager();
       $events = $em->getRepository('VeloBundle:Event')->findAll();
       $destinations=[];
       $count=[];

        foreach ($events as $event){
            $index=array_search($event->getIddestination(), $destinations);
            if($index){
                $count[$index]++;
            }else{
                array_push($destinations,$event->getIddestination());
                array_push($count,1);
            }
        }
        $max=max($count);
        $index=array_search($max, $count);
        $bestEventId=$destinations[$index];
        $bestDestionation = $em->getRepository('VeloBundle:Destination')->find($bestEventId);
        $data = $this->get('jms_serializer')->serialize($bestDestionation, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;

    }
}
