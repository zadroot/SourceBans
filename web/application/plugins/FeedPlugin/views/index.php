
<?php
	// Checks to see if the requesting agent is a Mozilla type browser
	// If it is, it pushes text/xml to enforce it to read the page as XML
	// If it is not, it returns proper application response.
	/* Section Disabled during development
	if(strstr(Yii::app()->request->getUserAgent(),"Mozilla") == "FALSE")
	{*/
		header('Content-Type: application/rss+xml; charset=UTF-8');
	/*}else{
		header('Content-Type: text/xml; charset=UTF-8');
	};
	 */
?>
	<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<?php

	$bans = $this->getBans();
	if(SourceBans::app()->settings->feed_item_count < 0)
	{
		foreach($bans as $ban)
		{
			
		}
	}else{
		for($i=0; $i < SourceBans::app()->settings->feed_item_count; $i++)
		{
		}
	}
	print_r ($bans);
?>