<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\PlaceRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Serializer\JMSSerializerAdapter;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations\Get; // N'oublons pas d'inclure Get

class PlaceController extends AbstractFOSRestController//AbstractController
{
    
    
    /**
     * @Get("/api/places/{id}",name="places_list")
     * @View
     */
    public function getPlaces($id,PlaceRepository $repo)

    {

        $places = $repo->find($id);
        return $places;
        // // transformer les objets en tableau  
        // $formatted = [];
        // foreach ($places as $place) {
        //     $formatted[] = [
        //         'id' => $place->getId(),
        //         'name' => $place->getName(),
        //         'address' => $place->getAdresse(),
        //     ];
        // }

        // return new JsonResponse($formatted);
    }
     /**
     * @Route("/places2",name="place_id",methods={"GET","POST"})
     * @View()
     */
    public function getPlaces2(PlaceRepository $repo)

    {

        $places = $repo->findAll();
        // transformer les objets en tableau  
        $formatted = [];
        foreach ($places as $place) {
            $formatted[] = [
                'id' => $place->getId(),
                'name' => $place->getName(),
                'address' => $place->getAdresse(),
            ];
        }

        return new JsonResponse($formatted);
    }
     /**
     * @Get("/api/user",name="user_list")
     * @View()
     */
    public function getPlaceslist(PlaceRepository $repo)

    {

        $places = $repo->findAll();
        return $places;
        // // transformer les objets en tableau  
        // $formatted = [];
        // foreach ($places as $place) {
        //     $formatted[] = [
        //         'id' => $place->getId(),
        //         'name' => $place->getName(),
        //         'address' => $place->getAdresse(),
        //     ];
        // }

        // return new JsonResponse($formatted);
    }


    
    /**
     * @Route("/api/places/{id}",name="place_id",methods={"GET","POST"})
     * @View()
     */
    public function getPlace(PlaceRepository $repo, $id)
    {
        $place = $repo->find($id);
        if (empty($place)) 
        {
            return new JsonResponse(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);        
        } 
       // dd($p);
       // return $this->json($place);
       return $place;
    }
    /**
     * @Get("/api/users",name="users_list")
     * @View(statusCode="200",serializerGroups={"guser","show"})
     */
    public function getPlaceslistuser(UserRepository $repo)

    {

        $users = $repo->findAll();
        return $users;
        // // transformer les objets en tableau  
        // $formatted = [];
        // foreach ($places as $place) {
        //     $formatted[] = [
        //         'id' => $place->getId(),
        //         'name' => $place->getName(),
        //         'address' => $place->getAdresse(),
        //     ];
        // }

        // return new JsonResponse($formatted);
    }
    /**
     * @Rest\Post("/api/places")
     * @Rest\View
     * @ParamConverter("place", converter="fos_rest.request_body")
     */
    public function createAction(Place $place)
    {
      //  $iduser=$this->getUser()->getId();
        
        $em = $this->getDoctrine()->getManager();
      //  $user=$em->getRepository(User::class)->find($iduser);
         
        //$place->setUser($user);
        $em->persist($place->getUser());

        $em->persist($place);
        $em->flush();

        return $place;
        dump($place); die;
    }
     /**
     * @Rest\Put("/api/places/{id}")
     * @Rest\View
     * @ParamConverter("place", converter="fos_rest.request_body")
     */
    public function put(Place $place,$id)
    {
    //    /$idplacer=$this->getPlace()->getId();
        $em = $this->getDoctrine()->getManager();
        $place1=$em->getRepository(Place::class)->find($id);
        $place1->setAdresse($place->getAdresse());
        $em->persist($place1);
       // $em->persist($place->getUser());

       // $em->persist($place);
       // $em->flush();

        // return $place;//
        dump($place1); die;
    }
}
