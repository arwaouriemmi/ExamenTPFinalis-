<?php

namespace App\Controller;

use App\Entity\Pfe;
use App\Form\PfeType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExamController extends AbstractController
{
    #[Route('/exam/add', name: 'add')]
    public function index(EntityManagerInterface $doctrine, Request $request): Response {
        $pfe = new Pfe();
        $form = $this->createForm(PfeType::class, $pfe);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $doctrine->persist($pfe);
            $doctrine->flush();
            return $this->render('exam/pfedetail.html.twig',['pfe' => $pfe]);
        } else {
            return $this->render('exam/index.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }
    #[Route('/exam/stats', name: 'nb')]
    public function afficher(ManagerRegistry $doctrine, Request $request): Response {
        $repo = $doctrine->getRepository(Pfe::class);
        $PfeparEntreprise = $repo->compteurPfe();

        return $this->render('exam/NbpfeParEntreprise.html.twig', [
            'PfeparEntreprise' => $PfeparEntreprise
        ]);
    }
}
