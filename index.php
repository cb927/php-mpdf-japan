<?php
require_once __DIR__ . '/vendor/autoload.php';
$defaultConfig = (new \Mpdf\Config\ConfigVariables)->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new \Mpdf\Config\FontVariables)->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'autoLangToFont' => true,
    'autoScriptToLang' => true,

    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/font',
    ]),

    'fontdata' => $fontData + [
        'ipafont' => [
            'R' => 'ipa_font.ttf',
        ]
    ],
]);

$stylesheet = file_get_contents('style.css');
$html = file_get_contents('pdf-02.html');

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->Output();
