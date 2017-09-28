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
                'required' => false,
                'choice_label' => 'material',
                'choice_value' => 'material',
                'multiple' => true,
                'attr' => array(
                    'class' => 'material',
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
            ->add('fork', EntityType::class, array(
                'class' => 'AppBundle\Entity\Bike',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.fork');
                },
                'choice_label' => 'fork',
                'choice_value' => 'fork',
                'multiple' => true,
                'required' => false,
                'attr' => array(
                    'class' => 'fork'
                )
            ))
            ->add('damper', EntityType::class, array(
                'class' => 'AppBundle\Entity\Bike',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.damper');
                },
                'choice_label' => 'damper',
                'choice_value' => 'damper',
                'multiple' => true,
                'required' => false,
                'attr' => array(
                    'class' => 'damper'
                )
            ))
            ->add('gears', EntityType::class, array(
                'class' => 'AppBundle\Entity\Bike',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.gears');
                },
                'choice_label' => 'gears',
                'choice_value' => 'gears',
                'multiple' => true,
                'required' => false,
                'attr' => array(
                    'class' => 'gears'
                )
            ))
            ->add('derailleur', EntityType::class, array(
                'class' => 'AppBundle\Entity\Bike',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.derailleur');
                },
                'choice_label' => 'derailleur',
                'choice_value' => 'derailleur',
                'multiple' => true,
                'required' => false,
                'attr' => array(
                    'class' => 'derailleur'
                )
            ))
            ->add('wheels', EntityType::class, array(
                'class' => 'AppBundle\Entity\Bike',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.wheels');
                },
                'choice_label' => 'wheels',
                'choice_value' => 'wheels',
                'multiple' => true,
                'required' => false,
                'attr' => array(
                    'class' => 'wheels'
                )
            ))
            ->add('size', EntityType::class, array(
                'class' => 'AppBundle\Entity\Bike',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.size');
                },
                'choice_label' => 'size',
                'choice_value' => 'size',
                'multiple' => true,
                'required' => false,
                'attr' => array(
                    'class' => 'size'
                )
            ))
            ->add('year', EntityType::class, array(
                'class' => 'AppBundle\Entity\Bike',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.year');
                },
                'choice_label' => 'year',
                'choice_value' => 'year',
                'multiple' => true,
                'required' => false,
                'attr' => array(
                    'class' => 'year'
                )
            ))
            ->add('save', SubmitType::class)
            ->getForm();

        return $this->render('default/steps.html.twig', array(
            'form' => $form->createView(),
        ));    }
}