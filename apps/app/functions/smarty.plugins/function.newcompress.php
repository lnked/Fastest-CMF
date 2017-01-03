<?php

function minifyJS($arr)
{
	minify($arr, 'http://javascript-minifier.com/raw');
}

function minifyCSS($arr)
{
	minify($arr, 'http://cssminifier.com/raw');
}

function minify($arr, $url)
{
	$root = PATH_ROOT;

	foreach ($arr as $key => $value) {
		$handler = fopen( $root . $value, 'w') or die("File <a href='" . $value . "'>" . $value . "</a> error!<br />");
		fwrite($handler, getMinified($url, file_get_contents($root . $key)));
		fclose($handler);
		echo "File <a href='" . $value . "'>" . $value . "</a> done!<br />";
	}
}

function getMinified($url, $content)
{
	$postdata = array('http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query( array('input' => $content) ) )
	);
	
	return file_get_contents($url, false, stream_context_create($postdata));
}

$js = array(
	"/js/app.js" => "/cache/app.js"
);

$css = array(
	"/css/main.css"	=> "/cache/main.css"
);

minifyJS($js);
minifyCSS($css);