---
extends: _layouts.post
section: content
title: "Understand Laravel Magic: How Models Dynamically Retrieves Attributes"
date: 2025-01-24
description: "Understand Laravel Magic: How Models Dynamically Retrieves Attributes"
---

I've been working with Laravel for almost eight years. For a long time, I didn’t fully understand what happens under the hood when accessing properties on a model instance and I'm sure that's the case for other Laravel developers.

Have you ever wondered how Laravel returns the correct value when calling `$user->email`, even though you never explicitly defined a `public $email` property on your model?
Or how Laravel lazy-loads the `posts` relationship when you call `$user->posts`, despite there being no `posts` property on your model?

In this post, I’ll explain how Laravel dynamically retrieves attributes on models and how it leverages PHP's magic methods to make it all work seamlessly.

#### PHP Overloading and the `__get` Magic Method

Laravel’s models rely on PHP’s [overloading](https://www.php.net/manual/en/language.oop5.overloading.php) capabilities, specifically the [__get](https://www.php.net/manual/en/language.oop5.overloading.php) magic method. This allows Laravel to intercept property access and execute custom logic when a property isn't explicitly defined.

When you call `$user->email`, if the property doesn’t exist, PHP invokes the `__get` magic method. Laravel takes advantage of this to dynamically retrieve the correct value. The diagram below illustrates this flow:

![model-attributes-diagram.jpg](/assets/img/model-attributes-diagram.jpg)

Here, "none of the above" means that `email` is not an existing or visible property on the class, it’s not present in the attributes array or an accessor, there is no method with the same name in the base Model class, and no relationship exists with that name.

I highly suggest that you enable Eloquent "strict" mode. This way, if `none of the above` happens, you'll receive an exception rather than a `null`.
