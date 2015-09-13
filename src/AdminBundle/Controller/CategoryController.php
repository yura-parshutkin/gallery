<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Category;
use AdminBundle\Form\CategoryType;

/**
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="admin.category.index")
     * @Method("GET")
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        $categories = $this->get('app.repository.category')->findAll();

        return [
            'categories' => $categories,
        ];
    }

    /**
     * @Route("/create", name="admin.category.create")
     * @Method("POST")
     * @Template("AdminBundle:Category:new.html.twig")
     * @param Request $request
     * @return array
     */
    public function createAction(Request $request)
    {
        $category = new Category();
        $form = $this->createCreateForm($category);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirect($this->generateUrl('admin.category.index'));
        }

        return [
            'category' => $category,
            'form'     => $form->createView(),
        ];
    }

    /**
     * @Route("/new", name="admin.category.new")
     * @Method("GET")
     * @Template()
     * @return array
     */
    public function newAction()
    {
        $category = new Category();
        $form = $this->createCreateForm($category);

        return [
            'category' => $category,
            'form'     => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}/edit", name="admin.category.edit")
     * @Method("GET")
     * @Template()
     * @param Category $category
     * @return array
     */
    public function editAction(Category $category)
    {
        $form = $this->createEditForm($category);

        return [
            'category' => $category,
            'form'     => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}", name="admin.category.update")
     * @Method("PUT")
     * @Template("AdminBundle:Category:edit.html.twig")
     * @param Request $request
     * @param Category $category
     * @return array
     */
    public function updateAction(Request $request, Category $category)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createEditForm($category);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin.category.index'));
        }

        return [
            'category' => $category,
            'form'     => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}/delete", name="admin.category.delete")
     * @param Category $category
     * @return array
     */
    public function deleteAction(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirect($this->generateUrl('admin.category.index'));
    }

    /**
     * @param Category $category
     * @Template("AdminBundle:Category:edit.html.twig")
     * @return \Symfony\Component\Form\Form
     */
    private function createEditForm(Category $category)
    {
        $form = $this->createForm(new CategoryType(), $category, [
            'action' => $this->generateUrl('admin.category.update', ['id' => $category->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }

    /**
     * @param Category $category The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Category $category)
    {
        $form = $this->createForm(new CategoryType(), $category, [
            'action' => $this->generateUrl('admin.category.create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'Create']);

        return $form;
    }
}