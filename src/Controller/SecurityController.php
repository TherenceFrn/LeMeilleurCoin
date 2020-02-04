<?php

namespace App\Controller;

use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController{
    private $urlGenerator;


    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * return Response
     * @return Response
     */

public function login(AuthenticationUtils $authenticationUtils): Response{

    $error = $authenticationUtils->getLastAuthenticationError();

    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('home/home.html.twig', ['last_username'=>$lastUsername, 'error'=>$error]);


    }

    /**
     *@Route ("/logout", name="app_logout")
     */
    public function logout()
{
    return $this->RedirectToRoute("home_index");
}


public function getPassword($credentials): ?string {
        return $credentials['password'];
}

public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey){
        if($targetPath = $this->getTargetPath($request->getSession(), $providerKey)){
            return new RedirectResponse($targetPath);
        }
        throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
}

protected function getLoginUrl(){
        return $this->urlGenerator->generate('security_login');
}

    private function getTargetPath($getSession, $providerKey)
    {
    }

}