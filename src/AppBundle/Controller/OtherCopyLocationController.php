<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\OtherCopyLocation;
use AppBundle\Form\OtherCopyLocationType;

/**
 * OtherCopyLocation controller.
 *
 * @Route("/other_copy_location")
 */
class OtherCopyLocationController extends Controller {

    /**
     * Lists all OtherCopyLocation entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="other_copy_location_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(OtherCopyLocation::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $otherCopyLocations = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'otherCopyLocations' => $otherCopyLocations,
        );
    }

    /**
     * Search for OtherCopyLocation entities.
     *
     * @param Request $request
     *
     * @Route("/search", name="other_copy_location_search")
     * @Method("GET")
     * @Template()
     */
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:OtherCopyLocation');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $otherCopyLocations = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $otherCopyLocations = array();
        }

        return array(
            'otherCopyLocations' => $otherCopyLocations,
            'q' => $q,
        );
    }

    /**
     * Creates a new OtherCopyLocation entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="other_copy_location_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $otherCopyLocation = new OtherCopyLocation();
        $form = $this->createForm(OtherCopyLocationType::class, $otherCopyLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($otherCopyLocation);
            $em->flush();

            $this->addFlash('success', 'The new otherCopyLocation was created.');
            return $this->redirectToRoute('other_copy_location_show', array('id' => $otherCopyLocation->getId()));
        }

        return array(
            'otherCopyLocation' => $otherCopyLocation,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new OtherCopyLocation entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="other_copy_location_new_popup")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a OtherCopyLocation entity.
     *
     * @param OtherCopyLocation $otherCopyLocation
     *
     * @return array
     *
     * @Route("/{id}", name="other_copy_location_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(OtherCopyLocation $otherCopyLocation) {

        return array(
            'otherCopyLocation' => $otherCopyLocation,
        );
    }

    /**
     * Displays a form to edit an existing OtherCopyLocation entity.
     *
     *
     * @param Request $request
     * @param OtherCopyLocation $otherCopyLocation
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="other_copy_location_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, OtherCopyLocation $otherCopyLocation) {
        $editForm = $this->createForm(OtherCopyLocationType::class, $otherCopyLocation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The otherCopyLocation has been updated.');
            return $this->redirectToRoute('other_copy_location_show', array('id' => $otherCopyLocation->getId()));
        }

        return array(
            'otherCopyLocation' => $otherCopyLocation,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a OtherCopyLocation entity.
     *
     *
     * @param Request $request
     * @param OtherCopyLocation $otherCopyLocation
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="other_copy_location_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, OtherCopyLocation $otherCopyLocation) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($otherCopyLocation);
        $em->flush();
        $this->addFlash('success', 'The otherCopyLocation was deleted.');

        return $this->redirectToRoute('other_copy_location_index');
    }

}
