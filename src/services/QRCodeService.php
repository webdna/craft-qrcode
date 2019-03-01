<?php
/**
 * QRCode plugin for Craft CMS 3.x
 *
 * Generate a QR code
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\qrcode\services;

use kuriousagency\qrcode\QRCode as Plugin;

use Endroid\QrCode\QrCode;

use Craft;
use craft\base\Component;
use craft\helpers\Template;

/**
 * @author    Kurious Agency
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
    public function generate($data, $size=null)
    {
		$generator = new QrCode($data);
		if ($size) {
			$generator->setSize($size);
		}

		return Template::raw($generator->writeDataUri());
    }
}
