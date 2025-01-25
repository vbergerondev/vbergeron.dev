<?php

use Illuminate\Support\Str;

return [
    'baseUrl' => '',
    'production' => false,
    'siteName' => './vbergeron.dev',
    'siteDescription' => 'Vincent is a Laravel/PHP Developer from Canada.',
    'siteAuthor' => 'Vincent Bergeron',

    'skills' => ['Laravel', 'PHP', 'Livewire', 'Alpine.js', 'Ruby on Rails', 'Vue.js', 'Docker', 'Git', 'SASS', 'TailwindCSS', 'HTML', 'CSS', 'Bootstrap', 'PHPUnit', 'Pest', 'jQuery', 'Linux', 'ci/cd', 'MySQL', 'Scrapy', 'DigitalOcean'],

    'collections' => [
        'posts' => [
            'author' => 'Vincent Bergeron',
            'sort' => '-date',
            'path' => 'blog/{filename}',
        ],
    ],

    'getDate' => function ($page) {
        return Datetime::createFromFormat('U', $page->date);
    },
    'getExcerpt' => function ($page, $length = 255) {
        if ($page->excerpt) {
            return $page->excerpt;
        }

        $content = preg_split('/<!-- more -->/m', $page->getContent(), 2);
        $cleaned = trim(
            strip_tags(
                preg_replace(['/<pre>[\w\W]*?<\/pre>/', '/<h\d>[\w\W]*?<\/h\d>/'], '', $content[0]),
                '<code>'
            )
        );

        if (count($content) > 1) {
            return $cleaned;
        }

        $truncated = substr($cleaned, 0, $length);

        if (substr_count($truncated, '<code>') > substr_count($truncated, '</code>')) {
            $truncated .= '</code>';
        }

        return strlen($cleaned) > $length
            ? preg_replace('/\s+?(\S+)?$/', '', $truncated) . '...'
            : $cleaned;
    },
    'isActive' => function ($page, $path) {
        return Str::endsWith(trimPath($page->getPath()), trimPath($path));
    },
];
