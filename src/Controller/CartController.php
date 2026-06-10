<?php

namespace App\Controller;

use App\Entity\CartLine;
use App\Entity\Food;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{
    private CartRepository $cartRepository;
    private EntityManagerInterface $em;

    private String $cartNotFoundMessage = 'Cart Not Found';

    public function __construct(
        CartRepository $cartRepository,
        EntityManagerInterface $em)
    {
        $this->cartRepository = $cartRepository;
        $this->em = $em;
    }

    #[Route('/api/cart', name: 'app_cart', methods: ['GET'])]
    public function getCart(): JsonResponse
    {
        $cart = $this->cartRepository->find(1);
        return $this->json(
            $cart,
            context: ['groups' => ['cart:read']]
        );
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/api/cart/foods/{id}', methods: ['POST'])]
    public function addFoodToCart(Food $food): JsonResponse
    {
        $cart = $this->cartRepository->find(1);
        if(!$cart){
            return $this->json(
                ['message' => $this->cartNotFoundMessage],
                404
            );
        }

        $cartLine = null;
        foreach ($cart->getCartLines() as $line){
            if ($line->getFood()->getId() === $food->getId()) {
                $cartLine = $line;
                $cartLine->setQuantity(
                    $cartLine->getQuantity() + 1
                );
                break;
            }
        }

        if(!$cartLine){
            $cartLine = (new CartLine())
                ->setFood($food)
                ->setQuantity(1);
            $cart->addCartLine($cartLine);
            $this->em->persist($cartLine);
        }
        $this->em->flush();

        return $this->json(
            $cart,
            context: ['groups' => ['cart:read']]
        );
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/api/cart/lines/{id}', methods: ['DELETE'])]
    public function removeCartLineFromCart(CartLine $cartLine): JsonResponse
    {
        $cart = $cartLine->getCart();
        if(!$cart){
            return $this->json(
                ['message' => $this->cartNotFoundMessage],
                404
            );
        }

        $cart->removeCartLine($cartLine);

        $this->em->flush();

        return $this->json(
            $cart,
            context: ['groups' => ['cart:read']]
        );
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/api/cart/lines/{id}', methods: ['PATCH'])]
    public function changeQuantity(CartLine $cartLine, Request $request): JsonResponse
    {
        $cart = $cartLine->getCart();
        if(!$cart){
            return $this->json(
                ['message' => $this->cartNotFoundMessage],
                404
            );
        }

        $data = json_decode(
            $request->getContent(),
            true
        );

        if (!isset($data['quantity'])) {
            return $this->json(
                ['message' => 'Quantity missing'],
                400
            );
        }

        $quantity = (int)$data['quantity'];

        if($quantity < 1){
            $cart->removeCartLine($cartLine);
        } else {
            $cartLine->setQuantity($quantity);
        }

        $this->em->flush();

        return $this->json(
            $cart,
            context: ['groups' => ['cart:read']]
        );
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/api/cart/clear', methods: ['POST'])]
    public function clearCart(): JsonResponse
    {
        $cart = $this->cartRepository->find(1);
        if(!$cart){
            return $this->json(
                ['message' => $this->cartNotFoundMessage],
                404
            );
        }
        foreach($cart->getCartLines() as $cartLine){
            $cart->removeCartLine($cartLine);
        }
        $this->em->flush();

        return $this->json(
            $cart,
            context: ['groups' => ['cart:read']]
        );
    }
}
