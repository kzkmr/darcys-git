(function($) {

  $(function () {
    $('.news-nav__item').on('click', function() {
      var index = $('.news-nav__item').index(this);
      $('.news-nav__item, .news-panel').removeClass('active');
      $(this).addClass('active');
      $('.news-panel').eq(index).addClass('active');
    });
  });
})(jQuery);