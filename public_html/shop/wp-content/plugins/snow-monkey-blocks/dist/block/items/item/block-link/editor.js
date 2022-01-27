!function(){var e={173:function(e,t,l){"use strict";var a={};l.r(a),l.d(a,{metadata:function(){return m},name:function(){return L},settings:function(){return I}});var s=window.wp.element,n=window.lodash,i=window.wp.blocks,o=(window.wp.richText,window.wp.i18n);const r=(e,t)=>t?(0,n.reduce)(e,((e,l)=>{const a=(0,n.get)(t,["sizes",l.slug,"url"]),s=(0,n.get)(t,["media_details","sizes",l.slug,"source_url"]),i=(0,n.get)(t,["sizes",l.slug,"width"]),o=(0,n.get)(t,["media_details","sizes",l.slug,"width"]),r=(0,n.get)(t,["sizes",l.slug,"height"]),m=(0,n.get)(t,["media_details","sizes",l.slug,"height"]);return{...e,[l.slug]:{url:a||s,width:i||o,height:r||m}}}),{}):{};var m=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/items-item-block-link","title":"Item (Block Link)","description":"It is a child block of the items block.","category":"smb","parent":["snow-monkey-blocks/items"],"attributes":{"titleTagName":{"type":"string","default":"div"},"title":{"type":"string","source":"html","selector":".smb-items__item__title","default":""},"lede":{"type":"string","source":"html","selector":".smb-items__item__lede","default":""},"summary":{"type":"string","source":"html","selector":".smb-items__item__content","default":""},"url":{"type":"string","source":"attribute","selector":".smb-items__item--block-link","attribute":"href","default":""},"target":{"type":"string","source":"attribute","selector":".smb-items__item--block-link","attribute":"target","default":"_self"},"imageID":{"type":"number","default":0},"imageURL":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"src","default":""},"imageAlt":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"alt","default":""},"imageWidth":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"width","default":""},"imageHeight":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"height","default":""},"imageSizeSlug":{"type":"string","default":"large"},"btnLabel":{"type":"string","source":"html","selector":".smb-items__item__btn > .smb-btn__label","default":""},"btnBackgroundColor":{"type":"string"},"btnTextColor":{"type":"string"},"btnSize":{"type":"string","default":""},"btnBorderRadius":{"type":"number"},"btnWrap":{"type":"boolean","default":false}},"supports":{"html":false},"editorScript":"file:../../../../dist/block/items/item/block-link/editor.js"}'),c=(0,s.createElement)("svg",{viewBox:"0 0 24 24"},(0,s.createElement)("rect",{x:"1",y:"15.5",width:"10",height:"1"}),(0,s.createElement)("rect",{x:"1",y:"17.5",width:"8",height:"1"}),(0,s.createElement)("rect",{x:"1",y:"19.5",width:"8",height:"1"}),(0,s.createElement)("path",{d:"M1,4.06v8.88a.56.56,0,0,0,.56.56h8.88a.56.56,0,0,0,.56-.56V4.06a.56.56,0,0,0-.56-.56H1.56A.56.56,0,0,0,1,4.06m8.89,8.61H2.11a.29.29,0,0,1-.28-.28V4.61a.29.29,0,0,1,.28-.28H9.89a.29.29,0,0,1,.28.28v7.78a.29.29,0,0,1-.28.28"}),(0,s.createElement)("path",{d:"M1.83,10.05,4,8.45a.15.15,0,0,1,.16,0L5.85,9.52A.13.13,0,0,0,6,9.5l2.11-2a.14.14,0,0,1,.19,0l2.21,2.15v.84L8.32,8.32a.14.14,0,0,0-.19,0L6,10.34a.13.13,0,0,1-.17,0L4.18,9.29a.14.14,0,0,0-.16,0L1.83,10.88Z"}),(0,s.createElement)("rect",{x:"1",y:"3.5",width:"10",height:"10",fill:"none"}),(0,s.createElement)("rect",{x:"13",y:"15.5",width:"10",height:"1"}),(0,s.createElement)("rect",{x:"13",y:"17.5",width:"8",height:"1"}),(0,s.createElement)("rect",{x:"13",y:"19.5",width:"8",height:"1"}),(0,s.createElement)("path",{d:"M13,4.06v8.88a.56.56,0,0,0,.56.56h8.88a.56.56,0,0,0,.56-.56V4.06a.56.56,0,0,0-.56-.56H13.56a.56.56,0,0,0-.56.56m8.89,8.61H14.11a.29.29,0,0,1-.28-.28V4.61a.29.29,0,0,1,.28-.28h7.78a.29.29,0,0,1,.28.28v7.78a.29.29,0,0,1-.28.28"}),(0,s.createElement)("path",{d:"M13.83,10.05,16,8.45a.15.15,0,0,1,.16,0l1.67,1.07a.13.13,0,0,0,.17,0l2.11-2a.14.14,0,0,1,.19,0l2.21,2.15v.84L20.32,8.32a.14.14,0,0,0-.19,0l-2.11,2a.13.13,0,0,1-.17,0L16.18,9.29a.14.14,0,0,0-.16,0l-2.19,1.59Z"}),(0,s.createElement)("rect",{x:"13",y:"3.5",width:"10",height:"10",fill:"none"}));function d(){return d=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var l=arguments[t];for(var a in l)Object.prototype.hasOwnProperty.call(l,a)&&(e[a]=l[a])}return e},d.apply(this,arguments)}var u=l(184),_=l.n(u),b=window.wp.data,g=window.wp.components,h=window.wp.blockEditor,p=window.wp.primitives,k=(0,s.createElement)(p.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,s.createElement)(p.Path,{d:"M15.6 7.2H14v1.5h1.6c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.8 0 5.2-2.3 5.2-5.2 0-2.9-2.3-5.2-5.2-5.2zM4.7 12.4c0-2 1.7-3.7 3.7-3.7H10V7.2H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H10v-1.5H8.4c-2 0-3.7-1.7-3.7-3.7zm4.6.9h5.3v-1.5H9.3v1.5z"})),y=(0,s.createElement)(p.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,s.createElement)(p.Path,{d:"M15.6 7.3h-.7l1.6-3.5-.9-.4-3.9 8.5H9v1.5h2l-1.3 2.8H8.4c-2 0-3.7-1.7-3.7-3.7s1.7-3.7 3.7-3.7H10V7.3H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H9l-1.4 3.2.9.4 5.7-12.5h1.4c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.9 0 5.2-2.3 5.2-5.2 0-2.9-2.4-5.2-5.2-5.2z"}));const v=e=>{let{id:t,src:l,allowedTypes:a,accept:n,onSelect:i,onSelectURL:r,onRemove:m}=e;return(0,s.createElement)(h.BlockControls,{group:"inline"},(0,s.createElement)(h.MediaReplaceFlow,{mediaId:t,mediaURL:l,allowedTypes:a,accept:n,onSelect:i,onSelectURL:r}),!!l&&!!m&&(0,s.createElement)(g.ToolbarItem,{as:g.Button,onClick:m},(0,o.__)("Release","snow-monkey-blocks")))},f=e=>{let{src:t,alt:l,id:a,style:n}=e;return(0,s.createElement)("img",{src:t,alt:l,className:`wp-image-${a}`,style:n})},w=e=>{let{src:t,style:l}=e;return(0,s.createElement)("video",{controls:!0,src:t,style:l})},E=(0,s.memo)((e=>{let t,{id:l,src:a,alt:i,url:o,target:r,allowedTypes:m,accept:c,onSelect:d,onSelectURL:u,onRemove:_,mediaType:b,style:g,rel:h,linkClass:p}=e;if("image"===b){let e;t=(0,s.createElement)(f,{src:a,alt:i,id:l,style:g}),e=h?(0,n.isEmpty)(h)?void 0:h:"_self"!==r&&r?"noopener noreferrer":void 0,o&&(t=(0,s.createElement)("span",{href:o,target:"_self"===r?void 0:r,rel:e,className:p},t))}else"video"===b&&(t=(0,s.createElement)(w,{src:a,style:g}));return(0,s.createElement)(s.Fragment,null,(0,s.createElement)(v,{id:l,src:a,allowedTypes:m,accept:c,onSelect:d,onSelectURL:u,onRemove:_}),t)}),((e,t)=>{const l=Object.keys(e);for(const a of l)if(e[a]!==t[a])return!1;return!0}));function x(e){const{src:t,onSelect:l,onSelectURL:a,mediaType:n,allowedTypes:i=["image"]}=e,r=!n&&t?"image":n;let m=(0,o.__)("Media","snow-monkey-blocks");1===i.length&&("image"===i[0]?m=(0,o.__)("Image","snow-monkey-blocks"):"video"===i[0]&&(m=(0,o.__)("Video","snow-monkey-blocks")));const c=(0,s.useMemo)((()=>i.map((e=>`${e}/*`)).join(",")),[i]);return t?(0,s.createElement)(E,d({},e,{accept:c,allowedTypes:i,mediaType:r})):(0,s.createElement)(h.MediaPlaceholder,{icon:"format-image",labels:{title:m},onSelect:l,onSelectURL:a,accept:c,allowedTypes:i})}const C=e=>"_self"!==e&&("_blank"===e||void 0);function N(e){const{url:t,target:l,onChange:a}=e;return(0,s.createElement)(h.__experimentalLinkControl,{className:"wp-block-navigation-link__inline-link-input",value:{url:t,opensInNewTab:C(l)},onChange:a})}function R(e){const{label:t,id:l,slug:a,onChange:n}=e;if(!l)return null;const{options:i}=(0,b.useSelect)((e=>{const{getMedia:t}=e("core"),a=t(l);if(!a)return{options:[]};const{getSettings:s}=e("core/block-editor"),{imageSizes:n}=s(),i=r(n,a);return{options:n.map((e=>!!i[e.slug]&&{value:e.slug,label:e.name})).filter((e=>e))}}));return 1>i.length?null:(0,s.createElement)(g.SelectControl,{label:t,value:a,options:i,onChange:n})}function T(){const e={disableCustomColors:!(0,h.useSetting)("color.custom"),disableCustomGradients:!(0,h.useSetting)("color.customGradient")},t=(0,h.useSetting)("color.palette.custom"),l=(0,h.useSetting)("color.palette.theme"),a=(0,h.useSetting)("color.palette.default"),n=(0,h.useSetting)("color.defaultPalette");e.colors=(0,s.useMemo)((()=>{const e=[];return l&&l.length&&e.push({name:(0,o._x)("Theme","Indicates this palette comes from the theme.","snow-monkey-blocks"),colors:l}),n&&a&&a.length&&e.push({name:(0,o._x)("Default","Indicates this palette comes from WordPress.","snow-monkey-blocks"),colors:a}),t&&t.length&&e.push({name:(0,o._x)("Custom","Indicates this palette comes from the theme.","snow-monkey-blocks"),colors:t}),e}),[a,l,t]);const i=(0,h.useSetting)("color.gradients.custom"),r=(0,h.useSetting)("color.gradients.theme"),m=(0,h.useSetting)("color.gradients.default"),c=(0,h.useSetting)("color.defaultGradients");return e.gradients=(0,s.useMemo)((()=>{const e=[];return r&&r.length&&e.push({name:(0,o._x)("Theme","Indicates this palette comes from the theme.","snow-monkey-blocks"),gradients:r}),c&&m&&m.length&&e.push({name:(0,o._x)("Default","Indicates this palette comes from WordPress.","snow-monkey-blocks"),gradients:m}),i&&i.length&&e.push({name:(0,o._x)("Custom","Indicates this palette is created by the user.","snow-monkey-blocks"),gradients:i}),e}),[i,r,m]),e}const S=m.attributes;var z=[{attributes:{...S,url:{type:"string",default:""},target:{type:"string",default:"_self"}},save(e){let{attributes:t,className:l}=e;const{titleTagName:a,title:n,lede:i,summary:o,url:r,target:m,imageID:c,imageURL:d,imageAlt:u,imageWidth:b,imageHeight:g,btnLabel:p,btnBackgroundColor:k,btnTextColor:y,btnSize:v,btnBorderRadius:f,btnWrap:w}=t,E=_()("c-row__col",l),x=_()("smb-items__item__btn","smb-btn",{[`smb-btn--${v}`]:!!v,"smb-btn--wrap":w}),C={color:y||void 0},N={backgroundColor:k||void 0,borderRadius:void 0!==f?`${f}px`:void 0};return(0,s.createElement)("div",{className:E},(0,s.createElement)("a",{className:"smb-items__item smb-items__item--block-link",href:r,target:"_self"===m?void 0:m,rel:"_self"===m?void 0:"noopener noreferrer"},!!d&&(0,s.createElement)("div",{className:"smb-items__item__figure"},(0,s.createElement)("img",{src:d,alt:u,width:!!b&&b,height:!!g&&g,className:`wp-image-${c}`})),"none"!==a&&(0,s.createElement)(h.RichText.Content,{tagName:a,className:"smb-items__item__title",value:n}),!h.RichText.isEmpty(i)&&(0,s.createElement)("div",{className:"smb-items__item__lede"},(0,s.createElement)(h.RichText.Content,{value:i})),!h.RichText.isEmpty(o)&&(0,s.createElement)("div",{className:"smb-items__item__content"},(0,s.createElement)(h.RichText.Content,{value:o})),!h.RichText.isEmpty(p)&&!!r&&(0,s.createElement)("div",{className:"smb-items__item__action"},(0,s.createElement)("span",{className:x,style:N},(0,s.createElement)("span",{className:"smb-btn__label",style:C},(0,s.createElement)(h.RichText.Content,{value:p}))))))}},{attributes:{...S,url:{type:"string",default:""},target:{type:"string",default:"_self"}},save(e){let{attributes:t,className:l}=e;const{titleTagName:a,title:n,lede:i,summary:o,url:r,target:m,imageID:c,imageURL:d,imageAlt:u,imageWidth:b,imageHeight:g,btnLabel:p,btnBackgroundColor:k,btnTextColor:y,btnSize:v,btnBorderRadius:f,btnWrap:w}=t,E=_()("c-row__col",l),x=_()("smb-items__item__btn","smb-btn",{[`smb-btn--${v}`]:!!v,"smb-btn--wrap":w}),C={color:y||void 0},N={backgroundColor:k||void 0,borderRadius:void 0!==f?`${f}px`:void 0};return(0,s.createElement)("div",{className:E},(0,s.createElement)("div",{className:"smb-items__item smb-items__item--block-link"},!!d&&(0,s.createElement)("div",{className:"smb-items__item__figure"},(0,s.createElement)("img",{src:d,alt:u,width:!!b&&b,height:!!g&&g,className:`wp-image-${c}`})),"none"!==a&&(0,s.createElement)(h.RichText.Content,{tagName:a,className:"smb-items__item__title",value:n}),!h.RichText.isEmpty(i)&&(0,s.createElement)("div",{className:"smb-items__item__lede"},(0,s.createElement)(h.RichText.Content,{value:i})),!h.RichText.isEmpty(o)&&(0,s.createElement)("div",{className:"smb-items__item__content"},(0,s.createElement)(h.RichText.Content,{value:o})),!h.RichText.isEmpty(p)&&!!r&&(0,s.createElement)("div",{className:"smb-items__item__action"},(0,s.createElement)("a",{className:x,href:r,style:N,target:"_self"===m?void 0:m,rel:"_self"===m?void 0:"noopener noreferrer"},(0,s.createElement)("span",{className:"smb-btn__label",style:C},(0,s.createElement)(h.RichText.Content,{value:p}))))))}},{attributes:{...S,url:{type:"string",default:""},target:{type:"string",default:"_self"}},save(e){let{attributes:t,className:l}=e;const{titleTagName:a,title:n,lede:i,summary:o,btnLabel:r,url:m,target:c,btnBackgroundColor:d,btnTextColor:u,imageID:b,imageURL:g,imageAlt:p,imageWidth:k,imageHeight:y}=t,v=_()("c-row__col",l),f={color:u||void 0},w={backgroundColor:d||void 0};return(0,s.createElement)("div",{className:v},(0,s.createElement)("a",{className:"smb-items__item",href:m,target:"_self"===c?void 0:c,rel:"_self"===c?void 0:"noopener noreferrer"},!!g&&(0,s.createElement)("div",{className:"smb-items__item__figure"},(0,s.createElement)("img",{src:g,alt:p,width:!!k&&k,height:!!y&&y,className:`wp-image-${b}`})),"none"!==a&&(0,s.createElement)(h.RichText.Content,{tagName:a,className:"smb-items__item__title",value:n}),!h.RichText.isEmpty(i)&&(0,s.createElement)("div",{className:"smb-items__item__lede"},(0,s.createElement)(h.RichText.Content,{value:i})),!h.RichText.isEmpty(o)&&(0,s.createElement)("div",{className:"smb-items__item__content"},(0,s.createElement)(h.RichText.Content,{value:o})),!h.RichText.isEmpty(r)&&!!m&&(0,s.createElement)("div",{className:"smb-items__item__action"},(0,s.createElement)("span",{className:"smb-items__item__btn smb-btn",style:w},(0,s.createElement)("span",{className:"smb-btn__label",style:f},(0,s.createElement)(h.RichText.Content,{value:r}))))))}}],B={to:[{type:"block",blocks:["snow-monkey-blocks/items-item-standard"],transform:e=>(0,i.createBlock)("snow-monkey-blocks/items-item-standard",e)},{type:"block",blocks:["snow-monkey-blocks/items-banner"],transform:e=>(0,i.createBlock)("snow-monkey-blocks/items-banner",e)},{type:"block",blocks:["snow-monkey-blocks/items-item-free"],transform:e=>(0,i.createBlock)("snow-monkey-blocks/items-item-free",{},[(0,i.createBlock)("core/paragraph",{content:e.summary})])}]};const{name:L}=m,I={icon:{foreground:"#cd162c",src:c},edit:function(e){let{attributes:t,setAttributes:l,isSelected:a,className:i}=e;const{titleTagName:m,title:c,lede:u,summary:p,url:v,target:f,imageID:w,imageURL:E,imageAlt:C,imageWidth:S,imageHeight:z,imageSizeSlug:B,btnLabel:L,btnBackgroundColor:I,btnTextColor:H,btnSize:W,btnBorderRadius:M,btnWrap:P}=t,[U,O]=(0,s.useState)(!1),$=!!v,A=$&&a,{resizedImages:j}=(0,b.useSelect)((e=>{if(!w)return{resizedImages:{}};const{getMedia:t}=e("core"),l=t(w);if(!l)return{resizedImages:{}};const{getSettings:a}=e("core/block-editor"),{imageSizes:s}=a();return{resizedImages:r(s,l)}}),[w]),V=["div","h2","h3","none"],D=_()("c-row__col",i),G=_()("smb-items__item__btn","smb-btn",{[`smb-btn--${W}`]:!!W,"smb-btn--wrap":P}),F={color:H||void 0},Z={backgroundColor:I||void 0,borderRadius:void 0!==M?`${M}px`:void 0},J=(0,s.useRef)(),q=(0,h.useBlockProps)({className:D,ref:J}),K=e=>{let{url:t,opensInNewTab:a}=e;return l({url:t,target:a?"_blank":"_self"})};return(0,s.createElement)(s.Fragment,null,(0,s.createElement)(h.InspectorControls,null,(0,s.createElement)(g.PanelBody,{title:(0,o.__)("Block settings","snow-monkey-blocks")},(0,s.createElement)(g.BaseControl,{label:(0,o.__)("Title tag","snow-monkey-blocks"),id:"snow-monkey-blocks/items-item-block-link/title-tag-name"},(0,s.createElement)("div",{className:"smb-list-icon-selector"},(0,n.times)(V.length,(e=>{const t=m===V[e];return(0,s.createElement)(g.Button,{isPrimary:t,isSecondary:!t,onClick:()=>{l({titleTagName:V[e]})},key:e},V[e])})))),(0,s.createElement)(R,{label:(0,o.__)("Images size","snow-monkey-blocks"),id:w,slug:B,onChange:e=>{let t=E;j[e]&&j[e].url&&(t=j[e].url);let a=S;j[e]&&j[e].width&&(a=j[e].width);let s=z;j[e]&&j[e].height&&(s=j[e].height),l({imageURL:t,imageWidth:a,imageHeight:s,imageSizeSlug:e})}})),(0,s.createElement)(g.PanelBody,{title:(0,o.__)("Button settings","snow-monkey-blocks")},(0,s.createElement)(g.SelectControl,{label:(0,o.__)("Button size","snow-monkey-blocks"),value:W,onChange:e=>l({btnSize:e}),options:[{value:"",label:(0,o.__)("Normal size","snow-monkey-blocks")},{value:"little-wider",label:(0,o.__)("Litle wider","snow-monkey-blocks")},{value:"wider",label:(0,o.__)("Wider","snow-monkey-blocks")},{value:"more-wider",label:(0,o.__)("More wider","snow-monkey-blocks")},{value:"full",label:(0,o.__)("Full size","snow-monkey-blocks")}]}),(0,s.createElement)(g.RangeControl,{label:(0,o.__)("Border radius","snow-monkey-blocks"),value:M,onChange:e=>l({btnBorderRadius:e}),min:"0",max:"50",initialPosition:"6",allowReset:!0}),(0,s.createElement)(g.CheckboxControl,{label:(0,o.__)("Wrap","snow-monkey-blocks"),checked:P,onChange:e=>l({btnWrap:e})}),(0,s.createElement)(h.__experimentalColorGradientControl,d({label:(0,o.__)("Background color","snow-monkey-blocks"),colorValue:I,onColorChange:e=>l({btnBackgroundColor:e})},T(),{__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0})),(0,s.createElement)(h.__experimentalColorGradientControl,d({label:(0,o.__)("Text color","snow-monkey-blocks"),colorValue:H,onColorChange:e=>l({btnTextColor:e})},T(),{__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0})),(0,s.createElement)(h.ContrastChecker,{backgroundColor:I,textColor:H}))),(0,s.createElement)("div",q,(0,s.createElement)("div",{className:"smb-items__item smb-items__item--block-link"},(!!E||a)&&(0,s.createElement)("div",{className:"smb-items__item__figure"},(0,s.createElement)(x,{src:E,id:w,alt:C,onSelect:e=>{const t=e.sizes&&e.sizes[B]?e.sizes[B].url:e.url,a=e.sizes&&e.sizes[B]?e.sizes[B].width:e.width,s=e.sizes&&e.sizes[B]?e.sizes[B].height:e.height;l({imageURL:t,imageID:e.id,imageAlt:e.alt,imageWidth:a,imageHeight:s})},onSelectURL:e=>{e!==E&&l({imageURL:e,imageID:0,imageSizeSlug:"large"})},onRemove:()=>l({imageURL:"",imageAlt:"",imageWidth:"",imageHeight:"",imageID:0}),isSelected:a})),(0,s.createElement)("div",{className:"smb-items__item__body"},"none"!==m&&(0,s.createElement)(h.RichText,{tagName:m,className:"smb-items__item__title",placeholder:(0,o.__)("Write title…","snow-monkey-blocks"),value:c,onChange:e=>l({title:e})}),(!h.RichText.isEmpty(u)||a)&&(0,s.createElement)(h.RichText,{className:"smb-items__item__lede",placeholder:(0,o.__)("Write lede…","snow-monkey-blocks"),value:u,onChange:e=>l({lede:e})}),(!h.RichText.isEmpty(p)||a)&&(0,s.createElement)(h.RichText,{className:"smb-items__item__content",placeholder:(0,o.__)("Write content…","snow-monkey-blocks"),value:p,onChange:e=>l({summary:e})}),(!h.RichText.isEmpty(L)||a)&&(0,s.createElement)("div",{className:"smb-items__item__action"},(0,s.createElement)("span",{className:G,style:Z},(0,s.createElement)(h.RichText,{className:"smb-btn__label",style:F,value:L,placeholder:(0,o.__)("Button","snow-monkey-blocks"),onChange:e=>l({btnLabel:e}),withoutInteractiveFormatting:!0}),(U||A)&&(0,s.createElement)(g.Popover,{position:"bottom center",anchorRef:J.current,onClose:()=>O(!1)},(0,s.createElement)(N,{url:v,target:f,onChange:K}))))))),(0,s.createElement)(h.BlockControls,{group:"block"},!$&&(0,s.createElement)(g.ToolbarButton,{icon:k,label:(0,o.__)("Link","snow-monkey-blocks"),"aria-expanded":U,onClick:()=>O(!U)}),A&&(0,s.createElement)(g.ToolbarButton,{isPressed:!0,icon:y,label:(0,o.__)("Unlink","snow-monkey-blocks"),onClick:()=>K("")})))},save:function(e){let{attributes:t,className:l}=e;const{titleTagName:a,title:n,lede:i,summary:o,url:r,target:m,imageID:c,imageURL:d,imageAlt:u,imageWidth:b,imageHeight:g,btnLabel:p,btnBackgroundColor:k,btnTextColor:y,btnSize:v,btnBorderRadius:f,btnWrap:w}=t,E=_()("c-row__col",l),x=_()("smb-items__item__btn","smb-btn",{[`smb-btn--${v}`]:!!v,"smb-btn--wrap":w}),C={color:y||void 0},N={backgroundColor:k||void 0,borderRadius:void 0!==f?`${f}px`:void 0};return(0,s.createElement)("div",h.useBlockProps.save({className:E}),(0,s.createElement)("a",{className:"smb-items__item smb-items__item--block-link",href:r,target:"_self"===m?void 0:m,rel:"_self"===m?void 0:"noopener noreferrer"},!!d&&(0,s.createElement)("div",{className:"smb-items__item__figure"},(0,s.createElement)("img",{src:d,alt:u,width:!!b&&b,height:!!g&&g,className:`wp-image-${c}`})),(0,s.createElement)("div",{className:"smb-items__item__body"},"none"!==a&&(0,s.createElement)(h.RichText.Content,{tagName:a,className:"smb-items__item__title",value:n}),!h.RichText.isEmpty(i)&&(0,s.createElement)("div",{className:"smb-items__item__lede"},(0,s.createElement)(h.RichText.Content,{value:i})),!h.RichText.isEmpty(o)&&(0,s.createElement)("div",{className:"smb-items__item__content"},(0,s.createElement)(h.RichText.Content,{value:o})),!h.RichText.isEmpty(p)&&!!r&&(0,s.createElement)("div",{className:"smb-items__item__action"},(0,s.createElement)("span",{className:x,href:r,style:N,target:"_self"===m?void 0:m,rel:"_self"===m?void 0:"noopener noreferrer"},(0,s.createElement)("span",{className:"smb-btn__label",style:C},(0,s.createElement)(h.RichText.Content,{value:p})))))))},deprecated:z,transforms:B};(e=>{if(!e)return;const{metadata:t,settings:l,name:a}=e;t&&(t.title&&(t.title=(0,o.__)(t.title,"snow-monkey-blocks"),l.title=t.title),t.description&&(t.description=(0,o.__)(t.description,"snow-monkey-blocks"),l.description=t.description),t.keywords&&(t.keywords=(0,o.__)(t.keywords,"snow-monkey-blocks"),l.keywords=t.keywords)),(0,i.registerBlockType)({name:a,...t},l)})(a)},184:function(e,t){var l;!function(){"use strict";var a={}.hasOwnProperty;function s(){for(var e=[],t=0;t<arguments.length;t++){var l=arguments[t];if(l){var n=typeof l;if("string"===n||"number"===n)e.push(l);else if(Array.isArray(l)){if(l.length){var i=s.apply(null,l);i&&e.push(i)}}else if("object"===n)if(l.toString===Object.prototype.toString)for(var o in l)a.call(l,o)&&l[o]&&e.push(o);else e.push(l.toString())}}return e.join(" ")}e.exports?(s.default=s,e.exports=s):void 0===(l=function(){return s}.apply(t,[]))||(e.exports=l)}()}},t={};function l(a){var s=t[a];if(void 0!==s)return s.exports;var n=t[a]={exports:{}};return e[a](n,n.exports,l),n.exports}l.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return l.d(t,{a:t}),t},l.d=function(e,t){for(var a in t)l.o(t,a)&&!l.o(e,a)&&Object.defineProperty(e,a,{enumerable:!0,get:t[a]})},l.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},l.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},l(173)}();