<?php
/**
 * QRCode plugin for Craft CMS 3.x
 *
 * Generate a QR code
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\qrcode\assetbundles\qrcodefieldfield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Kurious Agency
 * @package   QRCode
 * @since     0.0.1
 */
class QRCodeFieldFieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@kuriousagency/qrcode/assetbundles/qrcodefieldfield/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/QRCodeField.js',
        ];

        $this->css = [
            'css/QRCodeField.css',
        ];

        parent::init();
    }
}
