  // additonalQをデフォルトで非表示にし、moreInfoQuestionがクリックされたら表示する
  const additionalQ = document.getElementById('additionalQ');
  additionalQ.style.display = 'none';
  const moreInfoQuestion = document.getElementById('moreInfoQuestion');
  moreInfoQuestion.addEventListener('click', function() {
    if (additionalQ.style.display === 'none') {
      additionalQ.style.display = 'block';
    } else {
      additionalQ.style.display = 'none';
    }
  });
  
  const slider = document.getElementById('rating');
  const sliderValue = document.querySelector('.slider-value');
  slider.addEventListener('input', function() {
    sliderValue.textContent = this.value;
  });


