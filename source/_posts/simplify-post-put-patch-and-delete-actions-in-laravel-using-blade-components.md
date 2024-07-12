---
extends: _layouts.post
section: content
title: Simplify POST, PUT, PATCH and DELETE Actions in Laravel using Blade components
date: 2024-07-12
description: Simplify POST, PUT, PATCH and DELETE Actions in Laravel using Blade components
author: Vincent Bergeron
---

When we create a link on a page to redirect the user to another page, it uses a GET request. However, if you want a user to click on a link that executes a DELETE request (e.g., `DELETE /posts/1`), you will need a form to handle that for you. This is because if your route definition uses the `DELETE` verb, a user cannot visit that page from the URL as they would when visiting a normal page.

If you are building a backend application, chances are you have already created forms like this before:

```html
<form action="/posts/1" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete post</button>
</form>
```

And that’s totally fine. But over time, I found that it was taking up too much space in my HTML code, and a better idea came to mind:

```html
<x-action-button method="DELETE" action="/posts/1">
    Delete post
</x-action-button>

<!-- action-button.blade.php -->
@props(['action', 'method' => 'POST'])
<form action="{{ $action }}" method="POST">
    @csrf
    @method($method)
    <button type="submit">{{ $slot }}</button>
</form>
```

Behind the scenes, the Blade component generates the same code as above, but now we can achieve the same result using fewer lines of code.

It's not impressive, I admit. I’m sure many of you already have such a component in your projects. However, this sparked an idea for further improvement. What if we could, if desired, ask the user to confirm their password in a modal before the form is submitted? How would we do that using our favorite tools (Livewire, Alpine.js, Blade components) with a very minimal amount of JavaScript code? Well, I had to create this recently and will discuss it further in the next post 🙂
