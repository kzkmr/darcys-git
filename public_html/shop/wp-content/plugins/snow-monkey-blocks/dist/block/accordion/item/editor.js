!function(){var e={184:function(e,t){var n;!function(){"use strict";var o={}.hasOwnProperty;function a(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var i=typeof n;if("string"===i||"number"===i)e.push(n);else if(Array.isArray(n)){if(n.length){var r=a.apply(null,n);r&&e.push(r)}}else if("object"===i)if(n.toString===Object.prototype.toString)for(var c in n)o.call(n,c)&&n[c]&&e.push(c);else e.push(n.toString())}}return e.join(" ")}e.exports?(a.default=a,e.exports=a):void 0===(n=function(){return a}.apply(t,[]))||(e.exports=n)}()}},t={};function n(o){var a=t[o];if(void 0!==a)return a.exports;var i=t[o]={exports:{}};return e[o](i,i.exports,n),i.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var o in t)n.o(t,o)&&!n.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){"use strict";var e={};n.r(e),n.d(e,{metadata:function(){return i},name:function(){return d},settings:function(){return u}});var t=window.wp.element,o=(window.lodash,window.wp.blocks),a=(window.wp.richText,window.wp.i18n),i=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/accordion-item","title":"Panel","category":"smb","parent":["snow-monkey-blocks/accordion"],"attributes":{"title":{"type":"string","source":"html","selector":".smb-accordion__item__title__label","default":""},"initialState":{"type":"boolean","default":false}},"supports":{"html":false,"className":true},"editorScript":"file:../../../dist/block/accordion/item/editor.js"}'),r=(0,t.createElement)("svg",{viewBox:"0 0 24 24"},(0,t.createElement)("path",{d:"M2,16.5v4H22v-4Zm19,3H3v-2H21Z"}),(0,t.createElement)("path",{d:"M2,3.5v4H22v-4Zm19,3H3v-2H21Z"}),(0,t.createElement)("polygon",{points:"21 7.5 21 13.5 3 13.5 3 7.5 2 7.5 2 14.5 22 14.5 22 7.5 21 7.5"})),c=n(184),s=n.n(c),l=window.wp.components,m=window.wp.blockEditor,_=[{attributes:{title:{type:"string",source:"html",selector:".smb-accordion__item__title",default:""}},save(e){let{attributes:n,className:o}=e;const a=s()("smb-accordion__item",o),{title:i}=n;return(0,t.createElement)("div",{className:a},(0,t.createElement)("div",{className:"smb-accordion__item__title"},(0,t.createElement)(m.RichText.Content,{value:i})),(0,t.createElement)("input",{type:"checkbox",className:"smb-accordion__item__control"}),(0,t.createElement)("div",{className:"smb-accordion__item__body"},(0,t.createElement)(m.InnerBlocks.Content,null)))}},{attributes:{title:{type:"string",source:"html",selector:".smb-accordion__item__title",default:""}},save(e){let{attributes:n}=e;const{title:o}=n;return(0,t.createElement)("div",{className:"smb-accordion__item"},(0,t.createElement)("div",{className:"smb-accordion__item__title"},(0,t.createElement)(m.RichText.Content,{value:o})),(0,t.createElement)("input",{type:"checkbox",className:"smb-accordion__item__control"}),(0,t.createElement)("div",{className:"smb-accordion__item__body"},(0,t.createElement)(m.InnerBlocks.Content,null)))}}];const{name:d}=i,u={icon:{foreground:"#cd162c",src:r},edit:function(e){let{attributes:n,setAttributes:o,className:i}=e;const{title:r,initialState:c}=n,_=s()("smb-accordion__item",i),d=(0,m.useBlockProps)({className:_}),u=(0,m.useInnerBlocksProps)({className:"smb-accordion__item__body"});return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(m.InspectorControls,null,(0,t.createElement)(l.PanelBody,{title:(0,a.__)("Block settings","snow-monkey-blocks")},(0,t.createElement)(l.CheckboxControl,{label:(0,a.__)("Display in open state","snow-monkey-blocks"),checked:c,onChange:e=>o({initialState:e})}))),(0,t.createElement)("div",d,(0,t.createElement)("div",{className:"smb-accordion__item__title"},(0,t.createElement)(m.RichText,{className:"smb-accordion__item__title__label",value:r,onChange:e=>o({title:e}),placeholder:(0,a.__)("Enter title here","snow-monkey-blocks")}),(0,t.createElement)("div",{className:"smb-accordion__item__title__icon"},(0,t.createElement)("i",{className:"fas fa-angle-down"}))),(0,t.createElement)("div",u)))},save:function(e){let{attributes:n,className:o}=e;const{title:a,initialState:i}=n,r=s()("smb-accordion__item",o);return(0,t.createElement)("div",m.useBlockProps.save({className:r}),(0,t.createElement)("input",{type:"checkbox",className:"smb-accordion__item__control",checked:i}),(0,t.createElement)("div",{className:"smb-accordion__item__title"},(0,t.createElement)(m.RichText.Content,{tagName:"span",className:"smb-accordion__item__title__label",value:a}),(0,t.createElement)("div",{className:"smb-accordion__item__title__icon"},(0,t.createElement)("i",{className:"fas fa-angle-down"}))),(0,t.createElement)("div",m.useInnerBlocksProps.save({className:"smb-accordion__item__body"})))},deprecated:_};(e=>{if(!e)return;const{metadata:t,settings:n,name:i}=e;t&&(t.title&&(t.title=(0,a.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,a.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,a.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,o.registerBlockType)({name:i,...t},n)})(e)}()}();