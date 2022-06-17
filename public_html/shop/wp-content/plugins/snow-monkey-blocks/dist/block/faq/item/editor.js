!function(){var e={184:function(e,t){var n;!function(){"use strict";var s={}.hasOwnProperty;function o(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var a=typeof n;if("string"===a||"number"===a)e.push(n);else if(Array.isArray(n)){if(n.length){var l=o.apply(null,n);l&&e.push(l)}}else if("object"===a)if(n.toString===Object.prototype.toString)for(var r in n)s.call(n,r)&&n[r]&&e.push(r);else e.push(n.toString())}}return e.join(" ")}e.exports?(o.default=o,e.exports=o):void 0===(n=function(){return o}.apply(t,[]))||(e.exports=n)}()}},t={};function n(s){var o=t[s];if(void 0!==o)return o.exports;var a=t[s]={exports:{}};return e[s](a,a.exports,n),a.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var s in t)n.o(t,s)&&!n.o(e,s)&&Object.defineProperty(e,s,{enumerable:!0,get:t[s]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){"use strict";var e={};n.r(e),n.d(e,{metadata:function(){return l},name:function(){return p},settings:function(){return f}});var t=window.wp.element,s=window.lodash,o=window.wp.blocks,a=(window.wp.richText,window.wp.i18n),l=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/faq-item","title":"FAQ","description":"It is a child block of the FAQ block.","category":"smb","parent":["snow-monkey-blocks/faq"],"attributes":{"question":{"type":"string","source":"html","selector":".smb-faq__item__question__body","default":""},"questionColor":{"type":"string"},"answerColor":{"type":"string"},"questionLabel":{"type":"string","source":"html","selector":".smb-faq__item__question__label","default":"Q"},"answerLabel":{"type":"string","source":"html","selector":".smb-faq__item__answer__label","default":"A"}},"supports":{"anchor":true},"editorScript":"file:../../../dist/block/faq/item/editor.js"}'),r=(0,t.createElement)("svg",{viewBox:"0 0 24 24"},(0,t.createElement)("path",{d:"M12,3a9,9,0,1,0,9,9A9,9,0,0,0,12,3Zm0,17a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"}),(0,t.createElement)("path",{d:"M11.72,14.22a.36.36,0,0,1-.35-.36v.19a3.27,3.27,0,0,1,.2-1.2,2.62,2.62,0,0,1,.46-.77,8.76,8.76,0,0,1,.85-.82,4.33,4.33,0,0,0,.8-.86,1.43,1.43,0,0,0,.18-.7,1.64,1.64,0,0,0-.54-1.21A1.79,1.79,0,0,0,12,8a1.77,1.77,0,0,0-1.26.47,2.17,2.17,0,0,0-.6,1.17.36.36,0,0,1-.39.27l-.52-.07a.35.35,0,0,1-.3-.42,2.94,2.94,0,0,1,.91-1.68A3.14,3.14,0,0,1,12,7a3.21,3.21,0,0,1,2.24.77,2.46,2.46,0,0,1,.55,3,5.6,5.6,0,0,1-1.16,1.29,6.32,6.32,0,0,0-.75.75,1.52,1.52,0,0,0-.26.56,1.87,1.87,0,0,0-.09.5.35.35,0,0,1-.35.34Z"}),(0,t.createElement)("circle",{cx:"11.98",cy:"16.08",r:"0.92"})),i=n(184),c=n.n(i),_=window.wp.blockEditor,m=window.wp.components,u=window.wp.data;const d=l.attributes;var b=[{attributes:{...d,answer:{type:"string",source:"html",selector:".smb-faq__item__answer__body",multiline:"p",default:""}},migrate:e=>[(0,s.omit)(e,"answer"),(()=>{let t=e.answer;return t=t.match("</p><p>")?t.split("</p><p>"):t.split(),(0,s.times)(t.length,(e=>{const n=t[e].replace("<p>","").replace("</p>","");return(0,o.createBlock)("core/paragraph",{content:n})}))})()],save(e){let{attributes:n,className:s}=e;const{question:o,answer:a,questionColor:l,answerColor:r,questionLabel:i,answerLabel:m}=n,u=c()("smb-faq__item",s),d={color:l||void 0},b={color:r||void 0};return(0,t.createElement)("div",{className:u},(0,t.createElement)("div",{className:"smb-faq__item__question"},(0,t.createElement)("div",{className:"smb-faq__item__question__label",style:d},i),(0,t.createElement)("div",{className:"smb-faq__item__question__body"},(0,t.createElement)(_.RichText.Content,{value:o}))),(0,t.createElement)("div",{className:"smb-faq__item__answer"},(0,t.createElement)("div",{className:"smb-faq__item__answer__label",style:b},m),(0,t.createElement)("div",{className:"smb-faq__item__answer__body"},(0,t.createElement)(_.RichText.Content,{value:a}))))}},{attributes:{...d,answer:{type:"string",source:"html",selector:".smb-faq__item__answer__body",multiline:"p",default:""}},save(e){let{attributes:n}=e;const{question:s,answer:o,questionColor:a,answerColor:l}=n;return(0,t.createElement)("div",{className:"smb-faq__item"},(0,t.createElement)("div",{className:"smb-faq__item__question"},(0,t.createElement)("div",{className:"smb-faq__item__question__label",style:{color:a}},"Q"),(0,t.createElement)("div",{className:"smb-faq__item__question__body"},(0,t.createElement)(_.RichText.Content,{value:s}))),(0,t.createElement)("div",{className:"smb-faq__item__answer"},(0,t.createElement)("div",{className:"smb-faq__item__answer__label",style:{color:l}},"A"),(0,t.createElement)("div",{className:"smb-faq__item__answer__body"},(0,t.createElement)(_.RichText.Content,{value:o}))))}}];const{name:p}=l,f={icon:{foreground:"#cd162c",src:r},edit:function(e){let{attributes:n,setAttributes:s,className:o,clientId:l}=e;const{question:r,questionColor:i,answerColor:d,questionLabel:b,answerLabel:p}=n,f=(0,u.useSelect)((e=>{var t,n;return!(null===(t=e("core/block-editor").getBlock(l))||void 0===t||null===(n=t.innerBlocks)||void 0===n||!n.length)}),[l]),w=c()("smb-faq__item",o),q={color:i||void 0},v={color:d||void 0},y=(0,_.useBlockProps)({className:w}),k=(0,_.useInnerBlocksProps)({className:"smb-faq__item__answer__body"},{renderAppender:f?_.InnerBlocks.DefaultBlockAppender:_.InnerBlocks.ButtonBlockAppender});return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(_.InspectorControls,null,(0,t.createElement)(_.__experimentalPanelColorGradientSettings,{title:(0,a.__)("Color","snow-monkey-blocks"),initialOpen:!1,settings:[{colorValue:i,onColorChange:e=>s({questionColor:e}),label:(0,a.__)("Question color","snow-monkey-blocks")},{colorValue:d,onColorChange:e=>s({answerColor:e}),label:(0,a.__)("Answer color","snow-monkey-blocks")}],__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0}),(0,t.createElement)(m.PanelBody,{title:(0,a.__)("Block settings","snow-monkey-blocks")},(0,t.createElement)(m.BaseControl,{label:(0,a.__)("Question label","snow-monkey-blocks"),id:"snow-monkey-blocks/faq-item/question-label"},(0,t.createElement)(m.TextControl,{value:b,placeholder:(0,a.__)("Q","snow-monkey-blocks"),onChange:e=>s({questionLabel:e}),help:(0,a.sprintf)(// translators: %d: Length
(0,a.__)("Recommend length up to %d","snow-monkey-blocks"),Number(2))})),(0,t.createElement)(m.BaseControl,{label:(0,a.__)("Answer label","snow-monkey-blocks"),id:"snow-monkey-blocks/faq-item/answer-label"},(0,t.createElement)(m.TextControl,{value:p,placeholder:(0,a.__)("A","snow-monkey-blocks"),onChange:e=>s({answerLabel:e}),help:(0,a.sprintf)(// translators: %d: Length
(0,a.__)("Recommend length up to %d","snow-monkey-blocks"),Number(2))})))),(0,t.createElement)("div",y,(0,t.createElement)("div",{className:"smb-faq__item__question"},(0,t.createElement)("div",{className:"smb-faq__item__question__label",style:q},b),(0,t.createElement)(_.RichText,{className:"smb-faq__item__question__body",placeholder:(0,a.__)("Write question…","snow-monkey-blocks"),value:r,multiline:!1,onChange:e=>s({question:e})})),(0,t.createElement)("div",{className:"smb-faq__item__answer"},(0,t.createElement)("div",{className:"smb-faq__item__answer__label",style:v},p),(0,t.createElement)("div",k))))},save:function(e){let{attributes:n,className:s}=e;const{question:o,questionColor:a,answerColor:l,questionLabel:r,answerLabel:i}=n,m=c()("smb-faq__item",s),u={color:a||void 0},d={color:l||void 0};return(0,t.createElement)("div",_.useBlockProps.save({className:m}),(0,t.createElement)("div",{className:"smb-faq__item__question"},(0,t.createElement)("div",{className:"smb-faq__item__question__label",style:u},r),(0,t.createElement)(_.RichText.Content,{tagName:"div",className:"smb-faq__item__question__body",value:o})),(0,t.createElement)("div",{className:"smb-faq__item__answer"},(0,t.createElement)("div",{className:"smb-faq__item__answer__label",style:d},i),(0,t.createElement)("div",_.useInnerBlocksProps.save({className:"smb-faq__item__answer__body"}))))},deprecated:b};(e=>{if(!e)return;const{metadata:t,settings:n,name:s}=e;t&&(t.title&&(t.title=(0,a.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,a.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,a.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,o.registerBlockType)({name:s,...t},n)})(e)}()}();