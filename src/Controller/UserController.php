<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Validator\Constraints\Length;

# https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/query-builder.html

class UserController extends Controller
{
    /**
     * @Route("/users", name="users")
     */
    public function index()
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');         

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        for ($i = 0; $i < sizeof($users); $i++) {

            if(sizeof($users[$i]->getRoles())==2){

                unset($users[$i]);
            }
        }

       /* foreach ($users as &$user) {
           var_dump(sizeof($user->getRoles()));

           if(sizeof($user->getRoles())==2){


           }

        }*/

        return $this->render('admin/users/index.html.twig', [            
            'users' => $users,
            'user' => $this->getUser(),
        ]);
    }

    public function showProfil()
    {

        $this->denyAccessUnlessGranted('ROLE_USER');  

        return $this->render('profil/profil.html.twig', [          
           
            'user' => $this->getUser()
        ]);
    }

    public function deleteUser($id)
    {

       $this->denyAccessUnlessGranted('ROLE_ADMIN');  

      $em = $this->getDoctrine()->getManager();

      $usrRepo = $em->getRepository(User::class);
      
      $user = $usrRepo->find($id);

      $em->remove($user);

      $em->flush();

      return $this->redirectToRoute('listing_users');

    }

}
