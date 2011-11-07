<?php
 /**
  * (c) 2006-2010 Dominique Feyer <dominique.feyer@reelpeek.net>
  *
  * For the full copyright and license information, please view the LICENSE
  * file that was distributed with this source code.
  */

/**
 * Resume
 *
 * This class ...
 *
 * @package    Tx_Supersized_Controller_BackgroundController
 * @author     Dominique Feyer <dominique.feyer@reelpeek.net>
 */
class Tx_Supersized_Controller_BackgroundController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var t3lib_PageRenderer
	 */
	protected $pageRenderer;

	/**
	 * @var Tx_Supersized_Domain_Repository_ResourceRepository
	 */
	protected $resourceRepository;

	/**
	 * @param Tx_Supersized_Domain_Repository_ResourceRepository $resourceRepository
 	 * @return void
	 */
	public function injectResourceRepository(Tx_Supersized_Domain_Repository_ResourceRepository $resourceRepository) {
		$this->resourceRepository = $resourceRepository;
	}

	/**
	 * Configure action for this controller.
	 *
	 * @return string The rendered view
	 */
	public function configureAction() {

		$this->pageRenderer = $GLOBALS['TSFE']->getPageRenderer();

			// Set default mode
		if (!isset($this->settings['library']) || trim($this->settings['library']) === '') {
			$this->settings['library'] = 'core';
		}

		if (!t3lib_div::inArray(array('core', 'slideshow'), $this->settings['library'])) {
			throw new InvalidArgumentException(
				'Invalid mode check your TypoScript configuration (allowed mode "core" or "slideshow")',
				1316699924
			);
		}

		$this->addJquery();

		$this->addSupersized();

		$backgroundImages = $this->searchBackgroundImage();

		$this->view->assign('backgroundImages', $backgroundImages);

		$this->prepareConfiguration($backgroundImages);

		// Include Supersized configuration
		$this->pageRenderer->addJsFooterInlineCode(
			'supersized-' . $this->settings['library'],
			$this->view->render()
		);

		return FALSE;
	}

	/**
	 * @param $backgroundImages
	 * @return void
	 */
	protected function prepareConfiguration($backgroundImages) {
		if (count($backgroundImages) > 1) {
			$configuration = $this->settings['supersized'][$this->settings['library']];
		} else {
			$configuration = array();
			$this->settings['library'] = 'core';
		}

		$this->view->assign('library', $this->settings['library']);
		$this->view->assign('configuration', $configuration);
	}

	/**
	 * @return void
	 */
	protected function addSupersized() {
			// Include Supersized library
		if ($this->settings['include']['supersized'] == TRUE) {
				// Add supersized CSS
			$this->pageRenderer->addCssFile($this->getRelativePath($this->settings['css']['supersized'][$this->settings['library']]));
				// Add supersized JS
			$this->pageRenderer->addJsFooterFile($this->getRelativePath($this->settings['js']['supersized'][$this->settings['library']]), 'text/javascript', TRUE, TRUE);
		}
	}

	/**
	 * @return void
	 */
	protected function addJquery() {
			// Include jQuery library
		if ($this->settings['include']['jquery'] == TRUE) {
			if ($this->settings['include']['jquery'] == 2) {
					// Include from Google CDN
				$this->pageRenderer->addJsFile($this->settings['js']['jquerycdn']);
			} else {
					// Include local library
				$this->pageRenderer->addJsFile($this->getRelativePath($this->settings['js']['jquery']));
			}
		}
	}

	/**
	 * Search for background image in the current rootline
	 *
	 * @return array|Tx_Extbase_Persistence_ObjectStorage
	 */
	protected function searchBackgroundImage() {
		$resources = FALSE;

		if (isset($this->settings['mode']) && $this->settings['mode'] == 'directory' && trim($this->settings['directory']) !== '') {
			// Get background image from a directory
			$resources = $this->searchBackgroundImageInDirectory();
		}

		if (!isset($this->settings['mode']) || $this->settings['mode'] == 'rootline') {
			// Get background image from a rootline
			$resources = $this->searchBackgroundImageInRootline();

		}

		if ($resources == FALSE || !($resources instanceof Tx_Extbase_Persistence_ObjectStorage && $resources->current() instanceof Tx_Supersized_Domain_Model_Resource)) {
			$this->setDefaultBackgroundImage();
		}

		return $resources;
	}

	/**
	 * @return array
	 */
	protected function searchBackgroundImageInDirectory() {
		$resources = array();

		$directory = PATH_site . $this->settings['directory'];

		$iterator = new DirectoryIterator($directory);
		foreach ($iterator as $fileinfo) {
			if ($fileinfo->isFile()) {
				$resources[$fileinfo->getMTime()] = array(
					'title' => '--',
					'resource' => $this->settings['directory'] . $fileinfo->getFilename()
				);
			}
		}

		return $resources;
	}

	/**
	 * @return array
	 */
	protected function searchBackgroundImageInRootline() {
		$resources = $this->resourceRepository->searchInRootline($GLOBALS['TSFE']->id);

		return $resources;
	}

	/**
	 * @return void
	 */
	protected function setDefaultBackgroundImage() {
		// Set default page ressource
		$resources = array(
			array(
				'title' => $this->settings['default']['title'],
				'resource' => $this->settings['default']['resource']
			)
		);
	}

	/**
	 * Return the relative path of the given filename
	 *
	 * @param string $filename
	 * @return mixed
	 */
	protected function getRelativePath($filename) {
		return str_replace('EXT:', t3lib_extMgm::siteRelPath('supersized'), $filename);
	}
}
