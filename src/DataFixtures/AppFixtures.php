<?php

namespace App\DataFixtures;

use App\Entity\Passenger;
use App\Entity\BoardingPass;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $passenger1 = new Passenger();
        $passenger1->setFirstName('John');
        $passenger1->setLastName('Doe');

        $passenger2 = new Passenger();
        $passenger2->setFirstName('Daniel');
        $passenger2->setLastName('Black');

        $manager->persist($passenger1);
        $manager->persist($passenger2);

        //passenger1
        // Take train 78A from Madrid to Barcelona. Sit in seat 45B.
        $pass1 = new BoardingPass();
        $pass1->setTransportType('train')
            ->setTransportNumber('78A')
            ->setSeat('45B')
            ->setOrigin('Madrid')
            ->setDestination('Barcelona')
            ->setDepartureTime(date_create('2023-03-15 09:36:18'))
            ->setPassenger($passenger1);

        $manager->persist($pass1);

        // Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
        $pass2 = new BoardingPass();
        $pass2->setTransportType('bus')
            ->setOrigin('Barcelona')
            ->setDestination('Gerona Airport')
            ->setDepartureTime(date_create('2023-03-15 13:30:00'))
            ->setPassenger($passenger1);

        $manager->persist($pass2);

        // From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.
        $pass3 = new BoardingPass();
        $pass3->setTransportType('flight')
            ->setTransportNumber('SK455')
            ->setSeat('3A')
            ->setGate('45B')
            ->setOrigin('Gerona Airport GRO')
            ->setDestination('Stockholm ARN')
            ->setDepartureTime(date_create('2023-03-15 16:00:00'))
            ->setPassenger($passenger1);

        $manager->persist($pass3);

        // From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg.
        $pass4 = new BoardingPass();
        $pass4->setTransportType('flight')
            ->setTransportNumber('SK22')
            ->setSeat('7B')
            ->setGate('22')
            ->setOrigin('Stockholm')
            ->setDestination('New York JFK')
            ->setDepartureTime(date_create('2023-03-16 03:40:00'))
            ->setPassenger($passenger1);

        $manager->persist($pass4);


        //passenger 2
        // Take train TGV INOUI 6632 from Lyon to Paris. Sit in seat 12A.
        $pass1 = new BoardingPass();
        $pass1->setTransportType('train TGV INOUI')
            ->setTransportNumber('6632')
            ->setSeat('12A')
            ->setOrigin('Lyon Part Dieu')
            ->setDestination('Paris Gare de Lyon')
            ->setDepartureTime(date_create('2023-02-10 07:32:00'))
            ->setPassenger($passenger2);

        $manager->persist($pass1);

        // Take the airport bus from Paris to Roissy-CDG Airport. No seat assignment.
        $pass2 = new BoardingPass();
        $pass2->setTransportType('bus')
            ->setOrigin('Paris')
            ->setDestination('Roissy-CDG Airport')
            ->setDepartureTime(date_create('2023-02-10 10:30:00'))
            ->setPassenger($passenger2);

        $manager->persist($pass2);

        // From Roissy-CDG Airport, take flight QR42 to Doha DOH. Gate 8B, seat 9A. Baggage drop at ticket counter 115.
        $pass3 = new BoardingPass();
        $pass3->setTransportType('flight')
            ->setTransportNumber('QR42')
            ->setSeat('9A')
            ->setGate('8B')
            ->setOrigin('Paris CDG 2C')
            ->setDestination('Doha DOH')
            ->setDepartureTime(date_create('2023-02-10 17:05:00'))
            ->setPassenger($passenger2);

        $manager->persist($pass3);

        // From Doha, take flight QR674 to Male MLE. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg.
        $pass4 = new BoardingPass();
        $pass4->setTransportType('flight')
            ->setTransportNumber('QR674')
            ->setSeat('7B')
            ->setGate('22')
            ->setOrigin('Doha DOH')
            ->setDestination('Male MLE')
            ->setDepartureTime(date_create('2023-02-11 04:35:00'))
            ->setPassenger($passenger2);

        $manager->persist($pass4);

        $manager->flush();
    }
}
