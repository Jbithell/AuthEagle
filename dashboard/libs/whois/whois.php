<?php
function getwhois($domain = 'bbc.co.uk') {
	require_once("whois_lib.php");
	$whois = new Whois();
	if(!$whois->ValidDomain($domain)) return null;
	if($whois->Lookup($domain)) return nl2br($whois->GetData(1));
	else return null;
}
echo getwhois();