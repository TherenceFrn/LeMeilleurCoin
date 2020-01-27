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

class MesannoncesController extends AbstractController
{

    /**
     * @Route("mesannonces", name="mesannonces_index", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $annonces = $entityManager->getRepository('App:Annonce')->findAll();

        dump($annonces);

        return $this->render('Mesannonces/mesannonces.html.twig', ['mesannonces' => $annonces]);
    }

}