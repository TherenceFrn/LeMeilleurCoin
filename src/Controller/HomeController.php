<?php


namespace App\Controller;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
          * @Route("inscription", name="inscription_index", methods={"GET", "POST"})
          * @param Request $request
          * @param EntityManagerInterface $entityManager
          * @return Response
          */
         public function create(Request $request, EntityManagerInterface $entityManager): Response {

             $user = new User();

             $formUser = $this->createForm(RegisterType::class, $user);
             $formUser->handleRequest($request);

             if($formUser->isSubmitted() && $formUser->isValid()){
                 $this->addFlash("success", "Utilisateur crée !" );

                 $entityManager->persist($user);
                 $entityManager->flush();

                 return $this->redirectToRoute("home_index" );
             }

             return $this->render('Home/inscription.html.twig', ['formUser'=> $formUser->createView() ]);

         }

     /**
      * @Route("connexion", name="connexion_index", methods={"GET", "POST"})
      * @param Request $request
      * @param EntityManagerInterface $entityManager
      * @return Response
      */
     public function connexion(Request $request, EntityManagerInterface $entityManager): Response {

        //creer une instance
         $user = new User();

         //creation d'un formulaire : dans le dossier FORM
         $formUser = $this->createForm(RegisterType::class, $user);
         //?
         $formUser->handleRequest($request);

        //si le formulaire est validé et soumis
         if($formUser->isSubmitted() && $formUser->isValid()){

            //message en cas de succes
             $this->addFlash("success", "Utilisateur crée !" );

            //on envoi dans la base de donnéees
             //$entityManager->persist($user);

             //actualise la bdd
             //$entityManager->flush();

            //dump($user);
            //exit();
            //return $this->redirectToRoute("home_index" );

           // $userCorrespondant = $entityManager->getRepository('App:User')->find();

           //$this->session->set('userName', $user.userName);
         }

         return $this->render('Home/inscription.html.twig', ['formUser'=> $formUser->createView() ]);

     }

    /**
     * @Route("home", name="home_index", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response {

        return $this->render('Home/home.html.twig');
    }






}