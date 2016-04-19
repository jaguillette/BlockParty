<?php
/**
 * Tag Everything
 *
 * @copyright Copyright 2016 Jeremy Guillette
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * The Tag Everything page controller class.
 *
 * @package TagEverything
 */
class TagEverything_TaggedController extends Omeka_Controller_AbstractActionController
{
    public function showAction()
    {
        // Get the page object from the passed ID.
        //$pageId = $this->_getParam('id');
        //$page = $this->_helper->db->getTable('SimplePagesPage')->find($pageId);
        
        // Restrict access to the page when it is not published.
        //if (!$page->is_published 
        //    && !$this->_helper->acl->isAllowed('show-unpublished')) {
        //    throw new Omeka_Controller_Exception_403;
        //}

        $route = $this->getFrontController()->getRouter()->getCurrentRouteName();
        //$isHomePage = ($route == Omeka_Application_Resource_Router::HOMEPAGE_ROUTE_NAME);

        // Set the tagged object to the view.
        //$this->view->tag_everything_tagged = $tagged;
        //$this->view->is_home_page = $isHomePage;
    }
}
