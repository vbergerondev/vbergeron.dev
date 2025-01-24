@extends('_layouts.main')

@section('body')
    <section class="text-center mb-20">
        <p class="text-2xl text-gray-600">
            <span class="font-bold">Vincent Bergeron - Software Developer</span>
            <br>
            Specializing in PHP, Laravel, Livewire & Vue.js</p>
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
