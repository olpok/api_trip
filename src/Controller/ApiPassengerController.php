<?php

namespace App\Controller;

use App\Entity\Passenger;
use App\Repository\PassengerRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class ApiPassengerController extends AbstractController
{
    #[Route('/api/passengers', name: 'api_passengers', methods: "GET")]
    public function collection(PassengerRepository $passengerRepository): JsonResponse
    {
        /*  return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiPassengerController.php',
        ]);*/

        return $this->json(
            $passengerRepository->findAll(),
            200,
            [],
            ["groups" => "list_passengers"]
        );
    }


    #[Route('/api/passengers/{id}', name: 'api_passengers_item_get', methods: "GET")]
    public function item(Passenger $passenger, NormalizerInterface $normalizer) //: JsonResponse
    {
        $respNormalized = $normalizer->normalize(
            $passenger,
            null,
            ["groups" => "show_passenger"]
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
