<?php

use elysio\easypdf\EasyPdf;
use Mpdf\Mpdf;

require "vendor/autoload.php";

test('make pdf test', function () {
    // Initialize EasyPdf with the paths for views and cache
    $easyPdf = new EasyPdf('tests/views', 'tests/cache');

    // Generate the PDF
    $pdf = $easyPdf->makePdf('test_pdf', [
        'title' => 'Hello PDF',
        'subTitle' => 'I love PDF!'
    ]);

    // Check that the PDF instance is correctly generated
    expect($pdf)->toBeInstanceOf(Mpdf::class);

    // Save the PDF to a file
    $filePath = 'test.pdf';
    $result = $easyPdf->savePdf($pdf, $filePath);

    // Assert the file was saved successfully
    expect($result)->toBeTrue()
        ->and(file_exists($filePath))->toBeTrue();
});