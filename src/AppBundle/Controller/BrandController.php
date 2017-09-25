<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Brand;
use AppBundle\Form\BrandType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

///**
// * Class BrandController
// * @package AppBundle\Controller
// * @Route("/bra")
// */
class BrandController extends Controller
{
    /**
     * @Template("default/brands.html.twig")
     * @Route("/brand" , name="brands")
     */
    public function findBrandsAction() {
        $brands = $this->getDoctrine()->getRepository('AppBundle:Brand')->findAll();
        return ['brands' => $brands];
    }

    /**
     * @Template("default/brand.html.twig")
     * @Route("brand/{id}", name="brand", requirements={"id"="\d+"})
     */
    public function findBrandAction($id) {
        $brand = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Brand')
            ->find($id);
        if (!$brand) {
            throw $this->createNotFoundException('Brand not found');
        }
        return ['brand' => $brand];
    }

    /**
     * @Template("default/createbrand.html.twig")
     * @Route("/brand/create"), name="createbrand")
     */
    public function createBrandAction(Request $request) {

        $brand = new Brand();

        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($brand);
            $em->flush();
            return $this->redirectToRoute('brand', ['id' => $brand->getId()]);

        }
        return ['form' => $form->createView()];

    }

    /**
     * @Template("default/updatebrand.html.twig")
     * @Route("brand/update/{id}", name="updatebrand", requirements={"id"="\d+"})
     */
    public function updateBrandAction(Request $request, $id) {
        $brand = $this->getDoctrine()->getRepository('AppBundle:Brand')->find($id);
        if (!$brand) {
            throw $this->createNotFoundException('Brand not found');
        }

        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('brand', ['id' => $brand->getId()]);
        }
        return ['form' => $form->createView()];
    }
}
