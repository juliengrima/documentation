<?php

namespace App\Controller;

use App\Entity\Documentation;
use App\Form\DocumentationType;
use App\Repository\DocumentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/documentation')]
class DocumentationController extends AbstractController
{
    #[Route('/', name: 'documentation_index', methods: ['GET'])]
    public function index(DocumentationRepository $documentationRepository): Response
    {
        return $this->render('documentation/index.html.twig', [
            'documentations' => $documentationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'documentation_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $documentation = new Documentation();
        $form = $this->createForm(DocumentationType::class, $documentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($documentation);
            $entityManager->flush();

            return $this->redirectToRoute('documentation_index');
        }

        return $this->render('documentation/new.html.twig', [
            'documentation' => $documentation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'documentation_show', methods: ['GET'])]
    public function show(Documentation $documentation): Response
    {
        return $this->render('documentation/show.html.twig', [
            'documentation' => $documentation,
        ]);
    }

    #[Route('/{id}/edit', name: 'documentation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Documentation $documentation): Response
    {
        $form = $this->createForm(DocumentationType::class, $documentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('documentation_index');
        }

        return $this->render('documentation/edit.html.twig', [
            'documentation' => $documentation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'documentation_delete', methods: ['POST'])]
    public function delete(Request $request, Documentation $documentation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documentation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($documentation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('documentation_index');
    }
}
