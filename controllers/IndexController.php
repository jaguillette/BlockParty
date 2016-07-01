<?php
/**
 * Tag Everything
 *
 * @copyright Copyright 2016 Jeremy Guillette
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * The Tag Everything index controller class.
 *
 * @package TagEverything
 */
class TagEverything_IndexController extends Omeka_Controller_AbstractActionController
{
	public function init()
	{
		// Set the model class so this controller can perform some functions, 
		// such as $this->findById()
		$this->_helper->db->setDefaultModelName('TagEverythingTagPage');
	}
	
	public function indexAction()
	{
		// Always go to browse.
		//$this->_helper->redirector('browse');
		return;
	}

	public function addAction()
	{
		$page = new TagEverythingTagPage;

		$form = $this->_getForm($page);
		$this->view->form = $form;
		$this->_processPageForm($page, $form, 'add');
	}
	
	public function editAction()
	{
		// Get the requested page.
		$page = $this->_helper->db->findById();
		$form = $this->_getForm($page);
		$this->view->form = $form;
		$this->_processPageForm($page, $form, 'edit');
	}

	protected function _getForm($page=null)
	{
		$formOptions = array('type' => 'tag_everything_tag_page', 'hasPublicPage' => true);
		if ($page && $page->exists()) {
			$formOptions['record'] = $page;
		}

		$form = new Omeka_Form_Admin($formOptions);
		$form->addElementToEditGroup(
			'text', 'title',
			array(
				'id' => 'tag-page-title',
				'value' => $page->title,
				'label' => __('Title'),
				'description' => __('Name for the tag page (required)'),
				'required' => true
			)
		);

		$form->addElementToEditGroup(
			'text', 'slug',
			array(
				'id' => 'tag-page-slug',
				'value' => $page->slug,
				'label' => __('Slug'),
				'description' => __(
					'The slug is the part of the URL for this page. A slug '
					. 'will be created automatically from the title if one is '
					. 'not entered. Letters, numbers, underscores, dashes, and '
					. 'forward slashes are allowed.')
			)
		);

		$form->addElementToEditGroup(
			'text', 'tags',
			array(
				'id' => 'tag-page-tags',
				'value' => $page->tags,
				'label' => __('Tags'),
				'description' => __(
					'The tags this page will include.'
					. ' Separate multiple tags with commas')
			)
		);

		$form->addElementToEditGroup(
			'checkbox', 'use_tiny_mce',
			array(
				'id' => 'tag-page-use_tiny_mce',
				'value' => $page->use_tiny_mce,
				'label' => __('Use HTML Editor?'),
				'description' => __('Add an HTML editor to description fields.')
			)
		);

		$form->addElementToEditGroup(
			'text', 'display_order',
			array(
				'id' => 'tag-page-display_order',
				'value' => $page->display_order,
				'label' => __('Display order'),
				'description' => __(
					'The order that content types will be displayed in.'
					. 'Available types are exhibits, collections, and items.'
					. 'Input the types that you would like to include in the '
					. 'order you want to include them.')
			)
		);

		$form->addElementToEditGroup(
			'text', 'exhibits_title',
			array(
				'id' => 'tag-page-exhibits_title',
				'value' => $page->exhibits_title,
				'label' => __('Exhibits Section Title'),
				'description' => __(
					'The title for the exhibits section')
			)
		);

		$form->addElementToEditGroup(
			'textarea', 'exhibits_description',
			array(
				'id' => 'tag-page-exhibits_description',
				'class' => 'tag-pages-text',
				'value' => $page->exhibits_description,
				'label' => __('Exhibits Section Description'),
				'description' => __(
					'The description for the exhibits section')
			)
		);

		$form->addElementToEditGroup(
			'checkbox', 'exhibits_images',
			array(
				'id' => 'tag-page-exhibits_images',
				'value' => $page->exhibits_images,
				'label' => __('Display Exhibit Images'),
				'description' => __(
					'Check this box to display a preview image for each exhibit.')
			)
		);

		$form->addElementToEditGroup(
			'text', 'exhibits_max',
			array(
				'id' => 'tag-page-exhibits_max',
				'value' => $page->exhibits_max,
				'label' => __('Maximum Displayed Exhibits'),
				'description' => __(
					'Enter the maximum number of exhibits to be displayed on this page. '
					. 'If more than this number of exhibits are included under these tags, '
					. 'a random selection of the exhibits will be displayed.')
			)
		);

		$form->addElementToEditGroup(
			'text', 'collections_title',
			array(
				'id' => 'tag-page-collections_title',
				'value' => $page->collections_title,
				'label' => __('Collections Section Title'),
				'description' => __(
					'The title for the collections section')
			)
		);

		$form->addElementToEditGroup(
			'textarea', 'collections_description',
			array(
				'id' => 'tag-page-collections_description',
				'value' => $page->collections_description,
				'label' => __('Collections Section Description'),
				'description' => __(
					'The description for the collections section')
			)
		);

		$form->addElementToEditGroup(
			'checkbox', 'collections_images',
			array(
				'id' => 'tag-page-collections_images',
				'value' => $page->collections_images,
				'label' => __('Display Collection Images'),
				'description' => __(
					'Check this box to display a preview image for each collection.')
			)
		);

		$form->addElementToEditGroup(
			'text', 'collections_max',
			array(
				'id' => 'tag-page-collections_max',
				'value' => $page->collections_max,
				'label' => __('Maximum Displayed Collections'),
				'description' => __(
					'Enter the maximum number of collections to be displayed on this page. '
					. 'If more than this number of collections are included under these tags, '
					. 'a random selection of the collections will be displayed.')
			)
		);

		$form->addElementToEditGroup(
			'text', 'items_title',
			array(
				'id' => 'tag-page-items_title',
				'value' => $page->items_title,
				'label' => __('Items Section Title'),
				'description' => __(
					'The title for the items section')
			)
		);

		$form->addElementToEditGroup(
			'textarea', 'items_description',
			array(
				'id' => 'tag-page-items_description',
				'value' => $page->items_description,
				'label' => __('Items Section Description'),
				'description' => __(
					'The description for the items section')
			)
		);

		$form->addElementToEditGroup(
			'checkbox', 'items_images',
			array(
				'id' => 'tag-page-items_images',
				'value' => $page->items_images,
				'label' => __('Display Item Images'),
				'description' => __(
					'Check this box to display a preview image for each item.')
			)
		);

		$form->addElementToEditGroup(
			'text', 'items_max',
			array(
				'id' => 'tag-page-items_max',
				'value' => $page->items_max,
				'label' => __('Maximum Displayed Items'),
				'description' => __(
					'Enter the maximum number of items to be displayed on this page. '
					. 'If more than this number of items are included under these tags, '
					. 'a random selection of the items will be displayed.')
			)
		);
		
		$form->addElementToSaveGroup(
			'checkbox', 'is_published',
			array(
				'id' => 'tag_page_is_published',
				'values' => array(1, 0),
				'checked' => $page->is_published,
				'label' => __('Publish this page?'),
				'description' => __('Checking this box will make the page public')
			)
		);

		return $form;
	}
	
	/**
	 * Process the page edit and edit forms.
	 */
	private function _processPageForm($page, $form, $action)
	{
		// Set the page object to the view.
		$this->view->tag_everything_tag_page = $page;

		if ($this->getRequest()->isPost()) {
			if (!$form->isValid($_POST)) {
				$this->_helper->_flashMessenger(__('There was an error on the form. Please try again.'), 'error');
				return;
			}
			try {
				$page->setPostData($_POST);
				if ($page->save()) {
					if ('add' == $action) {
						$this->_helper->flashMessenger(__('The page "%s" has been added.', $page->title), 'success');
					} else if ('edit' == $action) {
						$this->_helper->flashMessenger(__('The page "%s" has been edited.', $page->title), 'success');
					}
					
					$this->_helper->redirector('browse');
					return;
				}
			// Catch validation errors.
			} catch (Omeka_Validate_Exception $e) {
				$this->_helper->flashMessenger($e);
			}
		}
	}

	protected function _getDeleteSuccessMessage($record)
	{
		return __('The page "%s" has been deleted.', $record->title);
	}
}