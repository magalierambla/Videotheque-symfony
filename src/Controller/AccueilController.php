<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;


class AccueilController extends Controller
{

    public $route;

    

    public function __construct(RequestStack $requestStack) {       

        $this->route = $requestStack->getCurrentRequest()->get('_route');
        

        // var_dump($this->route);
    }  

    public function changeLocale($locale, Request $request)
    {
           // On stocke la langue dans la session
         $request->getSession()->set('_locale', $locale);
 
           // On revient sur la page précédente
         return $this->redirect($request->headers->get('referer'));           
 
           
    }

    /**
     * @Route("/video", name="video")
     */
    public function index()
    {      

        return $this->render('accueil/index.html.twig');
    }
}
