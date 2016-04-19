<?php
/**
 * @package TagEverything
 */

class TagEverythingPlugin extends Omeka_Plugin_AbstractPlugin
{
	protected $_hooks = array('initialize','install','define_routes');

	public function hookInstall($args)
	{
		//some stuff
	}

	public function hookInitialize($args)
	{
		//probably important
	}

	/**
	 * Add the routes for accessing tagged groups of records.
	 * 
	 * @param Zend_Controller_Router_Rewrite $router
	 */
	public function hookDefineRoutes($args)
	{

		// Don't add to admin to avoid conflicts
		if (is_admin_theme()) {
			return;
		}

		$router = $args['router'];

		// Add routes
		$router->addRoute(
			'tagEverythingTagGroup',
			new Zend_Controller_Router_Route(
				'hodor',
				array(
					'module'     => 'tag-everything',
					'controller' => 'tagged',
					'action'     => 'show',
				)
			)
		);
	}
}
?>
