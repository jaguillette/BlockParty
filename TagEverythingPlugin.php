<?php
/**
 * @package TagEverything
 */

class TagEverythingPlugin extends Omeka_Plugin_AbstractPlugin
{
	protected $_hooks = array(
		'install',
		'uninstall',
		'initialize',
		'define_routes'
	);

	/**
	 * @var array Filters for the plugin.
	 */
	/*protected $_filters = array(
		'admin_navigation_main',
		'public_navigation_main'
	);*/

	public function hookInstall($args)
	{
		$db=$this->_db;
		$sql = "
		CREATE TABLE IF NOT EXISTS `$db->TagEverythingTagPage` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`slug` tinytext COLLATE utf8_unicode_ci NOT NULL,
			`tags` mediumtext COLLATE utf8_unicode_ci NOT NULL,
			`is_published` tinyint(1) NOT NULL,
			`title` tinytext COLLATE utf8_unicode_ci NOT NULL,
			`order` tinytext COLLATE utf8_unicode_ci NOT NULL,
			`exhibits_title` tinytext COLLATE utf8_unicode_ci,
			`collections_title` tinytext COLLATE utf8_unicode_ci,
			`items_title` tinytext COLLATE utf8_unicode_ci,
			`exhibits_description` mediumtext COLLATE utf8_unicode_ci,
			`collections_description` mediumtext COLLATE utf8_unicode_ci,
			`items_description` mediumtext COLLATE utf8_unicode_ci,
			`exhibits_images` tinyint(1) NOT NULL,
			`collections_images` tinyint(1) NOT NULL,
			`items_images` tinyint(1) NOT NULL,
			`exhibits_max` int(10) unsigned NOT NULL,
			`collections_max` int(10) unsigned NOT NULL,
			`items_max` int(10) unsigned NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
		$db->query($sql);

		//$this->installOptions();
	}

	public function hookUninstall($args)
	{
		// Drop the table
		$db = $this->_db;
		$sql = "DROP TABLE IF EXISTS `$db->TagEverythingTagPage`";
		$db->query($sql);

		//$this->_uninstallOptions();
	}

	public function hookInitialize($args)
	{
		// Any initializing functions
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

		// Add routes for each tag everything page
		$pages = get_db()->getTable('TagEverythingTagPage')->findAll();
		foreach ($pages as $page) {
			$router->addRoute(
				'tagEverythingTagGroup' . $page->id,
				new Zend_Controller_Router_Route(
					'tag-page/' . $page->slug,
					array(
						'module'     => 'tag-everything',
						'controller' => 'tag-page',
						'action'     => 'show',
						'id'         => $page->id
					)
				)
			);
		}
	}
}
?>
