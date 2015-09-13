<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subcategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/photo")
 */
class PhotoController extends Controller
{
    /**
     * @Route("/show/{id}", name="app.photo.show")
     * @Template()
     * @param Subcategory $subcategory
     * @return array
     */
    public function showAction(Subcategory $subcategory)
    {
        $categories = $this->get('app.repository.category')->findAll();

        return [
            'categories'  => $categories,
            'subcategory' => $subcategory
        ];
    }
}