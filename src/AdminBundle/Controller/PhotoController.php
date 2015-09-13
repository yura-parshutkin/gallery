<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Photo;
use AdminBundle\Form\PhotoType;

/**
 * @Route("/photo")
 */
class PhotoController extends Controller
{
    /**
     * @Route("/", name="admin.photo.index")
     * @Method("GET")
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        $photos = $this->get('app.repository.photo')->findAll();

        return [
            'photos' => $photos,
        ];
    }

    /**
     * @Route("/", name="admin.photo.create")
     * @Method("POST")
     * @Template("AdminBundle:Photo:new.html.twig")
     * @param Request $request
     * @return array
     */
    public function createAction(Request $request)
    {
        $photo = new Photo();
        $form = $this->createCreateForm($photo);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('app.repository.photo')->save($photo);
            return $this->redirect($this->generateUrl('admin.photo.index'));
        }

        return [
            'photo' => $photo,
            'form'  => $form->createView(),
        ];
    }

    /**
     * @Route("/new", name="admin.photo.new")
     * @Method("GET")
     * @Template()
     * @return array
     */
    public function newAction()
    {
        $photo = new Photo();
        $form = $this->createCreateForm($photo);

        return [
            'photo' => $photo,
            'form'  => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}/edit", name="admin.photo.edit")
     * @Method("GET")
     * @Template()
     * @param Photo $photo
     * @return array
     * @internal param Photo $id
     */
    public function editAction(Photo $photo)
    {
        $form = $this->createEditForm($photo);

        return [
            'photo' => $photo,
            'form'  => $form->createView(),
        ];
    }


    /**
     * @Route("/{id}", name="admin.photo.update")
     * @Method("PUT")
     * @Template("AdminBundle:Photo:edit.html.twig")
     * @param Request $request
     * @param Photo $photo
     * @return array
     */
    public function updateAction(Request $request, Photo $photo)
    {
        $form = $this->createEditForm($photo);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('app.repository.photo')->save($photo);

            return $this->redirect($this->generateUrl('admin.photo.index'));
        }

        return [
            'photo' => $photo,
            'edit'  => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}/delete", name="admin.photo.delete")
     * @param Photo $photo
     * @return array
     */
    public function deleteAction(Photo $photo)
    {
        $this->get('app.repository.photo')->remove($photo);

        return $this->redirect($this->generateUrl('admin.photo.index'));
    }

    /**
     * @param Photo $photo The photo
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Photo $photo)
    {
        $form = $this->createForm(new PhotoType(), $photo, [
            'action' => $this->generateUrl('admin.photo.update', ['id' => $photo->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }

    /**
     * @param Photo $photo The photo
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Photo $photo)
    {
        $form = $this->createForm(new PhotoType(), $photo, [
            'action' => $this->generateUrl('admin.photo.create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'Create']);

        return $form;
    }
}