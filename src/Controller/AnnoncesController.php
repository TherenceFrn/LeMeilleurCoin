<?php


namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoncesController extends AbstractController
{

    /**
     * @Route("mesannonces", name="annonces_index", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response {
        return $this->render('Home/mesannonces.html.twig');
    }

}