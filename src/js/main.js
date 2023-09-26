const init = () => {
  if (document.querySelector("#hero.slider")) {
    jQuery("#hero.slider").slick({
      infinite: true,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 3000,
      fade: true,
      cssEase: "ease",
      speed: 1000,
    });
  }
  if (document.querySelector(".filter-btn")) {
    jQuery(document).ready(function ($) {
      $(".filter-btn").click(function () {
        $(".filter-btn").removeClass("font-bold");
        $(this).addClass("font-bold");
        var category = $(this).data("cat");
        if (category === "all") {
          $("#post-list .portfolio_thumbnail").show();
        } else {
          $("#post-list .portfolio_thumbnail")
            .filter(function () {
              var categories = $(this).attr("data-cat").split(","); // Split the data-cat attribute values into an array of categories
              return categories.some(function (cat) {
                return cat.trim().includes(category); // Check if the category is contained within the current category value
              });
            })
            .show();
          $("#post-list .portfolio_thumbnail")
            .filter(function () {
              var categories = $(this).attr("data-cat").split(","); // Split the data-cat attribute values into an array of categories
              return !categories.some(function (cat) {
                return cat.trim().includes(category); // Check if the category is not contained within any of the category values
              });
            })
            .hide();
        }
      });
    });
  }

  jQuery(document).ready(function ($) {
    $(window).scroll(function () {
      var scroll = $(window).scrollTop();

      if (scroll >= 500) {
        $(".header").addClass("scrolled");
      } else {
        $(".header").removeClass("scrolled");
      }
    });
  });

  jQuery(document).ready(function ($) {
    $(".wp-block-image").attr("data-fancybox", "gallery");

    $(".wp-block-image").each(function () {
      var imgSrc = $(this).find("img").attr("src");
      $(this).attr("href", imgSrc);
    });

    Fancybox.bind('[data-fancybox="gallery"]', {
      //
    });
  });
  jQuery(document).ready(function ($) {
    $(document).ready(function () {
      $(".hamburger").click(function () {
        $(this).toggleClass("is-active");
        $(".mobile-menu").toggleClass("active");
        // $("body,html").toggleClass("overflow-hidden");
      });
    });
  });
};

init();
