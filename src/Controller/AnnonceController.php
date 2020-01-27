<?php


namespace App\Controller;
use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{


    /**
     * @Route("annonce", name="annonce_all", methods={"GET"})
     * @Route("annonce/{id}", name="annonce_index", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response {

        if(null !== $request->get('id')){
            return $this->render('Annonce/annonce.html.twig',['id'=>$request->get('id')]);

        }else{
            return $this->render('Annonce/annonce.html.twig');
        }

    }

}