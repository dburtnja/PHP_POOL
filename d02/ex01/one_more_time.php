#!/usr/bin/php
<?PHP

date_default_timezone_set("Europe/Paris");

if ($argc != 2)
	echo "Wrong Format\n";
else
{
	$nbr = preg_match_all("/[a-zA-Z0-9]+/", $argv[1], $words);
	if ($nbr == 7)
	{
		$data = $words[0];
		unset($data[0]);
		$month = array("janvier" => 1, "fevrier" => 2, "mars" => 3, "avril" => 4, "mai" => 5,
			"juin" => 6, "juillet" => 7, "aout" => 8, "septembre" => 9, "octobre" => 10, "novembre" => 11, "decembre" => 12);
		$data[2] = strtolower($data[2]);
		if (checkdate($month[$data[2]], $data[1], $data[3]))
		{
			echo mktime($data[4], $data[5], $data[6], $month[$data[2]], $data[1], $data[3]) . "\n";
		}
		else
			echo "Wrong Format: bad time\n";
	}
	else
		echo "Wrong Format\n";
}
?>
