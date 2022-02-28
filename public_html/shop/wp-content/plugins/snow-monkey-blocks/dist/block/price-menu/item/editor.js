!function(){var e={215:function(e,t,r){"use strict";var n={};r.r(n),r.d(n,{metadata:function(){return c},name:function(){return p},settings:function(){return d}});var i=window.wp.element,o=(window.lodash,window.wp.blocks),s=(window.wp.richText,window.wp.i18n),c=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/price-menu-item","title":"Menu","description":"It is a child block of the price menu block.","category":"smb","parent":["snow-monkey-blocks/price-menu"],"attributes":{"title":{"type":"string","source":"html","selector":".smb-price-menu__item__title","default":""},"price":{"type":"string","source":"html","selector":".smb-price-menu__item__price","default":""}},"supports":{"html":false},"editorScript":"file:../../../dist/block/price-menu/item/editor.js"}'),a=(0,i.createElement)("svg",{viewBox:"0 0 24 24"},(0,i.createElement)("path",{d:"M12,3a9,9,0,1,0,9,9A9,9,0,0,0,12,3Zm0,17a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"}),(0,i.createElement)("path",{d:"M12.33,11.34c-.76-.29-1.42-.54-1.42-1s.45-.85,1.17-.85a2.31,2.31,0,0,1,1.63.63l.06.06.61-.69-.06,0a2.82,2.82,0,0,0-1.79-.89V7h-.86V8.52A1.89,1.89,0,0,0,9.8,10.33c0,1.14,1.12,1.58,2.1,2,.79.31,1.54.61,1.54,1.2s-.49.9-1.29.9a3.45,3.45,0,0,1-2.08-.76L10,13.57l-.54.81.06,0a4.17,4.17,0,0,0,2.16.9V17h.86V15.32c1.23-.16,2-.9,2-1.9C14.55,12.18,13.37,11.73,12.33,11.34Z"})),l=r(184),u=r.n(l),m=window.wp.blockEditor;const{name:p}=c,d={icon:{foreground:"#cd162c",src:a},edit:function(e){let{attributes:t,setAttributes:r,className:n}=e;const{title:o,price:c}=t,a=u()("smb-price-menu__item",n),l=(0,m.useBlockProps)({className:a});return(0,i.createElement)("div",l,(0,i.createElement)(m.RichText,{className:"smb-price-menu__item__title",placeholder:(0,s.__)("Write title…","snow-monkey-blocks"),value:o,onChange:e=>r({title:e})}),(0,i.createElement)(m.RichText,{className:"smb-price-menu__item__price",placeholder:(0,s.__)("Write price…","snow-monkey-blocks"),value:c,onChange:e=>r({price:e})}))},save:function(e){let{attributes:t,className:r}=e;const{title:n,price:o}=t,s=u()("smb-price-menu__item",r);return(0,i.createElement)("div",m.useBlockProps.save({className:s}),(0,i.createElement)("div",{className:"smb-price-menu__item__title"},(0,i.createElement)(m.RichText.Content,{value:n})),(0,i.createElement)("div",{className:"smb-price-menu__item__price"},(0,i.createElement)(m.RichText.Content,{value:o})))}};(e=>{if(!e)return;const{metadata:t,settings:r,name:n}=e;t&&(t.title&&(t.title=(0,s.__)(t.title,"snow-monkey-blocks"),r.title=t.title),t.description&&(t.description=(0,s.__)(t.description,"snow-monkey-blocks"),r.description=t.description),t.keywords&&(t.keywords=(0,s.__)(t.keywords,"snow-monkey-blocks"),r.keywords=t.keywords)),(0,o.registerBlockType)({name:n,...t},r)})(n)},184:function(e,t){var r;!function(){"use strict";var n={}.hasOwnProperty;function i(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var o=typeof r;if("string"===o||"number"===o)e.push(r);else if(Array.isArray(r)){if(r.length){var s=i.apply(null,r);s&&e.push(s)}}else if("object"===o)if(r.toString===Object.prototype.toString)for(var c in r)n.call(r,c)&&r[c]&&e.push(c);else e.push(r.toString())}}return e.join(" ")}e.exports?(i.default=i,e.exports=i):void 0===(r=function(){return i}.apply(t,[]))||(e.exports=r)}()}},t={};function r(n){var i=t[n];if(void 0!==i)return i.exports;var o=t[n]={exports:{}};return e[n](o,o.exports,r),o.exports}r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r(215)}();