<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    
    public function getUsers(UserRepository $repo)

    {

        $users = $repo->findAll();
        // transformer les objets en tableau  
        $formatted = [];
        foreach ($users as $user) {
            $formatted[] = [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
            ];
        }

        return new JsonResponse($formatted);
    }
    

    public function getuser1(userRepository $repo, $id)
    {
        $user = $repo->find($id);
       // dd($p);
        return $this->json($user, 200);
    }
}
