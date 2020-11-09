# SignUpr
This PHP based Web Application lets people sign your "Initiative" or "Referendum" online (to the extent the law allows them to). This means that they can **fill out a form** which generates a **personal signature sheet** (called a "Signature Bogen") which is being sent to them via Mail. They will be able to send it back to you via postal service. Once it arrives at your place, you will be able to scan the personal QR-Code, which is printed on the sheet which allows you to register how many signatures were returned to your place.

The app was originally created for the Initiative "Gratis ÖV für Züri" by JUSO Stadt Zürich. [See a live and working example here](http://sign.gratis-oev-zueri.ch/) 



# Requirements

- PHP 7+
- MySQL 5+
- PHP mail() function enabled



# Dependencies

- [FPDF](https://github.com/Setasign/FPDF)
- [QR Code extension for FPDF](https://prgm.spipu.net/view/27)
- [PHP Mailer](https://github.com/PHPMailer/PHPMailer)



# Roadmap

- [x] Basic Setup
- [x] Peronalize Mail messages
- [x] Shortcodes for Mail messages
- [ ] Personalize FrontEnd form (signature form)



Thank you to all the contributers!

Feedback can be sent here: hoi@kpunkt.ch

<a href="https://www.buymeacoffee.com/timothyoesch"><img src="https://img.buymeacoffee.com/button-api/?text=Buy me a coffee&emoji=❤️&slug=timothyoesch&button_colour=FF5F5F&font_colour=ffffff&font_family=Cookie&outline_colour=000000&coffee_colour=FFDD00"></a>

