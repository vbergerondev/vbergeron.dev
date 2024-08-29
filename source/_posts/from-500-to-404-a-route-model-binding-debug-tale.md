---
extends: _layouts.post
section: content
title: "From 500 to 404: A Route Model Binding Debug Tale"
date: 2024-08-29
description: "From 500 to 404: A Route Model Binding Debug Tale"
author: Vincent Bergeron
---

Today, I had an interesting pairing session with a fellow developer at work. 
We were going over one of their controllers when I noticed they weren't using Laravel's [Route Model Binding](https://laravel.com/docs/11.x/routing#route-model-binding) in the project.
Since it was a relatively small and simple controller, I took the opportunity to show them how this feature works and how it can simplify the code.

The process started smoothly. We updated the route definition by changing the parameter from `user_id` to `user` and type-hinted the User model in the controller action. 
The best part? They already had an automated test for this controller action! The test existed ensure what happens if the `user_id` was associated to no existing user.
So, all we had to do was adjust the test, changing the route parameter to match the new setup, and then run the tests.

To our surprise, the test failed.

Instead of getting a `404` for a non-existent user (like before), the controller threw a `500` error. This was unexpected because Laravel is supposed to return a `404` if a model can’t be found.
After a bit of head-scratching and some investigation, we noticed that the controller was actually receiving an empty User model, with its `attributes` array completely empty.

After spending more time than we’d like to admit tracking down the issue, we finally found the culprit: the `setUp` method in the test class. 
It contained a `$this->withoutMiddleware()` call, hidden away near the bottom of the method, which we had initially overlooked. This line of code was the problem.

Laravel's Route Model Binding comes from the `SubstituteBindings` middleware. Since the middleware was being bypassed, Laravel couldn't handle the binding, and instead, it injected an empty user model.

Once we removed the `withoutMiddleware()` call, the tests passed successfully, and everything behaved as expected, with Laravel returning the appropriate `404` error for a missing user.


This gave me a good refresh about how Route Model Binding works, and next time I'll make sure to triple-check the `setUp` method!
