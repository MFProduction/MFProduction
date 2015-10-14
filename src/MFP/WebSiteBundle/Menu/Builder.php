<?php 

namespace MFP\WebSiteBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->addChild('Blog', array('route' => 'mfp_web_site_homepage'));
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
       
       	return $menu;
    }

    public function rightMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $securityContext = $this->container->get('security.context');
		$user = $this->container->get('security.context')->getToken()->getUser();
		if ($securityContext->isGranted('ROLE_ADMIN')) {

		   	$user->getusername();
		   	$menu->addChild('Posts', array('route' => 'admin_post'));
		   	$menu->addChild('Users', array('route' => 'admin_user'));
        	$menu->addChild('Category', array('route' => 'admin_category'));
        	//$menu->addChild('Login as: '.$user);
			//$menu['Login as: 	'.$user]->setLabelAttribute('class', 'no-link-span');
        	$menu->addChild('Logout', array('route' => 'logout'));
        }
        elseif ($securityContext->isGranted('ROLE_USER')) {
        	$menu->addChild('Blog-posts', array('route' => 'admin_post'));
        	//$menu->addChild('Login as: '.$user->getusername());
        	//$menu['Login as: '.$user->getusername()]->setLabelAttribute('class', 'no-link-span');
        	$menu->addChild('Logout', array('route' => 'logout'));	
        }
        
        else 
        {

			$menu->addChild('Login', array('route' => 'login'));        	
        }		
       
        return $menu;
    }
}