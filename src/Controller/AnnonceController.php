<?php


namespace App\Controller;
use App\Entity\Annonce;
use App\Entity\Category;
use App\Entity\Recherche;
use App\Entity\User;
use App\Form\AddAnnonceType;
use App\Form\RechercheType;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;


/**
 * @method getFavorites()
 */
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
            $annonces_c = $entityManager->getRepository('App:Category')->findAll();
            //dump($annonces);
            //exit();
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

        if($this->getUser() !== null){

            $annonce = new Annonce($request->getSession()->get('id'));
            $categorie = new Category();

            $formAnnonce = $this->createForm(AddAnnonceType::class, $annonce);

            $formAnnonce->handleRequest($request);

            if($formAnnonce->isSubmitted() && $formAnnonce->isValid()){

                $this->addFlash("success", "Annonce ajouté" );

                $entityManager->persist($annonce);
                $entityManager->flush();

                //return $this->redirectToRoute("home_index" );

                $annonce = $entityManager->getRepository('App:Annonce')->find($annonce->getId());
                $annonce_author = $entityManager->getRepository('App:User')->find($annonce->getAuthorId());
                return $this->render('Annonce/annonce.html.twig', ['annonce' => $annonce,'author_id'=>$annonce_author]);
            }

            return $this->render( 'Addannonce/addannonce.html.twig',['formAnnonce'=>$formAnnonce->createView()]);

        }else{

            //$annonce = $entityManager->getRepository('App:Annonce')->findAll();
            //return $this->render('Annonce/annonce.html.twig', ['annonces' => $annonce]);
            return $this->redirectToRoute('annonce_all');

        }

    }

    /**
     * @Route("annonce", name="annonce_all", methods={"GET", "POST"})
     * @Route("annonce/{id}", name="annonce_index", requirements={"id": "\d+"}, methods={"GET", "POST"})
     * @Route("annonce/{searched_word}", name="annonce_word", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        if(null !==$request->get('id')){
            //requete par id = nombre
            $annonce = $entityManager->getRepository('App:Annonce')->find($request->get('id'));

            if($annonce == null){
                return $this->redirectToRoute('annonce_all');
            }else{
                $annonce_author = $entityManager->getRepository('App:User')->find($annonce->getAuthorId());
            }

            return $this->render('Annonce/annonce.html.twig', ['annonce' => $annonce,'author_id'=>$annonce_author]);

        }else if(null !==$request->get('searched_word')){
            //RECUP GRACE A LA METHODE DQL
            //$annonces = findAnnoncesByWord();
            //$this->repository
            $annonces = $entityManager->getRepository('App:Annonce')->findAnnoncesByWord($request->get('searched_word'));
            return $this->render('Annonce/annonce.html.twig', ['annonces' => $annonces]);
        }else{
            //$annonces = $entityManager->getRepository('App:Annonce')->findAll();
            //return $this->render('Annonce/annonce.html.twig', ['annonces' => $annonces]);
            $recherche = new Recherche();

            $formAnnonce = $this->createForm(RechercheType::class, $recherche);
            $formAnnonce->handleRequest($request);

            //dump($formAnnonce);

            if($formAnnonce->isSubmitted()){

                //dump($recherche);
                //exit();
                return $this->redirectToRoute("annonce_word", ['searched_word'=>$recherche->getSearchedword()]);
            }

            return $this->render('Annonce/annonce.html.twig', ['formAnnonce' => $formAnnonce->createView()]);
        }

    }


    /**
     * @Route("favoris/{id}", name="favoris_index", requirements={"id": "\d+"}, methods={"GET"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */

    public function favoris(Request $request, EntityManagerInterface $entityManager): Response {

            // Récupérer l'annonce
            $annonce = $entityManager->getRepository('App:Annonce')->find($request->get('id'));

            // Récupérer l'utilisateur
            /** @var User $user */
            $user = $this->getUser();

            // Vérifier si l'utilisateur a déjà l'annonce en favoris
            if (!$user->getFavorites()->contains($annonce)) {
                $user->addFavorite($annonce);
            } else {
                $user->removeFavorite($annonce);
            }

            $entityManager->flush();

            $annonce = $entityManager->getRepository('App:Annonce')->find($request->get('id'));

            if($annonce == null){
                return $this->redirectToRoute('annonce_all');
            }else{
                $annonce_author = $entityManager->getRepository('App:User')->find($annonce->getAuthorId());
            }

            return $this->render('Annonce/annonce.html.twig', ['annonce' => $annonce,'author_id'=>$annonce_author]);
    }

    /**
     * @Route("mesfavoris", name="mesfavoris", methods={"GET"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */

    public function mesfavoris(Request $request, EntityManagerInterface $entityManager): Response {
        $user = $this->getUser();
        $annonces = $user->getFavorites();

        //dump($annonces);
        //exit();

        return $this->render('Favoris/favoris.html.twig', ['mesannonces' => $annonces]);

    }


}
