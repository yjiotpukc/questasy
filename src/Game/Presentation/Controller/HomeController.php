<?php

declare(strict_types=1);

namespace Game\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function home(): Response
     {
        return $this->render('home.html.twig');
    }
}
