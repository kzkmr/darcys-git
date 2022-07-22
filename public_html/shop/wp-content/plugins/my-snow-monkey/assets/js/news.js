(function($) {

  $(function () {
    $('.category-nav__item').on('click', function() {
      var index = $('.category-nav__item').index(this);
      $('.category-nav__item, .category-panel').removeClass('active');
      $(this).addClass('active');
      $('.category-panel').eq(index).addClass('active');
    });
  });
})(jQuery);