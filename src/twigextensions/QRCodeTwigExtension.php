<?php
/**
 * QRCode plugin for Craft CMS 4.x
 *
 * Generate a QR code
 *
 * @link      https://webdna.co.uk
 * @copyright Copyright (c) 2019 webdna
 */

namespace webdna\qrcode\twigextensions;

use webdna\qrcode\QRCode;

use Craft;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * @author    webdna
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
    public function getName(): string
    {
        return 'QRCode';
    }

    /**
     * @inheritdoc
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('qrcode', [$this, 'generate']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions(): array
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
    public function generate($data, $size=null): string
    {
        return QRCode::$plugin->service->generate($data, $size);
    }
}
