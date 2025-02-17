<?php
echo '<pre>';
try {

    // the code that throws an exception

var_dump(file_exists($_SERVER['DOCUMENT_ROOT'] . '/16221763.pdf'));
var_dump($_SERVER['DOCUMENT_ROOT'] . '/16221763.pdf');
    $imagick = new \Imagick();
    $imagick->setResolution(288,288);
    $imagick->readImage($_SERVER['DOCUMENT_ROOT'] . '/16221763.pdf');
    $imagick->writeImage($_SERVER['DOCUMENT_ROOT'] . '/16221763-test.png');
} catch ( Exception $e ) {

    var_dump( $e );
}
