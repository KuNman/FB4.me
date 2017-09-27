<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Bike;
use AppBundle\Entity\Query;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;



class DefaultController extends Controller
{

    /**
     * @Route("/" , name="index")
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


    /**
     * @Route("/steps", name="steps")
     */
    public function stepsAction() {
        $form = $this
            ->createFormBuilder()
            ->setMethod('POST')
            ->setAction($this->generateUrl('search_result'))
            ->add('material', EntityType::class, array(
                'class' => 'AppBundle\Entity\Bike',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.material', 'ASC');
                },
                'choice_label' => 'material',
                'choice_value' => 'material',
                'multiple' => true,
                'attr' => array(
                    'class' => 'material'
                )
            ))
            ->add('geometry', EntityType::class, array(
                'class' => 'AppBundle\Entity\Bike',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.geometry');
                },
                'choice_label' => 'geometry',
                'choice_value' => 'geometry',
                'multiple' => true,
                'required' => false,
                'attr' => array(
                    'class' => 'geometry'
                )
            ))
            ->add('save', SubmitType::class)
            ->getForm();

        return $this->render('default/steps.html.twig', array(
            'form' => $form->createView(),
        ));    }
}