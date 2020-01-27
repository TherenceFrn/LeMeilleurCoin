<?php


namespace App\Controller;
use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("connexion", name="home_index", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response {

        $user = new User();

        $formUser = $this->createForm(RegisterType::class, $user);

        $formUser->handleRequest($request);
        if($formUser->isSubmitted() && $formUser->isValid()){
            $this->addFlash("success", "Utilisateur crée !" );

            return $this->redirectToRoute("home_index" );
        }

// Appel a la vue
        return $this->render('Home/connexion.html.twig', ['formUser'=> $formUser->createView()
        ]);
    }





}