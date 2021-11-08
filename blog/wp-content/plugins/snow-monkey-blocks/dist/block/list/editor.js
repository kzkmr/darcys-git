!function(){var e={758:function(e,t,n){"use strict";var r={};function o(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}n.r(r),n.d(r,{metadata:function(){return u},name:function(){return w},settings:function(){return v}});var c=window.wp.element,l=window.lodash,i=window.wp.blocks,a=(window.wp.richText,window.wp.i18n);function s(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}var u=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/list","title":"Icon list","description":"Icons are displayed only on the actual screen.","category":"smb","attributes":{"content":{"type":"string","source":"html","selector":"ul","multiline":"li","default":""},"icon":{"type":"string","default":"angle-right"},"iconColor":{"type":"string"}},"supports":{"html":false},"example":{"attributes":{"content":"<li>Lorem ipsum dolor sit amet</li><li>consectetur adipiscing elit</li><li>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</li>"}}}'),b=(0,c.createElement)("svg",{viewBox:"0 0 24 24"},(0,c.createElement)("rect",{x:"7",y:"7",width:"13",height:"1"}),(0,c.createElement)("rect",{x:"3.5",y:"6.5",width:"2",height:"2",rx:"1"}),(0,c.createElement)("rect",{x:"7",y:"11.5",width:"13",height:"1"}),(0,c.createElement)("rect",{x:"3.5",y:"11",width:"2",height:"2",rx:"1"}),(0,c.createElement)("rect",{x:"7",y:"16",width:"13",height:"1"}),(0,c.createElement)("rect",{x:"3.5",y:"15.5",width:"2",height:"2",rx:"1"}));function p(){return p=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},p.apply(this,arguments)}var m=n(184),d=n.n(m),y=window.wp.components,f=window.wp.blockEditor;function g(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}var h=[{attributes:function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?g(Object(n),!0).forEach((function(t){o(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):g(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({},u.attributes),save:function(e){var t=e.attributes,n=t.content,r=t.icon,o=t.iconColor;return(0,c.createElement)("div",{className:"smb-list","data-icon":r,"data-icon-color":o},(0,c.createElement)("ul",null,(0,c.createElement)(f.RichText.Content,{value:n})))}}],w=u.name,v={icon:{foreground:"#cd162c",src:b},edit:function(e){var t=e.attributes,n=e.setAttributes,r=e.className,o=e.clientId,i=t.content,s=t.icon,u=t.iconColor,b=[{value:"angle-right",label:(0,a.__)("angle-right","snow-monkey-blocks")},{value:"angle-double-right",label:(0,a.__)("angle-double-right","snow-monkey-blocks")},{value:"arrow-alt-circle-right",label:(0,a.__)("arrow-alt-circle-right","snow-monkey-blocks")},{value:"arrow-right",label:(0,a.__)("arrow-right","snow-monkey-blocks")},{value:"check",label:(0,a.__)("check","snow-monkey-blocks")},{value:"check-circle",label:(0,a.__)("check-circle","snow-monkey-blocks")},{value:"check-square",label:(0,a.__)("check-square","snow-monkey-blocks")},{value:"chevron-circle-right",label:(0,a.__)("chevron-circle-right","snow-monkey-blocks")},{value:"hand-point-right",label:(0,a.__)("hand-point-right","snow-monkey-blocks")}],m=d()("smb-list",r),g=(0,f.useBlockProps)({className:m});return(0,c.createElement)(c.Fragment,null,(0,c.createElement)(f.InspectorControls,null,(0,c.createElement)(y.PanelBody,{title:(0,a.__)("Block Settings","snow-monkey-blocks")},(0,c.createElement)(y.BaseControl,{label:(0,a.__)("Icon","snow-monkey-blocks"),id:"snow-monkey-blocks/list/icon"},(0,c.createElement)("div",{className:"smb-list-icon-selector"},(0,l.times)(b.length,(function(e){var t=b[e].value,r=s===t;return(0,c.createElement)(y.Button,{isPrimary:r,onClick:function(){return n({icon:t})},key:e},(0,c.createElement)("i",{className:"fas fa-".concat(b[e].value),title:b[e].label}))}))))),(0,c.createElement)(f.PanelColorSettings,{title:(0,a.__)("Color Settings","snow-monkey-blocks"),initialOpen:!1,colorSettings:[{value:u,onChange:function(e){return n({iconColor:e})},label:(0,a.__)("Icon Color","snow-monkey-blocks")}]})),(0,c.createElement)("div",p({},g,{"data-icon":s,"data-icon-color":u}),(0,c.createElement)("style",null,'.editor-styles-wrapper [data-block="'.concat(o,'"] ul li::before, .customize-control-sidebar_block_editor [data-block="').concat(o,'"] ul li::before { border-color: ').concat(u," }")),(0,c.createElement)(f.RichText,{tagName:"ul",multiline:"li",value:i,onChange:function(e){return n({content:e})}})))},save:function(e){var t=e.attributes,n=e.className,r=t.content,o=t.icon,l=t.iconColor,i=d()("smb-list",n);return(0,c.createElement)("div",p({},f.useBlockProps.save({className:i}),{"data-icon":o,"data-icon-color":l}),(0,c.createElement)("ul",null,(0,c.createElement)(f.RichText.Content,{value:r})))},deprecated:h};!function(e){if(e){var t=e.metadata,n=e.settings,r=e.name;t&&(t.title&&(t.title=(0,a.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,a.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,a.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,i.registerBlockType)(function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?s(Object(n),!0).forEach((function(t){o(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({name:r},t),n)}}(r)},184:function(e,t){var n;!function(){"use strict";var r={}.hasOwnProperty;function o(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var c=typeof n;if("string"===c||"number"===c)e.push(n);else if(Array.isArray(n)){if(n.length){var l=o.apply(null,n);l&&e.push(l)}}else if("object"===c)if(n.toString===Object.prototype.toString)for(var i in n)r.call(n,i)&&n[i]&&e.push(i);else e.push(n.toString())}}return e.join(" ")}e.exports?(o.default=o,e.exports=o):void 0===(n=function(){return o}.apply(t,[]))||(e.exports=n)}()}},t={};function n(r){var o=t[r];if(void 0!==o)return o.exports;var c=t[r]={exports:{}};return e[r](c,c.exports,n),c.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var r in t)n.o(t,r)&&!n.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(758)}();