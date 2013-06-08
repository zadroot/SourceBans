<?php
class FeedController extends Controller
{
	public function actionIndex()
	{
		$plugin = SBPlugin::model()->findById('FeedPlugin');
		$view = $plugin->getViewFile('index');
		
		$this->renderPartial($view, array(
			'bans' => $this->getBans(),
		));
	}
	
	public function getBans()
	{
		$type = Yii::app()->request->getQuery('type') == 'ip' ? SBBan::IP_TYPE : SBBan::STEAM_TYPE;
		$bans = SBBan::model()->findAllByAttributes(array('type' => $type),array('limit' => SourceBans::app()->settings->feed_item_count, 'order' => "create_time DESC"));
		return $bans;
	}
}