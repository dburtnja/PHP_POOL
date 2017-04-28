#!/usr/bin/php
<?PHP

if ($argc == 2)
{
	$tab = file($argv[1]);
	$new_tab = preg_replace_callback("|(<a.*>)(.+)(</a>)|is", function($matches)
	{
		return $matches[1] . strtoupper($matches[2]). $matches[3];
	}
	,$tab);
	print_r($new_tab);
}
else
	echo "Error input\n";

?>
