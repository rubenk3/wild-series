<?php

namespace App\Controller;

use App\Entity\Program;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
  #[Route('/program/{id}/', name: 'program_show')]
  public function show(Program $program): Response
  {

    return $this->render('program.html.twig', ['program' => $program]);
  }

  #[Route('/new', name: 'new')]
  public function new(Request $request, ProgramRepository $programRepository): Response
  {

    $program = new Program();


    $form = $this->createForm(CategoryType::class, $program);


    $form->handleRequest($request);


    if ($form->isSubmitted()) {

      $programRepository->save($program, true);

      return $this->redirectToRoute('program_index');
      
    }


    return $this->render('program/new.html.twig', [

      'form' => $form,

    ]);
  }
}
