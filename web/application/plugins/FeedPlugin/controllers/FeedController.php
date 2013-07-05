<?php
// Your controller will always be an extension of another
class FeedController extends Controller {
	// What should the plugin do when the index is called?
	public function actionIndex() {
		// Ensure the plugin exists
		$plugin = SBPlugin::model() -> findById('FeedPlugin');
		// Display the index view
		$view = $plugin -> getViewFile('index');
		// renderPartial will render items from within the theme, this also pushes variables into the view
		$this -> renderPartial($view, array('bans' => $this -> getBans(), ));
	}

	// This function just grabs the bans table and turns it into an array
	public function getBans() {
		$type = Yii::app() -> request -> getQuery('type') == 'ip' ? SBBan::IP_TYPE : SBBan::STEAM_TYPE;
		$bans = SBBan::model() -> findAllByAttributes(array('type' => $type), array('limit' => SourceBans::app() -> settings -> feed_item_count, 'order' => "create_time DESC"));
		return $bans;
	}

	// The following two functions are part of incomplete functionality that will enforce AJAX Validation on the Settings Page
	// This feature does not currently work.
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
