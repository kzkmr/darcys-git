!function(){var e={886:function(e,t,l){"use strict";var o={};l.r(o),l.d(o,{metadata:function(){return d},name:function(){return T},settings:function(){return v}});var s=window.wp.element,a=window.lodash,r=window.wp.blocks,i=(window.wp.richText,window.wp.i18n);const n=function(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,l=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null;return e=Number(e),(isNaN(e)||e<t)&&(e=t),null!==l&&e>l&&(e=l),e};var d=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/slider","title":"Slider (Deprecated)","description":"Show attractive images as beautiful sliders. This block is being retained for backwards compatibility and is not recommended for use. Its use may slow down the page display.","category":"smb-deprecated","attributes":{"slidesToShow":{"type":"number","default":1},"slidesToScroll":{"type":"number","default":1},"mdSlidesToShow":{"type":"number","default":1},"mdSlidesToScroll":{"type":"number","default":1},"smSlidesToShow":{"type":"number","default":1},"smSlidesToScroll":{"type":"number","default":1},"dots":{"type":"boolean","default":false},"arrows":{"type":"boolean","default":true},"speed":{"type":"number","default":300},"autoplay":{"type":"boolean","default":false},"autoplaySpeed":{"type":"number","default":0},"fade":{"type":"boolean","default":false},"rtl":{"type":"boolean","default":false},"aspectRatio":{"type":"string","default":""}},"supports":{"align":["wide","full"]},"style":"snow-monkey-blocks/slider","editorScript":"file:../../dist/block/slider/editor.js"}'),c=(0,s.createElement)("svg",{viewBox:"0 0 24 24"},(0,s.createElement)("path",{d:"M5,5.78V18.22a.78.78,0,0,0,.78.78H18.22a.78.78,0,0,0,.78-.78V5.78A.78.78,0,0,0,18.22,5H5.78A.78.78,0,0,0,5,5.78m12.44,12H6.56a.38.38,0,0,1-.39-.39V6.56a.38.38,0,0,1,.39-.39H17.44a.38.38,0,0,1,.39.39V17.44a.38.38,0,0,1-.39.39"}),(0,s.createElement)("path",{d:"M6.17,14.16l3.06-2.23a.22.22,0,0,1,.22,0l2.34,1.5a.21.21,0,0,0,.24,0l3-2.83a.19.19,0,0,1,.27,0l3.09,3v1.16l-3.09-3a.18.18,0,0,0-.27,0l-3,2.82a.19.19,0,0,1-.24,0L9.45,13.11a.18.18,0,0,0-.22,0L6.17,15.33Z"}),(0,s.createElement)("path",{d:"M2.22,5H0V6.17H1.44a.38.38,0,0,1,.39.39V17.44a.38.38,0,0,1-.39.39H0V19H2.22A.78.78,0,0,0,3,18.22V5.78A.78.78,0,0,0,2.22,5Z"}),(0,s.createElement)("path",{d:"M24,17.83H22.56a.38.38,0,0,1-.39-.39V6.56a.38.38,0,0,1,.39-.39H24V5H21.78a.78.78,0,0,0-.78.78V18.22a.78.78,0,0,0,.78.78H24Z"}));function m(){return m=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var l=arguments[t];for(var o in l)Object.prototype.hasOwnProperty.call(l,o)&&(e[o]=l[o])}return e},m.apply(this,arguments)}var u=l(184),p=l.n(u),S=window.wp.components,b=window.wp.blockEditor,w=window.wp.data;function g(e){const{desktop:t,tablet:l,mobile:o}=e,a=[];return t&&a.push({name:"desktop",title:(0,s.createElement)(S.Dashicon,{icon:"desktop"})}),l&&a.push({name:"tablet",title:(0,s.createElement)(S.Dashicon,{icon:"tablet"})}),o&&a.push({name:"mobile",title:(0,s.createElement)(S.Dashicon,{icon:"smartphone"})}),(0,s.createElement)(S.TabPanel,{className:"smb-inspector-tabs",tabs:a},(e=>{if(e.name){if("desktop"===e.name)return t();if("tablet"===e.name)return l();if("mobile"===e.name)return o()}}))}const y=["snow-monkey-blocks/slider-item"],f=[["snow-monkey-blocks/slider-item"]],_=e=>({slidesToShow:e.slidesToShow,slidesToScroll:e.slidesToScroll,mdSlidesToShow:e.mdSlidesToShow,mdSlidesToScroll:e.mdSlidesToScroll,smSlidesToShow:e.smSlidesToShow,smSlidesToScroll:e.smSlidesToScroll,dots:e.dots,arrows:e.arrows,speed:e.speed,autoplay:e.autoplay,autoplaySpeed:e.autoplaySpeed,fade:e.fade,rtl:e.rtl}),h=d.attributes;var k=[{attributes:{...h},supports:{align:["wide","full"]},save(e){let{attributes:t,className:l}=e;const{slidesToShow:o,slidesToScroll:r,dots:i,arrows:n,speed:d,autoplay:c,autoplaySpeed:m,fade:u,rtl:S}=t,w=(0,a.omit)(_({slidesToShow:o,slidesToScroll:r,dots:i,arrows:n,speed:d,autoplay:c,autoplaySpeed:1e3*m,fade:u,rtl:S}),["mdSlidesToShow","mdSlidesToScroll","smSlidesToShow","smSlidesToScroll"]),g=p()("smb-slider",l),y=!0===w.rtl?"rtl":"ltr";return(0,s.createElement)("div",{className:g},(0,s.createElement)("div",{className:"smb-slider__canvas",dir:y,"data-smb-slider":JSON.stringify(w)},(0,s.createElement)(b.InnerBlocks.Content,null)))}},{attributes:{...h},supports:{align:["wide","full"]},save(e){let{attributes:t,className:l}=e;const{slidesToShow:o,slidesToScroll:r,dots:i,arrows:n,speed:d,autoplay:c,autoplaySpeed:m,rtl:u}=t,S=(0,a.omit)(_({slidesToShow:o,slidesToScroll:r,dots:i,arrows:n,speed:d,autoplay:c,autoplaySpeed:1e3*m,rtl:u}),["mdSlidesToShow","mdSlidesToScroll","smSlidesToShow","smSlidesToScroll","fade"]),w=p()("smb-slider",l),g=!0===S.rtl?"rtl":"ltr";return(0,s.createElement)("div",{className:w},(0,s.createElement)("div",{className:"smb-slider__canvas",dir:g,"data-smb-slider":JSON.stringify(S)},(0,s.createElement)(b.InnerBlocks.Content,null)))}},{attributes:{...h,content:{type:"array",source:"query",selector:".smb-slider__item",default:[],query:{imageID:{type:"number",source:"attribute",selector:".smb-slider__item__figure > img",attribute:"data-image-id",default:0},imageURL:{type:"string",source:"attribute",selector:".smb-slider__item__figure > img",attribute:"src",default:""},caption:{source:"html",selector:".smb-slider__item__caption"}}},items:{type:"number",default:2}},supports:{align:["wide","full"]},migrate:e=>[{slidesToShow:e.slidesToShow,slidesToScroll:e.slidesToScroll,dots:e.dots,arrows:e.arrows,speed:e.speed,autoplay:e.autoplay,autoplaySpeed:e.autoplaySpeed,rtl:e.rtl},(()=>{const t=void 0===e.content?0:e.content.length;return(0,a.times)(t,(t=>{const l=(0,a.get)(e.content,[t,"imageID"],0),o=(0,a.get)(e.content,[t,"imageURL"],""),s=(0,a.get)(e.content,[t,"caption"],"");return(0,r.createBlock)("snow-monkey-blocks/slider-item",{imageID:Number(l),imageURL:o,caption:s})}))})()],save(e){let{attributes:t,className:l}=e;const{slidesToShow:o,slidesToScroll:r,dots:i,arrows:n,content:d,speed:c,autoplay:m,autoplaySpeed:u,rtl:S}=t,w=void 0===d?0:d.length,g=(0,a.omit)(_({slidesToShow:o,slidesToScroll:r,dots:i,arrows:n,speed:c,autoplay:m,autoplaySpeed:1e3*u,rtl:S}),["mdSlidesToShow","mdSlidesToScroll","smSlidesToShow","smSlidesToScroll","fade"]),y=p()("smb-slider",l),f=!0===g.rtl?"rtl":"ltr";return(0,s.createElement)("div",{className:y},(0,s.createElement)("div",{className:"smb-slider__canvas",dir:f,"data-smb-slider":JSON.stringify(g)},(0,a.times)(w,(e=>{const t=(0,a.get)(d,[e,"imageID"],0),l=(0,a.get)(d,[e,"imageURL"],""),o=(0,a.get)(d,[e,"caption"],"");return(0,s.createElement)(s.Fragment,null,!!t&&(0,s.createElement)("div",{className:"smb-slider__item"},(0,s.createElement)("div",{className:"smb-slider__item__figure"},(0,s.createElement)("img",{src:l,alt:"",className:`wp-image-${t}`,"data-image-id":t})),!b.RichText.isEmpty(o)&&(0,s.createElement)("div",{className:"smb-slider__item__caption"},(0,s.createElement)(b.RichText.Content,{value:o}))))}))))}},{attributes:{...h,content:{type:"array",source:"query",selector:".smb-slider__item",default:[],query:{imageID:{type:"number",source:"attribute",selector:".smb-slider__item__figure > img",attribute:"data-image-id",default:0},imageURL:{type:"string",source:"attribute",selector:".smb-slider__item__figure > img",attribute:"src",default:""},caption:{source:"html",selector:".smb-slider__item__caption"}}},items:{type:"number",default:2}},save(e){let{attributes:t}=e;const{slidesToShow:l,slidesToScroll:o,dots:r,arrows:i,items:n,content:d,speed:c,autoplay:m,autoplaySpeed:u,rtl:p}=t,S=(0,a.omit)(_({slidesToShow:l,slidesToScroll:o,dots:r,arrows:i,speed:c,autoplay:m,autoplaySpeed:1e3*u,rtl:p}),["mdSlidesToShow","mdSlidesToScroll","smSlidesToShow","smSlidesToScroll","fade"]);return(0,s.createElement)("div",{className:"smb-slider"},(0,s.createElement)("div",{className:"smb-slider__canvas",dir:!0===S.rtl?"rtl":"ltr","data-smb-slider":JSON.stringify(S)},(0,a.times)(n,(e=>{const t=(0,a.get)(d,[e,"imageID"],0),l=(0,a.get)(d,[e,"imageURL"],""),o=(0,a.get)(d,[e,"caption"],"");return(0,s.createElement)(s.Fragment,null,!!t&&(0,s.createElement)("div",{className:"smb-slider__item"},(0,s.createElement)("div",{className:"smb-slider__item__figure"},(0,s.createElement)("img",{src:l,alt:"",className:`wp-image-${t}`,"data-image-id":t})),!b.RichText.isEmpty(o)&&(0,s.createElement)("div",{className:"smb-slider__item__caption"},(0,s.createElement)(b.RichText.Content,{value:o}))))}))))}},{attributes:{...h,content:{type:"array",source:"query",selector:".smb-slider__item",default:[],query:{imageID:{type:"number",source:"attribute",selector:".smb-slider__item__figure > img",attribute:"data-image-id",default:0},imageURL:{type:"string",source:"attribute",selector:".smb-slider__item__figure > img",attribute:"src",default:""},caption:{source:"html",selector:".smb-slider__item__caption"}}},items:{type:"number",default:2}},supports:{align:["wide","full"]},save(e){let{attributes:t}=e;const{slidesToShow:l,slidesToScroll:o,dots:r,arrows:i,items:n,content:d,speed:c,autoplay:m,autoplaySpeed:u,rtl:p}=t,S=(0,a.omit)(_({slidesToShow:l,slidesToScroll:o,dots:r,arrows:i,speed:c,autoplay:m,autoplaySpeed:1e3*u,rtl:p}),["mdSlidesToShow","mdSlidesToScroll","smSlidesToShow","smSlidesToScroll","fade"]);return(0,s.createElement)("div",{className:"smb-slider"},(0,s.createElement)("div",{className:"smb-slider__canvas",dir:!0===S.rtl?"rtl":"ltr","data-smb-slider":JSON.stringify(S)},(0,a.times)(n,(e=>{const t=(0,a.get)(d,[e,"imageID"],0),l=(0,a.get)(d,[e,"imageURL"],""),o=(0,a.get)(d,[e,"caption"],"");return(0,s.createElement)(s.Fragment,null,!!t&&(0,s.createElement)("div",{className:"smb-slider__item"},(0,s.createElement)("div",{className:"smb-slider__item__figure"},(0,s.createElement)("img",{src:l,alt:"","data-image-id":t})),!b.RichText.isEmpty(o)&&(0,s.createElement)("div",{className:"smb-slider__item__caption"},(0,s.createElement)(b.RichText.Content,{value:o}))))}))))}}];const{name:T}=d,v={icon:{foreground:"#cd162c",src:c},edit:function(e){let{attributes:t,setAttributes:l,className:o,clientId:a}=e;((e,t)=>{const{replaceBlock:l}=(0,w.useDispatch)("core/block-editor"),{getBlockOrder:o,getBlock:a}=(0,w.useSelect)((e=>({getBlockOrder:e("core/block-editor").getBlockOrder,getBlock:e("core/block-editor").getBlock})),[]),i=e=>`wp-block-${e.replace("/","-")}`;(0,s.useEffect)((()=>{o(e).forEach((e=>{const o=a(e);t.forEach((e=>{if("core/missing"===o.name||e.oldBlockName===o.name){const t=(0,r.parse)(o.originalContent.replace(e.oldBlockName,e.newBlockName).replace(i(e.oldBlockName),i(e.oldBlockName)+" "+i(e.newBlockName)))[0];l(o.clientId,t)}}))}))}),[])})(a,[{oldBlockName:"snow-monkey-blocks/slider--item",newBlockName:"snow-monkey-blocks/slider-item"}]);const{slidesToShow:d,slidesToScroll:c,mdSlidesToShow:u,mdSlidesToScroll:_,smSlidesToShow:h,smSlidesToScroll:k,dots:T,arrows:v,speed:E,autoplaySpeed:N,fade:B,rtl:C,aspectRatio:R}=t,x=(0,w.useSelect)((e=>{var t,l;return!(null===(t=e("core/block-editor").getBlock(a))||void 0===t||null===(l=t.innerBlocks)||void 0===l||!l.length)}),[a]),O=p()("smb-slider",o),I=(0,b.useBlockProps)({className:O}),D=(0,b.useInnerBlocksProps)({className:["c-row","c-row--margin"]},{allowedBlocks:y,template:f,templateLock:!1,renderAppender:x?b.InnerBlocks.DefaultBlockAppender:b.InnerBlocks.ButtonBlockAppender}),L=[{value:"",label:(0,i.__)("Default","snow-monkey-blocks")},{value:"16to9",label:(0,i.__)("16:9","snow-monkey-blocks")},{value:"4to3",label:(0,i.__)("4:3","snow-monkey-blocks")}],P=e=>l({slidesToShow:n(e,1,6)}),A=e=>l({slidesToScroll:n(e,1,6)}),H=e=>l({mdSlidesToShow:n(e,1,6)}),V=e=>l({mdSlidesToScroll:n(e,1,6)}),j=e=>l({smSlidesToShow:n(e,1,6)}),M=e=>l({smSlidesToScroll:n(e,1,6)});return(0,s.createElement)(s.Fragment,null,(0,s.createElement)(b.InspectorControls,null,(0,s.createElement)(S.PanelBody,{title:(0,i.__)("Block settings","snow-monkey-blocks")},(0,s.createElement)(S.ToggleControl,{label:(0,i.__)("Show dot indicators","snow-monkey-blocks"),checked:T,onChange:e=>l({dots:e})}),(0,s.createElement)(S.ToggleControl,{label:(0,i.__)("Prev/Next arrows","snow-monkey-blocks"),checked:v,onChange:e=>l({arrows:e})}),(0,s.createElement)(S.RangeControl,{label:(0,i.__)("Slide animation speed in milliseconds","snow-monkey-blocks"),value:E,onChange:e=>l({speed:n(e,100,1e3)}),min:"100",max:"1000",step:"100"}),(0,s.createElement)(S.RangeControl,{label:(0,i.__)("Autoplay Speed in seconds","snow-monkey-blocks"),value:N,onChange:e=>{const t=n(e,0,10);l({autoplaySpeed:t}),l(0<t?{autoplay:!0}:{autoplay:!1})},min:"0",max:"10"}),(0,s.createElement)(S.ToggleControl,{label:(0,i.__)("Enable fade","snow-monkey-blocks"),checked:B,onChange:e=>l({fade:e})}),(0,s.createElement)(S.ToggleControl,{label:(0,i.__)("Change the slider's direction to become right-to-left","snow-monkey-blocks"),checked:C,onChange:e=>l({rtl:e})}),(0,s.createElement)(S.SelectControl,{label:(0,i.__)("Aspect ratio","snow-monkey-blocks"),value:R,onChange:e=>l({aspectRatio:e}),options:L}),(0,s.createElement)(g,{desktop:()=>(0,s.createElement)(s.Fragment,null,(0,s.createElement)(S.RangeControl,{label:(0,i.__)("# of slides to show (Large window)","snow-monkey-blocks"),value:d,onChange:P,min:"1",max:"6"}),(0,s.createElement)(S.RangeControl,{label:(0,i.__)("# of slides to scroll (Large window)","snow-monkey-blocks"),value:c,onChange:A,min:"1",max:"6"})),tablet:()=>(0,s.createElement)(s.Fragment,null,(0,s.createElement)(S.RangeControl,{label:(0,i.__)("# of slides to show (Medium window)","snow-monkey-blocks"),value:u,onChange:H,min:"1",max:"6"}),(0,s.createElement)(S.RangeControl,{label:(0,i.__)("# of slides to scroll (Medium window)","snow-monkey-blocks"),value:_,onChange:V,min:"1",max:"6"})),mobile:()=>(0,s.createElement)(s.Fragment,null,(0,s.createElement)(S.RangeControl,{label:(0,i.__)("# of slides to show (Small window)","snow-monkey-blocks"),value:h,onChange:j,min:"1",max:"6"}),(0,s.createElement)(S.RangeControl,{label:(0,i.__)("# of slides to scroll (Small window)","snow-monkey-blocks"),value:k,onChange:M,min:"1",max:"6"}))}))),(0,s.createElement)("div",I,(0,s.createElement)("div",m({},D,{"data-columns":"2"}))))},save:function(e){let{attributes:t,className:l}=e;const{slidesToShow:o,slidesToScroll:a,mdSlidesToShow:r,mdSlidesToScroll:i,smSlidesToShow:n,smSlidesToScroll:d,dots:c,arrows:u,speed:S,autoplay:w,autoplaySpeed:g,fade:y,rtl:f,aspectRatio:h}=t,k=_({slidesToShow:o,slidesToScroll:a,mdSlidesToShow:r,mdSlidesToScroll:i,smSlidesToShow:n,smSlidesToScroll:d,dots:c,arrows:u,speed:S,autoplay:w,autoplaySpeed:1e3*g,fade:y,rtl:f}),T=p()("smb-slider",l,{[`smb-slider--${h}`]:!!h}),v=!0===k.rtl?"rtl":"ltr";return(0,s.createElement)("div",b.useBlockProps.save({className:T}),(0,s.createElement)("div",m({},b.useInnerBlocksProps.save({className:"smb-slider__canvas"}),{dir:v,"data-smb-slider":JSON.stringify(k)})))},deprecated:k};(e=>{if(!e)return;const{metadata:t,settings:l,name:o}=e;t&&(t.title&&(t.title=(0,i.__)(t.title,"snow-monkey-blocks"),l.title=t.title),t.description&&(t.description=(0,i.__)(t.description,"snow-monkey-blocks"),l.description=t.description),t.keywords&&(t.keywords=(0,i.__)(t.keywords,"snow-monkey-blocks"),l.keywords=t.keywords)),(0,r.registerBlockType)({name:o,...t},l)})(o)},184:function(e,t){var l;!function(){"use strict";var o={}.hasOwnProperty;function s(){for(var e=[],t=0;t<arguments.length;t++){var l=arguments[t];if(l){var a=typeof l;if("string"===a||"number"===a)e.push(l);else if(Array.isArray(l)){if(l.length){var r=s.apply(null,l);r&&e.push(r)}}else if("object"===a)if(l.toString===Object.prototype.toString)for(var i in l)o.call(l,i)&&l[i]&&e.push(i);else e.push(l.toString())}}return e.join(" ")}e.exports?(s.default=s,e.exports=s):void 0===(l=function(){return s}.apply(t,[]))||(e.exports=l)}()}},t={};function l(o){var s=t[o];if(void 0!==s)return s.exports;var a=t[o]={exports:{}};return e[o](a,a.exports,l),a.exports}l.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return l.d(t,{a:t}),t},l.d=function(e,t){for(var o in t)l.o(t,o)&&!l.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},l.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},l.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},l(886)}();