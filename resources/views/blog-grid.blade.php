<?php $page = "blog-grid"; ?>
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
						<li class="breadcrumb-item active" aria-current="page">{{ __('Blog') }}</li>
					</ol>
				</nav>
				<h2 class="breadcrumb-title">{{ __('Blog Grid') }}</h2>
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

				<div class="row blog-grid-row" id="blog-posts-container">
					<!-- 博客文章将动态加载到这里 -->
				</div>


				<!-- Blog Pagination -->
				<div class="row">
					<div class="col-md-12">
						<div class="blog-pagination">
							<nav>
								<ul class="pagination justify-content-center">
									<!-- 分頁顯示在這裡 -->
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<!-- /Blog Pagination -->

			</div>

			<!-- Blog Sidebar -->
			<div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

				<!-- Search -->
				<div class="card search-widget">
					<div class="card-body">
						<form class="search-form">
							<div class="input-group">
								<input type="text" placeholder="{{ __('Search') }}..." class="form-control">
								<div class="input-group-append">
									<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- /Search -->

				<!-- Latest Posts -->
				<div class="card post-widget">
					<div class="card-header">
						<h4 class="card-title">{{ __('Latest Posts') }}</h4>
					</div>
					<div class="card-body">
						<ul class="latest-posts">
							<!-- 最新博客文章将动态加载到这里 -->
						</ul>

					</div>
				</div>
				<!-- /Latest Posts -->

				<!-- Categories -->
				<div class="card category-widget">
					<div class="card-header">
						<h4 class="card-title">{{ __('Blog Categories') }}</h4>
					</div>
					<div class="card-body">
						<ul class="categories">
							<!-- 顯示Blog --> 
						</ul>
					</div>
				</div>
				<!-- /Categories -->

				<!-- Tags -->
				<div class="card tags-widget">
					<div class="card-header">
						<h4 class="card-title">{{ __('Tags') }}</h4>
					</div>
					<div class="card-body">
						<ul class="tags">
							<!-- Tags 將動態插入這裡 -->
						</ul>
					</div>
				</div>
				<!-- /Tags -->

			</div>
			<!-- /Blog Sidebar -->

		</div>
	</div>
