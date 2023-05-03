<?php

namespace App\Controller;

use App\Entity\TipoIncidente;
use App\Form\TipoIncidenteType;
use App\Repository\TipoIncidenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/tipo_incidente')]
class TipoIncidenteController extends AbstractController
{
    #[Route('/', name: 'app_tipo_incidente_index', methods: ['GET'])]
    public function index(TipoIncidenteRepository $tipoIncidenteRepository): Response
    {
        return $this->render('admin/tipo_incidente/index.html.twig', [
            'tipo_incidentes' => $tipoIncidenteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tipo_incidente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TipoIncidenteRepository $tipoIncidenteRepository): Response
    {
        $tipoIncidente = new TipoIncidente();
        $form = $this->createForm(TipoIncidenteType::class, $tipoIncidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tipoIncidenteRepository->save($tipoIncidente, true);

            return $this->redirectToRoute('app_tipo_incidente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/tipo_incidente/new.html.twig', [
            'tipo_incidente' => $tipoIncidente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tipo_incidente_show', methods: ['GET'])]
    public function show(TipoIncidente $tipoIncidente): Response
    {
        return $this->render('admin/tipo_incidente/show.html.twig', [
            'tipo_incidente' => $tipoIncidente,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tipo_incidente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TipoIncidente $tipoIncidente, TipoIncidenteRepository $tipoIncidenteRepository): Response
    {
        $form = $this->createForm(TipoIncidenteType::class, $tipoIncidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tipoIncidenteRepository->save($tipoIncidente, true);

            return $this->redirectToRoute('app_tipo_incidente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/tipo_incidente/edit.html.twig', [
            'tipo_incidente' => $tipoIncidente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tipo_incidente_delete', methods: ['POST'])]
    public function delete(Request $request, TipoIncidente $tipoIncidente, TipoIncidenteRepository $tipoIncidenteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tipoIncidente->getId(), $request->request->get('_token'))) {
            $tipoIncidenteRepository->remove($tipoIncidente, true);
        }

        return $this->redirectToRoute('app_tipo_incidente_index', [], Response::HTTP_SEE_OTHER);
    }
}
