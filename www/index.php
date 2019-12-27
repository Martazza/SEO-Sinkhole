<?php
require __DIR__ . '/../hasher.php';

$title   = $_GET['title'] ?? "Pippo 312312 dad assd ";

$content = link_generator( $title );

require ABSPATH . '/template.html';
