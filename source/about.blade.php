---
title: About
description: About me
---
@extends('_layouts.main')

@section('body')
    <h1>About</h1>

    <p class="mb-6">
        My name is Vincent. I'm a 26-year-old father of two, living in Québec, Canada.
        <br><br>
        From a young age, I was fascinated by computers and video games. It was always clear to me that I wanted to create websites for a living. Back in 2013, while still in high school, I decided it was time to start learning on my own through YouTube tutorials and online courses. I began with the basics of HTML, CSS, and JavaScript, quickly advancing to PHP and MySQL.
        <br><br>
        In 2016–2017, I attended <a href="https://www.multihexa.quebec/" target="_blank">Collège Multihexa</a>, where I was introduced to Laravel and Vue.js. While I already had experience with frameworks like CodeIgniter, CakePHP, and Ruby on Rails, discovering Laravel and its ecosystem was a transformative moment. I became deeply passionate about Laravel and have made it a priority to stay up-to-date with its developments every single day since then.
        <br><br>
        Fast forward to now: I've been working at the same company for 7 years, gaining extensive experience building a wide variety of Laravel applications. One of the most rewarding aspects of my role has been mentoring junior developers and interns, helping them get started with Laravel and guiding them as they grow. Sharing my passion for the framework and watching others develop their skills has been an incredibly fulfilling part of my journey.
    </p>

    <h3 class="mt-20">Skills</h3>
    @foreach($page->skills as $skill)
        <code class="lowercase">{{$skill}}</code>
    @endforeach

@endsection
