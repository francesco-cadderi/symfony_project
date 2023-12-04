<?php

namespace App\Controller;

use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class ImageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $em, Request $request, PaginatorInterface $paginator)
    {
        //trasformo tabella Image in una classe
        $repository = $em->getRepository(Image::class);

        //creo una query
        $query = $repository->createQueryBuilder('p');

        //filtro reqest con la query. Fisso parametri dell'oggetto $pagination
        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 4);

        //estraggo l'array dei miei dati da stampare
        $extractedItems = $pagination->getItems();

        //ciclo l'array. Creo degli array per ogni colonna del record, ed ad ognuno apllico un metodo differente
        foreach ($extractedItems as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getImg()));
            $titles[$key] = $entity->getTitle();
            $dates[$key] = $entity->getDate()->format('Y-m-d H:i:s');
        }
        
        return $this->render('index.html.twig', [
                                                    'extractedItems' => $extractedItems,
                                                    'images' => $images,
                                                    'titles' => $titles,
                                                    'dates' => $dates,
                                                    'pagination' => $pagination
                                                ]);
    }
}


