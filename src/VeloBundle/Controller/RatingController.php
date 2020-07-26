<?php

namespace VeloBundle\Controller;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use VeloBundle\Entity\Rating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rating controller.
 *
 */
class RatingController extends Controller
{
    /**
     * Lists all rating entities.
     *
     */
    public function indexAction($idevent)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('VeloBundle:Event')->find($idevent);

        $ratings = $em->getRepository('VeloBundle:Rating')->findBy(array("idevent" => $event));

        $data = $this->get('jms_serializer')->serialize($ratings, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Creates a new rating entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode(
            $request->getContent(),
            true
        );
        $em = $this->getDoctrine()->getManager();

        $rat = $em->getRepository('VeloBundle:Rating')->findOneBy(array("idevent" => $input["idevent"], "iduser" => $input["iduser"]));
        if ($rat == NULL) {
            $rating = new Rating();
            $rating->setIduser($input["iduser"]);
            $rating->setIdevent($input["idevent"]);
            $rating->setValue($input["value"]);

            $em->persist($rating);
            $em->flush();

            $data = $this->get('jms_serializer')->serialize($rating, 'json');
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        } else {
            $rat->setIduser($input["iduser"]);
            $rat->setIdevent($input["idevent"]);
            $rat->setValue($input["value"]);

            $em->flush();
            $data = $this->get('jms_serializer')->serialize($rat, 'json');
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }
    }

    /**
     * Finds and displays a rating entity.
     *
     */
    public function showAction(Rating $rating)
    {
        $data = $this->get('jms_serializer')->serialize($rating, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }



    /**
     * Deletes a rating entity.
     *
     */
    public function deleteAction(Request $request, Rating $rating)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($rating);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($rating->getId() . " is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
