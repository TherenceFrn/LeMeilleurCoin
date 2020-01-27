<?php

namespace App\Controller;
use App\Entity\Annonce;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DelannonceController extends AbstractController
{

    /**
     * @Route("delannonce", name="delannonce_all", methods={"GET"})
     * @Route("delannonce/{id}", name="delannonce_index", requirements={"id": "\d+"}, methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        if(null !== $request->get('id'))    {
            //s'il y a un id :

            $annonce = $entityManager->getRepository('App:Annonce')->find($request->get('id'));

            if($annonce == null){
            }else{
              $entityManager->remove($annonce);
              $entityManager->flush();
            }


            $annonces = $entityManager->getRepository('App:Annonce')->findAll();
            return $this->render('Delannonce/delannonce.html.twig', ['mesannonces' => $annonces]);


        }else{
            //s'il n'y a pas d'id :
            $annonces = $entityManager->getRepository('App:Annonce')->findAll();
            return $this->render('Delannonce/delannonce.html.twig', ['mesannonces' => $annonces]);

        }
    }

}