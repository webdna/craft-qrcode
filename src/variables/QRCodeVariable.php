<?php
/**
 * QRCode plugin for Craft CMS 4.x
 *
 * Generate a QR code
 *
 * @link      https://webdna.co.uk
 * @copyright Copyright (c) 2019 webdna
 */

namespace webdna\qrcode\variables;

use webdna\qrcode\QRCode;

use Craft;

/**
 * @author    webdna
 * @package   QRCode
 * @since     0.0.1
 */
class QRCodeVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param null $optional
     * @return string
     */
    public function generate($data, $size=null): string
    {
        return QRCode::$plugin->service->generate($data, $size);
    }
}
