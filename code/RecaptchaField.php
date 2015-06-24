<?php

/**
 * The reCAPTCHA form field with validation logic.
 * @see https://github.com/google/recaptcha
 * @see https://developers.google.com/recaptcha/docs/verify#error-code-reference
 * Class RecaptchaField
 */
class RecaptchaField extends FormField {
    /**
     * JavaScript options array in the following form:
     *  array(
     *      'theme' => 'dark'
     *  );
     *
     * @see https://developers.google.com/recaptcha/docs/display#render_param
     * @var array
     */
    private $jsOptions = array();

    /**
     * CSS classes to apply to recaptcha base class
     * @var array
     */
    private $css = array();

    public function Field($properties = array()) {
        // Check if keys were given
        if( empty(SiteConfig::current_site_config()->RecaptchaSecret) ||
            empty(SiteConfig::current_site_config()->RecaptchaWebkey))
            user_error('Please specify valid reCAPTCHA API keys.', E_USER_ERROR);

        // Include Google's JS
        Requirements::javascript('https://www.google.com/recaptcha/api.js');

        // Build css class string
        $css = ' ' . implode(' ', $this->css);

        // Iterate over JavaScript options and build config markup for tag
        $jsOpt = '';
        foreach($this->jsOptions as $key=>$val) {
            $jsOpt .= "data-$key='$val' ";
        }

        // Return non-rendered field was div
        return "<div class='g-recaptcha $css' data-sitekey='" . SiteConfig::current_site_config()->RecaptchaWebkey . "' $jsOpt></div>";
    }

    public function validate($validator) {
        // Check if recaptcha response field was set
        if( !isset($_POST['g-recaptcha-response']) ||
            empty($_POST['g-recaptcha-response'])) {
            // Set error message and exit
            $validator->validationError(
                $this->name,
                _t('RecaptchaField.EMPTY', 'Please verify that you are not a robot.'),
                'validation'
            );

            return false;
        } else
            $captchaResponse = $_POST['g-recaptcha-response'];

        // Create reCAPTCHA instance
        $recaptcha = new \ReCaptcha\ReCaptcha(SiteConfig::current_site_config()->RecaptchaSecret);

        // Verify identity
        $validationResponse = $recaptcha->verify($captchaResponse, $_SERVER['REMOTE_ADDR']);

        // Handle validation errors
        if(!$validationResponse->isSuccess()) {
            // Loop over error codes
            foreach($validationResponse->getErrorCodes() as $err) {
                // TODO: Give precise error messages instead of the following generic one
            }

            // Set error message and exit
            $validator->validationError(
                $this->name,
                _t('RecaptchaField.ERROR', 'There was an error validating our identity.'),
                'validation'
            );

            return false;
        }

        // If you made it to this point you are validated as human - yeah!
        return true;
    }

    /**
     * Injection method for JavaScript options
     * @param $key
     * @param $val
     */
    public function settings($key, $val) {
        $this->jsOptions[$key] = $val;
    }

    /**
     * Add one (String) or more (Array) CSS classes to apply to the recaptcha base tag
     * @param $classes
     */
    public function setCSS($classes) {
        if(is_array($classes)) {
            foreach($classes as $class)
                $this->css[] = $class;
        } else
            $this->css[] = $classes;
    }
}