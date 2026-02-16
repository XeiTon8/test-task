<?php

namespace App\Controller;

use App\Service\Calculator;
use App\Service\Carrier\CarrierRegistry;
use App\Service\Carrier\PackGroupCarrier;
use App\Service\Carrier\TransCompanyCarrier;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;


class CalculatingController extends AbstractController {

    #[Route('/api/shipping/calculate', methods: ['POST'])]
    public function calculate(Request $request): JsonResponse { 

        $registry = new CarrierRegistry([
           new PackGroupCarrier(),
           new TransCompanyCarrier()
        ]);

        $calculator = new Calculator($registry);

        $data = json_decode($request->getContent(), true);

        $carrier = $data['carrier'];
        $weightKg = (float)$data['weightKG'];

        if (!$carrier || !is_numeric($weightKg) || $weightKg <= 0) {
            return new JsonResponse([
                'error' => 'Invalid input'
            ], 400);
        }

        try { 
            $price = $calculator->calculate($carrier, weightKG: $weightKg);
            return new JsonResponse([
                'carrier' => $carrier,
                'weightKG' => $weightKg,
                'currency' => 'EUR',
                'price' => $price
            ]);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error'=> $e->getMessage()],400);
        } 
    }
   
}