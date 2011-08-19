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
 * Page
 */
class Tx_Supersized_Domain_Model_Page extends Tx_Extbase_DomainObject_AbstractValueObject {

	/**
	 * uid
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $uid;

	/**
	 * pid
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $pid;

	/**
	 * title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Supersized_Domain_Model_Resource>
	 */
	protected $background;

	public function __construct() {
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage instances.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->background = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * @param int $pid
	 */
	public function setPid($pid)
	{
		$this->pid = $pid;
	}

	/**
	 * @return int
	 */
	public function getPid()
	{
		return $this->pid;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Supersized_Domain_Model_Resource> $background
	 * @return void
	 */
	public function setBackground(Tx_Extbase_Persistence_ObjectStorage $background) {
		$this->background = $background;
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Supersized_Domain_Model_Resource>
	 */
	public function getBackground() {
		return $this->background;
	}

	/**
	 * @param Tx_Supersized_Domain_Model_Resource $background the Partner to be added
	 * @return void
	 */
	public function addBackground(Tx_Supersized_Domain_Model_Resource $background) {
		$this->background->attach($background);
	}

	/**
	 * @param Tx_Supersized_Domain_Model_Resource $backgroundToRemove the Partner to be removed
	 * @return void
	 */
	public function removeBackground(Tx_Supersized_Domain_Model_Resource $backgroundToRemove) {
		$this->background->detach($backgroundToRemove);
	}
}
?>