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
        $fields->addFieldToTab('Root.Recaptcha', \HtmlEditorField_Readonly::create('RecaptchaLink', _t('RecaptchaConfig.LINK', 'Link to admin panel'), '<a href="https://www.google.com/recaptcha/admin">https://www.google.com/recaptcha/admin</a>'));
        $fields->addFieldToTab('Root.Recaptcha', \ReadonlyField::create('RecaptchaVersion', _t('RecaptchaConfig.VERSION', 'reCAPTCHA version'), \ReCaptcha\ReCaptcha::VERSION));
    }
}