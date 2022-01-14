!function(){var e={572:function(e,t,n){"use strict";var r={};function o(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}n.r(r),n.d(r,{metadata:function(){return m},name:function(){return q},settings:function(){return g}});var a=window.wp.element,s=window.lodash,l=window.wp.blocks,i=(window.wp.richText,window.wp.i18n);function c(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}var m=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/faq-item","title":"Item","description":"It is a child block of the FAQ block.","category":"smb","parent":["snow-monkey-blocks/faq"],"attributes":{"question":{"type":"string","source":"html","selector":".smb-faq__item__question__body","default":""},"questionColor":{"type":"string"},"answerColor":{"type":"string"},"questionLabel":{"type":"string","source":"html","selector":".smb-faq__item__question__label","default":"Q"},"answerLabel":{"type":"string","source":"html","selector":".smb-faq__item__answer__label","default":"A"}},"supports":{"anchor":true}}'),_=(0,a.createElement)("svg",{viewBox:"0 0 24 24"},(0,a.createElement)("path",{d:"M12,3a9,9,0,1,0,9,9A9,9,0,0,0,12,3Zm0,17a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"}),(0,a.createElement)("path",{d:"M11.72,14.22a.36.36,0,0,1-.35-.36v.19a3.27,3.27,0,0,1,.2-1.2,2.62,2.62,0,0,1,.46-.77,8.76,8.76,0,0,1,.85-.82,4.33,4.33,0,0,0,.8-.86,1.43,1.43,0,0,0,.18-.7,1.64,1.64,0,0,0-.54-1.21A1.79,1.79,0,0,0,12,8a1.77,1.77,0,0,0-1.26.47,2.17,2.17,0,0,0-.6,1.17.36.36,0,0,1-.39.27l-.52-.07a.35.35,0,0,1-.3-.42,2.94,2.94,0,0,1,.91-1.68A3.14,3.14,0,0,1,12,7a3.21,3.21,0,0,1,2.24.77,2.46,2.46,0,0,1,.55,3,5.6,5.6,0,0,1-1.16,1.29,6.32,6.32,0,0,0-.75.75,1.52,1.52,0,0,0-.26.56,1.87,1.87,0,0,0-.09.5.35.35,0,0,1-.35.34Z"}),(0,a.createElement)("circle",{cx:"11.98",cy:"16.08",r:"0.92"})),u=n(184),b=n.n(u),f=window.wp.components,p=window.wp.blockEditor;function d(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function w(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?d(Object(n),!0).forEach((function(t){o(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):d(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var y=m.attributes,v=[{attributes:w(w({},y),{},{answer:{type:"string",source:"html",selector:".smb-faq__item__answer__body",multiline:"p",default:""}}),migrate:function(e){var t;return[(0,s.omit)(e,"answer"),(t=e.answer,t=t.match("</p><p>")?t.split("</p><p>"):t.split(),(0,s.times)(t.length,(function(e){var n=t[e].replace("<p>","").replace("</p>","");return(0,l.createBlock)("core/paragraph",{content:n})})))]},save:function(e){var t=e.attributes,n=e.className,r=t.question,o=t.answer,s=t.questionColor,l=t.answerColor,i=t.questionLabel,c=t.answerLabel,m=b()("smb-faq__item",n),_={color:s||void 0},u={color:l||void 0};return(0,a.createElement)("div",{className:m},(0,a.createElement)("div",{className:"smb-faq__item__question"},(0,a.createElement)("div",{className:"smb-faq__item__question__label",style:_},i),(0,a.createElement)("div",{className:"smb-faq__item__question__body"},(0,a.createElement)(p.RichText.Content,{value:r}))),(0,a.createElement)("div",{className:"smb-faq__item__answer"},(0,a.createElement)("div",{className:"smb-faq__item__answer__label",style:u},c),(0,a.createElement)("div",{className:"smb-faq__item__answer__body"},(0,a.createElement)(p.RichText.Content,{value:o}))))}},{attributes:w(w({},y),{},{answer:{type:"string",source:"html",selector:".smb-faq__item__answer__body",multiline:"p",default:""}}),save:function(e){var t=e.attributes,n=t.question,r=t.answer,o=t.questionColor,s=t.answerColor;return(0,a.createElement)("div",{className:"smb-faq__item"},(0,a.createElement)("div",{className:"smb-faq__item__question"},(0,a.createElement)("div",{className:"smb-faq__item__question__label",style:{color:o}},"Q"),(0,a.createElement)("div",{className:"smb-faq__item__question__body"},(0,a.createElement)(p.RichText.Content,{value:n}))),(0,a.createElement)("div",{className:"smb-faq__item__answer"},(0,a.createElement)("div",{className:"smb-faq__item__answer__label",style:{color:s}},"A"),(0,a.createElement)("div",{className:"smb-faq__item__answer__body"},(0,a.createElement)(p.RichText.Content,{value:r}))))}}],q=m.name,g={icon:{foreground:"#cd162c",src:_},edit:function(e){var t=e.attributes,n=e.setAttributes,r=e.className,o=t.question,s=t.questionColor,l=t.answerColor,c=t.questionLabel,m=t.answerLabel,_=b()("smb-faq__item",r),u={color:s||void 0},d={color:l||void 0},w=(0,p.useBlockProps)({className:_}),y=(0,p.__experimentalUseInnerBlocksProps)({className:"smb-faq__item__answer__body"});return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(p.InspectorControls,null,(0,a.createElement)(f.PanelBody,{title:(0,i.__)("Block Settings","snow-monkey-blocks")},(0,a.createElement)(f.BaseControl,{label:(0,i.__)("Question Label","snow-monkey-blocks"),id:"snow-monkey-blocks/faq-item/question-label"},(0,a.createElement)(f.TextControl,{value:c,placeholder:(0,i.__)("Q","snow-monkey-blocks"),onChange:function(e){return n({questionLabel:e})},help:(0,i.sprintf)(// translators: %d: Length
(0,i.__)("Recommend length up to %d","snow-monkey-blocks"),Number(2))})),(0,a.createElement)(f.BaseControl,{label:(0,i.__)("Answer Label","snow-monkey-blocks"),id:"snow-monkey-blocks/faq-item/answer-label"},(0,a.createElement)(f.TextControl,{value:m,placeholder:(0,i.__)("A","snow-monkey-blocks"),onChange:function(e){return n({answerLabel:e})},help:(0,i.sprintf)(// translators: %d: Length
(0,i.__)("Recommend length up to %d","snow-monkey-blocks"),Number(2))}))),(0,a.createElement)(p.PanelColorSettings,{title:(0,i.__)("Color Settings","snow-monkey-blocks"),colorSettings:[{value:s,onChange:function(e){return n({questionColor:e})},label:(0,i.__)("Question Color","snow-monkey-blocks")},{value:l,onChange:function(e){return n({answerColor:e})},label:(0,i.__)("Answer Color","snow-monkey-blocks")}]})),(0,a.createElement)("div",w,(0,a.createElement)("div",{className:"smb-faq__item__question"},(0,a.createElement)("div",{className:"smb-faq__item__question__label",style:u},c),(0,a.createElement)(p.RichText,{className:"smb-faq__item__question__body",placeholder:(0,i.__)("Write question…","snow-monkey-blocks"),value:o,multiline:!1,onChange:function(e){return n({question:e})}})),(0,a.createElement)("div",{className:"smb-faq__item__answer"},(0,a.createElement)("div",{className:"smb-faq__item__answer__label",style:d},m),(0,a.createElement)("div",y))))},save:function(e){var t=e.attributes,n=e.className,r=t.question,o=t.questionColor,s=t.answerColor,l=t.questionLabel,i=t.answerLabel,c=b()("smb-faq__item",n),m={color:o||void 0},_={color:s||void 0};return(0,a.createElement)("div",p.useBlockProps.save({className:c}),(0,a.createElement)("div",{className:"smb-faq__item__question"},(0,a.createElement)("div",{className:"smb-faq__item__question__label",style:m},l),(0,a.createElement)("div",{className:"smb-faq__item__question__body"},(0,a.createElement)(p.RichText.Content,{value:r}))),(0,a.createElement)("div",{className:"smb-faq__item__answer"},(0,a.createElement)("div",{className:"smb-faq__item__answer__label",style:_},i),(0,a.createElement)("div",{className:"smb-faq__item__answer__body"},(0,a.createElement)(p.InnerBlocks.Content,null))))},deprecated:v};!function(e){if(e){var t=e.metadata,n=e.settings,r=e.name;t&&(t.title&&(t.title=(0,i.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,i.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,i.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,l.registerBlockType)(function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?c(Object(n),!0).forEach((function(t){o(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):c(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({name:r},t),n)}}(r)},184:function(e,t){var n;!function(){"use strict";var r={}.hasOwnProperty;function o(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var a=typeof n;if("string"===a||"number"===a)e.push(n);else if(Array.isArray(n)){if(n.length){var s=o.apply(null,n);s&&e.push(s)}}else if("object"===a)if(n.toString===Object.prototype.toString)for(var l in n)r.call(n,l)&&n[l]&&e.push(l);else e.push(n.toString())}}return e.join(" ")}e.exports?(o.default=o,e.exports=o):void 0===(n=function(){return o}.apply(t,[]))||(e.exports=n)}()}},t={};function n(r){var o=t[r];if(void 0!==o)return o.exports;var a=t[r]={exports:{}};return e[r](a,a.exports,n),a.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var r in t)n.o(t,r)&&!n.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(572)}();