<?php

namespace App\Controller;

use App\Entity\Incidente;
use App\Form\IncidenteType;
use App\Repository\IncidenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CocheIncidenteRepository;
use App\Entity\CocheIncidente;

#[Route('/admin/incidente')]
class IncidenteController extends AbstractController
{
    #[Route('/', name: 'app_incidente_index', methods: ['GET'])]
    public function index(IncidenteRepository $incidenteRepository): Response
    {
        return $this->render('admin/incidente/index.html.twig', [
            'incidentes' => $incidenteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_incidente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, IncidenteRepository $incidenteRepository, EntityManagerInterface $em): Response
    {
        $incidente = new Incidente();
        $incidente->setUsuario($this->getUser());
        $form = $this->createForm(IncidenteType::class, $incidente);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $incidenteRepository->save($incidente, true);
            // Guardar en la base de datos en la tabla CocheIncidente los coches relacionados con el incidente
            $cocheIncidenteRepository = $em->getRepository(CocheIncidente::class);

            $coches = $form->get('coches')->getData();
            foreach ($coches as $coche) {
                $cocheIncidente = new CocheIncidente();

                $cocheIncidente->setIncidente($incidente);
                $cocheIncidente->setCoche($coche);
                $cocheIncidente->setDescripcion('');

                $cocheIncidenteRepository->save($cocheIncidente, true);
            }

            return $this->redirectToRoute('app_incidente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/incidente/new.html.twig', [
            'incidente' => $incidente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_incidente_show', methods: ['GET'])]
    public function show(Incidente $incidente, CocheIncidenteRepository $cocheIncidenteRepository): Response
    {
        $cochesIncidentesRelacionados = $cocheIncidenteRepository->findCarsByIncident($incidente);
        return $this->render('admin/incidente/show.html.twig', [
            'incidente' => $incidente,
            'cochesIncidentesRelacionados' => $cochesIncidentesRelacionados,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_incidente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Incidente $incidente, IncidenteRepository $incidenteRepository): Response
    {
        $form = $this->createForm(IncidenteType::class, $incidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $incidenteRepository->save($incidente, true);

            return $this->redirectToRoute('app_incidente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/incidente/edit.html.twig', [
            'incidente' => $incidente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_incidente_delete', methods: ['POST'])]
    public function delete(Request $request, Incidente $incidente, IncidenteRepository $incidenteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $incidente->getId(), $request->request->get('_token'))) {
            $incidenteRepository->remove($incidente, true);
        }

        return $this->redirectToRoute('app_incidente_index', [], Response::HTTP_SEE_OTHER);
    }
}
