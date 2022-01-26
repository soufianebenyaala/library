<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Livre;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/booking')]
class BookingController extends AbstractController
{
    #[Route('/', name: 'booking_index', methods: ['GET'])]
    public function index(BookingRepository $bookingRepository): Response
    {
        return $this->render('booking/index.html.twig', [
            'bookings' => $bookingRepository->findAll(),
        ]);
    }

    #[Route('/{id}/new', name: 'booking_new', methods: ['GET','POST'])]
    public function new(Request $request,Livre $livre,BookingRepository $bookingRepository): Response
    {
        

        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid() ) {
            $entityManager = $this->getDoctrine()->getManager();

            $livre->retireDeQteStock();

            $booking->setBackgroundColor("green")
                    ->setApprover(false)
                    ->setLivre($livre)
                    ->setUser($this->getUser());

            $entityManager->persist($booking);
            $entityManager->flush();

            return $this->redirectToRoute('user_show', ['id'=>$this->getUser()], Response::HTTP_SEE_OTHER);
   
        }
        
        $events = $bookingRepository->findAll();
        $rdvs = [];

        foreach ($events as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getBookingDate()->format('Y-m-d'),
                'end' => $event->getExpectedRetrunDate()->format('Y-m-d'),
                'backgroundColor' => $event->getBackgroundColor(),
                'title' => $event->getLivreTitle(),
            ];
        }
        $data = json_encode($rdvs);

        return $this->renderForm('booking/new.html.twig', [
            'booking' => $booking,
            'form' => $form,
            'id'=>$livre,
            'data'=> $data
        ],);
    }

    #[Route('/{id}', name: 'booking_show', methods: ['GET'])]
    public function show(Booking $booking): Response
    {
        return $this->render('booking/show.html.twig', [
            'booking' => $booking,
        ]);
    }

    #[Route('/{id}/edit', name: 'booking_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Booking $booking): Response
    {
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('booking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'booking_delete', methods: ['POST'])]
    public function delete(Request $request, Booking $booking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$booking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($booking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('booking_index', [], Response::HTTP_SEE_OTHER);
    }


}
