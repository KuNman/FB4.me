<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bike;
use Doctrine\ORM\EntityRepository;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class SearchController extends Controller
{

    /**
     * @Route("/search")
     */
    public function searchAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('search_step2'))
            ->add('Do_you_care_about_brand', ChoiceType::class, array(
                'choices' => array(
                    null => null,
                    'Yes' => 'I have favorite brand',
                    'No' => 'I dont care about brand',

                )
            ))
            ->add('Next', SubmitType::class, array(
                'attr' => array('class' => 'button special'),
            ))
            ->setMethod('POST')
            ->getForm();

        return $this->render('default/search/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/search/brand", name="search_step2")
     * @Template("default/search/step2.html.twig")
     */
    public function searchStep2Action(Request $request)
    {
        $nextStep = $request->request->get('form')['Do_you_care_about_brand'];

        if ($nextStep == 'Yes') {
            $form = $this
                ->createFormBuilder()
                ->setAction($this->generateUrl('search_step3'))
                ->setMethod('POST')
                ->add('Please_choose_brand', EntityType::class, array(
                    'class' => 'AppBundle\Entity\Brand',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('u')
                            ->orderBy('u.brand');
                    },
                    'choice_label' => 'brand',
                    'choice_value' => 'brand',
                    'attr' => array(
                        'class' => 'js-example-basic-single'
                    )
                ))
                ->add('Next', SubmitType::class, array(
                    'attr' => array('class' => 'button special'),
                ))
                ->getForm();

            return $this->render('default/search/step2.html.twig', array(
                'form' => $form->createView(),
            ));

        } elseif ($nextStep == 'No') {
            return $this->redirectToRoute('search_step3');
        }
    }

    /**
     * @Route("/search/details", name="search_step3")
     * @Template("default/search/step3.html.twig")
     */

    public function searchStep3Action(Request $request)

    {

        $post = $request->request->get('form');
        $brand = $post['Please_choose_brand'];

        $form = $this
            ->createFormBuilder()
            ->setAction($this->generateUrl('search_result'))
            ->setMethod('POST')
            ->add('Brand', HiddenType::class, array(
                'data' => $brand,
            ))
            ->add('Please_choose_frame_material', EntityType::class, array(
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
            ->add('Please_choose_your_favorite_fork', EntityType::class, array(
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
            ->add('Next', SubmitType::class, array(
                'attr' => array('class' => 'button special'),
            ))
            ->getForm();


        return $this->render('default/search/step3.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/search/result", name="search_result")
     * @Template("default/search/result.html.twig")
     */
    public function resultAction(Request $request)
    {
        $resultArray = array();

        $post = $request->request->get('form');

        if (isset($post['Brand'][0]) ) {
            $brand = $post['Brand'];
            $resultArray['brand'] = $brand;
        }

        if (isset($post['Please_choose_frame_material'][0]) ) {
            $material = $post['Please_choose_frame_material'][0];
            $resultArray['material'] = $material;
        }

        if (isset($post['Please_choose_frame_material'][1]) ) {
            $material2 = $post['Please_choose_frame_material'][1];
            $resultArray['material2'] = $material2;
        }

        if (isset($post['Please_choose_your_favorite_fork'][0]) ) {
            $fork = $post['Please_choose_your_favorite_fork'][0];
            $resultArray['fork'] = $fork;
        }

        if (isset($post['Please_choose_your_favorite_fork'][1]) ) {
            $fork2 = $post['Please_choose_your_favorite_fork'][1];
            $resultArray['fork2'] = $fork2;
        }

        if (isset($post['Please_choose_your_favorite_fork'][2]) ) {
            $fork3 = $post['Please_choose_your_favorite_fork'][2];
            $resultArray['fork3'] = $fork3;
        }

        if (isset($post['Please_choose_your_favorite_fork'][3]) ) {
            $fork4 = $post['Please_choose_your_favorite_fork'][3];
            $resultArray['fork4'] = $fork4;
        }

        if (isset($post['Please_choose_your_favorite_fork'][4]) ) {
            $fork5 = $post['Please_choose_your_favorite_fork'][4];
            $resultArray['fork5'] = $fork5;
        }

        if (isset($post['Please_choose_your_favorite_damper'][0]) ) {
            $damper = $post['Please_choose_your_favorite_damper'][0];
            $resultArray['damper'] = $damper;
        }

        if (isset($post['Please_choose_your_favorite_damper'][1]) ) {
            $damper2 = $post['Please_choose_your_favorite_damper'][1];
            $resultArray['damper2'] = $damper2;
        }

        if (isset($post['Please_choose_your_favorite_damper'][2]) ) {
            $damper3 = $post['Please_choose_your_favorite_damper'][2];
            $resultArray['damper3'] = $damper3;
        }

        if (isset($post['Please_choose_your_favorite_damper'][3]) ) {
            $damper4 = $post['Please_choose_your_favorite_damper'][3];
            $resultArray['damper4'] = $damper4;
        }

        if (isset($post['Please_choose_your_favorite_damper'][4]) ) {
            $damper5 = $post['Please_choose_your_favorite_damper'][4];
            $resultArray['damper5'] = $damper5;
        }

        if (isset($post['Please_choose_wheels_material'][0]) ) {
            $wheels = $post['Please_choose_wheels_material'][0];
            $resultArray['wheels'] = $wheels;
        }

        if (isset($post['Please_choose_wheels_material'][1]) ) {
            $wheels2 = $post['Please_choose_wheels_material'][1];
            $resultArray['wheels2'] = $wheels2;
        }

        if (isset($post['Please_choose_wheels_size'][0]) ) {
            $size = $post['Please_choose_wheels_size'][0];
            $resultArray['size'] = $size;
        }

        if (isset($post['Please_choose_wheels_size'][1]) ) {
            $size2 = $post['Please_choose_wheels_size'][1];
            $resultArray['size2'] = $size2;
        }

        if (isset($post['How_much_gears_you_would_have'][0]) ) {
            $gears = $post['How_much_gears_you_would_have'][0];
            $resultArray['gears'] = $gears;
        }

        if (isset($post['How_much_gears_you_would_have'][1]) ) {
            $gears2 = $post['How_much_gears_you_would_have'][1];
            $resultArray['gears2'] = $gears2;
        }

        if (isset($post['How_much_gears_you_would_have'][2]) ) {
            $gears3 = $post['How_much_gears_you_would_have'][2];
            $resultArray['gears3'] = $gears3;
        }

        if (isset($post['What_geometry_you_prefer'][0]) ) {
            $geometry = $post['What_geometry_you_prefer'][0];
            $resultArray['geometry'] = $geometry;
        }

        if (isset($post['What_geometry_you_prefer'][1]) ) {
            $geometry2 = $post['What_geometry_you_prefer'][1];
            $resultArray['geometry2'] = $geometry2;
        }

        if (isset($post['What_geometry_you_prefer'][2]) ) {
            $geometry3 = $post['What_geometry_you_prefer'][2];
            $resultArray['geometry3'] = $geometry3;
        }

        if (isset($post['Model_year'][0]) ) {
            $year = $post['Model_year'][0];
            $resultArray['year'] = $year;
        }

        if (isset($post['Model_year'][1]) ) {
            $year2 = $post['Model_year'][1];
            $resultArray['year2'] = $year2;
        }

        $repository = $this->getDoctrine()->getRepository(Bike::class);

        $query = $repository->createQueryBuilder('b');

        if (isset($brand)) {
            $brandArray = $this
                ->getDoctrine()
                ->getRepository('AppBundle:Brand')
                ->findBy(array('brand' => $brand));

            foreach ($brandArray as $row) {
                $brandId = $row->getId();
                $query->andwhere("b.brand = '$brandId'");
            }
        }



        if (isset($material) && isset($material2)) {
            $query->andWhere("b.material = '$material' OR b.material = '$material2' ");
        } elseif (isset($material)) {
            $query->andWhere("b.material = '$material' ");
        }

        if (isset($fork) && isset($fork2) && isset($fork3) && isset($fork4) && isset($fork5)) {
            $query->andWhere("b.fork = '$fork' OR b.fork = '$fork2' OR b.fork = '$fork3' 
            OR b.fork = '$fork4' OR b.fork = '$fork5' ");
        } elseif (isset($fork) && isset($fork2) && isset($fork3) && isset($fork4)) {
            $query->andWhere("b.fork = '$fork' OR b.fork = '$fork2' OR b.fork = '$fork3' OR b.fork = '$fork4' ");
        } elseif (isset($fork) && isset($fork2) && isset($fork3)) {
            $query->andWhere("b.fork = '$fork' OR b.fork = '$fork2' OR b.fork = '$fork3' ");
        } elseif (isset($fork) && isset($fork2)) {
            $query->andWhere("b.fork = '$fork' OR b.fork = '$fork2' ");
        } elseif (isset($fork) ) {
            $query->andWhere("b.fork = '$fork' ");
        }

        if (isset($damper) && isset($damper2) && isset($damper3) && isset($damper4) && isset($damper5)) {
            $query->andWhere("b.damper = '$damper' OR b.damper = '$damper2' OR b.damper = '$damper3' 
            OR b.damper = '$damper4' OR b.damper = '$damper5' ");
        } elseif (isset($damper) && isset($damper2) && isset($damper3) && isset($damper4)) {
            $query->andWhere("b.damper = '$damper' OR b.damper = '$damper2' OR b.damper = '$damper3' 
            OR b.damper = '$damper4' ");
        } elseif (isset($damper) && isset($damper2) && isset($damper3)) {
            $query->andWhere("b.damper = '$damper' OR b.damper = '$damper2' OR b.damper = '$damper3' ");
        } elseif (isset($damper) && isset($damper2)) {
            $query->andWhere("b.damper = '$damper' OR b.damper = '$damper2' ");
        } elseif (isset($damper)) {
            $query->andWhere("b.damper = '$damper' ");
        }

        if (isset($wheels) && isset($wheels2)) {
            $query->andWhere("b.wheels = '$wheels' OR b.wheels = '$wheels2' ");
        } elseif (isset($wheels)) {
            $query->andWhere("b.wheels = '$wheels' ");
        }

        if (isset($size) && isset($size2)) {
            $query->andWhere("b.size = '$size' OR b.size = '$size2' ");
        } elseif (isset($size)) {
            $query->andWhere("b.size = '$size' ");
        }

         if (isset($gears) && isset($gears2) && isset($gears3)) {
            $query->andWhere("b.gears = '$gears' OR b.gears = '$gears2' OR b.gears = '$gears3' ");
        } elseif (isset($gears) && isset($gears2)) {
            $query->andWhere("b.gears = '$gears' OR b.gears = '$gears2' ");
        } elseif (isset($gears3)) {
            $query->andWhere("b.gears = '$gears3' ");
        }

        if (isset($geometry) && isset($geometry2) && isset($geometry3)) {
            $query->andWhere("b.geometry = '$geometry' OR b.geometry = '$geometry2' OR b.geometry = '$geometry3' ");
        } elseif (isset($geometry) && isset($geometry2)) {
            $query->andWhere("b.geometry = '$geometry' OR b.geometry = '$geometry2' ");
        } elseif (isset($geometry)) {
            $query->andWhere("b.geometry = '$geometry' ");
        }

        if (isset($year) && isset($year2)) {
            $query->andWhere("b.year = '$year' OR b.year = '$year2' ");
        } elseif (isset($year)) {
            $query->andWhere("b.year = '$year' ");
        }

        if (isset($resultArray['brand'])) {
            $bike = $query->getQuery()->getResult();

            $dql = $query->getQuery()->getDQL();
            $rand = substr(md5(microtime()),rand(0,26),5);
            $dql = $this->createSlug($dql, $rand);

            return $this->render('default/search/result.html.twig',
                array('bike' => $bike, 'result' => $resultArray, 'rand' => $rand));

        } else {
            $bike = $query->getQuery()->getResult();

            $dql = $query->getQuery()->getDQL();
            $rand = substr(md5(microtime()),rand(0,26),5);
            $dql = $this->createSlug($dql, $rand);

            return $this->render('default/search/result.html.twig',
                array('bike' => $bike, 'result' => $resultArray, 'rand' => $rand));
        }
    }

    public function createSlug($dql, $rand) {
        $query = new \AppBundle\Entity\Query();
        $query->setQuery($dql);
        $query->setSlug($rand);
        $em = $this->getDoctrine()->getManager();
        $em->persist($query);
        $em->flush();
        return;
    }
}


