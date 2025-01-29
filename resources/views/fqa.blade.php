<?php $page="fqa";?>
@extends('layout.mainlayout')
@section('content')      
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">{{ __('breadcrumb_home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('breadcrumb_fqa') }}</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">{{ __('title_fqa') }}</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="container mt-3">
    <div class="row">
        <!-- 左侧列 -->
        <div class="col-md-6">
            <!-- 主卡片 1 -->
            <div class="main-card">
                <h3 id="headingOne">{{ __('faq_title_student') }}</h3>
                <div class="sub-cards">
                    <div class="sub-card">
                        <a href="#collapse1" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                            {{ __('faq_1_question') }}
                        </a>
                        <p></p>
                        <div id="collapse1" class="collapse" aria-labelledby="headingOne">
                            {{ __('faq_1_answer') }}
                        </div>
                    </div>
                    <div class="sub-card">
                        <a href="#collapse2" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                            {{ __('faq_2_question') }}
                        </a>
                        <p></p>
                        <div id="collapse2" class="collapse" aria-labelledby="headingOne">
                            {{ __('faq_2_answer') }}
                        </div>
                    </div>
                    <div class="sub-card">
                        <a href="#collapse3" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                            {{ __('faq_3_question') }}
                        </a>
                        <p></p>
                        <div id="collapse3" class="collapse" aria-labelledby="headingOne">
                            {{ __('faq_3_answer') }}
                        </div>
                    </div>
                    <div class="sub-card">
                        <a href="#collapse4" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                            {{ __('faq_4_question') }}
                        </a>
                        <p></p>
                        <div id="collapse4" class="collapse" aria-labelledby="headingOne">
                            {{ __('faq_4_answer') }}
                        </div>
                    </div>
                    <div class="sub-card">
                        <a href="#collapse5" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                            {{ __('faq_5_question') }}
                        </a>
                        <p></p>
                        <div id="collapse5" class="collapse" aria-labelledby="headingOne">
                            {{ __('faq_5_answer') }}
                        </div>
                    </div>
                    <div class="sub-card">
                        <a href="#collapse6" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                            {{ __('faq_6_question') }}
                        </a>
                        <p></p>
                        <div id="collapse6" class="collapse" aria-labelledby="headingOne">
                            {{ __('faq_6_answer') }}
                        </div>
                    </div>
                    <div class="sub-card">
                        <a href="#collapse7" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                            {{ __('faq_7_question') }}
                        </a>
                        <p></p>
                        <div id="collapse7" class="collapse" aria-labelledby="headingOne">
                            {{ __('faq_7_answer') }}
                        </div>
                    </div>
                    <div class="sub-card">
                        <a href="#collapse8" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                            {{ __('faq_8_question') }}
                        </a>
                        <p></p>
                        <div id="collapse8" class="collapse" aria-labelledby="headingOne">
                            {{ __('faq_8_answer') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 主卡片 3 -->
            

        <!-- 右侧列 -->
         <div class="main-card">
                <h3 id="headingThree">{{ __('faq_title_preparation') }}</h3>
                <div class="sub-cards">
                    <div class="sub-card">
                        <a href="#collapseThree" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
                            {{ __('faq_preparation_question') }}
                        </a>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree">
                            {{ __('faq_preparation_answer') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 主卡片 5 -->
            <div class="main-card">
                <h3 id="headingFive">{{ __('faq_title_rights') }}</h3>
                <div class="sub-cards">
                    <div class="sub-card">
                        <a href="#collapseFive" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseFive">
                            {{ __('faq_rights_question') }}
                        </a>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive">
                            {{ __('faq_rights_answer') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- 主卡片 2 -->
            <div class="main-card">
                <h3 id="headingTwo">{{ __('faq_title_teacher') }}</h3>
                <div class="sub-cards">
                    <div class="sub-card">
                        <a href="#collapseTwo" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                            {{ __('faq_teacher_question') }}
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                            {{ __('faq_teacher_answer') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 主卡片 4 -->
            <div class="main-card">
                <h3 id="headingFour">{{ __('faq_title_issues') }}</h3>
                <div class="sub-cards">
                    <div class="sub-card">
                        <a href="#collapseFour" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseFour">
                            {{ __('faq_issues_question') }}
                        </a>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour">
                            {{ __('faq_issues_answer') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->
@endsection
