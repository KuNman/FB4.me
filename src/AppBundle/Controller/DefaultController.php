<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Bike;
use AppBundle\Entity\Query;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class DefaultController extends Controller
{

    /**
     * @Route("/")
     *
     */
    public function indexAction()
    {
        return $this->render(":default:homepage.html.twig");
    }

    /**
     * @Template("default/contact.html.twig")
     * @Route("/Contact")
     */
    public function contactAction()
    {
        $this->render("default/contact.html.twig");
    }

    /**
     * @Route("/search/result/{slug}")
     */
    public function sluggableAction($slug) {
        $getQuery = $this->getDoctrine()->getRepository('AppBundle:Query')
            ->findOneBy(array('slug' => $slug))->getQuery();

        if (!isset($getQuery)) {
            throw $this->createNotFoundException('Page not found');

        }

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($getQuery);
        $bike = $query->getResult();

        return $this->render('default/search/result.html.twig',
            array('bike' => $bike, 'rand' => $slug));

    }

}