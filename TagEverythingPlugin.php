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
		'admin_head',
	);

	/**
	 * @var array Filters for the plugin.
	 */
	protected $_filters = array(
		'exhibit_layouts'
	);

	public function hookInstall($args)
	{
		// Any install functions
	}

	public function hookUninstall($args)
	{
		// Any uninstall functions
	}

	public function hookInitialize($args)
	{
		// Any initializing functions
	}

	public function hookAdminHead() {
		queue_css_file('tag-everything-admin','all');
	}

	public function filterExhibitLayouts($layouts)
	{
		$layouts['item-group'] = array(
			'name' => 'Item Group',
			'description' => 'Display a group of items from search parameters.'
		);
		return $layouts;
	}
}
?>
