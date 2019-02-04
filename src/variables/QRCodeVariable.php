<?php
/**
 * QRCode plugin for Craft CMS 3.x
 *
 * Generate a QR code
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\qrcode\variables;

use kuriousagency\qrcode\QRCode;

use Craft;

/**
 * @author    Kurious Agency
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
    public function generate($data, $size=null)
    {
        return QRCode::$plugin->service->generate($data, $size);
    }
}
