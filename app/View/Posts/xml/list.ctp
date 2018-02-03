// app/View/Recipes/xml/index.ctp
// Do some formatting and manipulation on
// the $recipes array.
<?xml version="1.0" encoding="utf-8"?>
<?php
$xml = Xml::fromArray(array('response' => $posts));
echo $xml->asXML();
?>