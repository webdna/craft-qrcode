<?php
/**
 * QRCode plugin for Craft CMS 3.x
 *
 * Generate a QR code
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\qrcode;

use kuriousagency\qrcode\services\QRCodeService;
use kuriousagency\qrcode\variables\QRCodeVariable;
use kuriousagency\qrcode\twigextensions\QRCodeTwigExtension;
use kuriousagency\qrcode\fields\QRCodeField as QRCodeFieldField;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Fields;
use craft\web\twig\variables\CraftVariable;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;

/**
 * Class QRCode
 *
 * @author    Kurious Agency
 * @package   QRCode
 * @since     0.0.1
 *
 * @property  QRCodeServiceService $qRCodeService
 */
class QRCode extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var QRCode
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '0.0.1';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
		self::$plugin = $this;
		
		$this->setComponents([
			'service' => QRCodeService::class,
		]);

        Craft::$app->view->registerTwigExtension(new QRCodeTwigExtension());

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = QRCodeFieldField::class;
            }
        );

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('qrcode', QRCodeVariable::class);
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'qrcode',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
