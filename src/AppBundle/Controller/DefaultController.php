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
            ->setAction($this->generateUrl('search_result'))
            ->setMethod('POST')
            ->add('frame', EntityType::class, array(
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
            ->add('fork', EntityType::class, array(
                'class' => 'AppBundle\Entity\Bike',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.fork');
                },
                'choice_label' => 'fork',
                'choice_value' => 'fork',
                'required' => false,
                'multiple' => true,
                'attr' => array(
                    'class' => 'fork'
                )
            ))
            ->add('Please_choose_your_favorite_damper', EntityType::class, array(
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
            ->add('Please_choose_wheels_material', EntityType::class, array(
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
            ->add('Please_choose_wheels_size', EntityType::class, array(
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
            ->add('How_much_gears_you_would_have', EntityType::class, array(
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
            ->add('What_geometry_you_prefer', EntityType::class, array(
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
            ->add('Model_year', EntityType::class, array(
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
            ->getForm();

        return $this->render('default/steps.html.twig', array(
            'form' => $form->createView(),
        ));    }
}