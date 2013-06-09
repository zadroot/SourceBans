<?php
class FeedController extends Controller {
	public function actionIndex() {
		$plugin = SBPlugin::model() -> findById('FeedPlugin');
		$view = $plugin -> getViewFile('index');

		$this -> renderPartial($view, array('bans' => $this -> getBans(), ));
	}

	public function getBans() {
		$type = Yii::app() -> request -> getQuery('type') == 'ip' ? SBBan::IP_TYPE : SBBan::STEAM_TYPE;
		$bans = SBBan::model() -> findAllByAttributes(array('type' => $type), array('limit' => SourceBans::app() -> settings -> feed_item_count, 'order' => "create_time DESC"));
		return $bans;
	}

	public function actionCreate() {
		$model = new User;
		$this -> performAjaxValidation($model);
		if (isset($_POST['User'])) {
			$model -> attributes = $_POST['User'];
			if ($model -> save())
				$this -> redirect('index');
		}
		$this -> render('create', array('model' => $model));
	}

	protected function performAjaxValidation($model) {
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
			echo CActiveForm::validate($model);
			Yii::app() -> end();
		}
	}

}
