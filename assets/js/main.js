(function ($) {
    "use strict";
  
    // Loading
    $(window).on("load", function () {
      $("#loading").hide();
    });
  
    $(".menu-collapse").on("click", function () {
      $(this).parent().toggleClass("menu-collapsing");
    });
  
    var url = window.location;
  
    // Show active menu yang tidak memiliki dropdown
    var navMenu = $("ul.nav-menu li a").filter(function () {
      return this.href == url;
    });
    navMenu.siblings().removeClass("active").end().addClass("active");
  
    // Show active dan dropdown menu yang memiliki dropdown
    var navMenuDropdown = $(".menu-dropdown ul li a").filter(function () {
      return this.href == url;
    });
    navMenuDropdown
      .closest(".menu-dropdown")
      .parent()
      .addClass("menu-collapsing");
    navMenuDropdown.addClass("active");
  })(jQuery);
  