<?php
 /**
  * (c) Dominique Feyer <dfeyer@ttree.ch>
  *
  * For the full copyright and license information, please view the LICENSE
  * file that was distributed with this source code.
  */

/**
 * Resume
 *
 * This class ...
 *
 * @package    Tx_Supersized_Utility_UserFunc
 * @author     Dominique Feyer <dfeyer@ttree.ch>
 */
class Tx_Supersized_Utility_UserFuncUtility {

	public static function getBackgroundTitle($params, $pObj) {
		if (isset($params['row']['uid']) && $params['row']['uid'] > 0) {
			$record = t3lib_BEfunc::getRecord($params['table'], (int)$params['row']['uid']);

			$params['title'] = $record['title'] . ' (' . basename($record['resource']) . ')';
		} else {
			$params['title'] = 'Please configure your background image ...';
		}
	}

}
