<?php

namespace RefugeeBundle\Controller;

use RefugeeBundle\Entity\camp;
use RefugeeBundle\Form\campType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class campController extends Controller
{
    public function ajoutCampAction(Request $request)
    {
        $camp = new camp();
        $form = $this->createForm(campType::class, $camp);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();




        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($camp);
            $em->flush();
            return $this->redirectToRoute("refugee_ajoutCamp");
        }
        $camp = $em->getRepository("RefugeeBundle:camp")->findAll();


        return $this->render("@Refugee/Refugie/ajoutC.html.twig", array('form' => $form->createView(), 'camp' => $camp));
    }

    public function afficherCampAction()
    {
        $em = $this->getDoctrine()->getManager();
        $camp = $em->getRepository("RefugeeBundle:camp")->findAll();
        return $this->render("@Refugee/Refugie/ajouterC.html.twig", array('camp' => $camp));
    }

    public function  modifierCampAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $refugie = $em->getRepository("RefugeeBundle:refugie")->find($id);
        $form = $this->createForm(refugieType::class, $refugie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($refugie);
            $em->flush();
            return $this->redirectToRoute("refugee_afficherRefugee");
        }
        return $this->render("@Refugee/Refugie/modifierR.html.twig", array('form' => $form->createView()));
    }

    public function supprimerCAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $camp = $em->getRepository("RefugeeBundle:camp")->find($id);
        if ($camp == null) return -1;
        else
        {
            $em->remove($camp);
            $em->flush();
            return $this->redirectToRoute("refugee_ajoutCamp");
        }
    }


}
