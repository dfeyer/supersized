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

		if ($this->settings['include']['jquery'] == TRUE) {
			if ($this->settings['include']['jquery'] === 'googleapis') {
				$this->response->addAdditionalHeaderData('<script src="' . $this->settings['js']['jquerycdn']	 . '" type="text/javascript"></script>');
			} else {
				$this->response->addAdditionalHeaderData('<script src="' . $this->getRelativePath($this->settings['js']['jquery'])	 . '" type="text/javascript"></script>');
			}
		}

		if ($this->settings['include']['supersized'] == TRUE) {
			// Include local version of the supersized library
			$this->view->assign('includeSupersized', TRUE);
			$this->response->addAdditionalHeaderData('<link media="screen" type="text/css" href="' . $this->getRelativePath($this->settings['css']['supersized'])	 . '" rel="stylesheet" />');
			$this->view->assign('supersizedScriptPath', $this->getRelativePath($this->settings['js']['supersized']));
		}

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

		$this->view->assign('resources', $resources);
	}

	protected function getRelativePath($filename) {
		return str_replace('EXT:', t3lib_extMgm::siteRelPath('supersized'), $filename);
	}
}
