## Maintainers
- Julian Scheuchenzuber <js@lvl51.de>
- Daniel Kliemsch <dk@lvl51.de>

## Installation
```
composer require level51/silverstripe-recaptcha
```

If you don't like composer you can just download and unpack it to the root of your SilverStripe project.

## Features
- reCAPTCHA administration via SiteConfig.
- AJAX-Compatibility.
- Integration with *UserForms* module
- Custom CSS classes: `$captcha->setCSS(array('test1', 'test2'));`

## JavaScript Options
* theme: dark, light (default)
* type: audio, image (default)
* size: compact, normal (default)
* tabindex: Decimal (0 is default)
* callback: Is invoked if validation was successful and receives *g-recaptcha-response* as parameter.
* expired-callback: Is invoiked when current captcha session was expired. The user will have to "solve" a new captcha.

Example usage:

```php
$captcha = RecaptchaField::create('Captcha');
$captcha->settings('theme', 'dark');
```

## Dependencies
- "php": ">=5.3.2"
- "google/recaptcha": "~1.1"

## Notes
- For testing on localhost you may use any credentials.

## Checkout
- https://github.com/google/recaptcha
- https://www.google.com/recaptcha/intro/index.html
- https://github.com/chillu/silverstripe-recaptcha
- https://developers.google.com/recaptcha/docs/verify#error-code-reference