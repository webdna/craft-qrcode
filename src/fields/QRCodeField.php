<?php
/**
 * QRCode plugin for Craft CMS 4.x
 *
 * Generate a QR code
 *
 * @link      https://webdna.co.uk
 * @copyright Copyright (c) 2019 webdna
 */

namespace webdna\qrcode\fields;

use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use webdna\qrcode\QRCode;

// use webdna\qrcode\assetbundles\qrcodefieldfield\QRCodeFieldFieldAsset;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;
use craft\helpers\Template;

/**
 * @author    webdna
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
    public string $property = '';

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
    public function rules(): array
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
        return Schema::TYPE_TEXT;
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue(mixed $value, ?ElementInterface $element = null): mixed
    {
        $type = explode('\\', get_class($element));
        $type = strtolower(end($type));
        try {
            $data = Craft::$app->getView()->renderString($this->property, [$type => $element]);
        } catch (LoaderError|SyntaxError $e) {
            Craft::$app->getErrorHandler()->logException($e);
        }
        $data = preg_replace("/\r|\n/", "", $data);
        return QRCode::$plugin->service->generate($this->_decodeOrReturn($data));
    }

    /**
     * @inheritdoc
     */
    public function serializeValue(mixed $value, ?ElementInterface $element = null): mixed
    {
        return parent::serializeValue($value, $element);
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml(): ?string
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
    public function getInputHtml(mixed $value, ?ElementInterface $element = null): string
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

    private function _decodeOrReturn(mixed $input)
    {
        $decoded = json_decode($input, true);
        return $decoded ?? $input;
    }
}
