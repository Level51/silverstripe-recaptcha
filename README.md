# reCAPTCHA fancy
Google's neue "high-intelligence" reCAPTCHA Lösung als SilverStripe Modul bzw. Datafield.

---
# Features
- Verwaltung von reCAPTCHA Credentials via SiteConfig im Backend.
- AJAX-Kompatibilität
- Integration mit UserForms Modul
- Custom CSS Klassen: `$captcha->setCSS(array('test1', 'test2'));`

---
# JavaScript Options
* theme: dark, light (default)
* type: audio, image (default)
* size: compact, normal (default),
* tabindex: Dezimalzahlen (0 ist default)
* callback: Wird im Erfolgsfall ausgelöst und erhält *g-recaptcha-response* als Parameter
* expired-callback: Wird ausgelöst wenn die aktuelle Captcha Session abgelaufen ist und der User ein Neues lösen muss

Beispiel zur Verwendung:

```php
$captcha = RecaptchaField::create('Captcha');
$captcha->settings('theme', 'dark');
```

---
# Dependencies
- "php": ">=5.3.2"
- "google/recaptcha": "~1.1"

---
# Notizen
- Für Tests auf dem localhost können jegliche Credentials verwendet werden.

---
# Checkout
- https://github.com/google/recaptcha
- https://www.google.com/recaptcha/intro/index.html
- https://github.com/chillu/silverstripe-recaptcha
- https://developers.google.com/recaptcha/docs/verify#error-code-reference

---
# Maintainers
- Julian Scheuchenzuber <js@lvl51.de>
- Daniel Kliemsch <dk@lvl51.de>