In order to make use of this feed, you can use of the following (in order of recommendation):
<br />
<a href="<?php echo (Yii::app()->request->getBaseUrl(true)); ?>/feed.rss" target="_blank">.rss</a>
<br /> 
<a href="<?php echo (Yii::app()->request->getBaseUrl(true)); ?>/feed.xml" target="_blank">.xml</a> 
<br /> 
<a href="<?php echo (Yii::app()->request->getBaseUrl(true)); ?>/feed.atom" target="_blank">.atom</a> 
<br /> 
<a href="<?php echo (Yii::app()->request->getBaseUrl(true)); ?>/feed.php" target="_blank">.php</a> 
<br />
<br />
Current number of items displayed in the feed set to -1 for unlimited: <?php echo ($itemCount); ?>
