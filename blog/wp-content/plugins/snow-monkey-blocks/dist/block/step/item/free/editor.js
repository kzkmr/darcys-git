!function(){var e={575:function(e,t,r){"use strict";var n={};function o(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}r.r(n),r.d(n,{metadata:function(){return c},name:function(){return _},settings:function(){return y}});var i=window.wp.element,s=(window.lodash,window.wp.blocks),l=(window.wp.richText,window.wp.i18n);function a(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}var c=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/step--item--free","title":"Item (Free input)","description":"It is a child block of the step block.","category":"smb","parent":["snow-monkey-blocks/step"],"attributes":{"title":{"type":"string","source":"html","selector":".smb-step__item__title > span","default":""},"numberColor":{"type":"string"}},"supports":{"anchor":true}}'),m=(0,i.createElement)("svg",{viewBox:"0 0 24 24"},(0,i.createElement)("rect",{x:"7.68",y:"6.14",width:"13",height:"1"}),(0,i.createElement)("rect",{x:"7.68",y:"11.14",width:"13",height:"1"}),(0,i.createElement)("rect",{x:"7.68",y:"16.14",width:"13",height:"1"}),(0,i.createElement)("path",{d:"M5.29,8.44H4.6V5.86a2.55,2.55,0,0,1-.89.52V5.75a1.87,1.87,0,0,0,.59-.33,1.24,1.24,0,0,0,.43-.57h.56Z"}),(0,i.createElement)("path",{d:"M5.85,12.8v.64H3.44a1.68,1.68,0,0,1,.24-.68,4.3,4.3,0,0,1,.77-.86A4.38,4.38,0,0,0,5,11.31a.78.78,0,0,0,.14-.42A.48.48,0,0,0,5,10.54a.49.49,0,0,0-.34-.12.46.46,0,0,0-.35.13.66.66,0,0,0-.14.43l-.69-.07a1.13,1.13,0,0,1,.39-.82,1.29,1.29,0,0,1,.8-.24,1.14,1.14,0,0,1,.83.28.92.92,0,0,1,.31.71,1.14,1.14,0,0,1-.09.46,2,2,0,0,1-.27.46,5.87,5.87,0,0,1-.45.46c-.22.2-.36.33-.41.39a1,1,0,0,0-.14.19Z"}),(0,i.createElement)("path",{d:"M3.51,17.46l.66-.08a.64.64,0,0,0,.17.39.5.5,0,0,0,.7,0,.65.65,0,0,0,.14-.43A.6.6,0,0,0,5,16.9a.43.43,0,0,0-.34-.15,1,1,0,0,0-.31.05l.07-.56a.67.67,0,0,0,.43-.12A.42.42,0,0,0,5,15.78a.39.39,0,0,0-.1-.29.4.4,0,0,0-.29-.11.41.41,0,0,0-.3.12.6.6,0,0,0-.15.36l-.63-.11a1.38,1.38,0,0,1,.2-.52.85.85,0,0,1,.37-.3,1.14,1.14,0,0,1,.53-.11,1,1,0,0,1,.81.32.83.83,0,0,1,.25.6.85.85,0,0,1-.51.75.82.82,0,0,1,.49.29.89.89,0,0,1,.18.56,1.07,1.07,0,0,1-.34.8,1.2,1.2,0,0,1-.86.33,1.15,1.15,0,0,1-.8-.28A1,1,0,0,1,3.51,17.46Z"})),u=r(184),p=r.n(u),d=window.wp.blockEditor,b=window.wp.data,f={to:[{type:"block",blocks:["snow-monkey-blocks/step--item"],transform:function(e){return(0,s.createBlock)("snow-monkey-blocks/step--item",e)}}]},_=c.name,y={icon:{foreground:"#cd162c",src:m},edit:function(e){var t=e.attributes,r=e.setAttributes,n=e.className,o=e.clientId,s=t.title,a=t.numberColor,c=(0,b.useSelect)((function(e){var t=(0,e("core/block-editor").getBlock)(o);return!(!t||!t.innerBlocks.length)}),[o]),m=p()("smb-step__item",n),u={backgroundColor:a||void 0},f=(0,d.useBlockProps)({className:m}),_=(0,d.__experimentalUseInnerBlocksProps)({className:"smb-step__item__summary"},{renderAppender:c?void 0:d.InnerBlocks.ButtonBlockAppender});return(0,i.createElement)(i.Fragment,null,(0,i.createElement)(d.InspectorControls,null,(0,i.createElement)(d.PanelColorSettings,{title:(0,l.__)("Color Settings","snow-monkey-blocks"),initialOpen:!1,colorSettings:[{value:a,onChange:function(e){return r({numberColor:e})},label:(0,l.__)("Number Color","snow-monkey-blocks")}]})),(0,i.createElement)("div",f,(0,i.createElement)("div",{className:"smb-step__item__title"},(0,i.createElement)("div",{className:"smb-step__item__number",style:u}),(0,i.createElement)(d.RichText,{tagName:"span",placeholder:(0,l.__)("Write title…","snow-monkey-blocks"),value:s,multiline:!1,onChange:function(e){return r({title:e})}})),(0,i.createElement)("div",{className:"smb-step__item__body"},(0,i.createElement)("div",_))))},save:function(e){var t=e.attributes,r=e.className,n=t.title,o=t.numberColor,s=p()("smb-step__item",r),l={backgroundColor:o||void 0};return(0,i.createElement)("div",d.useBlockProps.save({className:s}),(0,i.createElement)("div",{className:"smb-step__item__title"},(0,i.createElement)("div",{className:"smb-step__item__number",style:l}),(0,i.createElement)("span",null,(0,i.createElement)(d.RichText.Content,{value:n}))),(0,i.createElement)("div",{className:"smb-step__item__body"},(0,i.createElement)("div",{className:"smb-step__item__summary"},(0,i.createElement)(d.InnerBlocks.Content,null))))},transforms:f};!function(e){if(e){var t=e.metadata,r=e.settings,n=e.name;t&&(t.title&&(t.title=(0,l.__)(t.title,"snow-monkey-blocks"),r.title=t.title),t.description&&(t.description=(0,l.__)(t.description,"snow-monkey-blocks"),r.description=t.description),t.keywords&&(t.keywords=(0,l.__)(t.keywords,"snow-monkey-blocks"),r.keywords=t.keywords)),(0,s.registerBlockType)(function(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?a(Object(r),!0).forEach((function(t){o(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):a(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}({name:n},t),r)}}(n)},184:function(e,t){var r;!function(){"use strict";var n={}.hasOwnProperty;function o(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var i=typeof r;if("string"===i||"number"===i)e.push(r);else if(Array.isArray(r)){if(r.length){var s=o.apply(null,r);s&&e.push(s)}}else if("object"===i)if(r.toString===Object.prototype.toString)for(var l in r)n.call(r,l)&&r[l]&&e.push(l);else e.push(r.toString())}}return e.join(" ")}e.exports?(o.default=o,e.exports=o):void 0===(r=function(){return o}.apply(t,[]))||(e.exports=r)}()}},t={};function r(n){var o=t[n];if(void 0!==o)return o.exports;var i=t[n]={exports:{}};return e[n](i,i.exports,r),i.exports}r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r(575)}();