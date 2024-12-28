# EasyPdf

`EasyPdf` is a library that enables the creation of PDFs using Blade templates and the Mpdf library. It provides an easy-to-use interface for generating PDFs from Blade views, with options for saving or streaming the generated PDF.

## Features

- **Blade Template Integration**: Use Blade templates to generate HTML content for PDFs.
- **Mpdf Integration**: Leverage Mpdf for high-performance PDF generation.
- **Save or Stream PDFs**: Save PDFs to a file or stream them directly to the browser.

## Installation

You can install the package via Composer:

```bash
composer require elysio/easy-pdf
``` 

## Usage

### Initialize the EasyPdf instance

To initialize the `EasyPdf` class, you can either use the constructor directly or the static `init` method.

```php
use elysio\easypdf\EasyPdf;

$pdfGenerator = EasyPdf::init('path/to/views', 'path/to/cache');
``` 

### Generate a PDF

You can generate a PDF from a Blade view by calling the `makePdf` method. The method takes the name of the Blade view and an optional array of data to be passed to the view.

```php
$pdf = $pdfGenerator->makePdf('viewName', ['key' => 'value']);
```

This will return an `Mpdf` instance, which you can use for further operations (e.g., saving or streaming the PDF).

### Save the PDF

To save the generated PDF to a file, use the `savePdf` method:

```php
$success = $pdfGenerator->savePdf($pdf, 'path/to/save/document.pdf');
```

### Stream the PDF

To stream the generated PDF directly to the browser, use the `streamPdf` method:

```php
$pdfGenerator->streamPdf($pdf, 'document.pdf');
```

## Configuration

The `EasyPdf` class allows you to specify custom paths for the Blade views and cache directories when initializing the instance.

```php
$pdfGenerator = EasyPdf::init('custom/views', 'custom/cache');
```

## Dependencies

- **mpdf/mpdf**: Required for PDF generation.
- **eftec/bladeone**: Required for Blade templating.

## Development

To run tests during development, use the following command:

```bash
composer test
```

This will execute the tests using Pest.

## License

MIT License. See the [LICENSE](LICENSE) file for more information.

## Author

**Elysio Martins | Refaltor** <br/>
Email: [elysiomartinspro@gmail.com](mailto:elysiomartinspro@gmail.com)
