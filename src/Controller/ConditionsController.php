<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ConditionsController extends AbstractController{

/**
    * @Route("Conditions", name="conditions_index", methods={"GET"})
 *
 * @param Request $request
 * @return Response
*/
public function conditions(Request $request): Response{
    return $this->render("Conditions/cgu.html.twig");
}



    /**
     * @Route("faq", name="faq_index", methods={"GET"})
     *
     * @param Request $request
     * @return Response
     */
    public function Faq(Request $request): Response{
        return $this->render("Conditions/faq.html.twig");
    }



}