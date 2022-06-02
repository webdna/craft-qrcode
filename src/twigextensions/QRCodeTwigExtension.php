<?php
/**
 * QRCode plugin for Craft CMS 3.x
 *
 * Generate a QR code
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\qrcode\twigextensions;

use kuriousagency\qrcode\QRCode;

use Craft;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * @author    Kurious Agency
 * @package   QRCode
 * @since     0.0.1
 */
class QRCodeTwigExtension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'QRCode';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new TwigFilter('qrcode', [$this, 'generate']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('qrcode', [$this, 'generate']),
        ];
    }

    /**
     * @param null $text
     *
     * @return string
     */
    public function generate($data, $size=null)
    {
        return QRCode::$plugin->service->generate($data, $size);
    }
}
