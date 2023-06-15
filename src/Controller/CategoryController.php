<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category_index')]
    public function index(CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->findAll();
        return $this->render('category/index.html.twig',['category' => $category,]);
    }

    #[Route('/category/{categoryName}', name: 'category_show')]
    public function show(int $id, categoryRepository $categoryRepository)
    {
        $category = $categoryRepository->findOneBy(['id' => $id]);


        if (!$category) {
            throw $this->createNotFoundException(
                'No category with id : ' . $id . ' found in category\'s table.'
            );
        }
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
        
    }

    #[Route('/new', name: 'new')]

    public function new(Request $request, CategoryRepository $categoryRepository): Response

    {

        $category = new Category();


        $form = $this->createForm(CategoryType::class, $category);
        
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $categoryRepository->save($category, true);            

            return $this->redirectToRoute('category_index');

        }
        
        return $this->render('category/new.html.twig', [

            'form' => $form,

        ]);

    }
}