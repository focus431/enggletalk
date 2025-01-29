<?php $page = "course_info"; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Course Introduction') }}</li>
                    </ol>
                </nav>
                
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
                <!-- Courses -->
                <div class="courses-container">
                    <h1>{{ __('Overview') }}</h1>
                    <div class="row course_info">
                        <!-- 生活英文 (ESL) 課程 -->
                        <div class="course">
                            <div class="course-image">
                                <img src="/storage/course_info_images/esl.png" alt="生活英文">
                            </div>
                            <div class="course-info">
                                <h4>{{ __('courseInfo.title') }}</h4>
                                <p>{{ __('courseInfo.description1') }}</p>
                                <p>{{ __('courseInfo.description2') }}</p>
                                <p>{{ __('courseInfo.description3') }}</p>
                            </div>
                        </div>

                        <!-- 商用英文 課程 -->
                        <div class="course">
                            <div class="course-image">
                                <img src="/storage/course_info_images/business.png" alt="商用英文">
                            </div>
                            <div class="course-info">
                                <h4>{{ __('businessCourse.title') }}</h4>
                                <p>{{ __('businessCourse.description1') }}</p>
                                <p>{{ __('businessCourse.description2') }}</p>
                                <p>{{ __('businessCourse.description3') }}</p>
                            </div>
                        </div>

                        <!-- 時事新聞 課程 -->
                        <div class="course">
                            <div class="course-image">
                                <img src="/storage/course_info_images/cnn.png" alt="時事新聞">
                            </div>
                            <div class="course-info">
                                <h4>{{ __('currentAffairsCourse.title') }}</h4>
                                <p>{{ __('currentAffairsCourse.description1') }}</p>
                                <p>{{ __('currentAffairsCourse.description2') }}</p>
                                <p>{{ __('currentAffairsCourse.description3') }}</p>
                            </div>
                        </div>

                        <!-- 兒童及青少年 課程 -->
                        <div class="course">
                            <div class="course-image">
                                <img src="/storage/course_info_images/kids.png" alt="兒童及青少年">
                            </div>
                            <div class="course-info">
                                <h4>{{ __('childrenYouthCourse.title') }}</h4>
                                <p>{{ __('childrenYouthCourse.description1') }}</p>
                                <p>{{ __('childrenYouthCourse.description2') }}</p>
                                <p>{{ __('childrenYouthCourse.description3') }}</p>
                            </div>
                        </div>

                        <!-- 英文檢定 課程 -->
                        <div class="course">
                            <div class="course-image">
                                <img src="/storage/course_info_images/exam.png" alt="英文檢定">
                            </div>
                            <div class="course-info">
                                <h4>{{ __('englishExamCourse.title') }}</h4>
                                <p>{{ __('englishExamCourse.description1') }}</p>
                                <p>{{ __('englishExamCourse.description2') }}</p>
                                <p>{{ __('englishExamCourse.description3') }}</p>
                            </div>
                        </div>
                        <!-- 其他課程以此類推 -->
                    </div>
                </div>

                <!-- /Courses -->
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->
@endsection