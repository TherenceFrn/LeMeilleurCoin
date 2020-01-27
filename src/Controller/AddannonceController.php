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

class AddannonceController extends AbstractController
{


    /**
     * @Route("addannonce", name="addannonce_index", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $annonce = new Annonce();

        $annonce->setTitle('Ma première annonce');
        $annonce->setDescription('Voici ma première annonce, elle est vraiment sympas. Thérence gros alpha bg <3.');
        $annonce->setCity('Angers');
        $annonce->setDateCreated(new \DateTime('now'));
        $annonce->setAuthorId(1);
        $annonce->setPrice(752.02);
        $annonce->setZip('27 impasse diderot, 49100 Angers');

        $entityManager->persist($annonce);
        $entityManager->flush();

        dump($annonce);

        return $this->render( 'Addannonce/addannonce.html.twig',['annonce'=>$annonce]);
    }

}