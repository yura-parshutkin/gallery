<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainPageController extends Controller
{
    /**
     * @Route("/", name="admin.main_page.index")
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        return [];
    }
}