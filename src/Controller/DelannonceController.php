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
     * @Route("delannonce", name="delannonce_index", methods={"GET"})
     * @param Request $request
     * @return Response
     */

    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $annonces = $entityManager->getRepository('App:Annonce')->findAll();

        return $this->render('Delannonce/delannonce.html.twig', ['mesannonces' => $annonces]);
    }

}