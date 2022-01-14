!function(){var e={36:function(e,t,a){"use strict";var n={};function r(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}a.r(n),a.d(n,{metadata:function(){return u},name:function(){return N},settings:function(){return O}});var o=window.wp.element,i=window.lodash,s=window.wp.blocks,l=(window.wp.richText,window.wp.i18n);function c(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}var m=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,a=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null;return e=Number(e),(isNaN(e)||e<t)&&(e=t),null!==a&&e>a&&(e=a),e},u=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/testimonial","title":"Testimonial","description":"Let\'s arrange the voice of the customer.","category":"smb","attributes":{"md":{"type":"number","default":2},"lg":{"type":"number","default":2}},"supports":{"html":false},"example":{"innerBlocks":[{"name":"snow-monkey-blocks/testimonial-item","attributes":{"avatarID":1,"name":"Lorem","lede":"ipsum","content":"dolor sit amet"}},{"name":"snow-monkey-blocks/testimonial-item","attributes":{"avatarID":1,"name":"consectetur","lede":"adipiscing","content":"sed do eiusmod tempor"}}]}}'),d=(0,o.createElement)("svg",{viewBox:"0 0 24 24"},(0,o.createElement)("path",{d:"M22,1.5H6a1,1,0,0,0-1,1v8a1,1,0,0,0,1,1H9l1.12,3,3.29-3H22a1,1,0,0,0,1-1v-8A1,1,0,0,0,22,1.5ZM22,10a.5.5,0,0,1-.5.5H13.31l-1.1,1h0l-1.12,1-.5.46-.11-.31L10,11.42h0l-.35-.92H6.5A.5.5,0,0,1,6,10V3a.5.5,0,0,1,.5-.5h15A.5.5,0,0,1,22,3Z"}),(0,o.createElement)("path",{d:"M10,7.45a1,1,0,1,1,1-1A1,1,0,0,1,10,7.45Z"}),(0,o.createElement)("path",{d:"M14,7.45a1,1,0,1,1,1-1A1,1,0,0,1,14,7.45Z"}),(0,o.createElement)("path",{d:"M18,7.45a1,1,0,1,1,1-1A1,1,0,0,1,18,7.45Z"}),(0,o.createElement)("path",{d:"M3.41,18.69a3.36,3.36,0,0,1,.83-.64,2.51,2.51,0,1,1,2.51,0,3.6,3.6,0,0,1,.84.64,3.5,3.5,0,1,0-4.18,0Z"}),(0,o.createElement)("path",{d:"M9,22.5h1a6.88,6.88,0,0,0-2.32-5.39,2.47,2.47,0,0,1-.93.94A5,5,0,0,1,9,22.5Z"}),(0,o.createElement)("path",{d:"M2,22.5a5,5,0,0,1,2.25-4.45,2.47,2.47,0,0,1-.93-.94A6.88,6.88,0,0,0,1,22.5Z"}));function b(){return b=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var a=arguments[t];for(var n in a)Object.prototype.hasOwnProperty.call(a,n)&&(e[n]=a[n])}return e},b.apply(this,arguments)}var p=a(184),_=a.n(p),v=window.wp.components,f=window.wp.blockEditor,g=window.wp.data;function y(e){var t=e.desktop,a=e.tablet,n=e.mobile,r=[];return t&&r.push({name:"desktop",title:(0,o.createElement)(v.Dashicon,{icon:"desktop"})}),a&&r.push({name:"tablet",title:(0,o.createElement)(v.Dashicon,{icon:"tablet"})}),n&&r.push({name:"mobile",title:(0,o.createElement)(v.Dashicon,{icon:"smartphone"})}),(0,o.createElement)(v.TabPanel,{className:"smb-inspector-tabs",tabs:r},(function(e){if(e.name){if("desktop"===e.name)return t();if("tablet"===e.name)return a();if("mobile"===e.name)return n()}}))}var w=["snow-monkey-blocks/testimonial-item"],k=[["snow-monkey-blocks/testimonial-item"]];function h(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}var E=[{attributes:function(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?h(Object(a),!0).forEach((function(t){r(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):h(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}({},u.attributes),save:function(e){var t=e.className,a=_()("smb-testimonial",t);return(0,o.createElement)("div",{className:a},(0,o.createElement)("div",{className:"smb-testimonial__body"},(0,o.createElement)("div",{className:"c-row c-row--margin","data-columns":"1","data-md-columns":"2"},(0,o.createElement)(f.InnerBlocks.Content,null))))}},{save:function(){return(0,o.createElement)("div",{className:"smb-testimonial"},(0,o.createElement)("div",{className:"smb-testimonial__body"},(0,o.createElement)("div",{className:"c-row c-row--margin","data-columns":"1","data-md-columns":"2"},(0,o.createElement)(f.InnerBlocks.Content,null))))}},{attributes:{items:{type:"array",default:[],selector:".smb-testimonial__item",source:"query",query:{avatarID:{type:"number",source:"attribute",selector:".smb-testimonial__item__figure > img",attribute:"data-image-id",default:0},avatarURL:{type:"string",source:"attribute",selector:".smb-testimonial__item__figure > img",attribute:"src",default:"https://0.gravatar.com/avatar/00000000000000000000000000000000?s=128&d=mp&r=g"},name:{source:"html",selector:".smb-testimonial__item__name"},lede:{source:"html",selector:".smb-testimonial__item__lede"},content:{source:"html",selector:".smb-testimonial__item__content"}}},columns:{type:"number",default:1}},migrate:function(e){var t;return[{},(t=void 0===e.items?0:e.items.length,(0,i.times)(t,(function(t){var a=(0,i.get)(e.items,[t,"avatarID"],0),n=(0,i.get)(e.items,[t,"avatarURL"],"https://0.gravatar.com/avatar/00000000000000000000000000000000?s=128&d=mp&r=g"),r=(0,i.get)(e.items,[t,"name"],""),o=(0,i.get)(e.items,[t,"lede"],""),l=(0,i.get)(e.items,[t,"content"],"");return(0,s.createBlock)("snow-monkey-blocks/testimonial-item",{avatarID:Number(a),avatarURL:n,name:r,lede:o,content:l})})))]},save:function(e){var t=e.attributes,a=t.items,n=void 0===t.items?0:t.items.length;return(0,o.createElement)("div",{className:"smb-testimonial"},(0,o.createElement)("div",{className:"smb-testimonial__body"},(0,o.createElement)("div",{className:"c-row c-row--margin"},(0,i.times)(n,(function(e){var t=(0,i.get)(a,[e,"avatarID"],0),n=(0,i.get)(a,[e,"avatarURL"],"https://0.gravatar.com/avatar/00000000000000000000000000000000?s=128&d=mp&r=g"),r=(0,i.get)(a,[e,"name"],""),s=(0,i.get)(a,[e,"lede"],""),l=(0,i.get)(a,[e,"content"],"");return(0,o.createElement)("div",{className:"c-row__col c-row__col--1-1 c-row__col--md-1-2"},(0,o.createElement)("div",{className:"smb-testimonial__item"},(0,o.createElement)("div",{className:"smb-testimonial__item__figure"},(0,o.createElement)("img",{src:n,alt:"",className:"wp-image-".concat(t),"data-image-id":t})),(0,o.createElement)("div",{className:"smb-testimonial__item__body"},(0,o.createElement)("div",{className:"smb-testimonial__item__content"},(0,o.createElement)(f.RichText.Content,{value:l})),(0,o.createElement)("div",{className:"smb-testimonial__item__name"},(0,o.createElement)(f.RichText.Content,{value:r})),!f.RichText.isEmpty(s)&&(0,o.createElement)("div",{className:"smb-testimonial__item__lede"},(0,o.createElement)(f.RichText.Content,{value:s})))))})))))}},{attributes:{items:{type:"array",default:[],selector:".smb-testimonial__item",source:"query",query:{avatarID:{type:"number",source:"attribute",selector:".smb-testimonial__item__figure > img",attribute:"data-image-id",default:0},avatarURL:{type:"string",source:"attribute",selector:".smb-testimonial__item__figure > img",attribute:"src",default:"https://0.gravatar.com/avatar/00000000000000000000000000000000?s=128&d=mp&r=g"},name:{source:"html",selector:".smb-testimonial__item__name"},lede:{source:"html",selector:".smb-testimonial__item__lede"},content:{source:"html",selector:".smb-testimonial__item__content"}}},columns:{type:"number",default:1}},save:function(e){var t=e.attributes,a=t.items,n=t.columns;return(0,o.createElement)("div",{className:"smb-testimonial"},(0,o.createElement)("div",{className:"smb-testimonial__body"},(0,o.createElement)("div",{className:"c-row c-row--margin"},(0,i.times)(n,(function(e){var t=(0,i.get)(a,[e,"avatarID"],0),n=(0,i.get)(a,[e,"avatarURL"],"https://0.gravatar.com/avatar/00000000000000000000000000000000?s=128&d=mp&r=g"),r=(0,i.get)(a,[e,"name"],""),s=(0,i.get)(a,[e,"lede"],""),l=(0,i.get)(a,[e,"content"],"");return(0,o.createElement)("div",{className:"c-row__col c-row__col--1-1 c-row__col--md-1-2"},(0,o.createElement)("div",{className:"smb-testimonial__item"},(0,o.createElement)("div",{className:"smb-testimonial__item__figure"},(0,o.createElement)("img",{src:n,alt:"","data-image-id":t})),(0,o.createElement)("div",{className:"smb-testimonial__item__body"},(0,o.createElement)("div",{className:"smb-testimonial__item__content"},(0,o.createElement)(f.RichText.Content,{value:l})),(0,o.createElement)("div",{className:"smb-testimonial__item__name"},(0,o.createElement)(f.RichText.Content,{value:r})),!f.RichText.isEmpty(s)&&(0,o.createElement)("div",{className:"smb-testimonial__item__lede"},(0,o.createElement)(f.RichText.Content,{value:s})))))})))))}}],N=u.name,O={icon:{foreground:"#cd162c",src:d},edit:function(e){var t,a,n,r,i,c,u,d=e.attributes,p=e.setAttributes,h=e.className;t=e.clientId,a=[{oldBlockName:"snow-monkey-blocks/testimonial--item",newBlockName:"snow-monkey-blocks/testimonial-item"}],n=(0,g.useDispatch)("core/block-editor").replaceBlock,r=(0,g.useSelect)((function(e){return{getBlockOrder:e("core/block-editor").getBlockOrder,getBlock:e("core/block-editor").getBlock}}),[]),i=r.getBlockOrder,c=r.getBlock,u=function(e){return"wp-block-".concat(e.replace("/","-"))},(0,o.useEffect)((function(){i(t).forEach((function(e){var t=c(e);a.forEach((function(e){if("core/missing"===t.name||e.oldBlockName===t.name){var a=(0,s.parse)(t.originalContent.replace(e.oldBlockName,e.newBlockName).replace(u(e.oldBlockName),u(e.oldBlockName)+" "+u(e.newBlockName)))[0];n(t.clientId,a)}}))}))}),[]);var E=d.md,N=d.lg,O=_()("smb-testimonial",h),j=(0,f.useBlockProps)({className:O}),B=(0,f.__experimentalUseInnerBlocksProps)({className:["c-row","c-row--margin"]},{allowedBlocks:w,template:k,templateLock:!1,renderAppender:f.InnerBlocks.ButtonBlockAppender,orientation:"horizontal"}),P=function(e){return p({lg:m(e,1,4)})},x=function(e){return p({md:m(e,1,2)})};return(0,o.createElement)(o.Fragment,null,(0,o.createElement)(f.InspectorControls,null,(0,o.createElement)(v.PanelBody,{title:(0,l.__)("Block Settings","snow-monkey-blocks")},(0,o.createElement)(y,{desktop:function(){return(0,o.createElement)(v.RangeControl,{label:(0,l.__)("Columns per row (Large window)","snow-monkey-blocks"),value:N,onChange:P,min:"1",max:"4"})},tablet:function(){return(0,o.createElement)(v.RangeControl,{label:(0,l.__)("Columns per row (Medium window)","snow-monkey-blocks"),value:E,onChange:x,min:"1",max:"2"})}}))),(0,o.createElement)("div",j,(0,o.createElement)("div",{className:"smb-testimonial__body"},(0,o.createElement)("div",b({},B,{"data-columns":"1","data-md-columns":E,"data-lg-columns":N})))))},save:function(e){var t=e.attributes,a=e.className,n=t.md,r=t.lg,i=_()("smb-testimonial",a);return(0,o.createElement)("div",f.useBlockProps.save({className:i}),(0,o.createElement)("div",{className:"smb-testimonial__body"},(0,o.createElement)("div",{className:"c-row c-row--margin","data-columns":"1","data-md-columns":n,"data-lg-columns":r},(0,o.createElement)(f.InnerBlocks.Content,null))))},deprecated:E};!function(e){if(e){var t=e.metadata,a=e.settings,n=e.name;t&&(t.title&&(t.title=(0,l.__)(t.title,"snow-monkey-blocks"),a.title=t.title),t.description&&(t.description=(0,l.__)(t.description,"snow-monkey-blocks"),a.description=t.description),t.keywords&&(t.keywords=(0,l.__)(t.keywords,"snow-monkey-blocks"),a.keywords=t.keywords)),(0,s.registerBlockType)(function(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?c(Object(a),!0).forEach((function(t){r(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):c(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}({name:n},t),a)}}(n)},184:function(e,t){var a;!function(){"use strict";var n={}.hasOwnProperty;function r(){for(var e=[],t=0;t<arguments.length;t++){var a=arguments[t];if(a){var o=typeof a;if("string"===o||"number"===o)e.push(a);else if(Array.isArray(a)){if(a.length){var i=r.apply(null,a);i&&e.push(i)}}else if("object"===o)if(a.toString===Object.prototype.toString)for(var s in a)n.call(a,s)&&a[s]&&e.push(s);else e.push(a.toString())}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(a=function(){return r}.apply(t,[]))||(e.exports=a)}()}},t={};function a(n){var r=t[n];if(void 0!==r)return r.exports;var o=t[n]={exports:{}};return e[n](o,o.exports,a),o.exports}a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,{a:t}),t},a.d=function(e,t){for(var n in t)a.o(t,n)&&!a.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a(36)}();