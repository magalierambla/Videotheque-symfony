<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Film;
use App\Entity\User;
use App\Entity\Category;
use App\Form\FilmType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RequestStack;

class FilmsController extends Controller
{

    public $route;

    public function __construct(RequestStack $requestStack) {
       

        $this->route = $requestStack->getCurrentRequest()->get('_route');

        // var_dump($this->route);
    }
    /**
     * @Route("/films", name="films")
     */
    public function index()
    {

       $this->denyAccessUnlessGranted('ROLE_USER');         

       $films = $this->getDoctrine()->getRepository(Film::class)->findAll();

       

       if ($this->getUser()) {
       

              // var_dump(($this->getUser()->getUsername()));

              // var_dump(($this->getUser()->getUsername()));
       }

        return $this->render('films/index.html.twig', [            
            'user' => $this->getUser(),
            'films' => $films,
        ]);
    }

    public function show($id)
    {

        $this->denyAccessUnlessGranted('ROLE_USER');  

        $film = $this->getDoctrine()->getRepository(Film::class)->find($id);

        return $this->render('films/show_movie.html.twig', [
            'user' => $this->getUser(),
            'film' => $film,
        ]);
    	
    }

    public function delete($id)
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');  

        $entityManager = $this->getDoctrine()->getManager();

        $film = $this->getDoctrine()->getRepository(Film::class)->find($id);      

        $entityManager->remove($film);

        $entityManager->flush();       

        $filename = $this->getParameter('images_directory') .'/'. $film->getPicture();

        if (file_exists($filename)) {

            unlink($filename);
       } 

       return $this->redirectToRoute('listing_films');  
    	
    }

    public function add(Request $request)
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');  

      

        $film = new Film();

        //$categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        // dump($categories);

       // $film->addArrayCategory($categories);

        $form = $this->createForm(FilmType::class, $film);

        $form->handleRequest($request);

       if( $form->isSubmitted() && $form->isValid() ){

        $film->setTitle($film->getTitle());

        $film->setResume($film->getResume());
        
       

        if ($film->getPicture() !== null) {

            $file = $form->get('picture')->getData();

            $fileName = uniqid(). '.' .$file->guessExtension();

            try {

                $file->move($this->getParameter('images_directory'),$fileName);

            } catch (FileException $e) {
                return new Response($e->getMessage());
            }

            $film->setPicture($fileName);
        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($film);

        $em->flush(); 

        // var_dump($form->get('title')->getData().$form->get('resume')->getData()) ;

        // var_dump($film->getTitle().$film->getResume()) ;      

       return $this->redirectToRoute('listing_films');

        

       }

        return $this->render('films/add_movie.html.twig', [
            'form' => $form->createView()  ,
            'user' => $this->getUser(), 
            'film' => $film       
        ]);
    	
    }

    public function edit($id, Film $film, Request $request)
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');   

        $filmBdd = $this->getDoctrine()->getRepository(Film::class)->find($id);

        $oldPicture = $filmBdd->getPicture(); 

       // var_dump($film->getPicture());

        $form = $this->createForm(FilmType::class, $film);

        $form->handleRequest($request);


       if( $form->isSubmitted() && $form->isValid() ){

        $film->setTitle($film->getTitle());

        $film->setResume($film->getResume());

        $film->setLastUpdateDate(new \DateTime());
        

        if ($film->getPicture() !== null && $film->getPicture() !== $oldPicture) {

            // var_dump("toto1");

            // var_dump($film->getPicture());

            if($oldPicture){

                $filename = $this->getParameter('images_directory') .'/'. $oldPicture;

                if (file_exists($filename)) {
        
                    unlink($filename);
               } 

            }
           

            $file = $form->get('picture')->getData();

            $fileName = uniqid(). '.' .$file->guessExtension();

            try {

                $file->move($this->getParameter('images_directory'),$fileName);

            } catch (FileException $e) {

                return new Response($e->getMessage());
            }

            $film->setPicture($fileName);

        } else {            

            $film->setPicture($oldPicture);
        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($film);

        $em->flush();

        //return $this->redirectToRoute('listing_films');

        return $this->redirectToRoute('film_show',array('id' => $film->getId()));

        

       }

        return $this->render('films/edit_movie.html.twig', [
            'film' => $film,
            'form' => $form->createView() ,
            'user' => $this->getUser(),         
        ]);
    	
    }

    public function admin()
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');  

        $films = $this->getDoctrine()->getRepository(Film::class)->findAll();
        

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'films' => $films,
            'users' => $users,
            'user' => $this->getUser(),
        ]);
    }


}
