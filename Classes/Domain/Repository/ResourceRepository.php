<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Dominique Feyer <dominique.feyer@reelpeek.net>, ReelPeek
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/


/**
 * Repository for Tx_Supersized_Domain_Repository_ResourceRepository
 */
class Tx_Supersized_Domain_Repository_ResourceRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * @var Tx_Supersized_Domain_Repository_PageRepository
	 */
	protected $pageRepository;

	/**
	 * @param Tx_Supersized_Domain_Repository_PageRepository $pageRepository
 	 * @return void
	 */
	public function injectPageRepository(Tx_Supersized_Domain_Repository_PageRepository $pageRepository) {
		$this->pageRepository = $pageRepository;
	}

	public function initializeObject() {
		$querySettings = $this->objectManager->create('Tx_Extbase_Persistence_Typo3QuerySettings');
		$querySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
	}

	public function searchInRootline($start) {

		try {
			/** @var $currentPage Tx_Supersized_Domain_Model_Page */
			$currentPage = $this->pageRepository->findOneByUid($start);

			return $this->findInRootline($currentPage);

		} catch (RuntimeException $e) {
			if ($e->getCode() == '1313662124') {
				// We are on the root page
				return FALSE;
			} else {
				throw $e;
			}
		}
	}

	/**
	 * @param Tx_Supersized_Domain_Model_Page $currentPage
	 * @return Tx_Supersized_Domain_Model_Resource
	 */
	protected function findOneInRootline(Tx_Supersized_Domain_Model_Page $currentPage) {
		return $this->findInRootline($currentPage)->current();
	}

	/**
	 * @param Tx_Supersized_Domain_Model_Page $currentPage
	 * @return bool|Tx_Extbase_Persistence_ObjectStorage
	 */
	protected function findInRootline(Tx_Supersized_Domain_Model_Page $currentPage) {
		try {
			// Check resource in the current page
			$backgroundImage = $currentPage->getBackground();
			$backgroundImage->rewind();

			if ($backgroundImage->current() instanceof Tx_Supersized_Domain_Model_Resource) {
				return $backgroundImage;
			} else {
				// Check resource in the parent page
				$parentPage = $this->pageRepository->findParent($currentPage);
				return $this->findInRootline($parentPage);
			}
		} catch (t3lib_error_Exception $e) {
			return FALSE;
		}
	}

}

?>