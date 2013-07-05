<?php
class FeedPlugin extends SBPlugin {
	public $allowDisable = false;

	// Plugin Name
	public function getName() {
		return 'SourceBans Feed';
	}

	// Plugin Description
	public function getDescription() {
		return 'This application allows output of feeds in multiple formats.';
	}

	// Plugin Author
	public function getAuthor() {
		return 'SourceBans Team';
	}

	// Plugin version
	// This plugin is with the SourceBans package, so it uses the SourceBans global version.
	public function getVersion() {
		//return 'Version Number'
		return SourceBans::getVersion();
	}

	// Author URL
	public function getUrl() {
		return 'http://www.sourcebans.net/';
	}

	public function runInstall() {
		// Opens Database Transation
		$transaction = Yii::app() -> db -> beginTransaction();
		
		// Adds a new setting to the SBSetting table
		// Tries to write DB, if fails rolls back attempted changes
		try {
			$setting = new SBSetting;
			// New field name for SBSetting Table
			$setting -> name = 'feed_item_count';
			// Default Value
			$setting -> value = 10;
			// Save the new setting value
			$setting -> save();

			// Commit the new setting field to the database
			$transaction -> commit();
			return true;
		} catch(Exception $e) {
			$transaction -> rollback();
			return false;
		}
	}

	public function runSettings() {
		/* Grabs the feed_item_count setting from the settings table
		 * Returns the applicable value
		 * Multiple items can be added to this as it will return all settings
		 * necessary for the plugin
		*/
		return array('itemCount' => SourceBans::app() -> settings -> feed_item_count, );
	}

	public function runUninstall() {
		$transaction = Yii::app() -> db -> beginTransaction();
		// Try to remove settings on uninstall
		// If it fails roll back attempted changes
		try {
			// Checks the settings table for feed_item_count and preps for deletion of field
			SBSetting::model() -> deleteByPk('feed_item_count');

			$transaction -> commit();
			return true;
		} catch(Exception $e) {
			$transaction -> rollback();
			return false;
		}
	}

	public function onBeginRequest($event) {
		// Grabs base URL of whole application and creates a mod_rewrite rule that goes to root URL
		Yii::app() -> controllerMap['feed'] = $this -> getPathAlias('controllers.FeedController');
		// Forces the following extensions to all point to feed/index via a mod_rewrite. XML, ATOM, PHP, RSS
		Yii::app() -> urlManager -> addRules(array('feed\.xml' => 'feed/index', 'feed\.php' => 'feed/index', 'feed\.rss' => 'feed/index', 'feed\.atom' => 'feed/index', ), false);
		// true to append, false to prepend
	}
}
