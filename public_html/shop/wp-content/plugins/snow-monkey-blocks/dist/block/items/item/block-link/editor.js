!function(){var e={184:function(e,t){var l;!function(){"use strict";var a={}.hasOwnProperty;function s(){for(var e=[],t=0;t<arguments.length;t++){var l=arguments[t];if(l){var n=typeof l;if("string"===n||"number"===n)e.push(l);else if(Array.isArray(l)){if(l.length){var i=s.apply(null,l);i&&e.push(i)}}else if("object"===n)if(l.toString===Object.prototype.toString)for(var o in l)a.call(l,o)&&l[o]&&e.push(o);else e.push(l.toString())}}return e.join(" ")}e.exports?(s.default=s,e.exports=s):void 0===(l=function(){return s}.apply(t,[]))||(e.exports=l)}()}},t={};function l(a){var s=t[a];if(void 0!==s)return s.exports;var n=t[a]={exports:{}};return e[a](n,n.exports,l),n.exports}l.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return l.d(t,{a:t}),t},l.d=function(e,t){for(var a in t)l.o(t,a)&&!l.o(e,a)&&Object.defineProperty(e,a,{enumerable:!0,get:t[a]})},l.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},l.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){"use strict";var e={};l.r(e),l.d(e,{metadata:function(){return o},name:function(){return z},settings:function(){return B}});var t=window.wp.element,a=window.lodash,s=window.wp.blocks,n=(window.wp.richText,window.wp.i18n);const i=(e,t)=>t?(0,a.reduce)(e,((e,l)=>{const s=(0,a.get)(t,["sizes",l.slug,"url"]),n=(0,a.get)(t,["media_details","sizes",l.slug,"source_url"]),i=(0,a.get)(t,["sizes",l.slug,"width"]),o=(0,a.get)(t,["media_details","sizes",l.slug,"width"]),r=(0,a.get)(t,["sizes",l.slug,"height"]),m=(0,a.get)(t,["media_details","sizes",l.slug,"height"]);return{...e,[l.slug]:{url:s||n,width:i||o,height:r||m}}}),{}):{};var o=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/items-item-block-link","title":"Item (Block Link)","description":"It is a child block of the items block.","category":"smb","parent":["snow-monkey-blocks/items"],"attributes":{"titleTagName":{"type":"string","default":"div"},"title":{"type":"string","source":"html","selector":".smb-items__item__title","default":""},"lede":{"type":"string","source":"html","selector":".smb-items__item__lede","default":""},"summary":{"type":"string","source":"html","selector":".smb-items__item__content","default":""},"url":{"type":"string","source":"attribute","selector":".smb-items__item--block-link","attribute":"href","default":""},"target":{"type":"string","source":"attribute","selector":".smb-items__item--block-link","attribute":"target","default":"_self"},"imageID":{"type":"number","default":0},"imageURL":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"src","default":""},"imageAlt":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"alt","default":""},"imageWidth":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"width","default":""},"imageHeight":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"height","default":""},"imageSizeSlug":{"type":"string","default":"large"},"btnLabel":{"type":"string","source":"html","selector":".smb-items__item__btn > .smb-btn__label","default":""},"btnBackgroundColor":{"type":"string"},"btnTextColor":{"type":"string"},"btnSize":{"type":"string","default":""},"btnBorderRadius":{"type":"number"},"btnWrap":{"type":"boolean","default":false}},"supports":{"html":false},"editorScript":"file:../../../../dist/block/items/item/block-link/editor.js"}'),r=(0,t.createElement)("svg",{viewBox:"0 0 24 24"},(0,t.createElement)("rect",{x:"1",y:"15.5",width:"10",height:"1"}),(0,t.createElement)("rect",{x:"1",y:"17.5",width:"8",height:"1"}),(0,t.createElement)("rect",{x:"1",y:"19.5",width:"8",height:"1"}),(0,t.createElement)("path",{d:"M1,4.06v8.88a.56.56,0,0,0,.56.56h8.88a.56.56,0,0,0,.56-.56V4.06a.56.56,0,0,0-.56-.56H1.56A.56.56,0,0,0,1,4.06m8.89,8.61H2.11a.29.29,0,0,1-.28-.28V4.61a.29.29,0,0,1,.28-.28H9.89a.29.29,0,0,1,.28.28v7.78a.29.29,0,0,1-.28.28"}),(0,t.createElement)("path",{d:"M1.83,10.05,4,8.45a.15.15,0,0,1,.16,0L5.85,9.52A.13.13,0,0,0,6,9.5l2.11-2a.14.14,0,0,1,.19,0l2.21,2.15v.84L8.32,8.32a.14.14,0,0,0-.19,0L6,10.34a.13.13,0,0,1-.17,0L4.18,9.29a.14.14,0,0,0-.16,0L1.83,10.88Z"}),(0,t.createElement)("rect",{x:"1",y:"3.5",width:"10",height:"10",fill:"none"}),(0,t.createElement)("rect",{x:"13",y:"15.5",width:"10",height:"1"}),(0,t.createElement)("rect",{x:"13",y:"17.5",width:"8",height:"1"}),(0,t.createElement)("rect",{x:"13",y:"19.5",width:"8",height:"1"}),(0,t.createElement)("path",{d:"M13,4.06v8.88a.56.56,0,0,0,.56.56h8.88a.56.56,0,0,0,.56-.56V4.06a.56.56,0,0,0-.56-.56H13.56a.56.56,0,0,0-.56.56m8.89,8.61H14.11a.29.29,0,0,1-.28-.28V4.61a.29.29,0,0,1,.28-.28h7.78a.29.29,0,0,1,.28.28v7.78a.29.29,0,0,1-.28.28"}),(0,t.createElement)("path",{d:"M13.83,10.05,16,8.45a.15.15,0,0,1,.16,0l1.67,1.07a.13.13,0,0,0,.17,0l2.11-2a.14.14,0,0,1,.19,0l2.21,2.15v.84L20.32,8.32a.14.14,0,0,0-.19,0l-2.11,2a.13.13,0,0,1-.17,0L16.18,9.29a.14.14,0,0,0-.16,0l-2.19,1.59Z"}),(0,t.createElement)("rect",{x:"13",y:"3.5",width:"10",height:"10",fill:"none"}));function m(){return m=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var l=arguments[t];for(var a in l)Object.prototype.hasOwnProperty.call(l,a)&&(e[a]=l[a])}return e},m.apply(this,arguments)}var c=l(184),d=l.n(c),u=window.wp.data,_=window.wp.components,b=window.wp.blockEditor,g=window.wp.primitives,h=(0,t.createElement)(g.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(g.Path,{d:"M15.6 7.2H14v1.5h1.6c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.8 0 5.2-2.3 5.2-5.2 0-2.9-2.3-5.2-5.2-5.2zM4.7 12.4c0-2 1.7-3.7 3.7-3.7H10V7.2H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H10v-1.5H8.4c-2 0-3.7-1.7-3.7-3.7zm4.6.9h5.3v-1.5H9.3v1.5z"})),p=(0,t.createElement)(g.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(g.Path,{d:"M15.6 7.3h-.7l1.6-3.5-.9-.4-3.9 8.5H9v1.5h2l-1.3 2.8H8.4c-2 0-3.7-1.7-3.7-3.7s1.7-3.7 3.7-3.7H10V7.3H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H9l-1.4 3.2.9.4 5.7-12.5h1.4c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.9 0 5.2-2.3 5.2-5.2 0-2.9-2.4-5.2-5.2-5.2z"}));const k=e=>{let{id:l,src:a,allowedTypes:s,accept:i,onSelect:o,onSelectURL:r,onRemove:m}=e;return(0,t.createElement)(b.BlockControls,{group:"inline"},(0,t.createElement)(b.MediaReplaceFlow,{mediaId:l,mediaURL:a,allowedTypes:s,accept:i,onSelect:o,onSelectURL:r}),!!a&&!!m&&(0,t.createElement)(_.ToolbarItem,{as:_.Button,onClick:m},(0,n.__)("Release","snow-monkey-blocks")))},y=e=>{let{src:l,alt:a,id:s,style:n}=e;return(0,t.createElement)("img",{src:l,alt:a,className:`wp-image-${s}`,style:n})},v=e=>{let{src:l,style:a}=e;return(0,t.createElement)("video",{controls:!0,src:l,style:a})},f=(0,t.memo)((e=>{let l,{id:s,src:n,alt:i,url:o,target:r,allowedTypes:m,accept:c,onSelect:d,onSelectURL:u,onRemove:_,mediaType:b,style:g,rel:h,linkClass:p}=e;if("image"===b){let e;l=(0,t.createElement)(y,{src:n,alt:i,id:s,style:g}),e=h?(0,a.isEmpty)(h)?void 0:h:"_self"!==r&&r?"noopener noreferrer":void 0,o&&(l=(0,t.createElement)("span",{href:o,target:"_self"===r?void 0:r,rel:e,className:p},l))}else"video"===b&&(l=(0,t.createElement)(v,{src:n,style:g}));return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(k,{id:s,src:n,allowedTypes:m,accept:c,onSelect:d,onSelectURL:u,onRemove:_}),l)}),((e,t)=>{const l=Object.keys(e);for(const a of l)if(e[a]!==t[a])return!1;return!0}));function w(e){const{src:l,onSelect:a,onSelectURL:s,mediaType:i,allowedTypes:o=["image"]}=e,r=!i&&l?"image":i;let c=(0,n.__)("Media","snow-monkey-blocks");1===o.length&&("image"===o[0]?c=(0,n.__)("Image","snow-monkey-blocks"):"video"===o[0]&&(c=(0,n.__)("Video","snow-monkey-blocks")));const d=(0,t.useMemo)((()=>o.map((e=>`${e}/*`)).join(",")),[o]);return l?(0,t.createElement)(f,m({},e,{accept:d,allowedTypes:o,mediaType:r})):(0,t.createElement)(b.MediaPlaceholder,{icon:"format-image",labels:{title:c},onSelect:a,onSelectURL:s,accept:d,allowedTypes:o})}const E=e=>"_self"!==e&&("_blank"===e||void 0);function x(e){const{url:l,target:a,onChange:s}=e;return(0,t.createElement)(b.__experimentalLinkControl,{className:"wp-block-navigation-link__inline-link-input",value:{url:l,opensInNewTab:E(a)},onChange:s})}function C(e){const{label:l,id:a,slug:s,onChange:n}=e;if(!a)return null;const{options:o}=(0,u.useSelect)((e=>{const{getMedia:t}=e("core"),l=t(a);if(!l)return{options:[]};const{getSettings:s}=e("core/block-editor"),{imageSizes:n}=s(),o=i(n,l);return{options:n.map((e=>!!o[e.slug]&&{value:e.slug,label:e.name})).filter((e=>e))}}));return 1>o.length?null:(0,t.createElement)(_.SelectControl,{label:l,value:s,options:o,onChange:n})}function N(){const e={disableCustomColors:!(0,b.useSetting)("color.custom"),disableCustomGradients:!(0,b.useSetting)("color.customGradient")},l=(0,b.useSetting)("color.palette.custom"),a=(0,b.useSetting)("color.palette.theme"),s=(0,b.useSetting)("color.palette.default"),i=(0,b.useSetting)("color.defaultPalette");e.colors=(0,t.useMemo)((()=>{const e=[];return a&&a.length&&e.push({name:(0,n._x)("Theme","Indicates this palette comes from the theme.","snow-monkey-blocks"),colors:a}),i&&s&&s.length&&e.push({name:(0,n._x)("Default","Indicates this palette comes from WordPress.","snow-monkey-blocks"),colors:s}),l&&l.length&&e.push({name:(0,n._x)("Custom","Indicates this palette comes from the theme.","snow-monkey-blocks"),colors:l}),e}),[s,a,l]);const o=(0,b.useSetting)("color.gradients.custom"),r=(0,b.useSetting)("color.gradients.theme"),m=(0,b.useSetting)("color.gradients.default"),c=(0,b.useSetting)("color.defaultGradients");return e.gradients=(0,t.useMemo)((()=>{const e=[];return r&&r.length&&e.push({name:(0,n._x)("Theme","Indicates this palette comes from the theme.","snow-monkey-blocks"),gradients:r}),c&&m&&m.length&&e.push({name:(0,n._x)("Default","Indicates this palette comes from WordPress.","snow-monkey-blocks"),gradients:m}),o&&o.length&&e.push({name:(0,n._x)("Custom","Indicates this palette is created by the user.","snow-monkey-blocks"),gradients:o}),e}),[o,r,m]),e}const R=o.attributes;var T=[{attributes:{...R,url:{type:"string",default:""},target:{type:"string",default:"_self"}},save(e){let{attributes:l,className:a}=e;const{titleTagName:s,title:n,lede:i,summary:o,url:r,target:m,imageID:c,imageURL:u,imageAlt:_,imageWidth:g,imageHeight:h,btnLabel:p,btnBackgroundColor:k,btnTextColor:y,btnSize:v,btnBorderRadius:f,btnWrap:w}=l,E=d()("c-row__col",a),x=d()("smb-items__item__btn","smb-btn",{[`smb-btn--${v}`]:!!v,"smb-btn--wrap":w}),C={color:y||void 0},N={backgroundColor:k||void 0,borderRadius:void 0!==f?`${f}px`:void 0};return(0,t.createElement)("div",{className:E},(0,t.createElement)("a",{className:"smb-items__item smb-items__item--block-link",href:r,target:"_self"===m?void 0:m,rel:"_self"===m?void 0:"noopener noreferrer"},!!u&&(0,t.createElement)("div",{className:"smb-items__item__figure"},(0,t.createElement)("img",{src:u,alt:_,width:!!g&&g,height:!!h&&h,className:`wp-image-${c}`})),"none"!==s&&(0,t.createElement)(b.RichText.Content,{tagName:s,className:"smb-items__item__title",value:n}),!b.RichText.isEmpty(i)&&(0,t.createElement)("div",{className:"smb-items__item__lede"},(0,t.createElement)(b.RichText.Content,{value:i})),!b.RichText.isEmpty(o)&&(0,t.createElement)("div",{className:"smb-items__item__content"},(0,t.createElement)(b.RichText.Content,{value:o})),!b.RichText.isEmpty(p)&&!!r&&(0,t.createElement)("div",{className:"smb-items__item__action"},(0,t.createElement)("span",{className:x,style:N},(0,t.createElement)("span",{className:"smb-btn__label",style:C},(0,t.createElement)(b.RichText.Content,{value:p}))))))}},{attributes:{...R,url:{type:"string",default:""},target:{type:"string",default:"_self"}},save(e){let{attributes:l,className:a}=e;const{titleTagName:s,title:n,lede:i,summary:o,url:r,target:m,imageID:c,imageURL:u,imageAlt:_,imageWidth:g,imageHeight:h,btnLabel:p,btnBackgroundColor:k,btnTextColor:y,btnSize:v,btnBorderRadius:f,btnWrap:w}=l,E=d()("c-row__col",a),x=d()("smb-items__item__btn","smb-btn",{[`smb-btn--${v}`]:!!v,"smb-btn--wrap":w}),C={color:y||void 0},N={backgroundColor:k||void 0,borderRadius:void 0!==f?`${f}px`:void 0};return(0,t.createElement)("div",{className:E},(0,t.createElement)("div",{className:"smb-items__item smb-items__item--block-link"},!!u&&(0,t.createElement)("div",{className:"smb-items__item__figure"},(0,t.createElement)("img",{src:u,alt:_,width:!!g&&g,height:!!h&&h,className:`wp-image-${c}`})),"none"!==s&&(0,t.createElement)(b.RichText.Content,{tagName:s,className:"smb-items__item__title",value:n}),!b.RichText.isEmpty(i)&&(0,t.createElement)("div",{className:"smb-items__item__lede"},(0,t.createElement)(b.RichText.Content,{value:i})),!b.RichText.isEmpty(o)&&(0,t.createElement)("div",{className:"smb-items__item__content"},(0,t.createElement)(b.RichText.Content,{value:o})),!b.RichText.isEmpty(p)&&!!r&&(0,t.createElement)("div",{className:"smb-items__item__action"},(0,t.createElement)("a",{className:x,href:r,style:N,target:"_self"===m?void 0:m,rel:"_self"===m?void 0:"noopener noreferrer"},(0,t.createElement)("span",{className:"smb-btn__label",style:C},(0,t.createElement)(b.RichText.Content,{value:p}))))))}},{attributes:{...R,url:{type:"string",default:""},target:{type:"string",default:"_self"}},save(e){let{attributes:l,className:a}=e;const{titleTagName:s,title:n,lede:i,summary:o,btnLabel:r,url:m,target:c,btnBackgroundColor:u,btnTextColor:_,imageID:g,imageURL:h,imageAlt:p,imageWidth:k,imageHeight:y}=l,v=d()("c-row__col",a),f={color:_||void 0},w={backgroundColor:u||void 0};return(0,t.createElement)("div",{className:v},(0,t.createElement)("a",{className:"smb-items__item",href:m,target:"_self"===c?void 0:c,rel:"_self"===c?void 0:"noopener noreferrer"},!!h&&(0,t.createElement)("div",{className:"smb-items__item__figure"},(0,t.createElement)("img",{src:h,alt:p,width:!!k&&k,height:!!y&&y,className:`wp-image-${g}`})),"none"!==s&&(0,t.createElement)(b.RichText.Content,{tagName:s,className:"smb-items__item__title",value:n}),!b.RichText.isEmpty(i)&&(0,t.createElement)("div",{className:"smb-items__item__lede"},(0,t.createElement)(b.RichText.Content,{value:i})),!b.RichText.isEmpty(o)&&(0,t.createElement)("div",{className:"smb-items__item__content"},(0,t.createElement)(b.RichText.Content,{value:o})),!b.RichText.isEmpty(r)&&!!m&&(0,t.createElement)("div",{className:"smb-items__item__action"},(0,t.createElement)("span",{className:"smb-items__item__btn smb-btn",style:w},(0,t.createElement)("span",{className:"smb-btn__label",style:f},(0,t.createElement)(b.RichText.Content,{value:r}))))))}}],S={to:[{type:"block",blocks:["snow-monkey-blocks/items-item-standard"],transform:e=>(0,s.createBlock)("snow-monkey-blocks/items-item-standard",e)},{type:"block",blocks:["snow-monkey-blocks/items-banner"],transform:e=>(0,s.createBlock)("snow-monkey-blocks/items-banner",e)},{type:"block",blocks:["snow-monkey-blocks/items-item-free"],transform:e=>(0,s.createBlock)("snow-monkey-blocks/items-item-free",{},[(0,s.createBlock)("core/paragraph",{content:e.summary})])}]};const{name:z}=o,B={icon:{foreground:"#cd162c",src:r},edit:function(e){let{attributes:l,setAttributes:s,isSelected:o,className:r}=e;const{titleTagName:c,title:g,lede:k,summary:y,url:v,target:f,imageID:E,imageURL:R,imageAlt:T,imageWidth:S,imageHeight:z,imageSizeSlug:B,btnLabel:L,btnBackgroundColor:I,btnTextColor:H,btnSize:W,btnBorderRadius:M,btnWrap:P}=l,[U,O]=(0,t.useState)(!1),$=!!v,j=$&&o,{resizedImages:A}=(0,u.useSelect)((e=>{if(!E)return{resizedImages:{}};const{getMedia:t}=e("core"),l=t(E);if(!l)return{resizedImages:{}};const{getSettings:a}=e("core/block-editor"),{imageSizes:s}=a();return{resizedImages:i(s,l)}}),[E]),V=["div","h2","h3","none"],D=d()("c-row__col",r),G=d()("smb-items__item__btn","smb-btn",{[`smb-btn--${W}`]:!!W,"smb-btn--wrap":P}),F={color:H||void 0},Z={backgroundColor:I||void 0,borderRadius:void 0!==M?`${M}px`:void 0},J=(0,t.useRef)(),q=(0,b.useBlockProps)({className:D,ref:J}),K=e=>{let{url:t,opensInNewTab:l}=e;return s({url:t,target:l?"_blank":"_self"})};return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(b.InspectorControls,null,(0,t.createElement)(_.PanelBody,{title:(0,n.__)("Block settings","snow-monkey-blocks")},(0,t.createElement)(_.BaseControl,{label:(0,n.__)("Title tag","snow-monkey-blocks"),id:"snow-monkey-blocks/items-item-block-link/title-tag-name"},(0,t.createElement)("div",{className:"smb-list-icon-selector"},(0,a.times)(V.length,(e=>{const l=c===V[e];return(0,t.createElement)(_.Button,{isPrimary:l,isSecondary:!l,onClick:()=>{s({titleTagName:V[e]})},key:e},V[e])})))),(0,t.createElement)(C,{label:(0,n.__)("Images size","snow-monkey-blocks"),id:E,slug:B,onChange:e=>{let t=R;A[e]&&A[e].url&&(t=A[e].url);let l=S;A[e]&&A[e].width&&(l=A[e].width);let a=z;A[e]&&A[e].height&&(a=A[e].height),s({imageURL:t,imageWidth:l,imageHeight:a,imageSizeSlug:e})}})),(0,t.createElement)(_.PanelBody,{title:(0,n.__)("Button settings","snow-monkey-blocks")},(0,t.createElement)(_.SelectControl,{label:(0,n.__)("Button size","snow-monkey-blocks"),value:W,onChange:e=>s({btnSize:e}),options:[{value:"",label:(0,n.__)("Normal size","snow-monkey-blocks")},{value:"little-wider",label:(0,n.__)("Litle wider","snow-monkey-blocks")},{value:"wider",label:(0,n.__)("Wider","snow-monkey-blocks")},{value:"more-wider",label:(0,n.__)("More wider","snow-monkey-blocks")},{value:"full",label:(0,n.__)("Full size","snow-monkey-blocks")}]}),(0,t.createElement)(_.RangeControl,{label:(0,n.__)("Border radius","snow-monkey-blocks"),value:M,onChange:e=>s({btnBorderRadius:e}),min:"0",max:"50",initialPosition:"6",allowReset:!0}),(0,t.createElement)(_.CheckboxControl,{label:(0,n.__)("Wrap","snow-monkey-blocks"),checked:P,onChange:e=>s({btnWrap:e})}),(0,t.createElement)(b.__experimentalColorGradientControl,m({label:(0,n.__)("Background color","snow-monkey-blocks"),colorValue:I,onColorChange:e=>s({btnBackgroundColor:e})},N(),{__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0})),(0,t.createElement)(b.__experimentalColorGradientControl,m({label:(0,n.__)("Text color","snow-monkey-blocks"),colorValue:H,onColorChange:e=>s({btnTextColor:e})},N(),{__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0})),(0,t.createElement)(b.ContrastChecker,{backgroundColor:I,textColor:H}))),(0,t.createElement)("div",q,(0,t.createElement)("div",{className:"smb-items__item smb-items__item--block-link"},(!!R||o)&&(0,t.createElement)("div",{className:"smb-items__item__figure"},(0,t.createElement)(w,{src:R,id:E,alt:T,onSelect:e=>{const t=e.sizes&&e.sizes[B]?e.sizes[B].url:e.url,l=e.sizes&&e.sizes[B]?e.sizes[B].width:e.width,a=e.sizes&&e.sizes[B]?e.sizes[B].height:e.height;s({imageURL:t,imageID:e.id,imageAlt:e.alt,imageWidth:l,imageHeight:a})},onSelectURL:e=>{e!==R&&s({imageURL:e,imageID:0,imageSizeSlug:"large"})},onRemove:()=>s({imageURL:"",imageAlt:"",imageWidth:"",imageHeight:"",imageID:0}),isSelected:o})),(0,t.createElement)("div",{className:"smb-items__item__body"},"none"!==c&&(0,t.createElement)(b.RichText,{tagName:c,className:"smb-items__item__title",placeholder:(0,n.__)("Write title…","snow-monkey-blocks"),value:g,onChange:e=>s({title:e})}),(!b.RichText.isEmpty(k)||o)&&(0,t.createElement)(b.RichText,{className:"smb-items__item__lede",placeholder:(0,n.__)("Write lede…","snow-monkey-blocks"),value:k,onChange:e=>s({lede:e})}),(!b.RichText.isEmpty(y)||o)&&(0,t.createElement)(b.RichText,{className:"smb-items__item__content",placeholder:(0,n.__)("Write content…","snow-monkey-blocks"),value:y,onChange:e=>s({summary:e})}),(!b.RichText.isEmpty(L)||o)&&(0,t.createElement)("div",{className:"smb-items__item__action"},(0,t.createElement)("span",{className:G,style:Z},(0,t.createElement)(b.RichText,{className:"smb-btn__label",style:F,value:L,placeholder:(0,n.__)("Button","snow-monkey-blocks"),onChange:e=>s({btnLabel:e}),withoutInteractiveFormatting:!0}),(U||j)&&(0,t.createElement)(_.Popover,{position:"bottom center",anchorRef:J.current,onClose:()=>O(!1)},(0,t.createElement)(x,{url:v,target:f,onChange:K}))))))),(0,t.createElement)(b.BlockControls,{group:"block"},!$&&(0,t.createElement)(_.ToolbarButton,{icon:h,label:(0,n.__)("Link","snow-monkey-blocks"),"aria-expanded":U,onClick:()=>O(!U)}),j&&(0,t.createElement)(_.ToolbarButton,{isPressed:!0,icon:p,label:(0,n.__)("Unlink","snow-monkey-blocks"),onClick:()=>K("")})))},save:function(e){let{attributes:l,className:a}=e;const{titleTagName:s,title:n,lede:i,summary:o,url:r,target:m,imageID:c,imageURL:u,imageAlt:_,imageWidth:g,imageHeight:h,btnLabel:p,btnBackgroundColor:k,btnTextColor:y,btnSize:v,btnBorderRadius:f,btnWrap:w}=l,E=d()("c-row__col",a),x=d()("smb-items__item__btn","smb-btn",{[`smb-btn--${v}`]:!!v,"smb-btn--wrap":w}),C={color:y||void 0},N={backgroundColor:k||void 0,borderRadius:void 0!==f?`${f}px`:void 0};return(0,t.createElement)("div",b.useBlockProps.save({className:E}),(0,t.createElement)("a",{className:"smb-items__item smb-items__item--block-link",href:r,target:"_self"===m?void 0:m,rel:"_self"===m?void 0:"noopener noreferrer"},!!u&&(0,t.createElement)("div",{className:"smb-items__item__figure"},(0,t.createElement)("img",{src:u,alt:_,width:!!g&&g,height:!!h&&h,className:`wp-image-${c}`})),(0,t.createElement)("div",{className:"smb-items__item__body"},"none"!==s&&(0,t.createElement)(b.RichText.Content,{tagName:s,className:"smb-items__item__title",value:n}),!b.RichText.isEmpty(i)&&(0,t.createElement)("div",{className:"smb-items__item__lede"},(0,t.createElement)(b.RichText.Content,{value:i})),!b.RichText.isEmpty(o)&&(0,t.createElement)("div",{className:"smb-items__item__content"},(0,t.createElement)(b.RichText.Content,{value:o})),!b.RichText.isEmpty(p)&&!!r&&(0,t.createElement)("div",{className:"smb-items__item__action"},(0,t.createElement)("span",{className:x,href:r,style:N,target:"_self"===m?void 0:m,rel:"_self"===m?void 0:"noopener noreferrer"},(0,t.createElement)("span",{className:"smb-btn__label",style:C},(0,t.createElement)(b.RichText.Content,{value:p})))))))},deprecated:T,transforms:S};(e=>{if(!e)return;const{metadata:t,settings:l,name:a}=e;t&&(t.title&&(t.title=(0,n.__)(t.title,"snow-monkey-blocks"),l.title=t.title),t.description&&(t.description=(0,n.__)(t.description,"snow-monkey-blocks"),l.description=t.description),t.keywords&&(t.keywords=(0,n.__)(t.keywords,"snow-monkey-blocks"),l.keywords=t.keywords)),(0,s.registerBlockType)({name:a,...t},l)})(e)}()}();