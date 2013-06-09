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
		return SourceBans::getVersion();
	}

	// Author URL
	public function getUrl() {
		return 'http://www.sourcebans.net/';
	}

	public function runInstall() {
		$transaction = Yii::app() -> db -> beginTransaction();

		try {
			$setting = new SBSetting;
			$setting -> name = 'feed_item_count';
			$setting -> value = 10;
			$setting -> save();

			$transaction -> commit();
			return true;
		} catch(Exception $e) {
			$transaction -> rollback();
			return false;
		}
	}

	public function runSettings() {
		return array('itemCount' => SourceBans::app() -> settings -> feed_item_count, );
	}

	public function runUninstall() {
		$transaction = Yii::app() -> db -> beginTransaction();

		try {
			SBSetting::model() -> deleteByPk('feed_item_count');

			$transaction -> commit();
			return true;
		} catch(Exception $e) {
			$transaction -> rollback();
			return false;
		}
	}

	public function onBeginRequest($event) {
		Yii::app() -> controllerMap['feed'] = $this -> getPathAlias('controllers.FeedController');
		Yii::app() -> urlManager -> addRules(array('feed\.xml' => 'feed/index', 'feed\.php' => 'feed/index', 'feed\.rss' => 'feed/index', 'feed\.atom' => 'feed/index', ), false);
		// true to append, false to prepend
	}
}
