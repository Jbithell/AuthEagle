<?php
if (!isset($_GET['url'])) die('Please enter a valid url');
$url = $_GET['url'];
/*$site = file_get_contents($url);
$site = str_replace('src="','src="' . $url,$site);
$site = str_replace('url(','url(' . $url,$site);
$site = str_replace('content="','content="' . $url,$site);
echo $site;*/
?>
<?php
$parse = parse_url($url);
$target_domain = (empty($parse['scheme']) ? 'http' : $parse['scheme']) . '://' . (empty($parse['host']) ? explode('/', $parse['path'])[0] : $parse['host']);
//Download page
$url = ($target_domain . '/' . explode('/', $parse['path'], 2)[1] . (empty($parse['query']) ? null : '?' . $parse['query']));
$site = file_get_contents($url);
if (!strpos($http_response_header[0],'200')) die('HTTP Error ' . $http_response_header[0] . ' was returned - Please contact support');
$dom = DOMDocument::loadHTML($site);
if($dom instanceof DOMDocument) {
    // find <head> tag
    $head_tag_list = $dom->getElementsByTagName('head');
    // there should only be one <head> tag
    if($head_tag_list->length !== 1) die('The HTML is malformed without single head tag - Something went wrong - Please try again later');
    $head_tag = $head_tag_list->item(0);

    // find first child of head tag to later use in insertion
    $head_has_children = $head_tag->hasChildNodes();
    if($head_has_children) $head_tag_first_child = $head_tag->firstChild;

    // create new <base> tag
    $base_element = $dom->createElement('base');
    $base_element->setAttribute('href', $target_domain);
	$base_element->setAttribute('target', "_blank");
    // insert new base tag as first child to head tag
    if($head_has_children) {
        $base_node = $head_tag->insertBefore($base_element, $head_tag_first_child);
    } else {
        $base_node = $head_tag->appendChild($base_element);
    }
	$html = $dom->saveHTML();
	//$html = str_replace('href="','href="' . $_SERVER['REQUEST_URI'] . '?url=',$html);
	echo $html;
} else {
	echo 'Error';
    // something went wrong in loading HTML to DOM Document
    // provide error messaging
}
?>