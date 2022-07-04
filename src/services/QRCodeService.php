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

use webdna\qrcode\QRCode as Plugin;

use Endroid\QrCode\QrCode;

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
     * @return mixed
     */
    public function generate($data, $size=null): Markup
    {
        if (gettype($data) == 'array') {
            $data = json_encode($data);
        }

        $generator = new QrCode($data);
        if ($size) {
            $generator->setSize($size);
        }

        return Template::raw($generator->writeDataUri());
    }
}
