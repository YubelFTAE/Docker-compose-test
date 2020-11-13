<?php
$a = array('<foo>',"'bar'",'"baz"','&blong&', "\xc3\xa9");

echo "Normal: ",  json_encode($a), "\n"."<br/>";
echo "Tags: ",    json_encode($a, JSON_HEX_TAG), "\n"."<br/>";
echo "Apos: ",    json_encode($a, JSON_HEX_APOS), "\n"."<br/>";
echo "Quot: ",    json_encode($a, JSON_HEX_QUOT), "\n"."<br/>";
echo "Amp: ",     json_encode($a, JSON_HEX_AMP), "\n"."<br/>";
echo "Unicode: ", json_encode($a, JSON_UNESCAPED_UNICODE), "\n";
echo "All: ",     json_encode($a, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE), "\n\n";