<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */
?>
    <div class="row">
      <section class="span12">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'login-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
		'inputContainer'=>'.control-group',
		'validateOnSubmit' => true,
	),
)) ?>

          <fieldset>
            <div class="control-group">
              <?php echo $form->labelEx($model, 'username', array('class' => 'control-label')); ?>
              <?php echo $form->textField($model, 'username'); ?>
              <?php echo $form->error($model, 'username', array('class' => 'help-block')); ?>
            </div>
            <div class="control-group">
              <?php echo $form->labelEx($model, 'password', array('class' => 'control-label')); ?>
              <?php echo $form->passwordField($model, 'password'); ?>
              <?php echo $form->error($model, 'password', array('class' => 'help-block')); ?>
            </div>
            <div class="rememberMe">
              <?php $rememberMe = $form->checkBox($model, 'rememberMe', array('checked' => 'checked')) . $model->getAttributeLabel('rememberMe') ?>
              <?php echo CHtml::label($rememberMe, 'LoginForm_rememberMe', array('class' => 'checkbox')); ?>
              <?php echo $form->error($model, 'rememberMe', array('class' => 'help-block')); ?>
            </div>
            <div>
              <?php echo CHtml::submitButton(Yii::t('sourcebans', 'Login'), array('class' => 'btn btn-success')); ?>
              <div class="help-inline"><?php echo CHtml::link(Yii::t('sourcebans', 'Lost password'), array('site/lostPassword')) ?></div>
            </div>
          </fieldset>
<?php $this->endWidget() ?>

      </section>
    </div>