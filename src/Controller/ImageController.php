<?php

namespace App\Controller;

use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Image::class)->findAll();
        
        $images = array();
        foreach ($repository as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getImg()));
            $titles[$key] = $entity->getTitle();
            $dates[$key] = $entity->getDate()->format('Y-m-d H:i:s');
        }

        $bottone = true;
    
        return $this->render('index.html.twig', array('repository' => $repository ,
                                                      'images' => $images,
                                                      'titles' => $titles,
                                                      'dates' => $dates,
                                                      'bottone' => $bottone
                                                    ));
    }
}


