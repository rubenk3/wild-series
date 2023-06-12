<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}