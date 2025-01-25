---
extends: _layouts.post
section: content
title: My contribution to laravel/fortify 🎉
date: 2024-07-24
description: My contribution to laravel/fortify
---

Last week, my intern and I were working on a feature that adds logs every time a 2FA-related action occurs. We use Laravel Fortify, and even though Fortify already dispatches a lot of events in various cases, there was no built-in event dispatching when the user failed the 2FA challenge. It was a great opportunity to open my first PR and do the work instead of opening an issue and begging the Laravel team to fix it for me.

On Monday of this week, Taylor merged the [pull request](https://github.com/laravel/fortify/pull/558)! I was pretty happy and really loved the experience. I'll try to create more of these in the future. It was also, I think, a great experience for my intern to help me contribute to an open source package.
