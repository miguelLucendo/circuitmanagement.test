<?php
// src/Controller/FrontPageController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminPageController extends AbstractController {
    #[Route('/admin', name: 'admin_page')]
    public function indexAction() {
        return $this->render('admin/index.html.twig');
    }
}