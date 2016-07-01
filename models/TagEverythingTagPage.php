<?php
/**
 * Tag Everything
 *
 * @copyright Copyright 2016 Jeremy Guillette
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * The Tag Everything Tag Page record class.
 *
 * @package TagEverything
 */
class TagEverythingTagPage extends Omeka_Record_AbstractRecord implements Zend_Acl_Resource_Interface
{
	public $slug;
	public $tags;
	public $is_published = 0;
	public $title;
	public $display_order;
	public $exhibits_title;
	public $exhibits_description;
	public $exhibits_images;
	public $exhibits_max;
	public $collections_title;
	public $collections_description;
	public $collections_images;
	public $collections_max;
	public $items_title;
	public $items_description;
	public $items_images;
	public $items_max;
	public $updated;
	
	protected function _initializeMixins()
	{
		$this->_mixins[] = new Mixin_Search($this);
		$this->_mixins[] = new Mixin_Timestamp($this, 'inserted', 'updated');
	}
	
	/**
	 * Validate the form data.
	 */
	protected function _validate()
	{        
		if (empty($this->title)) {
			$this->addError('title', __('The page must be given a title.'));
		}        
		
		if (255 < strlen($this->title)) {
			$this->addError('title', __('The title for your page must be 255 characters or less.'));
		}
		
		if (!$this->fieldIsUnique('title')) {
			$this->addError('title', __('The title is already in use by another page. Please choose another.'));
		}
		
		if (trim($this->slug) == '') {
			$this->addError('slug', __('The page must be given a valid slug.'));
		}
		
		if (preg_match('/^\/+$/', $this->slug)) {
			$this->addError('slug', __('The slug for your page must not be a forward slash.'));
		}
		
		if (255 < strlen($this->slug)) {
			$this->addError('slug', __('The slug for your page must be 255 characters or less.'));
		}
		
		if (!$this->fieldIsUnique('slug')) {
			$this->addError('slug', __('The slug is already in use by another page. Please choose another.'));
		}
	}
	
	/**
	 * Prepare special variables before saving the form.
	 */
	protected function beforeSave($args)
	{
		$this->title = trim($this->title);
		// Generate the page slug.
		$this->slug = $this->_generateSlug($this->slug);
		// If the resulting slug is empty, generate it from the page title.
		if (empty($this->slug)) {
			$this->slug = $this->_generateSlug($this->title);
		}
	}
	
	protected function afterSave($args)
	{
		if (!$this->is_published) {
			$this->setSearchTextPrivate();
		}
		$this->setSearchTextTitle($this->title);
		$this->addSearchText($this->title);
		$this->addSearchText($this->text);
	}
	
	/**
	 * Generate a slug given a seed string.
	 * 
	 * @param string
	 * @return string
	 */
	private function _generateSlug($seed)
	{
		$seed = trim($seed);
		$seed = strtolower($seed);
		// Replace spaces with dashes.
		$seed = str_replace(' ', '-', $seed);
		// Remove all but alphanumeric characters, underscores, and dashes.
		return preg_replace('/[^\w\/-]/i', '', $seed);
	}

	/**
	 * Controls how record urls are handled.
	 */
	public function getRecordUrl($action = 'show')
	{
		if ('show' == $action) {
			return public_url($this->slug);
		}
		return array('module' => 'tag-everything', 'controller' => 'index', 
					 'action' => $action, 'id' => $this->id);
	}

	public function getResourceId(){
		return 'TagEverythingTagPage';
	}
}
?>
