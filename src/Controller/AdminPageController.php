<?php
// src/Controller/FrontPageController.php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminPageController extends AbstractController {
    #[Route('/admin', name: 'admin_page')]
    public function indexAction(EntityManagerInterface $entityManager) {
        return $this->render('admin/index.html.twig');
    }
}