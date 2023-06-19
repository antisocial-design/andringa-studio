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
              return $(this).data("cat") === category;
            })
            .show();
          $("#post-list .portfolio_thumbnail")
            .filter(function () {
              return $(this).data("cat") !== category;
            })
            .hide();
        }
      });
    });
  }
  jQuery(document).ready(function ($) {
    $(".wp-block-image").attr("data-fancybox", "gallery");

    $(".wp-block-image").each(function () {
      var imgSrc = $(this).find("img").attr("srcset");
      const url = imgSrc.split(/[\s,]+/);
      const output = url[url.length - 2];
      $(this).attr("href", output);
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
        $("body,html").toggleClass("overflow-hidden");
      });
    });
  });
};

init();
