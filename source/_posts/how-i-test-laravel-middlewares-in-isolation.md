---
extends: _layouts.post
section: content
title: How I test Laravel Middlewares in isolation
date: 2024-07-10
description: How I test Laravel Middlewares in isolation
---

Not so long ago, a colleague of mine showed me a method to test middlewares that totally changed how I test them now.

For a long time, I tested middlewares by creating a fake Laravel request, instantiating the middleware, and calling the `handle method with my fake $request object. This approach was working but caused some problems, such as handling an authenticated user or adding POST data. This required a deep understanding of Laravel requests, which is beneficial but added complexity to writing tests.

Luckily for us, there's an easier way to do it. The method consists of registering a fake route and attaching a middleware to it in the test itself.

```php
<?php

#[Test]
public function non_admin_gets_a_forbidden_response(): void
{
    $user = User::factory()->create(['is_admin' => false]);

    Route::get('/foo', fn(): Response => response('OK'))
        ->middleware(AuthorizeAdmin::class);

    $this->actingAs($user)
        ->get('/foo')
        ->assertForbidden();
}
```

This way, we are still testing the middleware in isolation, and we get to use Laravel's built-in get method instead of calling the handle method on the middleware ourselves.
