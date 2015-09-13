<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Subcategory;
use AdminBundle\Form\SubcategoryType;

/**
 * @Route("/sub-category")
 */
class SubcategoryController extends Controller
{
    /**
     * @Route("/", name="admin.subcategory.index")
     * @Method("GET")
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        $subcategories = $this->get('app.repository.subcategory')->findAll();

        return [
            'subcategories' => $subcategories,
        ];
    }

    /**
     * @Route("/", name="admin.subcategory.create")
     * @Method("POST")
     * @Template("AdminBundle:Subcategory:new.html.twig")
     * @param Request $request
     * @return array
     */
    public function createAction(Request $request)
    {
        $subcategory = new Subcategory();
        $form = $this->createCreateForm($subcategory);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('app.repository.subcategory')->save($subcategory);

            return $this->redirect($this->generateUrl('admin.subcategory.index'));
        }

        return [
            'subcategory' => $subcategory,
            'form'        => $form->createView(),
        ];
    }

    /**
     * @Route("/new", name="admin.subcategory.new")
     * @Method("GET")
     * @Template()
     * @return array
     */
    public function newAction()
    {
        $subcategory = new Subcategory();
        $form = $this->createCreateForm($subcategory);

        return [
            'subcategory' => $subcategory,
            'form'        => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}/edit", name="admin.subcategory.edit")
     * @Method("GET")
     * @Template()
     * @param Subcategory $subcategory
     * @return array
     */
    public function editAction(Subcategory $subcategory)
    {
        $form = $this->createEditForm($subcategory);

        return [
            'subcategory' => $subcategory,
            'form'        => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}", name="admin.subcategory.update")
     * @Method("PUT")
     * @Template("AdminBundle::Subcategory:edit.html.twig")
     * @param Request $request
     * @param Subcategory $subcategory
     * @return array
     * @internal param $id
     */
    public function updateAction(Request $request, Subcategory $subcategory)
    {
        $form = $this->createEditForm($subcategory);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('app.repository.subcategory')->save($subcategory);

            return $this->redirect($this->generateUrl('admin.subcategory.index'));
        }

        return [
            'subcategory' => $subcategory,
            'form'        => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}/delete", name="admin.subcategory.delete")
     * @param Subcategory $subcategory
     * @return array
     */
    public function deleteAction(Subcategory $subcategory)
    {
        $this->get('app.repository.subcategory')->remove($subcategory);

        return $this->redirect($this->generateUrl('admin.subcategory.index'));
    }

    /**
     * @param Subcategory $subcategory
     * @return \Symfony\Component\Form\Form
     */
    private function createCreateForm(Subcategory $subcategory)
    {
        $form = $this->createForm(new SubcategoryType(), $subcategory, [
            'action' => $this->generateUrl('admin.subcategory.create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'Create']);

        return $form;
    }

    /**
     * @param Subcategory $subcategory
     *
     * @return \Symfony\Component\Form\Form
     */
    private function createEditForm(Subcategory $subcategory)
    {
        $form = $this->createForm(new SubcategoryType(), $subcategory, [
            'action' => $this->generateUrl('admin.subcategory.update', ['id' => $subcategory->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }
}