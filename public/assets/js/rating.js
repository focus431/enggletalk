// public/js/rating.js

function createRatingElement(averageRating) {
  const ratingDiv = document.createElement('div');
  ratingDiv.className = 'rating';

  // 计算评分并创建星星图标
  for (let i = 0; i < 5; i++) {
    let star = document.createElement('i');
    star.className = 'fas fa-star' + (i < averageRating ? ' filled' : '');
    ratingDiv.appendChild(star);
  }

  // 创建包含评分数值的 span 元素
  const ratingValue = document.createElement('span');
  ratingValue.className = 'd-inline-block average-rating';
  ratingValue.textContent = '(' + averageRating.toFixed(2) + ')';

  ratingDiv.appendChild(ratingValue);

  return ratingDiv;
}
