<?php

// src/Controller/imageController.php
namespace App\Controller;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// ...

class ImageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Image::class);
        $images = $repository->findAll();

        //dd($images);

        //$images = $imageRepository->findAll();
    
        return $this->render('index.html.twig', [
            'title' => $images[0]->getTitle(),
            'img' => $images[0]->getImg(),
            'date' => $images[0]->getDate()->format('Y-m-d H:i:s')
            
        ]);

        /* foreach( $images as $singleImage ) {
            return $this->render('index.html.twig', [
                'title' => $this->$singleImage->getTitle(),
                
            ]);
        } */
        
    }
}

