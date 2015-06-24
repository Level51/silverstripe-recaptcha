<?php
/**
 * Used with the User Defined Forms module (if installed) to allow the users to have captcha fields with their custom forms.
 * Class EditableRecaptchaField
 */
if(class_exists('EditableFormField')) {
    class EditableRecaptchaField extends EditableFormField {
        private static $singular_name = 'reCAPTCHA Field';
        private static $plural_name = 'reCAPTCHA Fields';

        public function getFormField() {
            return RecaptchaField::create($this->Title);
        }

        public function getRequired() {
            return true;
        }

        public function getIcon() {
            return 'recaptcha-fancy/images/recaptcha_logo.png';
        }

        public function showInReports() {
            return false;
        }
    }
}