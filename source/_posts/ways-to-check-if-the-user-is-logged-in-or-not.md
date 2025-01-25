---
extends: _layouts.post
section: content
title: Ways to Check if the User is Logged In or Not
date: 2024-07-11
description: Ways to Check if the User is Logged In or Not
---
In Laravel, there are many ways to check whether a user is logged in. In this post, I will demonstrate my favorite methods for performing these checks. A lot of people use `auth()->user()`, but Laravel offers us other methods to avoid using negation.

### Checking if the User is Logged In

Although some people might tend to use `auth()->user()`, I prefer `check` as it returns a boolean.

```php
<?php

if (auth()->check()) {
    // The user is logged in
}

// You can also use the following, which does the same thing as `check`
if (auth()->hasUser()) {
    // The user is logged in
}
```

### Checking if the User is Not Logged In

I prefer this over using `!auth()->check()` or `auth()->user() === null` because `guest` clearly indicates that the user is not recognized by the system.

```php
<?php

if (auth()->guest()) {
    // The user is not logged in
}
```

I try to limit my use of `auth()->user()` to situations where I need the current user to ensure my code is as clean as possible and easy to understand by avoiding negation in my conditionals.

My posts are short for now. I am trying to get used to writing and hope to be able to write longer content in the future, but I hope it is still useful to you. 🙂
