<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/api/register', methods: ['POST'])]
    public function registerUser(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setUsername($data['username'])
            ->setEmail($data['email']);
        $user->setPassword(
            $passwordHasher->hashPassword($user, $data['password']));

        $cart = (new Cart())
            ->setUser($user);
        $user->setCart($cart);

        try {
            $em->persist($user);
            $em->persist($cart);
            $em->flush();
        } catch (UniqueConstraintViolationException) {
            return $this->json([
                'message' => 'Username already exists'
            ], 409);
        }

        return $this->json([
            'success' => true
        ]);
    }

    /**
     * @return never
     * Stupid dummy route because symfony is stupid
     * If it doesnt exist, symfony's router returns a 404 for login before
     * the json_login functionality can catch.
     */
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(): never
    {
        throw new \LogicException('Should be handled by json_login.');
    }

    #[Route('/api/user', methods: ['GET'])]
    public function getUserData(): JsonResponse
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException();
        }

        return $this->json(
            $user,
            context: ['groups' => ['user:read']]
        );
    }
}
