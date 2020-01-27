<?php


namespace App\Controller;
use App\Entity\Annonce;
use App\Entity\User;
use App\Form\AddAnnonceType;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{

    /**
     * @Route("mesannonces", name="annonces_index", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function annonces(Request $request): Response {
        return $this->render('Home/mesannonces.html.twig');
    }






    /**
     * @Route("annonce/add", name="annonce_add", methods={"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */

    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $annonce = new Annonce();

        $formAnnonce = $this->createForm(AddAnnonceType::class, $annonce);

        $formAnnonce->handleRequest($request);
        if($formAnnonce->isSubmitted() && $formAnnonce->isValid()){
            $this->addFlash("success", "Annonce ajouté" );

            $entityManager->persist($annonce);
            $entityManager->flush();

            $annonce = $entityManager->getRepository('App:Annonce')->find($annonce->getId());
            return $this->render('Annonce/annonce.html.twig', ['annonce' => $annonce]);
        }



        return $this->render( 'Addannonce/addannonce.html.twig',['formAnnonce'=>$formAnnonce->createView()
        ]);
    }





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