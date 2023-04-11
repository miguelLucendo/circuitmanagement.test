<?php
// src/Controller/FrontPageController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class FrontPageController extends AbstractController
{
   #[Route('/', name: 'front_page')]
    public function frontPage(): Response
    {
        // this looks exactly the same
        $number = random_int(0, 100);

        return $this->render('base.html.twig', [
            'number' => $number,
        ]);
        // return new Response(
        //     '<html><body>Lucky number: '.$number.'</body></html>'
        // );
    }
}