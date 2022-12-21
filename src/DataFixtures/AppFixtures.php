<?php

namespace App\DataFixtures;

use App\Entity\Voyage;
use DateTimeImmutable;
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

        $voyage1 = new Voyage();
        $voyage1->setCreatedAt(new DateTimeImmutable());
        $voyage1->setPassenger($passenger1);

        $voyage2 = new Voyage();
        $voyage2->setCreatedAt(new DateTimeImmutable());
        $voyage2->setPassenger($passenger1);

        $manager->persist($voyage1);
        $manager->persist($voyage2);

        //voyage1
        $pass1 = new BoardingPass();
        $pass1->setTransportType('train')
            ->setTransportNumber('78A')
            ->setSeat('45B')
            ->setOrigin('Madrid')
            ->setDestination('Barcelona')
            ->setDepartureTime(date_create('2023-03-15 09:36:18'))
            ->setVoyage($voyage1);

        $manager->persist($pass1);

        $pass2 = new BoardingPass();
        $pass2->setTransportType('bus')
            ->setOrigin('Barcelona')
            ->setDestination('Gerona Airport')
            ->setDepartureTime(date_create('2023-03-15 13:30:00'))
            ->setVoyage($voyage1);

        $manager->persist($pass2);

        $pass3 = new BoardingPass();
        $pass3->setTransportType('flight')
            ->setTransportNumber('SK455')
            ->setSeat('3A')
            ->setGate('45B')
            ->setOrigin('Gerona Airport GRO')
            ->setDestination('Stockholm ARN')
            ->setBaggageInfo('Baggage drop at ticket counter 344.')
            ->setDepartureTime(date_create('2023-03-15 16:00:00'))
            ->setVoyage($voyage1);

        $manager->persist($pass3);

        $pass4 = new BoardingPass();
        $pass4->setTransportType('flight')
            ->setTransportNumber('SK22')
            ->setSeat('7B')
            ->setGate('22')
            ->setOrigin('Stockholm')
            ->setDestination('New York JFK')
            ->setBaggageInfo('Baggage will we automatically transferred from your last leg.')
            ->setDepartureTime(date_create('2023-03-16 03:40:00'))
            ->setVoyage($voyage1);

        $manager->persist($pass4);

        //voyage2

        $pass1 = new BoardingPass();
        $pass1->setTransportType('train TGV INOUI')
            ->setTransportNumber('6632')
            ->setSeat('12A')
            ->setOrigin('Lyon Part Dieu')
            ->setDestination('Paris Gare de Lyon')
            ->setDepartureTime(date_create('2023-02-10 07:32:00'))
            ->setVoyage($voyage2);

        $manager->persist($pass1);

        $pass2 = new BoardingPass();
        $pass2->setTransportType('bus')
            ->setOrigin('Paris')
            ->setDestination('Roissy-CDG Airport')
            ->setDepartureTime(date_create('2023-02-10 10:30:00'))
            ->setVoyage($voyage2);

        $manager->persist($pass2);

        $pass3 = new BoardingPass();
        $pass3->setTransportType('flight')
            ->setTransportNumber('QR42')
            ->setSeat('9A')
            ->setGate('8B')
            ->setOrigin('Paris CDG 2C')
            ->setDestination('Doha DOH')
            ->setBaggageInfo('Baggage drop at ticket counter 212.')
            ->setDepartureTime(date_create('2023-02-10 17:05:00'))
            ->setVoyage($voyage2);

        $manager->persist($pass3);

        $pass4 = new BoardingPass();
        $pass4->setTransportType('flight')
            ->setTransportNumber('QR674')
            ->setSeat('7B')
            ->setGate('22')
            ->setOrigin('Doha DOH')
            ->setDestination('Male MLE')
            ->setBaggageInfo('Baggage will we automatically transferred from your last leg.')
            ->setDepartureTime(date_create('2023-02-11 04:35:00'))
            ->setVoyage($voyage2);

        $manager->persist($pass4);

        $manager->flush();
    }
}
