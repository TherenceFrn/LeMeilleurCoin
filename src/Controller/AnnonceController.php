<?php


namespace App\Controller;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        //$id = $request->get('id');
        //return $this->render( 'Annonce/annonce.html.twig', ['id' => $id]);

        if(null !==$request->get('id')){

            $annonce = $entityManager->getRepository('App:Annonce')->find($request->get('id'));

            return $this->render('Annonce/annonce.html.twig', ['annonce' => $annonce]);
        }else{

            //$repository = $this->getDoctrine()->getRepository(Annonce::class);

            //$products = $repository->findBy(
            //    ['nom' => 'premiere'],
            //);


            $annonces = $entityManager->getRepository('App:Annonce')->findAll();

            return $this->render('Annonce/annonce.html.twig', ['annonces' => $annonces]);
        }

    }

}