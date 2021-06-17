<?php

namespace App\Controller;

use App\Entity\InternalDocuments;
use App\Form\InternalDocumentsType;
use App\Repository\InternalDocumentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/internal/documents')]
class InternalDocumentsController extends AbstractController
{
    #[Route('/', name: 'internal_documents_index', methods: ['GET'])]
    public function index(InternalDocumentsRepository $internalDocumentsRepository): Response
    {
        return $this->render('internal_documents/index.html.twig', [
            'internal_documents' => $internalDocumentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'internal_documents_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $internalDocument = new InternalDocuments();
        $form = $this->createForm(InternalDocumentsType::class, $internalDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($internalDocument);
            $entityManager->flush();

            return $this->redirectToRoute('internal_documents_index');
        }

        return $this->render('internal_documents/new.html.twig', [
            'internal_document' => $internalDocument,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'internal_documents_show', methods: ['GET'])]
    public function show(InternalDocuments $internalDocument): Response
    {
        return $this->render('internal_documents/show.html.twig', [
            'internal_document' => $internalDocument,
        ]);
    }

    #[Route('/{id}/edit', name: 'internal_documents_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InternalDocuments $internalDocument): Response
    {
        $form = $this->createForm(InternalDocumentsType::class, $internalDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('internal_documents_index');
        }

        return $this->render('internal_documents/edit.html.twig', [
            'internal_document' => $internalDocument,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'internal_documents_delete', methods: ['POST'])]
    public function delete(Request $request, InternalDocuments $internalDocument): Response
    {
        if ($this->isCsrfTokenValid('delete'.$internalDocument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($internalDocument);
            $entityManager->flush();
        }

        return $this->redirectToRoute('internal_documents_index');
    }
}
