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
class TagEverythingTagPage extends Omeka_Record_AbstractRecord
{
	public $slug;
	public $tags;
	public $is_published;
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
}
?>
