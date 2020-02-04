<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends AbstractController
{
    /**
          * @Route("inscription", name="inscription_index", methods={"GET", "POST"})
          * @param Request $request
          * @param EntityManagerInterface $entityManager
          * @return Response
          */
         public function create(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager): Response {

             $user = new User();

             $formUser = $this->createForm(RegisterType::class, $user);
             $formUser->handleRequest($request);

             if($formUser->isSubmitted() && $formUser->isValid ()){

                 $password = $encoder->encodePassword($user, $user->getPassword());
                 $user->setPassword($password);

                 $this->addFlash("success", "Utilisateur crée, vous pouvez vous connecter!" );

                 $entityManager->persist($user);
                 $entityManager->flush();

                 return $this->redirectToRoute("connexion_index" );
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
            //on envoi dans la base de donnéees
             //$entityManager->persist($user);

             //actualise la bdd
             //$entityManager->flush();

             $user = $entityManager->getRepository('App:User')->findBy(["email" => $user->getEmail(), "password"=> $user->getPassword()]);



            dump($user);

            if (empty($user)) {
                 return $this->render('Home/inscription.html.twig', ['formUser'=> $formUser->createView() ]);
            } else {

                $request->getSession()->set('username', $user[0]->getUsername());
                $request->getSession()->set('password', $user[0]->getPassword());
                $request->getSession()->set('email', $user[0]->getEmail());
                $request->getSession()->set('id', $user[0]->getId());

               //  $this->session->set('username', $user->getUsername());
               //  $this->session->set('password', $user->getPassword());
               //  $this->session->set('email', $user->getEmail());
            }

            return $this->redirectToRoute("home_index" );

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

    /**
     * @Route("admin", name="admin", methods={"GET"})
     * @return Response
     */
    public function admin(): Response
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        return $this->render('Mesannonces/mesannonces.html.twig');
    }




}