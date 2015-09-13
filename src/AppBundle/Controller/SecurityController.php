<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="admin.security.login")
     * @Template()
     * @return array
     */
    public function loginAction()
    {
        $categories = $this->get('app.repository.category')->findAll();

        $authenticationUtils = $this->get('security.authentication_utils');

        return [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
            'categories'    => $categories
        ];
    }
}