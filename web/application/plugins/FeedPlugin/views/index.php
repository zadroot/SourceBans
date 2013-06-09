
<?php
	header('Content-Type: application/rss+xml; charset=UTF-8');
	for($i=0; $i < SourceBans::app()->settings->feed_item_count; $i++)
	{
		echo ($i);
?>
test
<?php
	}
	print_r ($this->getBans());
?>