<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Bike;
use AppBundle\Form\BikeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class BikeController extends Controller
{

    /**
     * @Template("default/bikes.html.twig")
     * @Route("/admin/bike", name="allbikes")
     */
    public function findAllBikesAction() {
        $bikes = $this->getDoctrine()->getRepository('AppBundle:Bike')->findAll();
        return ['bikes' => $bikes];
    }

    /**
     * @Template("default/bike.html.twig")
     * @Route ("/admin/bike/{id}", name="bike", requirements={"id"="\d+"})
     */
    public function findBikeAction($id) {

        $bike = $this->getDoctrine()->getRepository('AppBundle:Bike')->find($id);
        if (!$bike) {
            throw $this->createNotFoundException('Bike not found');
        }

        return ['bike' => $bike];
    }

    /**
     * @Template("default/createbike.html.twig")
     * @Route("/admin/bike/create", name="createbike")
     */
    public function createBikeAction(Request $request)
    {

        $bike = new Bike();

        $form = $this->createForm(BikeType::class, $bike);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bike);
            $em->flush();
            return $this->redirectToRoute('bike', ['id' => $bike->getId()]);

        }
        return ['form' => $form->createView()];

    }
}
