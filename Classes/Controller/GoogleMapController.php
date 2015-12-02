<?php

namespace LBR\LbrGooglemaps\Controller;

/**
 * *************************************************************
 *
 * Copyright notice
 *
 * (c) 1970 Marcel Briefs <t3@lbrmedia.net>, LBRmedia
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 * *************************************************************
 */

/**
 * GoogleMap
 */
class GoogleMapController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	
	/**
	 * locationRepository
	 *
	 * @var \LBR\LbrGooglemaps\Domain\Repository\LocationRepository
	 * @inject
	 */
	protected $locationRepository = NULL;
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		// find the locations
		$uidList = \TYPO3\CMS\Extbase\Utility\ArrayUtility::integerExplode ( ",", $this->settings ['GoogleMap'] ['locationUidList'] );
		$locations = array ();
		if (count ( $uidList )) {
			foreach ( $uidList as $uid ) {
				$location = $this->locationRepository->findByUid ( $uid );
				if ($location) {
					$locations [] = $location;
				}
			}
		}
		
		// calculate the center of the map
		$averageLatitude = 0;
		$averageLongitude = 0;
		
		if (count ( $locations )) {
			$validLocations = array ();
			foreach ( $locations as $location ) {
				if (is_numeric ( $location->getLatitude () ) && is_numeric ( $location->getLongitude () )) {
					$averageLatitude += $location->getLatitude ();
					$averageLongitude += $location->getLongitude ();
					$validLocations [] = $location;
				}
			}
			if (count ( $validLocations )) {
				$averageLatitude = $averageLatitude / count ( $validLocations );
				$averageLongitude = $averageLongitude / count ( $validLocations );
			}
			$locations = $validLocations;
			unset ( $validLocations );
		}
		
		// add JavaScript and Stylesheets
		$this->addStylesheetFiles ( $this->settings ['GoogleMap'] ['Stylesheets'] );
		$this->addJavaScriptFiles ( $this->settings ['GoogleMap'] ['JavaScript'] );
		
		$this->view->assignMultiple ( array (
				'locations' => $locations,
				'latitude' => $averageLatitude,
				'longitude' => $averageLongitude,
				'data' => $this->configurationManager->getContentObject ()->data 
		) );
	}
	
	/**
	 *
	 * @param array $items
	 */
	protected function addStylesheetFiles($items) {
		if (is_array ( $items )) {
			foreach ( $items as $key => $path ) {
				$GLOBALS ['TSFE']->getPageRenderer ()->addCssFile ( $path, 'stylesheet', 'all', '', true, false, "", true, "|" );
			}
		}
	}
	
	/**
	 *
	 * @param array $items            
	 */
	protected function addJavaScriptFiles($items) {
		if (is_array ( $items )) {
			foreach ( $items as $key => $path ) {
				$GLOBALS ['TSFE']->getPageRenderer ()->addJsFooterFile ( $path, 'text/javascript', true, false, "", true, "|" );
			}
		}
	}
}