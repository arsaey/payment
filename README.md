# Blognevis/Payments

`blognevis/payments` is a PHP package that integrates three payment libraries—Zarinpal, Plisio, and NowPayments—into a single, unified interface. This package simplifies the process of handling payments from multiple providers in your Laravel application.

## Table of Contents

- [Description](#description)
- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [Configuration](#configuration)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Description

The `blognevis/payments` package provides a seamless way to manage payments through Zarinpal, Plisio, and NowPayments using a consistent API. It is built on top of these libraries, offering a unified approach to handle various payment processes, including requests and verifications.

## Installation

To install the package, run the following command using Composer:

```
composer require blognevis/payments
```

After installation, publish the configuration file with Artisan:

```
php artisan vendor:publish --tag=config
```

This will allow you to customize the package's settings according to your application's needs.

## Usage

The package simplifies payment operations with easy-to-use routes and facades. Below is an example of how to request a payment using NowPayments and then verify it.

### Requesting a Payment

```
Route::get('/request-nowpayments', function () {
    $params = [
        "price_amount" => 1000,
        "price_currency" => "usd",
        "order_id" => "RGDBP-21314",
        "order_description" => "Apple Macbook Pro 2019 x 1",
        "ipn_callback_url" => "https://nowpayments.io",
        "success_url" => url('/verify-nowpayments'),
        "cancel_url" => url('/verify-nowpayments')
    ];
    $res = (new Payment('nowpayments'))->pay($params);
    return redirect($res['payment_url']);
});
```

### Verifying a Payment

```
Route::get('/verify-nowpayments', function () {
    $res = (new Payment('nowpayments'))->verify(request()->get('NP_id'));
    return response()->json($res);
});
```

### Accessing the Main Libraries

You can directly access the underlying payment libraries through the provided facades:

- `NowpaymentFacade`
- `PlisioPaymentFacade`
- `ZarinpalPaymentFacade`

This allows you to utilize the full capabilities of each payment library while still benefiting from the unified interface.

## Features

- **Unified Interface**: Combines Zarinpal, Plisio, and NowPayments into a single package for easier management.
- **Logging and Monitoring**: Provides a log route for monitoring payment activities.
- **Customizable Dashboard**: Access the log dashboard via `http://localhost:8000/blognevis-payments?dashboard_key=password`. The path and password can be customized in the configuration file.

## Configuration

After publishing the configuration file, you can find it in the `config` directory of your Laravel application. Here, you can set the paths, credentials, and other settings necessary for integrating the payment gateways.

## Contributing

If you'd like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Commit your changes (`git commit -am 'Add new feature'`).
5. Push to the branch (`git push origin feature-branch`).
6. Create a new Pull Request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For more information or support, feel free to contact us at [your-email@example.com].
