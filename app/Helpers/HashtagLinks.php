<?php
namespace App\Helpers;

/**
 *
 */
class HashtagLinks {

	public static function getLinks($description){
	    $pattern = '/#(\w+)/';
	    $replacement = '<a href="/explore/tag/$1">#$1</a>';
	    return preg_replace($pattern, $replacement, $description);
	}

}