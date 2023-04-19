<?php

namespace App\Controller;

use App\Entity\Reservacion;
use App\Entity\Usuario;
use App\Form\ReservacionType;
use Doctrine\ORM\EntityManagerInterface;
use SebastianBergmann\Environment\Console;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservacion')]
class ReservacionController extends AbstractController
{
    #[Route('/', name: 'app_reservacion_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservacions = $entityManager
            ->getRepository(Reservacion::class)
            ->findAll();

        return $this->render('reservacion/index.html.twig', [
            'reservacions' => $reservacions,
        ]);
    }

    #[Route('/new', name: 'app_reservacion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('ROLE_CLIENTE')) {

        $userEstado = $this->getUser()->getEstado();

        if ($userEstado === 'A'){
            $reservacion = new Reservacion();
            $form = $this->createForm(ReservacionType::class, $reservacion);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($reservacion);
                $entityManager->flush();

                return $this->redirectToRoute('app_reservacion_index', [], Response::HTTP_SEE_OTHER);
            }

        return $this->renderForm('reservacion/new.html.twig', [
            'reservacion' => $reservacion,
            'form' => $form,
        ]);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
        
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
        
        
    }

    #[Route('/{idReservacion}', name: 'app_reservacion_show', methods: ['GET'])]
    public function show(Reservacion $reservacion): Response
    {
        return $this->render('reservacion/show.html.twig', [
            'reservacion' => $reservacion,
        ]);
    }

    #[Route('/{idReservacion}/edit', name: 'app_reservacion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservacion $reservacion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservacionType::class, $reservacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservacion/edit.html.twig', [
            'reservacion' => $reservacion,
            'form' => $form,
        ]);
    }

    #[Route('/{idReservacion}', name: 'app_reservacion_delete', methods: ['POST'])]
    public function delete(Request $request, Reservacion $reservacion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservacion->getIdReservacion(), $request->request->get('_token'))) {
            $entityManager->remove($reservacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservacion_index', [], Response::HTTP_SEE_OTHER);
    }
}
