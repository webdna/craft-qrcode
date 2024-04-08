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
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

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
//        dd($data);

        if (is_array($data)) {
            $data = json_encode($data, JSON_THROW_ON_ERROR);
        }

        $writer = new PngWriter();
        
        $qrCode = QrCode::create($data)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize($size)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255, 100));

        $result = $writer->write($qrCode);

        return Template::raw($result->getDataUri());
    }
}
