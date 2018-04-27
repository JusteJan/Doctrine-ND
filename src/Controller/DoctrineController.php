<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DoctrineController extends Controller
{
    /**
     * @Route("/save", name="save")
     */
    public function saveAction()
    {
        $category = new Category();
        $category
            ->setTitle('category1')
        ;

        $product = new Product();
        $product
            ->setTitle('product1')
            ->setActive(true)
            ->setPrice('10')
            ->setCategory($category)
        ;

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return new JsonResponse('Product created');

    }

    /**
     * @Route("/delete/{id}", name="delete")
     *
     */
    public function deleteAction(Product $product = null)
    {
        if (!$product) {
            return new JsonResponse('The product does not exist');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return new JsonResponse('Product removed');
    }
}
