---
extends: _layouts.post
section: content
title: "How a Post Helped Me Identify and Fix Multiple SQL Queries on a Single Table in the Same HTTP Request"
date: 2025-01-13
description: "A simple post led me to uncover and resolve an issue where multiple SQL queries were being made on the same table during a single HTTP request. Here's how I fixed it."
author: Vincent Bergeron
---
In very early January, I was casually hanging out on X when I came across [a very insightful post](https://x.com/ste_bau/status/1875175531282346400).

The post explained a simple but powerful concept: if you're executing something computationally heavy, and it's called multiple times in a single request, you can leverage Laravel's `once` helper. This helper ensures that the callback you pass to it is executed only the first time it’s called. After that, it caches the result in memory and simply returns it on subsequent calls within the same request.

Naturally, this piqued my interest. I immediately dove into our codebase to see if there was any part of the application that could benefit from this technique. After a quick investigation (and a little help from Sentry's performance tab), I found something interesting: a query to our `settings` table that was being executed far too many times.

Here’s what the original code looked like:

```php
public static function getValue(string $name): ?string
{
    /** @var ?Setting $setting */
    $setting = self::query()->where('Name', '=', $name)->first();

    return $setting?->Value;
}
```

On the surface, this code is simple and effective—it fetches the Value of a specific Name from the settings table. However, the issue arose when this method was called multiple times during a single request. Each call resulted in a separate query to the database, which quickly added up and became a performance bottleneck.

#### The Fix

Inspired by the post, I refactored the code to use the once helper. Here's the updated version:
```php
public static function getValue(string $name): ?string
{
    $values = once(fn (): Collection => self::query()->pluck('Value', 'Name'));

    return $values[$name] ?? null;
}
```

Let’s break this down:

- **Caching the Query Result**:
  The first time `getValue` is called, the `once` helper executes the callback. This callback fetches all rows from the settings table, mapping `Name` to `Value` using the pluck method.


- **Storing in Memory:** The result is stored in memory as an array (or technically a Collection in Laravel).


- **Reusing the Data:** On subsequent calls to `getValue` within the same request, the cached array is returned directly, avoiding additional database queries.

This small change had a big impact: instead of executing multiple queries for every page load, our app now executes just one query per request—no matter how many times `getValue` is called.

#### Bonus Tip: Clearing the Cache

If you ever need to clear the cached result during a request, you can call:

`Once::flush();`

This will clear all cached results, allowing the once helper to recompute values when called again.

If you haven’t already, I highly recommend exploring your app’s performance metrics (tools like Sentry or Laravel Telescope are great for this) and keeping an eye out for opportunities to use once. You might be surprised at the difference it can make!

You can read more about Laravel's `once` helper here: [https://laravel.com/docs/11.x/helpers#method-once](https://laravel.com/docs/11.x/helpers#method-once)
