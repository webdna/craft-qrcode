<?php
/**
 * QRCode plugin for Craft CMS 3.x
 *
 * Generate a QR code
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\qrcode\fields;

use kuriousagency\qrcode\QRCode;
// use kuriousagency\qrcode\assetbundles\qrcodefieldfield\QRCodeFieldFieldAsset;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;
use craft\helpers\Template;

/**
 * @author    Kurious Agency
 * @package   QRCode
 * @since     0.0.1
 */
class QRCodeField extends Field
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $property;

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('qrcode', 'QR Code');
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules = array_merge($rules, [
            ['property', 'string'],
			['property', 'required'],
        ]);
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function getContentColumnType(): string
    {
        return Schema::TYPE_STRING;
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue($value, ElementInterface $element = null)
    {
		$type = explode('\\',get_class($element));
		$type = strtolower(end($type));
		$data = Craft::$app->getView()->renderString($this->property, [$type=>$element]);
		$data = preg_replace( "/\r|\n/", "", $data);
		$value = QRCode::$plugin->service->generateQRCode(json_decode($data));

		return $value;
    }

    /**
     * @inheritdoc
     */
    public function serializeValue($value, ElementInterface $element = null)
    {
        return parent::serializeValue($value, $element);
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        // Render the settings template
        return Craft::$app->getView()->renderTemplate(
            'qrcode/_components/fields/QRCodeField_settings',
            [
                'field' => $this,
            ]
        );
	}

    /**
     * @inheritdoc
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        // Register our asset bundle
		// Craft::$app->getView()->registerAssetBundle(QRCodeFieldFieldAsset::class);
		//if (!$value) {
		//	$value = $this->_getValue($element);
		//}

        // Get our id and namespace
        $id = Craft::$app->getView()->formatInputId($this->handle);
        $namespacedId = Craft::$app->getView()->namespaceInputId($id);

        // Variables to pass down to our field JavaScript to let it namespace properly
        $jsonVars = [
            'id' => $id,
            'name' => $this->handle,
            'namespace' => $namespacedId,
            'prefix' => Craft::$app->getView()->namespaceInputId(''),
            ];
        $jsonVars = Json::encode($jsonVars);
        // Craft::$app->getView()->registerJs("$('#{$namespacedId}-field').QRCodeQRCodeField(" . $jsonVars . ");");

        // Render the input template
        return Craft::$app->getView()->renderTemplate(
            'qrcode/_components/fields/QRCodeField_input',
            [
                'name' => $this->handle,
                'value' => Template::raw($value),
                'field' => $this,
                'id' => $id,
                'namespacedId' => $namespacedId,
            ]
        );
    }
}
