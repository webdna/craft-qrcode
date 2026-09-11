<?php
/**
 * QRCode plugin for Craft CMS 4.x
 *
 * Generate a QR code
 *
 * @link      https://webdna.co.uk
 * @copyright Copyright (c) 2019 webdna
 */

namespace webdna\qrcode\services;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use webdna\qrcode\QRCode as Plugin;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

use Twig\Markup;

use Craft;
use craft\base\Component;
use craft\helpers\Template;

/**
 * @author    webdna
 * @package   QRCode
 * @since     0.0.1
 */
class QRCodeService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @param mixed $data
     * @param ?int $size
     * @return Markup
     */
    /**
     * @throws \JsonException
     */
    public function generate(mixed $data, ?int $size = 300): Markup
    {
        // set default size
        if ($size === null) {
            $size = 300;
        }

        if (is_array($data)) {
            $data = json_encode($data, JSON_THROW_ON_ERROR);
        }

        $writer = new PngWriter();
        
        // Use the constructor rather than the static create()/setter chain:
        // the setters were deprecated in endroid/qr-code 5.x and removed in 6.0,
        // while the constructor signature is identical across both majors.
        $qrCode = new QrCode(
            data: $data,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: $size,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255, 100),
        );

        $result = $writer->write($qrCode);

        return Template::raw($result->getDataUri());
    }
}
