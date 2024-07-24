---
extends: _layouts.post
section: content
title: My contribution to laravel/fortify 🎉
date: 2024-07-24
description: My contribution to laravel/fortify
author: Vincent Bergeron
---

Last week, my intern and I was working on a feature that adds logs everytime an 2FA relation action happened. We use Laravel Fortify and even though Fortify already dispatches a lots of events in various cases, there was no built-in event dispatching when the user failed the 2FA challenge. It was a great opportunity to open my first PR and do the work instead of opening an issue and begging for the Laravel team to fix the issue for me.


Monday of this week, Taylor merged the [pull request](https://github.com/laravel/fortify/pull/558)! I was pretty happy and really loved the experience. I'll try to create more of these in the future. It was also a great experience for my intern to help me contribute to an open source package.