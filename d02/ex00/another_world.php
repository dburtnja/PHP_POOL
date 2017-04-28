#!/usr/bin/php
<?PHP

$nbr = preg_match_all("/[!-~]+/", $argv[1], $words);
for($i = 0; $i < $nbr; $i++)
{
	echo $words[0][$i];
	if ($i + 1 >= $nbr)
		echo "\n";
	else
		echo " ";
}
?>
