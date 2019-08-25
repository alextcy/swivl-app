<?php

namespace SwivlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SwivlBundle:Default:index.html.twig');
    }
}
