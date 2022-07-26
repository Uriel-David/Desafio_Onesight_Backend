<?php

namespace App\Controller;

use App\Entity\Events;
use App\Form\EventType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/events", name="events_index")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $events = $doctrine->getRepository(Events::class)->findAll();

        if (!$events) {
            $events = null;
        }

        return $this->render('events/index.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * @Route("/events/create", name="events_create")
     */
    public function createEvent(ManagerRegistry $doctrine, Request $request): Response
    {
        $event  = new Events();
        $form   = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            
            $this->addFlash('notice', 'Update Successfully!');

            return $this->redirectToRoute('events_index');
        }

        return $this->render('events/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/events/update/{id}", name="events_update")
     */
    public function updateEvent(ManagerRegistry $doctrine, Request $request, $id): Response
    {
        $event  = $doctrine->getRepository(Events::class)->find($id);
        $form   = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            
            $this->addFlash('notice', 'Updated Successfully!');

            return $this->redirectToRoute('events_index');
        }

        return $this->render('events/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/events/delete/{id}", name="events_delete")
     */
    public function deleteEvent(ManagerRegistry $doctrine, $id): Response
    {
        $event         = $doctrine->getRepository(Events::class)->find($id);
        $entityManager = $doctrine->getManager();
        $entityManager->remove($event);
        $entityManager->flush();

        $this->addFlash('notice', 'Deleted Successfully!');

        return $this->redirectToRoute('events_index');
    }
}
