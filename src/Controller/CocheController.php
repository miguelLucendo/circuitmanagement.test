<?php

namespace App\Controller;

use App\Entity\Coche;
use App\Form\CocheType;
use App\Repository\CocheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;

#[Route('/admin/coche')]
class CocheController extends AbstractController
{
    #[Route('/', name: 'app_coche_index', methods: ['GET'])]
    public function index(CocheRepository $cocheRepository): Response
    {
        return $this->render('admin/coche/index.html.twig', [
            'coches' => $cocheRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_coche_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CocheRepository $cocheRepository): Response
    {
        $coche = new Coche();
        $form = $this->createForm(CocheType::class, $coche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cocheRepository->save($coche, true);

            return $this->redirectToRoute('app_coche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/coche/new.html.twig', [
            'coche' => $coche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coche_show', methods: ['GET'])]
    public function show(Coche $coche): Response
    {
        return $this->render('admin/coche/show.html.twig', [
            'coche' => $coche,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coche_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Coche $coche, CocheRepository $cocheRepository): Response
    {
        $form = $this->createForm(CocheType::class, $coche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cocheRepository->save($coche, true);

            return $this->redirectToRoute('app_coche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/coche/edit.html.twig', [
            'coche' => $coche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coche_delete', methods: ['POST'])]
    public function delete(Request $request, Coche $coche, CocheRepository $cocheRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $coche->getId(), $request->request->get('_token'))) {
            try {
                $cocheRepository->remove($coche, true);
            } catch (ForeignKeyConstraintViolationException $e) {
                $this->addFlash('error', 'No se puede eliminar el coche porque tiene incidentes asociados');
            }
        }

        return $this->redirectToRoute('app_coche_index', [], Response::HTTP_SEE_OTHER);
    }
}
