!function(e){Drupal.behaviors.portfolio={attach:function(n,o){var t=e(".skip-link"),i=e("#main-content"),a=e(".main-menu-toggle"),c=e(".main-menu-nav");t.click(function(n){n.preventDefault(),e("html, body").animate({scrollTop:i.offset().top},1e3,function(){if((location.hash=i).focus(),i.is(":focus"))return!1;i.attr("tabindex","-1"),i.focus()})}),a.click(function(){c.toggleClass("show")})}}}(jQuery);