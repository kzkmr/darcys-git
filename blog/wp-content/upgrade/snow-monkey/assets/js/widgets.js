!function(){"use strict";var e=function(e,t){0<e.length&&Array.prototype.slice.call(e,0).forEach((function(e,n){t(e,n)}))};function t(t){var n=function(e){e.setAttribute("data-is-expanded","false")},i=function(e){e.setAttribute("data-is-hidden","true")},r=t.parentNode,d=function(){var e=document.createElement("button"),t=document.createElement("span");return t.classList.add("c-ic-angle-right"),i(t),e.insertBefore(t,e.firstElementChild),e.classList.add("children-expander"),n(e),e}();i(t),d.addEventListener("click",(function(){"false"===d.getAttribute("data-is-expanded")?function(){d.setAttribute("data-is-expanded","true");var t=r.children;e(t,(function(e){return"true"===e.getAttribute("data-is-hidden")&&function(e){e.setAttribute("data-is-hidden","false")}(e)}))}():function(){var t=r.querySelectorAll(".children-expander");e(t,n);var d=r.querySelectorAll(".children, .sub-menu");e(d,i)}()}),!1),r.insertBefore(d,t)}document.addEventListener("DOMContentLoaded",(function(){var n=document.querySelectorAll(".c-widget:not(.widget_block) .children, .c-widget:not(.widget_block) .sub-menu");e(n,t)}),!1)}();