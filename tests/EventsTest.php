<?php

namespace App\Tests;

use DateTime;
use App\Entity\Events;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EventsTest extends KernelTestCase
{
    /** @var EntityManagerInterface */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        DatabasePrimer::prime($kernel);

        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    /** @test */
    public function a_event_record_can_be_created_in_the_database()
    {
        // Set up
        $dateNow = new DateTime();

        // Event
        $event = new Events();
        $event->setEventName('Event Test');
        $event->setEventDescription('Test Event Description');
        $event->setExpectedParticipants(10);
        $event->setDateEvent($dateNow);
        $event->setApproval(false);

        $this->entityManager->persist($event);

        // Do something
        $this->entityManager->flush();

        $eventRepository = $this->entityManager->getRepository(Events::class);
        $eventRecord     = $eventRepository->findOneBy(['event_name' => 'Event Test']);

        // Make assertions
        $this->assertEquals('Event Test', $eventRecord->getEventName());
        $this->assertEquals('Test Event Description', $eventRecord->getEventDescription());
        $this->assertEquals(10, $eventRecord->getExpectedParticipants());
        $this->assertEquals($dateNow, $eventRecord->getDateEvent());
        $this->assertEquals(0, $eventRecord->isApproval());
    }
}