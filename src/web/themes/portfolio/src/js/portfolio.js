(function ($, Drupal) {
  Drupal.behaviors.portfolio = {
    attach: function (context, settings) {
      var skip = $(".skip-link"),
        $target = $("#main-content");
      skip.click(function (event) {
        event.preventDefault();
        $("html, body").animate(
          { scrollTop: $target.offset().top },
          1000,
          function () {
            location.hash = $target;
            $target.focus();
            if ($target.is(":focus")) {
              return !1;
            } else {
              $target.attr("tabindex", "-1");
              $target.focus();
            }
          }
        );
      });
    },
  };
})(jQuery, Drupal);
