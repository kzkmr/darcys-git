!function(){"use strict";var e={n:function(t){var a=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(a,{a:a}),a},d:function(t,a){for(var i in a)e.o(a,i)&&!e.o(t,i)&&Object.defineProperty(t,i,{enumerable:!0,get:a[i]})},o:function(e,t){return Object.prototype.hasOwnProperty.call(e,t)}},t=window.jQuery,a=e.n(t);a()((function(){var e=function(e){e.find(".wpaw-color-picker-field__input").each((function(e,t){var i=a()(t);i.wpColorPicker({change:function(){i.trigger("input")}})}))};a()(document).on("widget-added widget-updated",(function(t,a){e(a)})),a()(document).on("wpaw-repeaters-add-repeater",(function(t,i){var n=i.repeater;n.find(".wpaw-color-picker-field").each((function(e,t){var i=a()(t).find(".wpaw-color-picker-field__input").clone(!1),n=a()(t).find(".wp-picker-container");n.before(i),n.remove()})),e(n)})),a()("#widgets-right .widget:has(.wpaw-color-picker-field__input) .widget-inside").each((function(t,i){e(a()(i))}))})),a()((function(){function e(e){var t=e.closest(".wpaw-item-selector").find(".wpaw-item-selector__input"),i=e.find(".wpaw-item-selector__selected-item").map((function(e,t){return a()(t).attr("data-post-id")})).get();t.val(i).trigger("change")}function t(e){e.find(".wpaw-item-selector__selected-items");var t=e.find(".wpaw-item-selector__items"),i=e.find(".wpaw-item-selector__post-type").val(),n=e.find(".wpaw-item-selector__search__input").val(),r="";r="?per_page="+t.attr("data-per-page"),r+="&offset="+t.attr("data-offset"),n&&(r+="&search="+n),"true"!==t.attr("data-loading")&&"true"!==t.attr("data-failed")&&(t.append('<span class="spinner"></span>'),t.attr("data-loading","true"),function(e,t){var i=wp_awesome_widgets_item_selector_wp_api.root.match(/\?/)?t.replace("?","&"):t;return a().ajax({dataType:"json",type:"GET",url:wp_awesome_widgets_item_selector_wp_api.root+"wp/v2/"+e+i})}(i,r).done((function(e){0<e.length?(function(e,t){t.forEach((function(t){var i=t.title.rendered?t.title.rendered:"&nbsp;";a()('<li class="wpaw-item-selector__item" />').attr("data-post-id",t.id).attr("data-post-title",t.title.rendered).append('<span class="dashicons dashicons-plus" />').append(i).appendTo(e)}))}(t,e),t.attr("data-offset",parseInt(t.attr("data-offset"))+parseInt(t.attr("data-per-page")))):t.attr("data-failed","true")})).fail((function(){console.error("Read failed or canceled."),t.attr("data-failed","true")})).always((function(){t.find(".spinner").remove(),t.attr("data-loading","false")})))}a()(document).on("click",".wpaw-item-selector__item",(function(t){var i=a()(t.currentTarget).closest(".wpaw-item-selector"),n=i.find(".wpaw-item-selector__selected-items"),r=(i.find(".wpaw-item-selector__input"),a()(t.currentTarget).attr("data-post-title")||"&nbsp"),o=a()('<li class="wpaw-item-selector__selected-item" />').attr("data-post-id",a()(t.currentTarget).attr("data-post-id")).append('<span class="dashicons dashicons-minus" />').append(r);n.find('[data-post-id="'+a()(t.currentTarget).attr("data-post-id")+'"]').length||(o.appendTo(n),e(n))})),a()(document).on("mouseover",".wpaw-item-selector__selected-items",(function(t){var i=a()(t.currentTarget);a()(t.currentTarget).sortable({update:function(t,a){e(i)}}),a()(t.currentTarget).disableSelection()})),a()(document).on("click",".wpaw-item-selector__selected-item",(function(t){var i=a()(t.currentTarget).closest(".wpaw-item-selector").find(".wpaw-item-selector__selected-items");a()(t.currentTarget).remove(),e(i)})),a()(document).on("widget-added widget-updated",(function(e,a){var i=a.find(".wpaw-item-selector");1>i.length||t(i)})),a()("#widgets-right .widget:has(.wpaw-item-selector) .widget-inside").each((function(e,i){var n=a()(i).find(".wpaw-item-selector");1>n.length||t(n)})),a()(document).on("click",".wpaw-item-selector__refresh-btn",(function(e){var i=a()(e.currentTarget).closest(".wpaw-item-selector"),n=(i.find(".wpaw-item-selector__selected-items"),i.find(".wpaw-item-selector__items"));n.attr("data-offset",0),n.empty(),t(i)})),a()(document).on("change",".wpaw-item-selector__post-type",(function(i){var n=a()(i.currentTarget).closest(".wpaw-item-selector"),r=n.find(".wpaw-item-selector__selected-items"),o=n.find(".wpaw-item-selector__items"),c=n.find(".wpaw-item-selector__search__input");o.attr("data-offset",0),o.attr("data-failed","false"),r.empty(),e(r),c.val(""),o.empty(),t(n)})),a()(document).on("input",".wpaw-item-selector__search__input",(function(e){var i=a()(e.currentTarget).closest(".wpaw-item-selector"),n=i.find(".wpaw-item-selector__items");n.attr("data-offset",0),n.attr("data-failed","false"),n.empty(),setTimeout((function(){t(i)}),2e3)})),document.addEventListener("scroll",(function(e){a()(e.target).hasClass("wpaw-item-selector__items")&&(a()(e.target).get(0).scrollHeight-a()(e.target).height()>a()(e.target).scrollTop()||t(a()(e.target).closest(".wpaw-item-selector")))}),!0)})),a()((function(){a()(document).on("click",".wpaw-repeaters__add-repeater-btn",(function(e){e.preventDefault();var t=a()(e.currentTarget).closest(".wpaw-widget-form"),i=t.find(".wpaw-repeaters__item").first().clone(!0);i.find("input, select, textarea, button").each((function(e,t){a()(t).on("change",(function(){var e=i.closest(".form, form");e.find(".widget-control-save").css("display","inline-block"),e.find(".widget-control-save").trigger("click")}))})),t.find(".wpaw-repeaters__items").append(i),t.find(".wpaw-repeaters__item").each((function(e,t){var i=e;a()(t).find("input, select, textarea, button").each((function(e,t){var n=a()(t);if(void 0===n.attr("name"))return!0;n.attr("name",a()(t).attr("name").replace(/\[\s*\d+\s*\](\[[^\[\]]+\])$/,"["+i+"]$1")),n.attr("id",a()(t).attr("id").replace(/\[\s*\d+\s*\](\[[^\[\]]+\])$/,"["+i+"]$1")),n.on("touchstart",(function(){n.focus()}))}))})),a()(document).trigger("wpaw-repeaters-add-repeater",{repeater:i,widget:t})})),a()(document).on("click",".wpaw-repeaters__item-controls .button-link-delete",(function(e){e.preventDefault();var t=a()(e.currentTarget),i=t.closest(".form, form");t.closest(".wpaw-repeaters__item").remove(),i.find(".widget-control-save").css("display","inline-block"),i.find(".widget-control-save").trigger("click")})),a()(document).on("mouseover",".wpaw-repeaters__items",(function(e){a()(e.currentTarget).sortable()}))})),a()((function(){a()(document).on("click",".wpaw-thumbnail-field__set-image-btn",(function(e){e.preventDefault();var t=a()(e.currentTarget),i=t.closest(".form, form"),n=t.closest(".wpaw-thumbnail-field"),r=wp.media({title:"Insert image",library:{type:"image"},button:{text:"Use this image"},multiple:!1});r.on("select",(function(){var e=r.state().get("selection").first().toJSON(),t=void 0!==e.sizes.medium?e.sizes.medium.url:e.sizes.full.url,o=a()("<img/>").attr("src",t);n.find(".wpaw-thumbnail-field__thumbnail").empty().append(o),n.find(".wpaw-thumbnail-field__input-image").val(e.id),i.find(".widget-control-save").css("display","inline-block"),i.find(".widget-control-save").trigger("click")})).open()})),a()(document).on("click",".wpaw-thumbnail-field__unset-image-btn",(function(e){e.preventDefault();var t=a()(e.currentTarget),i=t.closest(".form, form"),n=t.closest(".wpaw-thumbnail-field");n.find(".wpaw-thumbnail-field__thumbnail").empty(),n.find(".wpaw-thumbnail-field__input-image").val(""),i.find(".widget-control-save").css("display","inline-block"),i.find(".widget-control-save").trigger("click")}))})),a()((function(){a()(document).on("wpaw-repeaters-add-repeater",(function(e,t){var a=t.repeater;a.find(".wpaw-thumbnail-field__thumbnail").empty(),a.find(".wpaw-thumbnail-field__input-image").val(""),a.find(".wpaw-pr-box-widget__input-title").val(""),a.find(".wpaw-pr-box-widget__input-summary").val("")}))})),a()((function(){a()(document).on("wpaw-repeaters-add-repeater",(function(e,t){var a=t.repeater;a.find(".wpaw-thumbnail-field__thumbnail").empty(),a.find(".wpaw-thumbnail-field__input-image").val("")})),a()(document).on("change",".js-wpaw-slider-widget-type",(function(e){var t=a()(e.currentTarget).closest(".wpaw-widget-form");"slide"===a()(e.currentTarget).val()?t.find(".js-wpaw-slider-widget-only-slide").attr("aria-hidden","false"):t.find(".js-wpaw-slider-widget-only-slide").attr("aria-hidden","true")})),a()('[id*="inc2734_wp_awesome_widgets_slider"]').on("click",(function(e){"slide"===a()(e.currentTarget).find(".js-wpaw-slider-widget-type").val()?a()(e.currentTarget).find(".js-wpaw-slider-widget-only-slide").attr("aria-hidden","false"):a()(e.currentTarget).find(".js-wpaw-slider-widget-only-slide").attr("aria-hidden","true")}))}))}();