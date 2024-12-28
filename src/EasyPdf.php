<?php

namespace elysio\easypdf;

use eftec\bladeone\BladeOne;
use Mpdf\Mpdf;
use Mpdf\MpdfException;

class EasyPdf
{
    private string $folderViews;
    private string $cacheViews;

    /**
     * Constructor to initialize the folder paths for views and cache.
     *
     * @param string $folderViewsPath Path to the folder containing Blade views.
     * @param string $cacheViewsPath Path to the folder used for caching compiled Blade views.
     */
    public function __construct(string $folderViewsPath = 'views', string $cacheViewsPath = 'cache')
    {
        $this->folderViews = $folderViewsPath;
        $this->cacheViews = $cacheViewsPath;
    }

    /**
     * Static method to initialize the EasyPdf instance.
     *
     * @param string $folderViews Path to the folder containing Blade views.
     * @param string $cacheViews Path to the folder used for caching compiled Blade views.
     * @return EasyPdf
     */
    public static function init(string $folderViews = 'views', string $cacheViews = 'cache'): EasyPdf
    {
        return new self($folderViews, $cacheViews);
    }

    /**
     * Get the folder path where Blade views are stored.
     *
     * @return string
     */
    public function getFolderViews(): string
    {
        return $this->folderViews;
    }

    /**
     * Get the folder path where Blade cache files are stored.
     *
     * @return string
     */
    public function getCacheViews(): string
    {
        return $this->cacheViews;
    }

    /**
     * Generate a PDF using a Blade template.
     *
     * @param string $viewName Name of the Blade view file (without extension).
     * @param array $data Data to be passed to the Blade view.
     * @return Mpdf|null Returns an Mpdf instance if successful, or null on failure.
     */
    public function makePdf(string $viewName, array $data = []): ?Mpdf
    {
        try {

            $blade = new BladeOne($this->getFolderViews(), $this->getCacheViews());
            $html = $blade->run($viewName, $data);
            $mpdf = new Mpdf();
            $mpdf->WriteHTML($html);

            return $mpdf;
        } catch (MpdfException $e) {
            error_log("Error generating PDF: " . $e->getMessage());
            return null;
        } catch (\Exception $e) {
            error_log("General error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Save the generated PDF to a specified file path.
     *
     * @param Mpdf $pdf Instance of the Mpdf class.
     * @param string $filePath Path where the PDF should be saved.
     * @return bool Returns true if the file was saved successfully, false otherwise.
     */
    public function savePdf(Mpdf $pdf, string $filePath): bool
    {
        try {
            $pdf->Output($filePath, 'F');
            return true;
        } catch (MpdfException $e) {
            error_log("Error saving PDF: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Stream the generated PDF directly to the browser.
     *
     * @param Mpdf $pdf Instance of the Mpdf class.
     * @param string $fileName Name of the file to display in the browser.
     */
    public function streamPdf(Mpdf $pdf, string $fileName = 'document.pdf'): void
    {
        try {
            $pdf->Output($fileName, 'I');
        } catch (MpdfException $e) {
            error_log("Error streaming PDF: " . $e->getMessage());
        }
    }
}
