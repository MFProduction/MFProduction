<?php

namespace MFP\WebSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$posts = $em->getRepository('MFPWebSiteBundle:Post')->findAll();
        
        return $this->render('MFPWebSiteBundle:Default:index.html.twig', array(
        		'posts'=>$posts
        	));
    }

    public function displayAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$post = $em->getRepository('MFPWebSiteBundle:Post')->find($id);
        
        return $this->render('MFPWebSiteBundle:Default:display.html.twig', array(
        		'post'=>$post
        	));
    }
}
