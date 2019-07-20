<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{uuid}", name="user")
     */
    public function getUserByPersonUuid($uuid)
    {
        $person = $this->getDoctrine()->getRepository(Person::class)->findOneBy(['uuid' => $uuid]);
        if (empty($person) || empty($person->getUserUuid())) throw new NotFoundHttpException('Not found');
        return new JsonResponse(['userUuid' => $person->getUserUuid()]);
    }
}
