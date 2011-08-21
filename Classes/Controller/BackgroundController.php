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
			$pageRenderer->addCssFile($this->getRelativePath($this->settings['css']['supersized']));

				// Add supersized JS
			$pageRenderer->addJsFooterFile($this->getRelativePath($this->settings['js']['supersized']), 'text/javascript', TRUE, TRUE);
		}

		$this->view->assign('backgroundImages', $this->searchBackgroundImage());

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
		$resources = $this->resourceRepository->searchInRootline($GLOBALS['TSFE']->id);

		if ($resources == FALSE || !($resources->current() instanceof Tx_Supersized_Domain_Model_Resource)) {
			// Set default page ressource
			$resources = array(
				array(
					'title' => $this->settings['default']['title'],
					'resource' => $this->settings['default']['resource']
				)
			);
		}

		return $resources;
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
