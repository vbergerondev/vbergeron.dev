---
title: About
description: A little bit about the site
---
@extends('_layouts.main')

@section('body')
    <h1>About</h1>

    <img src="/assets/img/vincent.png"
        alt="About image"
        class="flex rounded-full h-64 w-64 bg-contain mx-auto md:float-right my-6 md:ml-10">

    <p class="mb-6">
        Hey there! I'm Vincent Bergeron. Coding has been my passion for over a decade now. It all began back in 2013 when I started with basic HTML, but I quickly found my stride with PHP, which just clicked for me. Around the same time, I enrolled in an OpenClassrooms course (then known as Site du Zéro) to really master PHP & MySQL.
    </p>

    <p class="mb-6">
        As a young developer, I eagerly followed my favorite YouTuber's tutorials, diving into frameworks like Rails and CakePHP. Then, in 2017, while working on a school project, I discovered Laravel and was immediately captivated by its power and elegance. The project also pushed me to learn Vue.js. Since then, I've been hooked. This journey solidified my passion for modern web development tools, guiding me towards specializing in Laravel.
    </p>

    <p class="mb-6">
        In 2018, I joined my current company, where I've embraced continuous learning and adopted best practices in software development. Leading teams and tackling complex projects in Laravel and Rails have been incredibly rewarding, allowing me to apply my passion for solving intricate problems through meticulous coding.
    </p>

    <h3 class="mt-20">Skills</h3>
    @foreach($page->skills as $skill)
        <code class="lowercase">{{$skill}}</code>
    @endforeach

@endsection
