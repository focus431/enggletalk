<?php $page="blank-page";?>
@extends('layout.mainlayout')
@section('content')		
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">常見問題</li>
                    </ol>
                </nav>
                <h1 class="breadcrumb-title">常見問題</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="faq-section">
                    <div class="faq-item mb-4">
                        <h2 class="h5">如何開始線上英文課程？</h2>
                        <p>註冊帳號後，您可以選擇喜歡的外籍教師，並預約您方便的時間進行一對一線上英文課程。</p>
                    </div>
                    <div class="faq-item mb-4">
                        <h2 class="h5">課程費用如何計算？</h2>
                        <p>我們提供多種課程方案，您可以根據自己的需求選擇適合的課程包。詳細價格請參考課程方案頁面。</p>
                    </div>
                    <div class="faq-item mb-4">
                        <h2 class="h5">如何選擇適合的老師？</h2>
                        <p>您可以查看每位老師的個人簡介、教學風格和學生評價，選擇最適合您的外籍教師。</p>
                    </div>
                    <div class="faq-item mb-4">
                        <h2 class="h5">上課設備需要準備什麼？</h2>
                        <p>您需要準備具有攝像頭和麥克風的電腦或平板，以及穩定的網路連線。</p>
                    </div>
                    <div class="faq-item mb-4">
                        <h2 class="h5">可以更換老師嗎？</h2>
                        <p>是的，您可以隨時更換老師，我們希望為您提供最適合的學習體驗。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>		
<!-- /Page Content -->

@php
use Spatie\SchemaOrg\Schema;

$faqs = Schema::fAQPage()
    ->mainEntity([
        Schema::question()
            ->name('如何開始線上英文課程？')
            ->acceptedAnswer(
                Schema::answer()
                    ->text('註冊帳號後，您可以選擇喜歡的外籍教師，並預約您方便的時間進行一對一線上英文課程。')
            ),
        Schema::question()
            ->name('課程費用如何計算？')
            ->acceptedAnswer(
                Schema::answer()
                    ->text('我們提供多種課程方案，您可以根據自己的需求選擇適合的課程包。詳細價格請參考課程方案頁面。')
            ),
        Schema::question()
            ->name('如何選擇適合的老師？')
            ->acceptedAnswer(
                Schema::answer()
                    ->text('您可以查看每位老師的個人簡介、教學風格和學生評價，選擇最適合您的外籍教師。')
            ),
        Schema::question()
            ->name('上課設備需要準備什麼？')
            ->acceptedAnswer(
                Schema::answer()
                    ->text('您需要準備具有攝像頭和麥克風的電腦或平板，以及穩定的網路連線。')
            ),
        Schema::question()
            ->name('可以更換老師嗎？')
            ->acceptedAnswer(
                Schema::answer()
                    ->text('是的，您可以隨時更換老師，我們希望為您提供最適合的學習體驗。')
            )
    ]);

echo $faqs->toScript();
@endphp
@endsection