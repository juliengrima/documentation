<?php

namespace App\Controller;

use App\Entity\Documentation;
use App\Entity\Customers;
use App\Form\DocumentationType;
use App\Repository\DocumentationRepository;
//use ContainerFz0xDxJ\getMaker_AutoCommand_MakeUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/documentation')]
class DocumentationController extends AbstractController
{

    #[Route('/{custid}/new', name: 'documentation_new', methods: ['POST', 'GET'])]
    public function new(Request $request, $custid): Response
    {
        $documentation = new Documentation();
        $form = $this->createForm(DocumentationType::class, $documentation);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $customerId = $em->getRepository('App:Customers')->findOneBy(array('id' => $custid));
        $customers = $em->getRepository('App:Customers')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $documentation->setCustomersId($customerId);
            $entityManager->persist($documentation);
            $entityManager->flush();

            return $this->redirectToRoute('documentation_edit', [
                'id' => $documentation,
                'customers' => $customers
            ]);
        }

        return $this->render('documentation/new.html.twig', [
            'documentation' => $documentation,
            'customers' => $customers,
            'customerid' => $customerId,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'documentation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Documentation $documentation): Response
    {
            $form = $this->createForm(DocumentationType::class, $documentation);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $customers = $em->getRepository('App:Customers')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('documentation_edit', [
                'id' => $documentation,
                'customers' => $customers
            ]);
        }

        return $this->render('documentation/edit.html.twig', [
            'documentation' => $documentation,
            'customers' => $customers,
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

        return $this->redirectToRoute('customers_index');
    }

    #[Route('/{id}/try', name: 'documentation_try', methods: ['GET', 'POST'])]
    public function try($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $customerId = $em->getRepository('App:Documentation')->findOneBy(array('customers_id' => $id));
        $documentation = $em->getRepository('App:Documentation')->findOneBy(array('id' => $customerId));
        if (isset($customerId)) {
            return $this->redirectToRoute('documentation_edit', [
                'id' => $documentation
            ]);
        } else {
            return $this->redirectToRoute('documentation_new', [
                'custid' => $id
            ]);
        }
    }
}
