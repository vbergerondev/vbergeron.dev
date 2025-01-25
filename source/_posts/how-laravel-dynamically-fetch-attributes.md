---
extends: _layouts.post
section: content
title: "Understand Laravel Magic: How Eloquent Models Dynamically Retrieves Attributes"
date: 2025-01-24
description: "Understand Laravel Magic: How Eloquent Models Dynamically Retrieves Attributes"
---

I've been working with Laravel for almost eight years, and I think I know Eloquent pretty well. But for a long time, I didn’t fully understand what happens under the hood when accessing properties on a model instance—and I’m sure I’m not the only Laravel developer who felt that way.


Have you ever wondered how Laravel returns the correct value when calling `$user->email`, even though you never explicitly defined a `public $email` property on your Eloquent model?
Or how Laravel lazy-loads the `posts` relationship when you call `$user->posts`, despite there being no `posts` property on your model?

In this post, I’ll explain how it dynamically retrieves attributes on models and how it leverages PHP's magic methods to make it all work seamlessly.

#### PHP Overloading and the `__get` Magic Method

Eloquent models rely on PHP’s [overloading](https://www.php.net/manual/en/language.oop5.overloading.php) capabilities, specifically the [__get](https://www.php.net/manual/en/language.oop5.overloading.php) magic method. This allows to intercept property access and execute custom logic when a property isn't explicitly defined.

When you call `$user->email`, if the property doesn’t exist, PHP invokes the `__get` magic method. In the case of Laravel, the `__get` method is defined on the base `Model` class. Laravel takes advantage of this to dynamically retrieve the correct value. The diagram below illustrates this flow:

![model-attributes-diagram.jpg](/assets/img/model-attributes-diagram.jpg)

Here, "none of the above" means that you're trying to fetch something that does not exist. In this case, an exception will be thrown or null will be returned.

In Laravel [9.35.0](https://github.com/laravel/framework/releases/tag/v9.35.0), a new `Model::shouldBeStrict` method was introduced which adds a "strict" mode to Eloquent models. 
This mode, among other things, will prevent access to non-existent attributes by throwing an exception instead of returning `null`. If you're not familiar with it, I suggest that you watch this [free Laracasts video](https://laracasts.com/series/jeffreys-larabits/episodes/29).
