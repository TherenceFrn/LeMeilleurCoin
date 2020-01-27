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
     * @Route("annonce/mesannonces", name="annonces_all", methods={"GET"})
     * @Route("annonce/mesannonces/{author_id}", name="annonces_index", methods={"GET"})
     * @param Request $request
     * @return Response
     */

    public function annonces(Request $request, EntityManagerInterface $entityManager): Response {

      if(null !==$request->get('author_id')){

                $annonce = $entityManager->getRepository('App:Annonce')->findBy(["Author_id" => $request->get('author_id')], []);
                return $this->render('Mesannonces/mesannonces.html.twig', ['mesannonces' => $annonce]);

            }else{

                $annonces = $entityManager->getRepository('App:Annonce')->findAll();
                return $this->render('Mesannonces/mesannonces.html.twig', ['mesannonces' => $annonces]);

            }
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
            return $this->redirectToRoute("home_index" );

            $annonce = $entityManager->getRepository('App:Annonce')->find($annonce->getId());
            return $this->render('Annonce/annonce.html.twig', ['annonce' => $annonce]);
        }

        return $this->render( 'Addannonce/addannonce.html.twig',['formAnnonce'=>$formAnnonce->createView()]);

    }

    /**
     * @Route("annonce", name="annonce_all", methods={"GET"})
     * @Route("annonce/{id}", name="annonce_index", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {


        if(null !==$request->get('id')){

            $annonce = $entityManager->getRepository('App:Annonce')->find($request->get('id'));

            $annonce_author = $entityManager->getRepository('App:User')->find($annonce->getAuthorId());

            return $this->render('Annonce/annonce.html.twig', ['annonce' => $annonce,'author_id'=>$annonce_author]);

        }else{

                $annonces = $entityManager->getRepository('App:Annonce')->findAll();

                return $this->render('Annonce/annonce.html.twig', ['annonces' => $annonces]);
            }

        }
}