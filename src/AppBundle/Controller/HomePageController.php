<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{
    /**
     * @Route("/", name="app.home_page.index")
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        $categories = $this->get('app.repository.category')->findAll();
        $photos     = $this->get('app.repository.photo')->findAll();

        return [
            'categories'  => $categories,
            'photos'      => $photos
        ];
    }
}