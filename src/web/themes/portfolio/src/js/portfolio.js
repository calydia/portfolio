(function ($, Drupal) {
  Drupal.behaviors.portfolio = {
    attach: function (context, settings) {
      var menuToggle = $(".main-menu-toggle"),
          mobileMenu = $(".main-menu-nav");

      menuToggle.click(function () {
        mobileMenu.toggleClass("show");
      });
    },
  };
})(jQuery, Drupal);
