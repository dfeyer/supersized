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

		/** @var $pageRenderer t3lib_PageRenderer */
		$pageRenderer = $GLOBALS['TSFE']->getPageRenderer();

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

		$this->view->assign('library', $this->settings['library']);

			// Include jQuery library
		if ($this->settings['include']['jquery'] == TRUE) {
			if ($this->settings['include']['jquery'] == 2) {
					// Include from Google CDN
				$pageRenderer->addJsFile($this->settings['js']['jquerycdn']);
			} else {
					// Include local library
				$pageRenderer->addJsFile($this->getRelativePath($this->settings['js']['jquery']));
			}
		}

			// Include Supersized library
		if ($this->settings['include']['supersized'] == TRUE) {
				// Add supersized CSS
			$pageRenderer->addCssFile($this->getRelativePath($this->settings['css']['supersized'][$this->settings['library']]));
				// Add supersized JS
			$pageRenderer->addJsFooterFile($this->getRelativePath($this->settings['js']['supersized'][$this->settings['library']]), 'text/javascript', TRUE, TRUE);
		}

		$backgroundImages = $this->searchBackgroundImage();

		$this->view->assign('backgroundImages', $backgroundImages);

		if (count($backgroundImages) > 1) {
			$configuration = $this->settings['supersized'][$this->settings['library']];
		} else {
			$configuration = array();
		}

		$this->view->assign('configuration', $configuration);


		// Include Supersized configuration
		$configuration = $this->view->render();

		$pageRenderer->addJsFooterInlineCode('supersized', $configuration);

		return FALSE;
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
			$this->setDefaultPageBackground();
		}

		return $resources;
	}

	/**
	 * @return void
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
	protected function setDefaultPageBackground() {
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
