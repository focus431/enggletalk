@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">英語學習部落格</li>
                    </ol>
                </nav>
                <h1 class="breadcrumb-title">英語學習部落格</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                @foreach($blogPosts as $post)
                <article class="blog-post">
                    <div class="blog-header">
                        <figure class="blog-thumbnail">
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid" loading="lazy">
                        </figure>
                        <h2 class="blog-title">
                            <a href="/blog/{{ $post->slug }}">{{ $post->title }}</a>
                        </h2>
                    </div>
                    <div class="blog-info">
                        <span class="blog-category">{{ $post->category }}</span>
                        <span class="blog-date">{{ $post->created_at->format('Y-m-d') }}</span>
                    </div>
                    <div class="blog-content">
                        <p>{{ $post->excerpt }}</p>
                        <a href="/blog/{{ $post->slug }}" class="read-more">閱讀更多</a>
                    </div>
                </article>
                @endforeach

                <!-- Pagination -->
                {{ $blogPosts->links() }}
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 col-md-12">
                <div class="blog-sidebar">
                    <!-- Categories -->
                    <div class="card category-widget">
                        <div class="card-header">
                            <h4 class="card-title">文章分類</h4>
                        </div>
                        <div class="card-body">
                            <ul class="categories">
                                <li><a href="#">英語會話技巧</a></li>
                                <li><a href="#">商業英語</a></li>
                                <li><a href="#">考試準備</a></li>
                                <li><a href="#">學習方法</a></li>
                                <li><a href="#">文法教學</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Latest Posts -->
                    <div class="card post-widget">
                        <div class="card-header">
                            <h4 class="card-title">最新文章</h4>
                        </div>
                        <div class="card-body">
                            <ul class="latest-posts">
                                @foreach($latestPosts as $post)
                                <li>
                                    <div class="post-thumb">
                                        <a href="/blog/{{ $post->slug }}">
                                            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4>
                                            <a href="/blog/{{ $post->slug }}">{{ $post->title }}</a>
                                        </h4>
                                        <p>{{ $post->created_at->format('Y-m-d') }}</p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->

@php
use Spatie\SchemaOrg\Schema;

$blogPosts = $blogPosts->map(function($post) {
    return Schema::blogPosting()
        ->headline($post->title)
        ->articleBody($post->excerpt)
        ->image($post->image)
        ->datePublished($post->created_at)
        ->dateModified($post->updated_at)
        ->author(
            Schema::person()
                ->name($post->author_name)
        )
        ->publisher(
            Schema::organization()
                ->name('EnggleTalk')
                ->logo('https://enggle.com.tw/logo.png')
        );
});

$blogPage = Schema::collectionPage()
    ->name('英語學習部落格')
    ->description('提供實用的英語學習技巧、考試準備方法和商業英語教學文章')
    ->hasPart($blogPosts);

echo $blogPage->toScript();
@endphp
@endsection