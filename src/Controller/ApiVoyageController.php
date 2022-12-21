<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Repository\VoyageRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiVoyageController extends AbstractController
{
    #[Route('/api/voyages', name: 'api_voyages', methods: "GET")]
    public function collection(VoyageRepository $voyageRepository): JsonResponse
    {

        return $this->json(
            $voyageRepository->findAll(),
            200,
            [],
            ["groups" => "list_voyages"]
        );
    }


    #[Route('/api/voyages/{id}', name: 'api_voyages_item_get', methods: "GET")]
    public function item(Voyage $voyage, NormalizerInterface $normalizer) //: JsonResponse
    {
        $respNormalized = $normalizer->normalize(
            $voyage,
            null,
            ["groups" => "show_voyage"]
        );

        $myArray = [];
        foreach ($respNormalized as $value) {
            foreach ($value as $issue) {
                foreach ($issue as $elkey => $elvalue) {
                    switch ($elkey) {
                        case 'transport_type':
                            $myArray[] = "Take "  . $elvalue;
                            break;
                        case 'transport_number':
                            $elvalue != 0 ?  $elvalue =  " " . $elvalue . "," : $elvalue =
                                "";
                            $myArray[] =  $elvalue;
                            break;
                        case 'origin':
                            $myArray[] = " from " . $elvalue;
                            break;
                        case  'destination':
                            $myArray[] = " to " . $elvalue . ". ";
                            break;
                        case  'gate':
                            $elvalue == 0 ? $elvalue = "" : $elvalue =
                                "Gate " . $elvalue . ", ";
                            $myArray[] =  $elvalue;
                            break;
                        case  'seat':
                            $elvalue == 0 ? $elvalue = "No seat attributed" : $elvalue =
                                "Seat " . $elvalue . ". ";
                            $myArray[] =  $elvalue;
                            break;
                        case 'baggage_info':
                            $elvalue == 0 ? $elvalue = "" : $elvalue = $elvalue;
                            $myArray[] =  $elvalue;
                            break;
                    }
                }
            }
        }

        $chunks = array_chunk($myArray, 7);

        $result = [];
        foreach ($chunks as $entry) {
            $result[] = ($entry[0] . $entry[1] . $entry[2] . $entry[3] . $entry[4] . $entry[5] . $entry[6]);
        }
        $result[] =  "You have arrived at your final destination.";

        return
            $this->json(
                $result,
                200,
            );
    }
}
