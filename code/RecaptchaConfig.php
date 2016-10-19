<?php

/**
 * Basic configuration for providing a secret API-key via SiteConfig.
 * Class RecaptchaConfig
 */
class RecaptchaConfig extends DataExtension {

    private static $db = array(
        'RecaptchaSecret' => 'Varchar(40)',
        'RecaptchaWebkey' => 'Varchar(40)'
    );

    public function updateCMSFields(\FieldList $fields) {
        $fields->addFieldToTab('Root.Recaptcha', \TextField::create('RecaptchaSecret', _t('RecaptchaConfig.SECRET', 'Secret API-key')));
        $fields->addFieldToTab('Root.Recaptcha', \TextField::create('RecaptchaWebkey', _t('RecaptchaConfig.WEB_KEY', 'Website key')));
        $fields->addFieldToTab('Root.Recaptcha', \HtmlEditorField_Readonly::create('RecaptchaLink', _t('RecaptchaConfig.LINK', 'Link to admin panel'), '<a href="https://www.google.com/recaptcha/admin" target="_blank">https://www.google.com/recaptcha/admin</a>'));
        $fields->addFieldToTab('Root.Recaptcha', \ReadonlyField::create('RecaptchaVersion', _t('RecaptchaConfig.VERSION', 'reCAPTCHA version'), \ReCaptcha\ReCaptcha::VERSION));
    }

    /**
     * Sets default credentials if lacking but given in config.
     */
    public function requireDefaultRecords() {
        parent::requireDefaultRecords();
        $sC = SiteConfig::current_site_config();

        if (!$sC->RecaptchaSecret &&
            ($secret = Config::inst()->get('Recaptcha', 'secret'))) {
            $sC->RecaptchaSecret = $secret;
            $sC->write();
            DB::alteration_message('Added recaptcha web secret', 'changed');
        }

        if (!$sC->RecaptchaWebkey &&
            ($key = Config::inst()->get('Recaptcha', 'key'))) {
            $sC->RecaptchaWebkey = $key;
            $sC->write();
            DB::alteration_message('Added recaptcha key', 'changed');
        }
    }
}