jQuery.noConflict();
(function ($) {
  $(document).ready(function () {
    // Initialize tabs
    function initializeTabs() {
      const $tabButtons = $(".tab-btn");
      const $tabContents = $(".tab-content");

      console.log("Tab buttons found:", $tabButtons.length);
      console.log("Tab contents found:", $tabContents.length);

      if ($tabButtons.length === 0 || $tabContents.length === 0) {
        console.warn("No tab buttons or contents found.");
        return;
      }

      $tabButtons.off("click").on("click", function (e) {
        e.preventDefault();
        const targetTab = $(this).data("tab");

        console.log("Switching to tab:", targetTab);

        $tabButtons
          .removeClass("border-green-600 text-green-700 bg-teal-50 active")
          .addClass("border-transparent text-gray-500 bg-gray-50");

        $tabContents.addClass("hidden");

        $(this)
          .addClass("border-green-600 text-green-700 bg-teal-50 active")
          .removeClass("border-transparent text-gray-500 bg-gray-50");

        const $targetContent = $(`#${targetTab}`);
        if ($targetContent.length) {
          $targetContent.removeClass("hidden");
          console.log("Tab content shown:", targetTab);
        } else {
          console.warn("Target tab content not found:", targetTab);
        }
      });
    }

    // Initialize quantity buttons
    function initializeQuantityButtons() {
      const $minusBtn = $(".quantity-minus");
      const $plusBtn = $(".quantity-plus");
      const $quantityInput = $(".quantity-input");

      if ($minusBtn.length && $plusBtn.length && $quantityInput.length) {
        $minusBtn.off("click").on("click", function (e) {
          e.preventDefault();
          const currentValue = parseInt($quantityInput.val()) || 1;
          $quantityInput.val(Math.max(1, currentValue - 1));
        });

        $plusBtn.off("click").on("click", function (e) {
          e.preventDefault();
          const currentValue = parseInt($quantityInput.val()) || 1;
          $quantityInput.val(currentValue + 1);
        });
      } else {
        console.warn("Quantity buttons or input not found.");
      }
    }

    // Global quantity function for inline onclick
    window.changeQuantity = function (delta) {
      const $quantityInput = $(".quantity-input");
      if ($quantityInput.length) {
        const currentValue = parseInt($quantityInput.val()) || 1;
        $quantityInput.val(Math.max(1, currentValue + delta));
      }
    };

    // Initialize image gallery
    function initializeImageGallery() {
      const $mainImage = $(".product-image-main img");
      const $galleryThumbnails = $(".gallery-thumbnail img");

      $galleryThumbnails.off("click").on("click", function () {
        if ($mainImage.length) {
          const newSrc = $(this)
            .attr("src")
            .replace("-150x150", "")
            .replace("-thumbnail", "");
          $mainImage.attr("src", newSrc);
          console.log("Image changed to:", newSrc);
        }
      });
    }

    // Initialize form validation
    function initializeFormValidation() {
      const $addToCartForm = $("form.cart");
      if ($addToCartForm.length) {
        $addToCartForm.on("submit", function (e) {
          const quantity = $(".quantity-input").val();
          if (!quantity || quantity < 1) {
            e.preventDefault();
            alert("Please select a valid quantity");
          }
        });
      }
    }

    // Execute initializations
    try {
      initializeTabs();
      initializeQuantityButtons();
      initializeImageGallery();
      initializeFormValidation();

      // Re-initialize tabs on AJAX complete
      $(document).on("ajaxComplete", function () {
        initializeTabs();
        console.log("Tabs re-initialized after AJAX.");
      });
    } catch (error) {
      console.error("Initialization error:", error);
    }
  });
})(jQuery);
