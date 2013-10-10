<?php
$chunk = $modx->getObject('modChunk',array('name' => $tpl));
	
	if ($chunk) {
		$content = $chunk->getContent();
		foreach($scriptProperties as $key => $value ){
			$content = str_replace('[[+' . $key . ']]',$value,$content);
		}
		// Replaceplaceholder for jQuery
		$content = str_replace('[[+','${',$content);
		$content = str_replace(']]','}',$content);
		return '<script id="'.$tpl.'" type="text/x-jquery-tmpl">' . $content . '</script>';
	}else{
		return "Invalid template name [" . $tpl . "]";
	}