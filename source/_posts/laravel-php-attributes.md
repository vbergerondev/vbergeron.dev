---
extends: _layouts.post
section: content
title: "Laravel's PHP attributes"
date: 2025-02-02
author: Vincent Bergeron
description: "Laravel's PHP attributes"
---
Happy New Year!

Lately I've been quite excited by **Laravel's PHP attributes**.

>Attributes offer the ability to add structured, machine-readable metadata information on declarations in code: Classes, methods, functions, parameters, properties and class constants can be the target of an attribute.
>
> Source: [https://www.php.net/manual/en/language.attributes.overview.php](https://www.php.net/manual/en/language.attributes.overview.php)

Laravel offers some attributes out-of-the-box and I found a [very good article](https://nabilhassen.com/complete-guide-to-laravel-and-livewire-php-attributes-23-attributes) on X describing all of them.

My favourite one (and the one I use the most) is `#[Config(...)]`

Before, you would have to initialize the property yourself:
```php
<?php

class Service {
    private string $apiKey;
    
    public function __construct()
    {
        $this->apiKey = config('services.api_key');
    }
}
```

Now, you can use the `Config` attribute to inject the configuration value automatically and leverage PHP's constructor property promotion at the same time.
```php
<?php

use Illuminate\Container\Attributes\Config;

class Service {
    public function __construct(
        #[Config('services.api_key')] private string $apiKey,
    )
    {
        //
    }
}
```

Feel free to take a look at [this blog post](https://nabilhassen.com/complete-guide-to-laravel-and-livewire-php-attributes-23-attributes) for a more in-depth look at all attributes Laravel (and Livewire) has to offer.
