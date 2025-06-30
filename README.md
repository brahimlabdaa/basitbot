# BasitBot PHP Package

A simple PHP package to send messages using the [BasitBot API](https://basitbot.com).

---

## Installation

You can install the package via Composer:

```bash
composer require haladigitally/basitbot


Configuration (Laravel)
Publish the configuration file:

bash

php artisan vendor:publish --provider="Haladigitally\Basitbot\BasitbotServiceProvider" --tag=config
Add your BasitBot API credentials to your .env file:

.env

BASITBOT_ENDPOINT=https://basitbot.com/api/
BASITBOT_APP_KEY=your-app-key-here
BASITBOT_AUTH_KEY=your-auth-key-here


Basic example:

php
use Haladigitally\Basitbot\BasitBot;

$basitBot = new BasitBot();

// Send a simple text message
$response = $basitBot->sendText('RECEIVER_NUMBER', 'Hello from BasitBot!');

print_r($response);


| Method         | Description                     | Parameters                                                                  | Returns |
| -------------- | ------------------------------- | --------------------------------------------------------------------------- | ------- |
| `sendText`     | Send a text message             | `string $to`, `string $message`, `bool $sandbox = false`                    | `array` |
| `sendFile`     | Send a text message with a file | `string $to`, `string $message`, `string $fileUrl`, `bool $sandbox = false` | `array` |
| `sendTemplate` | Send a template message         | `string $to`, `string $templateId`, `array $variables`                      | `array` |
| `sendOtp`      | Send an OTP message             | `string $to`, `string $message`, `int $expireIn = 300`                      | `array` |



Examples


Send a Text Message

Edit
$response = $basitBot->sendText('966501234567', 'Hello, this is a test message!');
print_r($response);


Send a Text Message with File
php

$response = $basitBot->sendFile('966501234567', 'Please check the attached file.', 'https://example.com/file.pdf');
print_r($response);


Send a Template Message
php

$response = $basitBot->sendTemplate('966501234567', 'TEMPLATE_ID', [
    '{variableKey1}' => 'John',
    '{variableKey2}' => 'Doe',
]);
print_r($response);


Send an OTP Message
php

$response = $basitBot->sendOtp('966501234567', 'Your OTP is 123456', 300);
print_r($response);

License
The MIT License (MIT).
See LICENSE for details.

Contribution
Feel free to open issues or submit pull requests.

Contact
For questions or support, contact [basitbot.contact@gmail.com].
