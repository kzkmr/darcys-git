!function(){var e={881:function(e,t,n){"use strict";var s={};n.r(s),n.d(s,{metadata:function(){return i},name:function(){return w},settings:function(){return q}});var o=window.wp.element,a=window.lodash,l=window.wp.blocks,r=(window.wp.richText,window.wp.i18n),i=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/faq-item","title":"FAQ","description":"It is a child block of the FAQ block.","category":"smb","parent":["snow-monkey-blocks/faq"],"attributes":{"question":{"type":"string","source":"html","selector":".smb-faq__item__question__body","default":""},"questionColor":{"type":"string"},"answerColor":{"type":"string"},"questionLabel":{"type":"string","source":"html","selector":".smb-faq__item__question__label","default":"Q"},"answerLabel":{"type":"string","source":"html","selector":".smb-faq__item__answer__label","default":"A"}},"supports":{"anchor":true},"editorScript":"file:../../../dist/block/faq/item/editor.js"}'),c=(0,o.createElement)("svg",{viewBox:"0 0 24 24"},(0,o.createElement)("path",{d:"M12,3a9,9,0,1,0,9,9A9,9,0,0,0,12,3Zm0,17a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"}),(0,o.createElement)("path",{d:"M11.72,14.22a.36.36,0,0,1-.35-.36v.19a3.27,3.27,0,0,1,.2-1.2,2.62,2.62,0,0,1,.46-.77,8.76,8.76,0,0,1,.85-.82,4.33,4.33,0,0,0,.8-.86,1.43,1.43,0,0,0,.18-.7,1.64,1.64,0,0,0-.54-1.21A1.79,1.79,0,0,0,12,8a1.77,1.77,0,0,0-1.26.47,2.17,2.17,0,0,0-.6,1.17.36.36,0,0,1-.39.27l-.52-.07a.35.35,0,0,1-.3-.42,2.94,2.94,0,0,1,.91-1.68A3.14,3.14,0,0,1,12,7a3.21,3.21,0,0,1,2.24.77,2.46,2.46,0,0,1,.55,3,5.6,5.6,0,0,1-1.16,1.29,6.32,6.32,0,0,0-.75.75,1.52,1.52,0,0,0-.26.56,1.87,1.87,0,0,0-.09.5.35.35,0,0,1-.35.34Z"}),(0,o.createElement)("circle",{cx:"11.98",cy:"16.08",r:"0.92"})),_=n(184),m=n.n(_),u=window.wp.blockEditor,d=window.wp.components,b=window.wp.data;const p=i.attributes;var f=[{attributes:{...p,answer:{type:"string",source:"html",selector:".smb-faq__item__answer__body",multiline:"p",default:""}},migrate:e=>[(0,a.omit)(e,"answer"),(()=>{let t=e.answer;return t=t.match("</p><p>")?t.split("</p><p>"):t.split(),(0,a.times)(t.length,(e=>{const n=t[e].replace("<p>","").replace("</p>","");return(0,l.createBlock)("core/paragraph",{content:n})}))})()],save(e){let{attributes:t,className:n}=e;const{question:s,answer:a,questionColor:l,answerColor:r,questionLabel:i,answerLabel:c}=t,_=m()("smb-faq__item",n),d={color:l||void 0},b={color:r||void 0};return(0,o.createElement)("div",{className:_},(0,o.createElement)("div",{className:"smb-faq__item__question"},(0,o.createElement)("div",{className:"smb-faq__item__question__label",style:d},i),(0,o.createElement)("div",{className:"smb-faq__item__question__body"},(0,o.createElement)(u.RichText.Content,{value:s}))),(0,o.createElement)("div",{className:"smb-faq__item__answer"},(0,o.createElement)("div",{className:"smb-faq__item__answer__label",style:b},c),(0,o.createElement)("div",{className:"smb-faq__item__answer__body"},(0,o.createElement)(u.RichText.Content,{value:a}))))}},{attributes:{...p,answer:{type:"string",source:"html",selector:".smb-faq__item__answer__body",multiline:"p",default:""}},save(e){let{attributes:t}=e;const{question:n,answer:s,questionColor:a,answerColor:l}=t;return(0,o.createElement)("div",{className:"smb-faq__item"},(0,o.createElement)("div",{className:"smb-faq__item__question"},(0,o.createElement)("div",{className:"smb-faq__item__question__label",style:{color:a}},"Q"),(0,o.createElement)("div",{className:"smb-faq__item__question__body"},(0,o.createElement)(u.RichText.Content,{value:n}))),(0,o.createElement)("div",{className:"smb-faq__item__answer"},(0,o.createElement)("div",{className:"smb-faq__item__answer__label",style:{color:l}},"A"),(0,o.createElement)("div",{className:"smb-faq__item__answer__body"},(0,o.createElement)(u.RichText.Content,{value:s}))))}}];const{name:w}=i,q={icon:{foreground:"#cd162c",src:c},edit:function(e){let{attributes:t,setAttributes:n,className:s,clientId:a}=e;const{question:l,questionColor:i,answerColor:c,questionLabel:_,answerLabel:p}=t,f=(0,b.useSelect)((e=>{var t,n;return!(null===(t=e("core/block-editor").getBlock(a))||void 0===t||null===(n=t.innerBlocks)||void 0===n||!n.length)}),[a]),w=m()("smb-faq__item",s),q={color:i||void 0},v={color:c||void 0},y=(0,u.useBlockProps)({className:w}),k=(0,u.useInnerBlocksProps)({className:"smb-faq__item__answer__body"},{renderAppender:f?u.InnerBlocks.DefaultBlockAppender:u.InnerBlocks.ButtonBlockAppender});return(0,o.createElement)(o.Fragment,null,(0,o.createElement)(u.InspectorControls,null,(0,o.createElement)(u.__experimentalPanelColorGradientSettings,{title:(0,r.__)("Color","snow-monkey-blocks"),initialOpen:!1,settings:[{colorValue:i,onColorChange:e=>n({questionColor:e}),label:(0,r.__)("Question color","snow-monkey-blocks")},{colorValue:c,onColorChange:e=>n({answerColor:e}),label:(0,r.__)("Answer color","snow-monkey-blocks")}],__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0}),(0,o.createElement)(d.PanelBody,{title:(0,r.__)("Block settings","snow-monkey-blocks")},(0,o.createElement)(d.BaseControl,{label:(0,r.__)("Question label","snow-monkey-blocks"),id:"snow-monkey-blocks/faq-item/question-label"},(0,o.createElement)(d.TextControl,{value:_,placeholder:(0,r.__)("Q","snow-monkey-blocks"),onChange:e=>n({questionLabel:e}),help:(0,r.sprintf)(// translators: %d: Length
(0,r.__)("Recommend length up to %d","snow-monkey-blocks"),Number(2))})),(0,o.createElement)(d.BaseControl,{label:(0,r.__)("Answer label","snow-monkey-blocks"),id:"snow-monkey-blocks/faq-item/answer-label"},(0,o.createElement)(d.TextControl,{value:p,placeholder:(0,r.__)("A","snow-monkey-blocks"),onChange:e=>n({answerLabel:e}),help:(0,r.sprintf)(// translators: %d: Length
(0,r.__)("Recommend length up to %d","snow-monkey-blocks"),Number(2))})))),(0,o.createElement)("div",y,(0,o.createElement)("div",{className:"smb-faq__item__question"},(0,o.createElement)("div",{className:"smb-faq__item__question__label",style:q},_),(0,o.createElement)(u.RichText,{className:"smb-faq__item__question__body",placeholder:(0,r.__)("Write question…","snow-monkey-blocks"),value:l,multiline:!1,onChange:e=>n({question:e})})),(0,o.createElement)("div",{className:"smb-faq__item__answer"},(0,o.createElement)("div",{className:"smb-faq__item__answer__label",style:v},p),(0,o.createElement)("div",k))))},save:function(e){let{attributes:t,className:n}=e;const{question:s,questionColor:a,answerColor:l,questionLabel:r,answerLabel:i}=t,c=m()("smb-faq__item",n),_={color:a||void 0},d={color:l||void 0};return(0,o.createElement)("div",u.useBlockProps.save({className:c}),(0,o.createElement)("div",{className:"smb-faq__item__question"},(0,o.createElement)("div",{className:"smb-faq__item__question__label",style:_},r),(0,o.createElement)(u.RichText.Content,{tagName:"div",className:"smb-faq__item__question__body",value:s})),(0,o.createElement)("div",{className:"smb-faq__item__answer"},(0,o.createElement)("div",{className:"smb-faq__item__answer__label",style:d},i),(0,o.createElement)("div",u.useInnerBlocksProps.save({className:"smb-faq__item__answer__body"}))))},deprecated:f};(e=>{if(!e)return;const{metadata:t,settings:n,name:s}=e;t&&(t.title&&(t.title=(0,r.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,r.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,r.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,l.registerBlockType)({name:s,...t},n)})(s)},184:function(e,t){var n;!function(){"use strict";var s={}.hasOwnProperty;function o(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var a=typeof n;if("string"===a||"number"===a)e.push(n);else if(Array.isArray(n)){if(n.length){var l=o.apply(null,n);l&&e.push(l)}}else if("object"===a)if(n.toString===Object.prototype.toString)for(var r in n)s.call(n,r)&&n[r]&&e.push(r);else e.push(n.toString())}}return e.join(" ")}e.exports?(o.default=o,e.exports=o):void 0===(n=function(){return o}.apply(t,[]))||(e.exports=n)}()}},t={};function n(s){var o=t[s];if(void 0!==o)return o.exports;var a=t[s]={exports:{}};return e[s](a,a.exports,n),a.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var s in t)n.o(t,s)&&!n.o(e,s)&&Object.defineProperty(e,s,{enumerable:!0,get:t[s]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(881)}();