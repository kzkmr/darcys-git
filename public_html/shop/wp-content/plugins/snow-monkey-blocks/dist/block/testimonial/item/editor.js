!function(){var e={184:function(e,t){var a;!function(){"use strict";var n={}.hasOwnProperty;function i(){for(var e=[],t=0;t<arguments.length;t++){var a=arguments[t];if(a){var s=typeof a;if("string"===s||"number"===s)e.push(a);else if(Array.isArray(a)){if(a.length){var r=i.apply(null,a);r&&e.push(r)}}else if("object"===s)if(a.toString===Object.prototype.toString)for(var l in a)n.call(a,l)&&a[l]&&e.push(l);else e.push(a.toString())}}return e.join(" ")}e.exports?(i.default=i,e.exports=i):void 0===(a=function(){return i}.apply(t,[]))||(e.exports=a)}()}},t={};function a(n){var i=t[n];if(void 0!==i)return i.exports;var s=t[n]={exports:{}};return e[n](s,s.exports,a),s.exports}a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,{a:t}),t},a.d=function(e,t){for(var n in t)a.o(t,n)&&!a.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){"use strict";var e={};a.r(e),a.d(e,{metadata:function(){return s},name:function(){return d},settings:function(){return u}});var t=window.wp.element,n=(window.lodash,window.wp.blocks),i=(window.wp.richText,window.wp.i18n),s=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/testimonial-item","title":"Testimonial","description":"It is a child block of the testimonial block.","category":"smb","parent":["snow-monkey-blocks/testimonial"],"attributes":{"avatarID":{"type":"number","default":0},"avatarURL":{"type":"string","source":"attribute","selector":".smb-testimonial__item__figure > img","attribute":"src","default":"https://0.gravatar.com/avatar/00000000000000000000000000000000?s=128&d=mp&r=g"},"avatarAlt":{"type":"string","source":"attribute","selector":".smb-testimonial__item__figure > img","attribute":"alt","default":""},"name":{"type":"string","source":"html","selector":".smb-testimonial__item__name","default":""},"lede":{"type":"string","source":"html","selector":".smb-testimonial__item__lede","default":""},"content":{"type":"string","source":"html","selector":".smb-testimonial__item__content","default":""}},"supports":{"html":false},"editorScript":"file:../../../dist/block/testimonial/item/editor.js"}'),r=(0,t.createElement)("svg",{viewBox:"0 0 24 24"},(0,t.createElement)("path",{d:"M22,1.5H6a1,1,0,0,0-1,1v8a1,1,0,0,0,1,1H9l1.12,3,3.29-3H22a1,1,0,0,0,1-1v-8A1,1,0,0,0,22,1.5ZM22,10a.5.5,0,0,1-.5.5H13.31l-1.1,1h0l-1.12,1-.5.46-.11-.31L10,11.42h0l-.35-.92H6.5A.5.5,0,0,1,6,10V3a.5.5,0,0,1,.5-.5h15A.5.5,0,0,1,22,3Z"}),(0,t.createElement)("path",{d:"M10,7.45a1,1,0,1,1,1-1A1,1,0,0,1,10,7.45Z"}),(0,t.createElement)("path",{d:"M14,7.45a1,1,0,1,1,1-1A1,1,0,0,1,14,7.45Z"}),(0,t.createElement)("path",{d:"M18,7.45a1,1,0,1,1,1-1A1,1,0,0,1,18,7.45Z"}),(0,t.createElement)("path",{d:"M3.41,18.69a3.36,3.36,0,0,1,.83-.64,2.51,2.51,0,1,1,2.51,0,3.6,3.6,0,0,1,.84.64,3.5,3.5,0,1,0-4.18,0Z"}),(0,t.createElement)("path",{d:"M9,22.5h1a6.88,6.88,0,0,0-2.32-5.39,2.47,2.47,0,0,1-.93.94A5,5,0,0,1,9,22.5Z"}),(0,t.createElement)("path",{d:"M2,22.5a5,5,0,0,1,2.25-4.45,2.47,2.47,0,0,1-.93-.94A6.88,6.88,0,0,0,1,22.5Z"})),l=a(184),o=a.n(l),m=window.wp.components,c=window.wp.blockEditor,_=[{attributes:{...s.attributes},save(e){let{attributes:a}=e;const{avatarID:n,avatarURL:i,name:s,lede:r,content:l}=a;return(0,t.createElement)("div",{className:"c-row__col"},(0,t.createElement)("div",{className:"smb-testimonial__item"},(0,t.createElement)("div",{className:"smb-testimonial__item__figure"},(0,t.createElement)("img",{src:i,alt:"",className:`wp-image-${n}`})),(0,t.createElement)("div",{className:"smb-testimonial__item__body"},(0,t.createElement)("div",{className:"smb-testimonial__item__content"},(0,t.createElement)(c.RichText.Content,{value:l})),(0,t.createElement)("div",{className:"smb-testimonial__item__name"},(0,t.createElement)(c.RichText.Content,{value:s})),!c.RichText.isEmpty(r)&&(0,t.createElement)("div",{className:"smb-testimonial__item__lede"},(0,t.createElement)(c.RichText.Content,{value:r})))))}}];const{name:d}=s,u={icon:{foreground:"#cd162c",src:r},edit:function(e){let{attributes:a,setAttributes:n,isSelected:s,className:r}=e;const{avatarID:l,avatarURL:_,avatarAlt:d,name:u,lede:p,content:v}=a,b=o()("c-row__col",r),f=(0,c.useBlockProps)({className:b});return(0,t.createElement)("div",f,(0,t.createElement)("div",{className:"smb-testimonial__item"},(!!l||s)&&(0,t.createElement)("div",{className:"smb-testimonial__item__figure"},(0,t.createElement)(c.MediaUpload,{onSelect:e=>{const t=e.sizes.thumbnail?e.sizes.thumbnail.url:e.url;n({avatarURL:t,avatarID:e.id,avatarAlt:e.alt})},type:"image",value:l,render:e=>(0,t.createElement)(m.Button,{className:"image-button",onClick:e.open,style:{padding:0}},(0,t.createElement)("img",{src:_,alt:d,className:`wp-image-${l}`}))})),(0,t.createElement)("div",{className:"smb-testimonial__item__body"},(0,t.createElement)("div",{className:"smb-testimonial__item__content"},(0,t.createElement)(c.RichText,{placeholder:(0,i.__)("Write content…","snow-monkey-blocks"),value:v,onChange:e=>n({content:e})})),(0,t.createElement)(c.RichText,{className:"smb-testimonial__item__name",placeholder:(0,i.__)("Write name…","snow-monkey-blocks"),value:u,onChange:e=>n({name:e})}),(!c.RichText.isEmpty(p)||s)&&(0,t.createElement)(c.RichText,{className:"smb-testimonial__item__lede",placeholder:(0,i.__)("Write lede…","snow-monkey-blocks"),value:p,onChange:e=>n({lede:e})}))))},save:function(e){let{attributes:a,className:n}=e;const{avatarID:i,avatarURL:s,avatarAlt:r,name:l,lede:m,content:_}=a,d=o()("c-row__col",n);return(0,t.createElement)("div",c.useBlockProps.save({className:d}),(0,t.createElement)("div",{className:"smb-testimonial__item"},(0,t.createElement)("div",{className:"smb-testimonial__item__figure"},(0,t.createElement)("img",{src:s,alt:r,className:`wp-image-${i}`})),(0,t.createElement)("div",{className:"smb-testimonial__item__body"},(0,t.createElement)("div",{className:"smb-testimonial__item__content"},(0,t.createElement)(c.RichText.Content,{value:_})),(0,t.createElement)("div",{className:"smb-testimonial__item__name"},(0,t.createElement)(c.RichText.Content,{value:l})),!c.RichText.isEmpty(m)&&(0,t.createElement)("div",{className:"smb-testimonial__item__lede"},(0,t.createElement)(c.RichText.Content,{value:m})))))},deprecated:_};(e=>{if(!e)return;const{metadata:t,settings:a,name:s}=e;t&&(t.title&&(t.title=(0,i.__)(t.title,"snow-monkey-blocks"),a.title=t.title),t.description&&(t.description=(0,i.__)(t.description,"snow-monkey-blocks"),a.description=t.description),t.keywords&&(t.keywords=(0,i.__)(t.keywords,"snow-monkey-blocks"),a.keywords=t.keywords)),(0,n.registerBlockType)({name:s,...t},a)})(e)}()}();