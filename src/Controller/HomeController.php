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
     * @Route("connexion", name="connexion_index", methods={"GET", "POST"})
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

    // Appel a la vue
        return $this->render('Home/connexion.html.twig', ['formUser'=> $formUser->createView()
        ]);


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