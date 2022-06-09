!function(){var e={184:function(e,t){var a;!function(){"use strict";var s={}.hasOwnProperty;function i(){for(var e=[],t=0;t<arguments.length;t++){var a=arguments[t];if(a){var l=typeof a;if("string"===l||"number"===l)e.push(a);else if(Array.isArray(a)){if(a.length){var r=i.apply(null,a);r&&e.push(r)}}else if("object"===l)if(a.toString===Object.prototype.toString)for(var n in a)s.call(a,n)&&a[n]&&e.push(n);else e.push(a.toString())}}return e.join(" ")}e.exports?(i.default=i,e.exports=i):void 0===(a=function(){return i}.apply(t,[]))||(e.exports=a)}()}},t={};function a(s){var i=t[s];if(void 0!==i)return i.exports;var l=t[s]={exports:{}};return e[s](l,l.exports,a),l.exports}a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,{a:t}),t},a.d=function(e,t){for(var s in t)a.o(t,s)&&!a.o(e,s)&&Object.defineProperty(e,s,{enumerable:!0,get:t[s]})},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){"use strict";var e={};a.r(e),a.d(e,{metadata:function(){return n},name:function(){return k},settings:function(){return N}});var t=window.wp.element,s=window.lodash,i=window.wp.blocks,l=(window.wp.richText,window.wp.i18n);const r=function(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,a=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null;return e=Number(e),(isNaN(e)||e<t)&&(e=t),null!==a&&e>a&&(e=a),e};var n=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/spider-slider","title":"Slider","description":"Show attractive images as beautiful sliders.","category":"smb","attributes":{"images":{"type":"array","default":[],"source":"query","selector":".smb-spider-slider .spider__slide","query":{"url":{"type":"string","source":"attribute","selector":".spider__figure","attribute":"src"},"alt":{"type":"string","source":"attribute","selector":".spider__figure","attribute":"alt"},"id":{"type":"string","source":"attribute","selector":".spider__figure","attribute":"data-image-id"},"width":{"type":"number","source":"attribute","selector":".spider__figure","attribute":"width"},"height":{"type":"number","source":"attribute","selector":".spider__figure","attribute":"height"},"caption":{"type":"string","source":"html","selector":".smb-spider-slider__item__caption","default":""}}},"sizeSlug":{"type":"string","default":"large"},"dots":{"type":"boolean","default":false},"dotsToThumbnail":{"type":"boolean","default":false},"arrows":{"type":"boolean","default":false},"fade":{"type":"boolean","default":false},"shifted":{"type":"boolean","default":false},"gutter":{"type":"string"},"aspectRatio":{"type":"string","default":""},"displayCaption":{"type":"boolean","default":false},"interval":{"type":"number","default":0},"duration":{"type":"number","default":0},"lgSlidesToShow":{"type":"number","default":1},"mdSlidesToShow":{"type":"number","default":1},"smSlidesToShow":{"type":"number","default":1}},"supports":{"align":["wide","full"]},"style":"snow-monkey-blocks/spider-slider","editorStyle":"snow-monkey-blocks/spider-slider/editor","editorScript":"file:../../dist/block/spider-slider/editor.js"}'),o=(0,t.createElement)("svg",{viewBox:"0 0 24 24"},(0,t.createElement)("path",{d:"M5,5.78V18.22a.78.78,0,0,0,.78.78H18.22a.78.78,0,0,0,.78-.78V5.78A.78.78,0,0,0,18.22,5H5.78A.78.78,0,0,0,5,5.78m12.44,12H6.56a.38.38,0,0,1-.39-.39V6.56a.38.38,0,0,1,.39-.39H17.44a.38.38,0,0,1,.39.39V17.44a.38.38,0,0,1-.39.39"}),(0,t.createElement)("path",{d:"M6.17,14.16l3.06-2.23a.22.22,0,0,1,.22,0l2.34,1.5a.21.21,0,0,0,.24,0l3-2.83a.19.19,0,0,1,.27,0l3.09,3v1.16l-3.09-3a.18.18,0,0,0-.27,0l-3,2.82a.19.19,0,0,1-.24,0L9.45,13.11a.18.18,0,0,0-.22,0L6.17,15.33Z"}),(0,t.createElement)("path",{d:"M2.22,5H0V6.17H1.44a.38.38,0,0,1,.39.39V17.44a.38.38,0,0,1-.39.39H0V19H2.22A.78.78,0,0,0,3,18.22V5.78A.78.78,0,0,0,2.22,5Z"}),(0,t.createElement)("path",{d:"M24,17.83H22.56a.38.38,0,0,1-.39-.39V6.56a.38.38,0,0,1,.39-.39H24V5H21.78a.78.78,0,0,0-.78.78V18.22a.78.78,0,0,0,.78.78H24Z"}));function d(){return d=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var a=arguments[t];for(var s in a)Object.prototype.hasOwnProperty.call(a,s)&&(e[s]=a[s])}return e},d.apply(this,arguments)}var c=a(184),m=a.n(c),u=window.wp.blockEditor,p=window.wp.components,g=window.wp.data,h=function(e){let{icon:a,size:s=24,...i}=e;return(0,t.cloneElement)(a,{width:s,height:s,...i})},_=window.wp.primitives,b=(0,t.createElement)(_.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"-2 -2 24 24"},(0,t.createElement)(_.Path,{d:"M10 2c4.42 0 8 3.58 8 8s-3.58 8-8 8-8-3.58-8-8 3.58-8 8-8zm1.13 9.38l.35-6.46H8.52l.35 6.46h2.26zm-.09 3.36c.24-.23.37-.55.37-.96 0-.42-.12-.74-.36-.97s-.59-.35-1.06-.35-.82.12-1.07.35-.37.55-.37.97c0 .41.13.73.38.96.26.23.61.34 1.06.34s.8-.11 1.05-.34z"}));function w(e){const{desktop:a,tablet:s,mobile:i}=e,l=[];return a&&l.push({name:"desktop",title:(0,t.createElement)(p.Dashicon,{icon:"desktop"})}),s&&l.push({name:"tablet",title:(0,t.createElement)(p.Dashicon,{icon:"tablet"})}),i&&l.push({name:"mobile",title:(0,t.createElement)(p.Dashicon,{icon:"smartphone"})}),(0,t.createElement)(p.TabPanel,{className:"smb-inspector-tabs",tabs:l},(e=>{if(e.name){if("desktop"===e.name)return a();if("tablet"===e.name)return s();if("mobile"===e.name)return i()}}))}const f=["image"],v=n.attributes;var y=[{attributes:{...v},supports:{align:["wide","full"]},save(e){let{attributes:a,className:s}=e;const{images:i,aspectRatio:l,arrows:r,dots:n,dotsToThumbnail:o,fade:c,shifted:p,gutter:g,displayCaption:h,interval:_,lgSlidesToShow:b,mdSlidesToShow:w,smSlidesToShow:f}=a;if(!i.length)return null;const v="wide"===a.align,y="full"===a.align,E=!!p&&!c,k=m()("smb-spider-slider",s,{[`smb-spider-slider--${l}`]:!!l,"smb-spider-slider--shifted":E,[`smb-spider-slider--gutter-${g}`]:!!g});return(0,t.createElement)("div",d({},u.useBlockProps.save({className:k}),{"data-fade":c?"true":"false","data-interval":0<_?1e3*_:void 0,"data-lg-slide-to-show":!c&&1<b?b:void 0,"data-md-slide-to-show":!c&&1<w?w:void 0,"data-sm-slide-to-show":!c&&1<f?f:void 0}),(0,t.createElement)("div",{className:"spider"},(y||v)&&(0,t.createElement)("div",{className:"c-container"},(0,t.createElement)("div",{className:"spider__reference"})),(0,t.createElement)("div",{className:"spider__canvas"},i.map(((e,a)=>(0,t.createElement)("div",{className:"spider__slide","data-id":a,key:a},(0,t.createElement)("div",{className:"smb-spider-slider__figure-wrapper"},(0,t.createElement)("img",{className:"spider__figure",src:e.url,alt:e.alt,width:e.width,height:e.height,"data-image-id":e.id})),h&&!!e.caption&&(0,t.createElement)("div",{className:"smb-spider-slider__item"},(0,t.createElement)("div",{className:"smb-spider-slider__item__caption"},e.caption)))))),r&&(0,t.createElement)("div",{className:"spider__arrows"},(0,t.createElement)("button",{className:"spider__arrow","data-direction":"prev"},"Prev"),(0,t.createElement)("button",{className:"spider__arrow","data-direction":"next"},"Next"))),n&&(0,t.createElement)("div",{className:"spider__dots","data-thumbnails":o?"true":"false"},i.map(((e,a)=>(0,t.createElement)("button",{className:"spider__dot","data-id":a,key:a},o?(0,t.createElement)("img",{className:"spider__figure",src:e.url,alt:e.alt,width:e.width,height:e.height}):(0,t.createElement)(t.Fragment,null,a))))))}},{attributes:{...v},supports:{align:["wide","full"]},save(e){let{attributes:a,className:s}=e;const{images:i,aspectRatio:l,arrows:r,dots:n,dotsToThumbnail:o,fade:c,shifted:p,gutter:g,displayCaption:h,interval:_,lgSlidesToShow:b,mdSlidesToShow:w,smSlidesToShow:f}=a;if(!i.length)return null;const v=!c&&"full"===a.align,y=!!p&&v,E=m()("smb-spider-slider",s,{[`smb-spider-slider--${l}`]:!!l,"smb-spider-slider--shifted":y,[`smb-spider-slider--gutter-${g}`]:!!g});return(0,t.createElement)("div",d({},u.useBlockProps.save({className:E}),{"data-fade":c?"true":"false","data-interval":0<_?1e3*_:void 0,"data-lg-slide-to-show":!c&&1<b?b:void 0,"data-md-slide-to-show":!c&&1<w?w:void 0,"data-sm-slide-to-show":!c&&1<f?f:void 0}),(0,t.createElement)("div",{className:"spider"},y&&(0,t.createElement)("div",{className:"c-container"},(0,t.createElement)("div",{className:"spider__reference"})),(0,t.createElement)("div",{className:"spider__canvas"},i.map(((e,a)=>(0,t.createElement)("div",{className:"spider__slide","data-id":a,key:a},(0,t.createElement)("div",{className:"smb-spider-slider__figure-wrapper"},(0,t.createElement)("img",{className:"spider__figure",src:e.url,alt:e.alt,width:e.width,height:e.height,"data-image-id":e.id})),h&&!!e.caption&&(0,t.createElement)("div",{className:"smb-spider-slider__item"},(0,t.createElement)("div",{className:"smb-spider-slider__item__caption"},e.caption)))))),r&&(0,t.createElement)(t.Fragment,null,(0,t.createElement)("button",{className:"spider__arrow","data-direction":"prev"},"Prev"),(0,t.createElement)("button",{className:"spider__arrow","data-direction":"next"},"Next"))),n&&(0,t.createElement)("div",{className:"spider__dots","data-thumbnails":o?"true":"false"},i.map(((e,a)=>(0,t.createElement)("button",{className:"spider__dot","data-id":a,key:a},o?(0,t.createElement)("img",{className:"spider__figure",src:e.url,alt:e.alt,width:e.width,height:e.height}):(0,t.createElement)(t.Fragment,null,a))))))}},{attributes:{...v},supports:{align:["wide","full"]},migrate:e=>("16to9"===e.aspectRatio&&(e.aspectRatio="16x9"),"4to3"===e.aspectRatio&&(e.aspectRatio="4x3"),e),save(e){let{attributes:a,className:s}=e;const{images:i,aspectRatio:l,arrows:r,dots:n,dotsToThumbnail:o,fade:c,displayCaption:p,interval:g,lgSlidesToShow:h,mdSlidesToShow:_,smSlidesToShow:b}=a;if(!i.length)return null;const w=m()("smb-spider-slider",s,{[`smb-spider-slider--${l}`]:!!l});return(0,t.createElement)("div",d({},u.useBlockProps.save({className:w}),{"data-fade":c?"true":"false","data-interval":0<g?1e3*g:void 0,"data-lg-slide-to-show":!c&&1<h?h:void 0,"data-md-slide-to-show":!c&&1<_?_:void 0,"data-sm-slide-to-show":!c&&1<b?b:void 0}),(0,t.createElement)("div",{className:"spider"},(0,t.createElement)("div",{className:"spider__canvas"},i.map(((e,a)=>(0,t.createElement)("div",{className:"spider__slide","data-id":a,key:a},(0,t.createElement)("img",{className:"spider__figure",src:e.url,alt:e.alt,width:e.width,height:e.height,"data-image-id":e.id}),p&&!!e.caption&&(0,t.createElement)("div",{className:"smb-spider-slider__item"},(0,t.createElement)("div",{className:"smb-spider-slider__item__caption"},e.caption)))))),r&&(0,t.createElement)(t.Fragment,null,(0,t.createElement)("button",{className:"spider__arrow","data-direction":"prev"},"Prev"),(0,t.createElement)("button",{className:"spider__arrow","data-direction":"next"},"Next"))),n&&(0,t.createElement)("div",{className:"spider__dots","data-thumbnails":o?"true":"false"},i.map(((e,a)=>(0,t.createElement)("button",{className:"spider__dot","data-id":a,key:a},o?(0,t.createElement)("img",{className:"spider__figure",src:e.url,alt:e.alt,width:e.width,height:e.height}):(0,t.createElement)(t.Fragment,null,a))))))}}],E={attributes:{images:[{url:`${smb.pluginUrl}/dist/img/photos/beach-sand-coast2756.jpg`},{url:`${smb.pluginUrl}/dist/img/photos/man-guy-photographer1579.jpg`},{url:`${smb.pluginUrl}/dist/img/photos/building-architecture-sky2096.jpg`}],arrows:!0,dots:!0}};const{name:k}=n,N={icon:{foreground:"#cd162c",src:o},keywords:[(0,l.__)("Carousel","snow-monkey-blocks")],edit:function(e){let{attributes:a,setAttributes:i,className:n,isSelected:o}=e;const{images:c,sizeSlug:_,aspectRatio:v,arrows:y,dots:E,dotsToThumbnail:k,fade:N,shifted:S,gutter:T,displayCaption:C,interval:x,duration:P,lgSlidesToShow:z,mdSlidesToShow:R,smSlidesToShow:M}=a,$=!!c.length,{resizedImages:j,imageSizes:B}=(0,g.useSelect)((e=>{const t=[];if(!$)return{resizedImages:t,imageSizes:[]};const{getSettings:a}=e("core/block-editor"),i=a();return c.forEach((a=>{const{getMedia:l}=e("core"),r=l(a.id);r&&(t[a.id]=((e,t)=>t?(0,s.reduce)(e,((e,a)=>{const i=(0,s.get)(t,["sizes",a.slug,"url"]),l=(0,s.get)(t,["media_details","sizes",a.slug,"source_url"]),r=(0,s.get)(t,["sizes",a.slug,"width"]),n=(0,s.get)(t,["media_details","sizes",a.slug,"width"]),o=(0,s.get)(t,["sizes",a.slug,"height"]),d=(0,s.get)(t,["media_details","sizes",a.slug,"height"]);return{...e,[a.slug]:{url:i||l,width:r||n,height:o||d}}}),{}):{})(i.imageSizes,r))})),{resizedImages:t,imageSizes:i.imageSizes||[]}}),[c]),H="wide"===a.align,O="full"===a.align,V=!N,A=S&&V&&(H||O),F=(0,t.useRef)(),D=(0,t.useRef)(),I=(0,t.useRef)();(0,t.useEffect)((()=>{const e=!!F.current&&!!I.current&&A&&Math.floor(F.current.offsetWidth);e&&(F.current.style.setProperty("--spider-canvas-width",`${e}px`),I.current.style.width=`${e}px`);const t=!!D.current&&A&&Math.floor(D.current.offsetWidth);t&&F.current.style.setProperty("--spider-reference-width",`${t}px`)}),[!!F.current&&F.current.offsetWidth]);const L=m()("smb-spider-slider",n,{[`smb-spider-slider--${v}`]:!!v,"smb-spider-slider--shifted":A,[`smb-spider-slider--gutter-${T}`]:!!T}),U=$?B.map((e=>({value:e.slug,label:e.name}))):[],W=[{value:"",label:(0,l.__)("Default","snow-monkey-blocks")},{value:"16x9",label:(0,l.__)("16:9","snow-monkey-blocks")},{value:"4x3",label:(0,l.__)("4:3","snow-monkey-blocks")}],Z=[{value:"",label:(0,l.__)("None","snow-monkey-blocks")},{value:"s",label:(0,l.__)("S","snow-monkey-blocks")},{value:"m",label:(0,l.__)("M","snow-monkey-blocks")},{value:"l",label:(0,l.__)("L","snow-monkey-blocks")}],q=e=>i({lgSlidesToShow:r(e,1,6)}),G=e=>i({mdSlidesToShow:r(e,1,6)}),J=e=>i({smSlidesToShow:r(e,1,6)}),K=(0,t.createElement)(u.MediaPlaceholder,{addToGallery:$,isAppender:$,className:n,disableMediaButtons:$&&!o,icon:!$&&"format-gallery",labels:{title:!$&&(0,l.__)("Slider","snow-monkey-blocks"),instructions:!$&&(0,l.__)("Drag images, upload new ones or select files from your library.","snow-monkey-blocks")},onSelect:e=>{i({images:e})},accept:"image/*",allowedTypes:f,multiple:!0,value:c});return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(u.InspectorControls,null,(0,t.createElement)(p.PanelBody,{title:(0,l.__)("Dimensions","snow-monkey-blocks"),initialOpen:!1},(0,t.createElement)(p.SelectControl,{label:(0,l.__)("Block spacing","snow-monkey-blocks"),value:T,onChange:e=>i({gutter:e}),options:Z})),(0,t.createElement)(p.PanelBody,{title:(0,l.__)("Block settings","snow-monkey-blocks")},(0,t.createElement)(p.SelectControl,{label:(0,l.__)("Images size","snow-monkey-blocks"),value:_,options:U,onChange:e=>{const t=c.map((t=>{if(!t.id)return t;const a=(0,s.get)(j,[t.id,e,"url"])||(0,s.get)(j,[t.id,"full","url"]),i=(0,s.get)(j,[t.id,e,"width"])||(0,s.get)(j,[t.id,"full","width"]),l=(0,s.get)(j,[t.id,e,"height"])||(0,s.get)(j,[t.id,"full","height"]);return{...t,...a&&{url:a},...i&&{width:i},...l&&{height:l}}}));i({images:t,sizeSlug:e})}}),(0,t.createElement)(p.SelectControl,{label:(0,l.__)("Aspect ratio","snow-monkey-blocks"),value:v,onChange:e=>i({aspectRatio:e}),options:W}),(0,t.createElement)(p.ToggleControl,{label:(0,l.__)("Display arrows","snow-monkey-blocks"),checked:y,onChange:e=>i({arrows:e})}),(0,t.createElement)(p.ToggleControl,{label:(0,l.__)("Display dots","snow-monkey-blocks"),checked:E,onChange:e=>i({dots:e})}),E&&(0,t.createElement)(p.ToggleControl,{label:(0,l.__)("Change dots to thumbnails","snow-monkey-blocks"),checked:k,onChange:e=>i({dotsToThumbnail:e})}),(0,t.createElement)(p.ToggleControl,{label:(0,l.__)("Fade","snow-monkey-blocks"),checked:N,onChange:e=>i({fade:e})}),V&&(0,t.createElement)(p.ToggleControl,{label:(0,l.__)("Shifting the slider","snow-monkey-blocks"),help:S&&(!O||!H)&&(0,t.createElement)(t.Fragment,null,(0,t.createElement)(h,{icon:b,style:{fill:"#d94f4f"}}),(0,l.__)("It must be full width (.alignfull) or wide width (.alignwide).","snow-monkey-blocks")),checked:S,onChange:e=>i({shifted:e})}),(0,t.createElement)(p.ToggleControl,{label:(0,l.__)("Display caption","snow-monkey-blocks"),checked:C,onChange:e=>i({displayCaption:e})}),(0,t.createElement)(p.RangeControl,{label:(0,l.__)("Autoplay Speed in seconds","snow-monkey-blocks"),help:(0,l.__)('If "0", no scroll.',"snow-monkey-blocks"),value:x,onChange:e=>i({interval:r(e,0,10)}),min:"0",max:"10"}),(0,t.createElement)(p.RangeControl,{label:(0,l.__)("Animation speed in seconds","snow-monkey-blocks"),help:(0,l.__)('If "0", default animation speed.',"snow-monkey-blocks"),value:P,onChange:e=>i({duration:r(e,0,10)}),min:"0",max:"5",step:"0.1"}),!N&&(0,t.createElement)(w,{desktop:()=>(0,t.createElement)(p.RangeControl,{label:(0,l.__)("# of slides to show (Large window)","snow-monkey-blocks"),value:z,onChange:q,min:"1",max:6<c.length?6:c.length}),tablet:()=>(0,t.createElement)(p.RangeControl,{label:(0,l.__)("# of slides to show (Medium window)","snow-monkey-blocks"),value:R,onChange:G,min:"1",max:6<c.length?6:c.length}),mobile:()=>(0,t.createElement)(p.RangeControl,{label:(0,l.__)("# of slides to show (Small window)","snow-monkey-blocks"),value:M,onChange:J,min:"1",max:6<c.length?6:c.length})}))),$?(0,t.createElement)("div",d({},(0,u.useBlockProps)({className:L,ref:F}),{"data-fade":N?"true":"false","data-lg-slide-to-show":!N&&1<z?z:void 0,"data-md-slide-to-show":!N&&1<R?R:void 0,"data-sm-slide-to-show":!N&&1<M?M:void 0}),(0,t.createElement)("div",{className:"spider"},A&&(0,t.createElement)("div",{className:"c-container"},(0,t.createElement)("div",{className:"spider__reference",ref:D})),(0,t.createElement)("div",{className:"spider__canvas",ref:I},c.map(((e,a)=>(0,t.createElement)("div",{className:"spider__slide","data-id":a,key:a},(0,t.createElement)("div",{className:"smb-spider-slider__figure-wrapper"},(0,t.createElement)("img",{className:"spider__figure",src:e.url,alt:e.alt,width:e.width,height:e.height,"data-image-id":e.id})),C&&!!e.caption&&(0,t.createElement)("div",{className:"smb-spider-slider__item"},(0,t.createElement)("div",{className:"smb-spider-slider__item__caption"},e.caption)))))),y&&(0,t.createElement)("div",{className:"spider__arrows"},(0,t.createElement)("button",{className:"spider__arrow","data-direction":"prev"},"Prev"),(0,t.createElement)("button",{className:"spider__arrow","data-direction":"next"},"Next"))),E&&(0,t.createElement)("div",{className:"spider__dots","data-thumbnails":k?"true":"false"},c.map(((e,a)=>(0,t.createElement)("button",{className:"spider__dot","data-id":a,key:a},k?(0,t.createElement)("img",{className:"spider__figure",src:e.url,alt:e.alt,width:e.width,height:e.height}):(0,t.createElement)(t.Fragment,null,a))))),K):(0,t.createElement)("div",(0,u.useBlockProps)({ref:F}),K))},save:function(e){let{attributes:a,className:s}=e;const{images:i,aspectRatio:l,arrows:r,dots:n,dotsToThumbnail:o,fade:c,shifted:p,gutter:g,displayCaption:h,interval:_,duration:b,lgSlidesToShow:w,mdSlidesToShow:f,smSlidesToShow:v}=a;if(!i.length)return null;const y="wide"===a.align,E="full"===a.align,k=p&&!c&&(y||E),N=m()("smb-spider-slider",s,{[`smb-spider-slider--${l}`]:!!l,"smb-spider-slider--shifted":k,[`smb-spider-slider--gutter-${g}`]:!!g});return(0,t.createElement)("div",d({},u.useBlockProps.save({className:N}),{"data-fade":c?"true":"false","data-interval":0<_?1e3*_:void 0,"data-duration":0<b?1e3*b:void 0,"data-lg-slide-to-show":!c&&1<w?w:void 0,"data-md-slide-to-show":!c&&1<f?f:void 0,"data-sm-slide-to-show":!c&&1<v?v:void 0}),(0,t.createElement)("div",{className:"spider"},k&&(0,t.createElement)("div",{className:"c-container"},(0,t.createElement)("div",{className:"spider__reference"})),(0,t.createElement)("div",{className:"spider__canvas"},i.map(((e,a)=>(0,t.createElement)("div",{className:"spider__slide","data-id":a,key:a},(0,t.createElement)("div",{className:"smb-spider-slider__figure-wrapper"},(0,t.createElement)("img",{className:"spider__figure",src:e.url,alt:e.alt,width:e.width,height:e.height,"data-image-id":e.id})),h&&!!e.caption&&(0,t.createElement)("div",{className:"smb-spider-slider__item"},(0,t.createElement)("div",{className:"smb-spider-slider__item__caption"},e.caption)))))),r&&(0,t.createElement)("div",{className:"spider__arrows"},(0,t.createElement)("button",{className:"spider__arrow","data-direction":"prev"},"Prev"),(0,t.createElement)("button",{className:"spider__arrow","data-direction":"next"},"Next"))),n&&(0,t.createElement)("div",{className:"spider__dots","data-thumbnails":o?"true":"false"},i.map(((e,a)=>(0,t.createElement)("button",{className:"spider__dot","data-id":a,key:a},o?(0,t.createElement)("img",{className:"spider__figure",src:e.url,alt:e.alt,width:e.width,height:e.height}):(0,t.createElement)(t.Fragment,null,a))))))},deprecated:y,example:E};(e=>{if(!e)return;const{metadata:t,settings:a,name:s}=e;t&&(t.title&&(t.title=(0,l.__)(t.title,"snow-monkey-blocks"),a.title=t.title),t.description&&(t.description=(0,l.__)(t.description,"snow-monkey-blocks"),a.description=t.description),t.keywords&&(t.keywords=(0,l.__)(t.keywords,"snow-monkey-blocks"),a.keywords=t.keywords)),(0,i.registerBlockType)({name:s,...t},a)})(e)}()}();