</div>
<!-- /Page Content -->
@endsection
@section('scripts')
<script>
	let blogsData = []; // 存储从后端获取的博客数据

	// 页面加载完成后获取博客数据
	document.addEventListener('DOMContentLoaded', function() {
		fetchBlogs();
		fetchLatestBlogs();
	});

	function fetchLatestBlogs() {
		fetch('/blogs/latest') // 假设 '/blogs/latest' 是获取最新博客的API端点
			.then(response => response.json())
			.then(data => {
				displayLatestBlogs(data);
			})
			.catch(error => console.error('Error fetching latest blogs:', error));
	}

	function displayLatestBlogs(blogs) {
		const latestPostsContainer = document.querySelector('.latest-posts');
		latestPostsContainer.innerHTML = ''; // 清空现有内容

		blogs.forEach(blog => {
			const localDate = convertToLocalDate(blog.created_at);
			const shortDescription = blog.description.length > 20 ? `${blog.description.substring(0, 20)}...` : blog.description;

			// 注意这里修改了 href 属性，添加了正确的博客ID
			latestPostsContainer.innerHTML += `
            <li>
                <div class="post-thumb">
                    <a href="/blog-details/${blog.id}">
                        <img class="img-fluid" src="/storage/${blog.image}" alt="">
                    </a>
                </div>
                <div class="post-info">
                    <h4>
                        <a href="/blog-details/${blog.id}">${blog.name}</a>
                    </h4>
                    <p>${localDate}</p>
                </div>
            </li>
        `;
		});
	}

	function updatePagination(data) {
		const paginationContainer = document.querySelector('.pagination');
		paginationContainer.innerHTML = ''; // 清空现有的分页组件

		// 添加“上一页”按钮
		if (data.prev_page_url) {
			paginationContainer.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="fetchBlogs(${data.current_page - 1})"><i class="fas fa-angle-double-left"></i></a></li>`;
		}

		// 添加中间的分页按钮
		for (let i = 1; i <= data.last_page; i++) {
			paginationContainer.innerHTML += `<li class="page-item ${i === data.current_page ? 'active' : ''}"><a class="page-link" href="#" onclick="fetchBlogs(${i})">${i}</a></li>`;
		}

		// 添加“下一页”按钮
		if (data.next_page_url) {
			paginationContainer.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="fetchBlogs(${data.current_page + 1})"><i class="fas fa-angle-double-right"></i></a></li>`;
		}
	}

	function displayBlogs(blogs) {
		const container = document.getElementById('blog-posts-container');
		container.innerHTML = ''; // 清空现有内容
		blogs.forEach(blog => {
			container.innerHTML += createBlogPostHtml(blog);
		});
	}

	const monthMap = {
		'01': '{{ __("Jan") }}',
		'02': '{{ __("Feb") }}',
		'03': '{{ __("Mar") }}',
		'04': '{{ __("Apr") }}',
		'05': '{{ __("May") }}',
		'06': '{{ __("Jun") }}',
		'07': '{{ __("Jul") }}',
		'08': '{{ __("Aug") }}',
		'09': '{{ __("Sep") }}',
		'10': '{{ __("Oct") }}',
		'11': '{{ __("Nov") }}',
		'12': '{{ __("Dec") }}'
	};

	function convertToLocalDate(utcTime) {
		const date = new Date(utcTime);
		const year = date.getFullYear();
		const month = date.getMonth() + 1; // getMonth() 返回的月份是从0开始的
		const monthStr = monthMap[month.toString().padStart(2, '0')]; // 转换为英文简写
		const day = date.getDate(); // 不需要填充0，因为我们需要的是单个数字

		return `${year} ${monthStr} ${day}`;
	}

	function createBlogPostHtml(blog) {
		const localDate = convertToLocalDate(blog.created_at);
		const shortDescription = blog.description.length > 20 ? `${blog.description.substring(0, 20)}...` : blog.description;

		return `
      <div class="col-md-6 col-sm-12">
          <div class="blog grid-blog">
              <div class="blog-image">
							<a href="/blog-details/${blog.id}"><img class="img-fluid" src="/storage/${blog.image}" alt="Post Image"></a>
              </div>
              <div class="blog-content">
                  <ul class="entry-meta meta-item">
                      <li>
                          <div class="post-author">
                              <a href="profile"><img src="${blog.authorImage}" alt="Post Author"> <span>${blog.authorName}</span></a>
                          </div>
                      </li>
                      <li><i class="far fa-clock"></i> ${localDate}</li>
                  </ul>
                  <h3 class="blog-title"><a href="/blog-details/${blog.id}">${blog.name}</a></h3>
									<p class="mb-0">${shortDescription}</p>
								</div>
          </div>
      </div>
  `;
	}

	document.querySelector('.search-form').addEventListener('submit', function(e) {
		e.preventDefault();
		const searchTerm = document.querySelector('.search-form input[type="text"]').value.trim();
		fetchBlogs(1, searchTerm);
	});

	document.querySelector('.search-form input[type="text"]').addEventListener('input', function(e) {
		const searchTerm = e.target.value.trim();
		if (!searchTerm) {
			fetchBlogs();
		}
	});

	function fetchBlogs(page = 1, searchTerm = '') {
		let blogsUrl = `{{ route('blogs') }}?page=${page}`;

		if (searchTerm) {
			blogsUrl += `&search=${encodeURIComponent(searchTerm)}`;
		}

		fetch(blogsUrl)
			.then(response => response.json())
			.then(data => {
				blogsData = data.data;
				displayBlogs(data.data);
				updatePagination(data);
				const categoryCounts = countCategories(blogsData);
				updateCategoryWidget(categoryCounts);
				const subCategoryCounts = countSubCategories(blogsData);
				updateTagsWidget(subCategoryCounts);
			})
			.catch(error => console.error('Error fetching blogs:', error));
	}

	function updateTagsWidget(subCategoryCounts) {
		const tagsList = document.querySelector('.tags');
		tagsList.innerHTML = ''; 

		Object.entries(subCategoryCounts).forEach(([subCategory, count]) => {
			const listItem = document.createElement('li');
			listItem.innerHTML = `<a href="#" class="tag">${subCategory} <span>(${count})</span></a>`;
			listItem.querySelector('a').addEventListener('click', function(event) {
				event.preventDefault();
				filterBlogsBySubCategory(subCategory);
			});
			tagsList.appendChild(listItem);
		});
	}

	function filterBlogsBySubCategory(subCategory) {
		const filteredBlogs = blogsData.filter(blog => blog.sub_category === subCategory);
		displayBlogs(filteredBlogs);
		document.querySelector('.pagination').innerHTML = '';
		const newUrl = `/blog-grid?subCategory=${encodeURIComponent(subCategory)}`;
		history.pushState({ path: newUrl }, '', newUrl);
	}

	function countCategories(blogs) {
		const categoryCounts = {};
		blogs.forEach(blog => {
			const category = blog.category;
			if (categoryCounts[category]) {
				categoryCounts[category]++;
			} else {
				categoryCounts[category] = 1;
			}
		});
		return categoryCounts;
	}

	function countSubCategories(blogs) {
		const subCategoryCounts = {};
		blogs.forEach(blog => {
			const subCategory = blog.sub_category;
			subCategoryCounts[subCategory] = (subCategoryCounts[subCategory] || 0) + 1;
		});
		return subCategoryCounts;
	}

	const categoryCounts = countCategories(blogsData);

	function updateCategoryWidget(categoryCounts) {
		const categoriesList = document.querySelector('.categories');
		categoriesList.innerHTML = '';
		for (const [category, count] of Object.entries(categoryCounts)) {
			const listItem = document.createElement('li');
			listItem.innerHTML = `<a href="#" class="category">${category} <span>(${count})</span></a>`;
			listItem.querySelector('a').addEventListener('click', function(event) {
				event.preventDefault();
				filterBlogsByCategory(category);
			});
			categoriesList.appendChild(listItem);
		}
	}

	function filterBlogsByCategory(category) {
		const filteredBlogs = blogsData.filter(blog => blog.category === category);
		displayBlogs(filteredBlogs);
		document.querySelector('.pagination').innerHTML = '';
	}

	updateCategoryWidget(categoryCounts);
</script>
@endsection 
