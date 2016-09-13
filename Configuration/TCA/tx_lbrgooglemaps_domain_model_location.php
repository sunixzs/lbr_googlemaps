<?php
return array (
		'ctrl' => array (
				'title' => 'LLL:EXT:lbr_googlemaps/Resources/Private/Language/locallang_db.xlf:tx_lbrgooglemaps_domain_model_location',
				'label' => 'title',
				'tstamp' => 'tstamp',
				'crdate' => 'crdate',
				'cruser_id' => 'cruser_id',
				'dividers2tabs' => TRUE,
				
				'versioningWS' => 2,
				'versioning_followPages' => TRUE,
				
				'languageField' => 'sys_language_uid',
				'transOrigPointerField' => 'l10n_parent',
				'transOrigDiffSourceField' => 'l10n_diffsource',
				'delete' => 'deleted',
				'enablecolumns' => array (
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime' 
				),
				'searchFields' => 'title,latitude,longitude,tooltip,',
				'iconfile' => 'EXT:lbr_googlemaps/Resources/Public/Icons/tx_lbrgooglemaps_domain_model_location.gif' 
		),
		'interface' => array (
				'showRecordFieldList' => '
					sys_language_uid,
					l10n_parent,
					l10n_diffsource,
					hidden,
					title,
					latitude,
					longitude,
					tooltip' 
		),
		'types' => array (
				'1' => array (
						'showitem' => '
							sys_language_uid,
							l10n_parent,
							l10n_diffsource,
							title,
							--palette--;Koordinaten;coordinates,
							tooltip,
							--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
							hidden,
							starttime,
							endtime
						' 
				) 
		),
		'palettes' => array (
				'coordinates' => array (
						'showitem' => 'latitude, longitude' 
				) 
		),
		'columns' => array (
				'sys_language_uid' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
						'config' => array (
								'type' => 'select',
								'renderType' => 'selectSingle',
								'foreign_table' => 'sys_language',
								'foreign_table_where' => 'ORDER BY sys_language.title',
								'items' => array (
										array (
												'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
												- 1 
										),
										array (
												'LLL:EXT:lang/locallang_general.xlf:LGL.default_value',
												0 
										) 
								) 
						) 
				),
				'l10n_parent' => array (
						'displayCond' => 'FIELD:sys_language_uid:>:0',
						'exclude' => 1,
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
						'config' => array (
								'type' => 'select',
								'renderType' => 'selectSingle',
								'items' => array (
										array (
												'',
												0 
										) 
								),
								'foreign_table' => 'tx_lbrgooglemaps_domain_model_location',
								'foreign_table_where' => 'AND tx_lbrgooglemaps_domain_model_location.pid=###CURRENT_PID### AND tx_lbrgooglemaps_domain_model_location.sys_language_uid IN (-1,0)' 
						) 
				),
				'l10n_diffsource' => array (
						'config' => array (
								'type' => 'passthrough' 
						) 
				),
				
				't3ver_label' => array (
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
						'config' => array (
								'type' => 'input',
								'size' => 30,
								'max' => 255 
						) 
				),
				
				'hidden' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
						'config' => array (
								'type' => 'check' 
						) 
				),
				'starttime' => array (
						'exclude' => 1,
						'l10n_mode' => 'mergeIfNotBlank',
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
						'config' => array (
								'type' => 'input',
								'size' => 13,
								'max' => 20,
								'eval' => 'datetime',
								'checkbox' => 0,
								'default' => 0,
								'range' => array (
										'lower' => mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) ) 
								) 
						) 
				),
				'endtime' => array (
						'exclude' => 1,
						'l10n_mode' => 'mergeIfNotBlank',
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
						'config' => array (
								'type' => 'input',
								'size' => 13,
								'max' => 20,
								'eval' => 'datetime',
								'checkbox' => 0,
								'default' => 0,
								'range' => array (
										'lower' => mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) ) 
								) 
						) 
				),
				
				'title' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:lbr_googlemaps/Resources/Private/Language/locallang_db.xlf:tx_lbrgooglemaps_domain_model_location.title',
						'config' => array (
								'type' => 'input',
								'size' => 30,
								'eval' => 'trim,required' 
						) 
				),
				'latitude' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:lbr_googlemaps/Resources/Private/Language/locallang_db.xlf:tx_lbrgooglemaps_domain_model_location.latitude',
						'config' => array (
								'type' => 'input',
								'size' => 20,
								'eval' => 'trim,required' 
						) 
				),
				'longitude' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:lbr_googlemaps/Resources/Private/Language/locallang_db.xlf:tx_lbrgooglemaps_domain_model_location.longitude',
						'config' => array (
								'type' => 'input',
								'size' => 20,
								'eval' => 'trim,required' 
						) 
				),
				'tooltip' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:lbr_googlemaps/Resources/Private/Language/locallang_db.xlf:tx_lbrgooglemaps_domain_model_location.tooltip',
						'defaultExtras' => 'richtext:rte_transform[mode=ts_links]',
						'config' => array (
								'type' => 'text',
								'cols' => 40,
								'rows' => 15,
								'eval' => 'trim',
								'wizards' => array (
										'RTE' => array (
												'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_rte.gif',
												'notNewRecords' => 1,
												'RTEonly' => 1,
												'module' => array (
														'name' => 'wizard_rich_text_editor',
														'urlParameters' => array (
																'mode' => 'wizard',
																'act' => 'wizard_rte.php' 
														) 
												),
												'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
												'type' => 'script' 
										) 
								) 
						) 
				) 
		) 
);
