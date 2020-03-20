<?php
$team = array(3088158, 3334697, 2329773);
//$team = array(3088158, , 3140358);
//End Settings
date_default_timezone_set("Europe/London");
$output = '';
$url = 'https://api.stackexchange.com/2.2/users/' . implode(';', $team) . '?order=desc&sort=reputation&site=stackoverflow';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_ENCODING, '');
$data = json_decode(curl_exec($curl), true);
curl_close($curl);
$lastchanged = 0;
if (count($data['items']) == count($team)) {
	$output .=  '<table>';
	foreach ($data['items'] as $user) {
		$output .=  '<tr><td><a href="' . $user['link'] . '"><img src="' . $user['profile_image'] . '" /></a></td><td>' . $user['display_name'] . '</td><td><b>' . $user['reputation'] . '</b></td><td>&#8593; ' . $user['reputation_change_day']. ' Today</td></tr>';
		if ($lastchanged < $user['last_modified_date']) $lastchanged = $user['last_modified_date'];
	}
	$output .=  '</table>';
} else {
	//Probably because quota used up!
	foreach ($team as $stackid) {
		//Old method using images
		$output .= '<img src="https://stackoverflow.com/users/flair/' . $stackid . '.png?theme=clean" /><br/>';
	}
}
?>
<title>AuthEagle - Dev Team Leaderboard</title>
<center><h1>AuthEagle - Dev Team Leaderboard</h1></center>
<style>
td {
	padding: 10px;
}
</style><center><?php echo $output; ?></center>
<p align="right"><i>Last Updated: <?php
function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13)) return $number. 'th';
    else return $number. $ends[$number % 10];
}
//Example Usage
echo date("H:i D");
echo ' ' . ordinal(date("d")) . ' ';
echo date("M Y");
?></i></p>