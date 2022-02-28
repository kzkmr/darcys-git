!function(){var e={947:function(e,t,n){"use strict";var o={};n.r(o),n.d(o,{metadata:function(){return c},name:function(){return p},settings:function(){return b}});var a=window.wp.element,i=(window.lodash,window.wp.blocks),r=(window.wp.richText,window.wp.i18n),c=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/accordion-item","title":"Panel","category":"smb","parent":["snow-monkey-blocks/accordion"],"attributes":{"title":{"type":"string","source":"html","selector":".smb-accordion__item__title__label","default":""},"initialState":{"type":"boolean","default":false}},"supports":{"html":false,"className":true},"editorScript":"file:../../../dist/block/accordion/item/editor.js"}'),s=(0,a.createElement)("svg",{viewBox:"0 0 24 24"},(0,a.createElement)("path",{d:"M2,16.5v4H22v-4Zm19,3H3v-2H21Z"}),(0,a.createElement)("path",{d:"M2,3.5v4H22v-4Zm19,3H3v-2H21Z"}),(0,a.createElement)("polygon",{points:"21 7.5 21 13.5 3 13.5 3 7.5 2 7.5 2 14.5 22 14.5 22 7.5 21 7.5"})),l=n(184),m=n.n(l),_=window.wp.components,d=window.wp.blockEditor,u=[{attributes:{title:{type:"string",source:"html",selector:".smb-accordion__item__title",default:""}},save(e){let{attributes:t,className:n}=e;const o=m()("smb-accordion__item",n),{title:i}=t;return(0,a.createElement)("div",{className:o},(0,a.createElement)("div",{className:"smb-accordion__item__title"},(0,a.createElement)(d.RichText.Content,{value:i})),(0,a.createElement)("input",{type:"checkbox",className:"smb-accordion__item__control"}),(0,a.createElement)("div",{className:"smb-accordion__item__body"},(0,a.createElement)(d.InnerBlocks.Content,null)))}},{attributes:{title:{type:"string",source:"html",selector:".smb-accordion__item__title",default:""}},save(e){let{attributes:t}=e;const{title:n}=t;return(0,a.createElement)("div",{className:"smb-accordion__item"},(0,a.createElement)("div",{className:"smb-accordion__item__title"},(0,a.createElement)(d.RichText.Content,{value:n})),(0,a.createElement)("input",{type:"checkbox",className:"smb-accordion__item__control"}),(0,a.createElement)("div",{className:"smb-accordion__item__body"},(0,a.createElement)(d.InnerBlocks.Content,null)))}}];const{name:p}=c,b={icon:{foreground:"#cd162c",src:s},edit:function(e){let{attributes:t,setAttributes:n,className:o}=e;const{title:i,initialState:c}=t,s=m()("smb-accordion__item",o),l=(0,d.useBlockProps)({className:s}),u=(0,d.useInnerBlocksProps)({className:"smb-accordion__item__body"});return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(d.InspectorControls,null,(0,a.createElement)(_.PanelBody,{title:(0,r.__)("Block settings","snow-monkey-blocks")},(0,a.createElement)(_.CheckboxControl,{label:(0,r.__)("Display in open state","snow-monkey-blocks"),checked:c,onChange:e=>n({initialState:e})}))),(0,a.createElement)("div",l,(0,a.createElement)("div",{className:"smb-accordion__item__title"},(0,a.createElement)(d.RichText,{className:"smb-accordion__item__title__label",value:i,onChange:e=>n({title:e}),placeholder:(0,r.__)("Enter title here","snow-monkey-blocks")}),(0,a.createElement)("div",{className:"smb-accordion__item__title__icon"},(0,a.createElement)("i",{className:"fas fa-angle-down"}))),(0,a.createElement)("div",u)))},save:function(e){let{attributes:t,className:n}=e;const{title:o,initialState:i}=t,r=m()("smb-accordion__item",n);return(0,a.createElement)("div",d.useBlockProps.save({className:r}),(0,a.createElement)("input",{type:"checkbox",className:"smb-accordion__item__control",checked:i}),(0,a.createElement)("div",{className:"smb-accordion__item__title"},(0,a.createElement)(d.RichText.Content,{tagName:"span",className:"smb-accordion__item__title__label",value:o}),(0,a.createElement)("div",{className:"smb-accordion__item__title__icon"},(0,a.createElement)("i",{className:"fas fa-angle-down"}))),(0,a.createElement)("div",d.useInnerBlocksProps.save({className:"smb-accordion__item__body"})))},deprecated:u};(e=>{if(!e)return;const{metadata:t,settings:n,name:o}=e;t&&(t.title&&(t.title=(0,r.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,r.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,r.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,i.registerBlockType)({name:o,...t},n)})(o)},184:function(e,t){var n;!function(){"use strict";var o={}.hasOwnProperty;function a(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var i=typeof n;if("string"===i||"number"===i)e.push(n);else if(Array.isArray(n)){if(n.length){var r=a.apply(null,n);r&&e.push(r)}}else if("object"===i)if(n.toString===Object.prototype.toString)for(var c in n)o.call(n,c)&&n[c]&&e.push(c);else e.push(n.toString())}}return e.join(" ")}e.exports?(a.default=a,e.exports=a):void 0===(n=function(){return a}.apply(t,[]))||(e.exports=n)}()}},t={};function n(o){var a=t[o];if(void 0!==a)return a.exports;var i=t[o]={exports:{}};return e[o](i,i.exports,n),i.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var o in t)n.o(t,o)&&!n.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(947)}();