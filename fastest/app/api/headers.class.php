<?
//CSP only works in modern browsers Chrome 25+, Firefox 23+, Safari 7+
$headerCSP = "Content-Security-Policy:".
        "connect-src 'self' ;". // XMLHttpRequest (AJAX request), WebSocket or EventSource.
        "default-src 'self';". // Default policy for loading html elements
        "frame-ancestors 'self' ;". //allow parent framing - this one blocks click jacking and ui redress
        "frame-src 'none';". // vaid sources for frames
        "media-src 'self' *.example.com;". // vaid sources for media (audio and video html tags src)
        "object-src 'none'; ". // valid object embed and applet tags src
        "report-uri https://example.com/violationReportForCSP.php;". //A URL that will get raw json data in post that lets you know what was violated and blocked
        "script-src 'self' 'unsafe-inline' example.com code.jquery.com https://ssl.google-analytics.com ;". // allows js from self, jquery and google analytics.  Inline allows inline js
        "style-src 'self' 'unsafe-inline';";// allows css from self and inline allows inline css
//Sends the Header in the HTTP response to instruct the Browser how it should handle content and what is whitelisted
//Its up to the browser to follow the policy which each browser has varying support
header($contentSecurityPolicy);
//X-Frame-Options is not a standard (note the X- which stands for extension not a standard)
//This was never officially created but is supported by a lot of the current browsers in use in 2015 and will block iframing of your website
header('X-Frame-Options: SAMEORIGIN');


<?php
$data = json_decode($HTTP_RAW_POST_DATA,true);
$to = 'myemail@example.com';
$subject = 'CSP Violations';
$message="Following violations occured:<br/><br/>";
if($document_uri!="")
    $message.="<b>Document URI:</b> ".$data['csp-report']['document-uri']."<br/><br/>";
if($referrer!="")
    $message.="<b>Referrer:</b> ".$data['csp-report']['referrer']."<br/><br/>";
if($blocked_uri!="")
    $message.="<b>Blocked URI:</b> ".$data['csp-report']['blocked_uri']."<br/><br/>";
if($violated_directive!="")
    $message.="<b>Violated Directive:</b> ".$data['csp-report']['violated_directive']."<br/><br/>";
if($original_policy!="")
    $message.="<b>Original Policy:</b> ".$data['csp-report']['original_policy']."<br/><br/>";
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Example Website <noreply@example.com>' . "\r\n";
// Mail it
mail($to, $subject, $message, $headers);