<?php

// src/Controller/ProductController.php
namespace App\Controller;

use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// ...

class ImageController extends AbstractController
{
    #[Route('/index', name: 'product_show')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $image = $entityManager->getRepository(Image::class)->findAll;

        /* if (!$image) {
            throw $this->createNotFoundException(
                'No image found'
            );
        } */

        return new Response('Check out this great product: '.$image->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}

