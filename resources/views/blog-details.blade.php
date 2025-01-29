<?php $page = 'blog-details'; ?>
@extends('layout.mainlayout')
@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">Blog Details</h2>
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
          <div class="blog-view">
            <div class="blog blog-single-post">
              <div class="blog-image">
                <a href="javascript:void(0);">
                  <!-- 使用 Blade 模板语法设置图片路径 -->
                  <img alt="" src="{{ asset('storage/' . $blog->image) }}" class="img-fluid">
                </a>
              </div>
              <h3 class="blog-title">{{ $blog->name }}</h3>

              <div class="blog-info clearfix">
                <div class="post-left">
                  <ul>
                    <li>
                      <div class="post-author">
                        <a href="profile"><img alt="" src="{{ asset('storage/' . $blog->image) }}"
                            class="img-fluid"><span>{{ $blog->author }}</span></a>
                      </div>
                    </li>
                    <li><i class="far fa-calendar"></i> <span
                        id="localTime">{{ \Carbon\Carbon::parse($blog->created_at)->format('Y-m-d') }}</span></li>
                    <li class="comments-count"><i class="far fa-comments"></i>12 Comments</li>
                    <li><i class="fa fa-tags"></i>{{ $blog->sub_category }}</li>
                  </ul>
                </div>
              </div>
              <div class="blog-content">
                {{ $blog->description }}

              </div>
            </div>

            <!-- <div class="card blog-share clearfix">
        <div class="card-header">
         <h4 class="card-title">Share the post</h4>
        </div>
        <div class="card-body">
         <ul class="social-share">
          <li><a href="#" title="Facebook"><i class="fab fa-facebook"></i></a></li>
          <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
          <li><a href="#" title="Google Plus"><i class="fab fa-google-plus"></i></a></li>
          <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
         </ul>
        </div>
       </div> -->
            <!-- <div class="card author-widget clearfix">
          <div class="card-header">
           <h4 class="card-title">About Author</h4>
           </div>
          <div class="card-body">
           <div class="about-author">
            <div class="about-author-img">
             <div class="author-img-wrap">
              <a href="profile"><img class="img-fluid rounded-circle" alt="" src="assets/img/user/user1.jpg"></a>
             </div>
            </div>
            <div class="author-details">
             <a href="profile" class="blog-author-name">Darren Elder</a>
             <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
            </div>
           </div>
          </div>
          </div> -->
            <div class="card blog-comments clearfix">
              <div class="card-header">
                <h4 class="card-title"></h4>
              </div>
              <div class="card-body pb-0">
                <ul class="comments-list">
                  <li>

                  </li>
                </ul>
              </div>
            </div>

            <div class="card new-comment clearfix">
              <div class="card-header">
                <h4 class="card-title">Leave Comment</h4>
              </div>
              <div class="card-body">
                <form id="comment-form">

                  <input type="hidden" name="blog_id" value="{{ $blog->id }}">

                  <div class="form-group">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name">
                  </div>
                  <div class="form-group">
                    <label>Your Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email"> <!-- 注意：這裡添加了 name 屬性 -->
                  </div>
                  <div class="form-group">
                    <label>Comments</label>
                    <textarea rows="4" class="form-control" name="content"></textarea>
                  </div>
                  <div class="submit-section">
                    <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                  </div>
                </form>

              </div>
            </div>

          </div>
        </div>

        <!-- Blog Sidebar -->
        <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

          <!-- Search -->
          <!-- <div class="card search-widget">
       <div class="card-body">
        <form class="search-form">
         <div class="input-group">
          <input type="text" placeholder="Search..." class="form-control">
          <div class="input-group-append">
           <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
          </div>
         </div>
        </form>
       </div>
      </div> -->
          <!-- /Search -->

          <!-- Latest Posts -->
          <div class="card post-widget">
            <div class="card-header">
              <h4 class="card-title">Latest Posts</h4>
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
              <h4 class="card-title">Blog Categories</h4>
            </div>
            <div class="card-body">
              <ul class="categories">
                <!-- 顯示Blog的分類 -->
              </ul>
            </div>
          </div>
          <!-- /Categories -->

          <!-- Tags -->
          <div class="card tags-widget">
            <div class="card-header">
              <h4 class="card-title">Tags</h4>
            </div>
            <div class="card-body">
              <ul class="tags">
                <!-- 标签将动态加载到这里 -->
              </ul>
            </div>
          </div>
          <!-- /Tags -->
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
      // 獲取 blog_id 並從後端獲取評論數據
      const blogId = "{{ $blog->id }}";
      fetchComments(blogId);
      var blogIdInput = document.querySelector('#comment-form input[name="blog_id"]');
      if (blogIdInput && blogIdInput.value) {
        console.log('blog_id has a value:', blogIdInput.value);
      } else {
        console.log('blog_id does not have a value');
      }
      fetchBlogs();
      fetchLatestBlogs();
      submitCommentForm();

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
        const shortDescription = blog.description.length > 20 ? `${blog.description.substring(0, 20)}...` : blog
          .description;

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





























    // 定义一个映射，将月份数字转换为英文简写
    const monthMap = {
      '01': 'Jan',
      '02': 'Feb',
      '03': 'Mar',
      '04': 'Apr',
      '05': 'May',
      '06': 'Jun',
      '07': 'Jul',
      '08': 'Aug',
      '09': 'Sep',
      '10': 'Oct',
      '11': 'Nov',
      '12': 'Dec'
    };

    // 定义一个函数将 UTC 时间转换为只包含日期的本地时间字符串
    function convertToLocalDate(utcTime) {
      const date = new Date(utcTime);
      const year = date.getFullYear();
      const month = date.getMonth() + 1; // getMonth() 返回的月份是从0开始的
      const monthStr = monthMap[month.toString().padStart(2, '0')]; // 转换为英文简写
      const day = date.getDate(); // 不需要填充0，因为我们需要的是单个数字

      return `${year} ${monthStr} ${day}`;
    }

    // 然后在 createBlogPostHtml 函数内使用这个函数来格式化日期
    function createBlogPostHtml(blog) {
      // 将 UTC 时间转换为只包含日期的本地时间
      const localDate = convertToLocalDate(blog.created_at);
      // 截取描述的前20个字符，如果超过了就添加省略号
      const shortDescription = blog.description.length > 20 ? `${blog.description.substring(0, 20)}...` : blog
      .description;

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


    // // 搜索表单提交事件监听器
    // document.querySelector('.search-form').addEventListener('submit', function(e) {
    // 	e.preventDefault(); // 阻止表单默认提交行为
    // 	const searchTerm = document.querySelector('.search-form input[type="text"]').value.trim();

    // 	// 调用 fetchBlogs 函数并传递搜索词
    // 	fetchBlogs(1, searchTerm);
    // });

    // 监听输入框的清空事件，如果输入框被清空，则重新加载博客
    // document.querySelector('.search-form input[type="text"]').addEventListener('input', function(e) {
    // 	const searchTerm = e.target.value.trim();

    // 	// 如果搜索词为空，则重新加载博客
    // 	if (!searchTerm) {
    // 		fetchBlogs();
    // 	}
    // });

    // 更新 fetchBlogs 函数以在获取数据后调用 countCategories 和 updateCategoryWidget 函数
    function fetchBlogs(page = 1, searchTerm = '') {
      let blogsUrl = `{{ route('blogs') }}?page=${page}`;

      // 如果有搜索词，则添加到请求URL中
      if (searchTerm) {
        blogsUrl += `&search=${encodeURIComponent(searchTerm)}`;
      }

      fetch(blogsUrl)
        .then(response => response.json())
        .then(data => {
          blogsData = data.data; // 更新全局博客数据


          // 計算主類別的數量並更新類別 widget
          const categoryCounts = countCategories(blogsData);
          updateCategoryWidget(categoryCounts);

          // 計算子類別的數量並更新標簽 widget
          const subCategoryCounts = countSubCategories(blogsData);
          updateTagsWidget(subCategoryCounts);
        })
        .catch(error => console.error('Error fetching blogs:', error));
    }





    function updateTagsWidget(subCategoryCounts) {
      const tagsList = document.querySelector('.tags');
      tagsList.innerHTML = ''; // 清空現有的列表項

      Object.entries(subCategoryCounts).forEach(([subCategory, count]) => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `<a href="#" class="tag">${subCategory} <span>(${count})</span></a>`;

        // 修改點擊事件監聽器，實現導航功能
        listItem.querySelector('a').addEventListener('click', function(event) {
          event.preventDefault(); // 防止頁面跳轉
          // 重新導向到 blog-grid.blade.php，並傳遞 subCategory 參數
          window.location.href = `/blog-grid?subCategory=${encodeURIComponent(subCategory)}`;
        });

        tagsList.appendChild(listItem);
      });
    }




    function filterBlogsBySubCategory(subCategory) {
      // 使用 filter 方法篩選出具有相同 sub_category 的博客
      const filteredBlogs = blogsData.filter(blog => blog.sub_category === subCategory);


      // 更新分頁組件，因為篩選後可能不再需要分頁
      // 如果您希望保留分頁功能，您需要根據篩選後的數據來更新分頁邏輯
      // 這裡為了簡單，我們假設不再需要分頁
      document.querySelector('.pagination').innerHTML = '';
    }




    function countCategories(blogs) {
      // 使用对象来存储每个类别的计数
      const categoryCounts = {};

      // 遍历所有博客文章
      blogs.forEach(blog => {
        // 假设每个博客对象都有一个 category 属性
        const category = blog.category;
        // 如果该类别已经在对象中，增加计数，否则初始化为1
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
        // 假設 sub_category 是一個字符串，直接增加計數
        const subCategory = blog.sub_category;
        subCategoryCounts[subCategory] = (subCategoryCounts[subCategory] || 0) + 1;
      });

      return subCategoryCounts;
    }





    // 假设 blogsData 是包含所有博客数据的数组
    const categoryCounts = countCategories(blogsData);

    // 接下来您可以用这个 categoryCounts 对象更新您的页面
    // 例如：
    function updateCategoryWidget(categoryCounts) {
      const categoriesList = document.querySelector('.categories');
      categoriesList.innerHTML = ''; // 清空现有的列表项

      // 遍历 categoryCounts 对象，为每个类别创建一个列表项
      for (const [category, count] of Object.entries(categoryCounts)) {
        const listItem = document.createElement('li');
        listItem.innerHTML = `<a href="#" class="category">${category} <span>(${count})</span></a>`;

        // 为分类添加点击事件监听器
        listItem.querySelector('a').addEventListener('click', function(event) {
          event.preventDefault(); // 防止页面跳转
          filterBlogsByCategory(category); // 筛选博客
        });

        categoriesList.appendChild(listItem);
      }
    }



    function filterBlogsByCategory(category) {
      // 使用 filter 方法筛选出具有相同 category 的博客
      const filteredBlogs = blogsData.filter(blog => blog.category === category);
      document.querySelector('.pagination').innerHTML = '';
    }



    function submitCommentForm() {
      document.getElementById('comment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/comments', {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Accept': 'application/json'
            },
            body: formData
          })
          .then(response => {
            if (!response.ok) {
              throw response;
            }
            return response.json();
          })
          .then(data => {
            // 處理成功響應
            console.log(data);
            alert("評論已提交！");
            // 重置表單
            document.getElementById('comment-form').reset();
          })
          .catch(error => {
            if (error.json) {
              error.json().then(body => {
                // 確保 body 存在且包含 errors 屬性
                if (body && body.errors) {
                  // 顯示錯誤訊息
                  alert("錯誤：" + Object.values(body.errors).join("\n"));
                } else {
                  // 處理沒有錯誤訊息的情況
                  alert("發生錯誤！ 可能未登入");
                }
              });
            } else {
              console.error('Error:', error);
            }
          });

      });


    }





    function fetchComments(blogId) {
      fetch(`/comments/${blogId}`)
        .then(response => response.json())
        .then(comments => {
          displayComments(comments);
        })
        .catch(error => console.error('Error fetching comments:', error));
    }

    function displayComments(comments) {
      const commentsList = document.querySelector('.comments-list');
      const commentsCountElements = document.querySelectorAll('.comments-count');
      const commentsCountElement = document.querySelector('.card-header .card-title');

      commentsList.innerHTML = '';
      const commentsCountText = `Comments (${comments.length})`;
      commentsCountElement.textContent = commentsCountText;

      // 更新所有评论计数元素
      commentsCountElements.forEach(element => {
        element.innerHTML = `<i class="far fa-comments"></i>${commentsCountText}`;
      });

      comments.forEach(comment => {
        const localDate = formatDate(comment.created_at);
        const commentHtml = createCommentHtml(comment, localDate);
        commentsList.innerHTML += commentHtml;
      });
    }

    function formatDate(dateString) {
      return moment(dateString).local().format('YYYY-MM-DD');
    }

    function createCommentHtml(comment, formattedDate) {
      // 设置默认头像路径
      const defaultAvatarPath = '/storage/avatars/default-avatar.jpg';
      // 检查是否有有效的 avatar_path，如果没有，则使用默认头像
      const avatarPath = comment.avatar_path ? `/storage/${comment.avatar_path}` : defaultAvatarPath;

      return `
        <li>
            <div class="comment">
                <div class="comment-author">
                    <img class="avatar" src="${avatarPath}" alt="User Avatar">
                </div>
                <div class="comment-block">
                    <span class="comment-by">
                        <span class="blog-author-name">${comment.name}</span>
                    </span>
                    <p>${comment.content}</p>
                    <p class="blog-date">${formattedDate}</p>
                </div>
            </div>
        </li>
    `;
    }






    // 假设您在某个地方已经调用了 updateCategoryWidget 函数
    updateCategoryWidget(categoryCounts);
  </script>
@endsection
