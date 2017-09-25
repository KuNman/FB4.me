<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Bike;
use AppBundle\Form\BrandType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\Query;



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
     * @Route("/contact")
     */
    public function contactAction()
    {
        $this->render("default/contact.html.twig");
    }


}