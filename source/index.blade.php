@extends('_layouts.main')

@section('body')
    <section class="text-center mb-24">
        <div class="mb-4">
            <img src="/assets/img/vincent.png" alt="Vincent Bergeron" class="w-32 h-32 rounded-full border-2 border-gray-700 mx-auto object-cover shadow-lg">
        </div>
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Vincent Bergeron</h1>
        <p class="text-xl text-gray-600">Software Developer <br> Specializing in PHP, Laravel, Livewire & Vue.js // Currently working <a target="_blank" href="https://tlmgo.com">@tlm</a></p>
    </section>

    <h2 class="underline">Latest articles</h2>
    @foreach ($posts->take(3) as $post)
        <div class="w-full mb-6">
            <p class="text-gray-700 font-medium my-2">
                {{ $post->getDate()->format('F j, Y') }}
            </p>

            <h3 class="text-2xl mt-0">
                <a href="{{ $post->getUrl() }}" title="Read {{ $post->title }}" class="text-gray-900 font-extrabold">
                    {{ $post->title }}
                </a>
            </h3>

            <p class="mt-0 mb-4">{!! $post->getExcerpt() !!}</p>

            <a href="{{ $post->getUrl() }}" title="Read - {{ $post->title }}" class="uppercase tracking-wide mb-4">
                Read
            </a>
        </div>

        @if (! $loop->last)
            <hr class="border-b my-6">
        @endif
    @endforeach
@stop
