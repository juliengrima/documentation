<?php

namespace App\Controller;

use App\Entity\Prices;
use App\Form\PricesType;
use App\Form\PricesTypeNew;
use App\Repository\PricesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/prices')]
class PricesController extends AbstractController
{
    #[Route('/', name: 'prices_index', methods: ['GET'])]
    public function index(PricesRepository $pricesRepository): Response
    {
        return $this->render('prices/index.html.twig', [
            'prices' => $pricesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'prices_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $price = new Prices();
        $form = $this->createForm(PricesType::class, $price);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $pricesList = $em->getRepository('App:Prices')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($price);
            $entityManager->flush();

            return $this->redirectToRoute('prices_edit', [
                'id' => $price->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prices/new.html.twig', [
            'price' => $price,
            'listnames' => $pricesList,
            'form' => $form->createView(),
        ]);
    }

//    #[Route('/{id}', name: 'prices_show', methods: ['GET'])]
//    public function show(Prices $price): Response
//    {
//        return $this->render('prices/show.html.twig', [
//            'price' => $price,
//        ]);
//    }

    #[Route('/{id}/edit', name: 'prices_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prices $price, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PricesType::class, $price);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $pricesList = $em->getRepository('App:Prices')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('prices_edit', [
                'id' => $price->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prices/edit.html.twig', [
            'price' => $price,
            'listnames' => $pricesList,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'prices_delete', methods: ['POST'])]
    public function delete(Request $request, Prices $price, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$price->getId(), $request->request->get('_token'))) {
            $entityManager->remove($price);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prices_index', [], Response::HTTP_SEE_OTHER);
    }
}
