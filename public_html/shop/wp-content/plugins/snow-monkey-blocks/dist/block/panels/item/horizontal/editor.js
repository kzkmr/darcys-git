!function(){var e={184:function(e,t){var a;!function(){"use strict";var l={}.hasOwnProperty;function n(){for(var e=[],t=0;t<arguments.length;t++){var a=arguments[t];if(a){var i=typeof a;if("string"===i||"number"===i)e.push(a);else if(Array.isArray(a)){if(a.length){var s=n.apply(null,a);s&&e.push(s)}}else if("object"===i)if(a.toString===Object.prototype.toString)for(var r in a)l.call(a,r)&&a[r]&&e.push(r);else e.push(a.toString())}}return e.join(" ")}e.exports?(n.default=n,e.exports=n):void 0===(a=function(){return n}.apply(t,[]))||(e.exports=a)}()}},t={};function a(l){var n=t[l];if(void 0!==n)return n.exports;var i=t[l]={exports:{}};return e[l](i,i.exports,a),i.exports}a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,{a:t}),t},a.d=function(e,t){for(var l in t)a.o(t,l)&&!a.o(e,l)&&Object.defineProperty(e,l,{enumerable:!0,get:t[l]})},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){"use strict";var e={};a.r(e),a.d(e,{metadata:function(){return m},name:function(){return U},settings:function(){return H}});var t=window.wp.element,l=window.lodash,n=window.wp.blocks,i=(window.wp.richText,window.wp.i18n);const s=(e,t)=>t?(0,l.reduce)(e,((e,a)=>{const n=(0,l.get)(t,["sizes",a.slug,"url"]),i=(0,l.get)(t,["media_details","sizes",a.slug,"source_url"]),s=(0,l.get)(t,["sizes",a.slug,"width"]),r=(0,l.get)(t,["media_details","sizes",a.slug,"width"]),m=(0,l.get)(t,["sizes",a.slug,"height"]),o=(0,l.get)(t,["media_details","sizes",a.slug,"height"]);return{...e,[a.slug]:{url:n||i,width:s||r,height:m||o}}}),{}):{},r=e=>{const t=document.createElement("div");return t.style.display="none",t.innerHTML=e,t.innerText};var m=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/panels-item-horizontal","title":"Panel (Horizontal layout)","description":"It is a child block of the panels block.","category":"smb","parent":["snow-monkey-blocks/panels"],"attributes":{"titleTagName":{"type":"string","default":"div"},"title":{"type":"string","source":"html","selector":".smb-panels__item__title","default":""},"summary":{"type":"string","source":"html","selector":".smb-panels__item__content","default":""},"linkLabel":{"type":"string","source":"text","selector":".smb-panels__item__link","default":""},"linkURL":{"type":"string","source":"attribute","selector":".smb-panels__item__action > a","attribute":"href","default":""},"linkTarget":{"type":"string","source":"attribute","selector":".smb-panels__item__action > a","attribute":"target","default":"_self"},"imagePosition":{"type":"string","default":"right"},"imageID":{"type":"number","default":0},"imageURL":{"type":"string","source":"attribute","selector":".smb-panels__item__figure > img","attribute":"src","default":""},"imageAlt":{"type":"string","source":"attribute","selector":".smb-panels__item__figure > img","attribute":"alt","default":""},"imageWidth":{"type":"string","source":"attribute","selector":".smb-panels__item__figure > img","attribute":"width","default":""},"imageHeight":{"type":"string","source":"attribute","selector":".smb-panels__item__figure > img","attribute":"height","default":""},"imageSizeSlug":{"type":"string","default":"large"}},"supports":{"html":false},"editorScript":"file:../../../../dist/block/panels/item/horizontal/editor.js"}'),o=(0,t.createElement)("svg",{viewBox:"0 0 24 24"},(0,t.createElement)("path",{d:"M3,3v8h8V3Zm7,7H4V4h6Z"}),(0,t.createElement)("path",{d:"M13,3v8h8V3Zm7,7H14V4h6Z"}),(0,t.createElement)("path",{d:"M3,13v8h8V13Zm7,7H4V14h6Z"}),(0,t.createElement)("path",{d:"M13,13v8h8V13Zm7,7H14V14h6Z"})),c=a(184),_=a.n(c),g=window.wp.blockEditor,u=window.wp.components,p=window.wp.data,d=window.wp.primitives,b=(0,t.createElement)(d.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(d.Path,{d:"M4 18h6V6H4v12zm9-9.5V10h7V8.5h-7zm0 7h7V14h-7v1.5z"})),h=(0,t.createElement)(d.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(d.Path,{d:"M14 6v12h6V6h-6zM4 10h7V8.5H4V10zm0 5.5h7V14H4v1.5z"})),v=(0,t.createElement)(d.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(d.Path,{d:"M15.6 7.2H14v1.5h1.6c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.8 0 5.2-2.3 5.2-5.2 0-2.9-2.3-5.2-5.2-5.2zM4.7 12.4c0-2 1.7-3.7 3.7-3.7H10V7.2H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H10v-1.5H8.4c-2 0-3.7-1.7-3.7-3.7zm4.6.9h5.3v-1.5H9.3v1.5z"})),k=(0,t.createElement)(d.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(d.Path,{d:"M15.6 7.3h-.7l1.6-3.5-.9-.4-3.9 8.5H9v1.5h2l-1.3 2.8H8.4c-2 0-3.7-1.7-3.7-3.7s1.7-3.7 3.7-3.7H10V7.3H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H9l-1.4 3.2.9.4 5.7-12.5h1.4c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.9 0 5.2-2.3 5.2-5.2 0-2.9-2.4-5.2-5.2-5.2z"}));function E(){return E=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var a=arguments[t];for(var l in a)Object.prototype.hasOwnProperty.call(a,l)&&(e[l]=a[l])}return e},E.apply(this,arguments)}const y=e=>{let{id:a,src:l,allowedTypes:n,accept:s,onSelect:r,onSelectURL:m,onRemove:o}=e;return(0,t.createElement)(g.BlockControls,{group:"inline"},(0,t.createElement)(g.MediaReplaceFlow,{mediaId:a,mediaURL:l,allowedTypes:n,accept:s,onSelect:r,onSelectURL:m}),!!l&&!!o&&(0,t.createElement)(u.ToolbarItem,{as:u.Button,onClick:o},(0,i.__)("Release","snow-monkey-blocks")))},f=e=>{let{src:a,alt:l,id:n,style:i}=e;return(0,t.createElement)("img",{src:a,alt:l,className:`wp-image-${n}`,style:i})},w=e=>{let{src:a,style:l}=e;return(0,t.createElement)("video",{controls:!0,src:a,style:l})},T=(0,t.memo)((e=>{let a,{id:n,src:i,alt:s,url:r,target:m,allowedTypes:o,accept:c,onSelect:_,onSelectURL:g,onRemove:u,mediaType:p,style:d,rel:b,linkClass:h}=e;if("image"===p){let e;a=(0,t.createElement)(f,{src:i,alt:s,id:n,style:d}),e=b?(0,l.isEmpty)(b)?void 0:b:"_self"!==m&&m?"noopener noreferrer":void 0,r&&(a=(0,t.createElement)("span",{href:r,target:"_self"===m?void 0:m,rel:e,className:h},a))}else"video"===p&&(a=(0,t.createElement)(w,{src:i,style:d}));return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(y,{id:n,src:i,allowedTypes:o,accept:c,onSelect:_,onSelectURL:g,onRemove:u}),a)}),((e,t)=>{const a=Object.keys(e);for(const l of a)if(e[l]!==t[l])return!1;return!0}));function N(e){const{src:a,onSelect:l,onSelectURL:n,mediaType:s,allowedTypes:r=["image"]}=e,m=!s&&a?"image":s;let o=(0,i.__)("Media","snow-monkey-blocks");1===r.length&&("image"===r[0]?o=(0,i.__)("Image","snow-monkey-blocks"):"video"===r[0]&&(o=(0,i.__)("Video","snow-monkey-blocks")));const c=(0,t.useMemo)((()=>r.map((e=>`${e}/*`)).join(",")),[r]);return a?(0,t.createElement)(T,E({},e,{accept:c,allowedTypes:r,mediaType:m})):(0,t.createElement)(g.MediaPlaceholder,{icon:"format-image",labels:{title:o},onSelect:l,onSelectURL:n,accept:c,allowedTypes:r})}const R=e=>"_self"!==e&&("_blank"===e||void 0);function x(e){const{url:a,target:l,onChange:n}=e;return(0,t.createElement)(g.__experimentalLinkControl,{className:"wp-block-navigation-link__inline-link-input",value:{url:a,opensInNewTab:R(l)},onChange:n})}function z(e){const{label:a,id:l,slug:n,onChange:i}=e;if(!l)return null;const{options:r}=(0,p.useSelect)((e=>{const{getMedia:t}=e("core"),a=t(l);if(!a)return{options:[]};const{getSettings:n}=e("core/block-editor"),{imageSizes:i}=n(),r=s(i,a);return{options:i.map((e=>!!r[e.slug]&&{value:e.slug,label:e.name})).filter((e=>e))}}));return 1>r.length?null:(0,t.createElement)(u.SelectControl,{label:a,value:n,options:r,onChange:i})}const S=m.attributes;var L=[{attributes:{...S,linkTarget:{type:"string",default:"_self"}},save(e){let{attributes:a,className:l}=e;const{titleTagName:n,title:i,summary:s,linkLabel:r,linkURL:m,linkTarget:o,imagePosition:c,imageID:u,imageURL:p,imageAlt:d}=a,b=_()("c-row__col",l),h=_()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===c});return(0,t.createElement)("div",{className:b},(0,t.createElement)("div",{className:h},!!p&&(0,t.createElement)("div",{className:"smb-panels__item__figure"},(0,t.createElement)("img",{src:p,alt:d,className:`wp-image-${u}`})),(0,t.createElement)("div",{className:"smb-panels__item__body"},!g.RichText.isEmpty(i)&&"none"!==n&&(0,t.createElement)(g.RichText.Content,{tagName:n,className:"smb-panels__item__title",value:i}),!g.RichText.isEmpty(s)&&(0,t.createElement)("div",{className:"smb-panels__item__content"},(0,t.createElement)(g.RichText.Content,{value:s})),!g.RichText.isEmpty(r)&&(0,t.createElement)("div",{className:"smb-panels__item__action"},m?(0,t.createElement)("a",{href:m,target:"_self"===o?void 0:o,rel:"_self"===o?void 0:"noopener noreferrer"},(0,t.createElement)("div",{className:"smb-panels__item__link"},(0,t.createElement)(g.RichText.Content,{value:r}))):(0,t.createElement)("div",{className:"smb-panels__item__link"},(0,t.createElement)(g.RichText.Content,{value:r}))))))}},{attributes:{...S,linkURL:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"href",default:""},linkTarget:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"target",default:"_self"}},save(e){let{attributes:a,className:l}=e;const{titleTagName:n,title:i,summary:s,linkLabel:r,linkURL:m,linkTarget:o,imagePosition:c,imageID:u,imageURL:p,imageAlt:d}=a,b=(0,t.createElement)(t.Fragment,null,!!p&&(0,t.createElement)("div",{className:"smb-panels__item__figure"},(0,t.createElement)("img",{src:p,alt:d,className:`wp-image-${u}`})),(0,t.createElement)("div",{className:"smb-panels__item__body"},!g.RichText.isEmpty(i)&&"none"!==n&&(0,t.createElement)(g.RichText.Content,{tagName:n,className:"smb-panels__item__title",value:i}),!g.RichText.isEmpty(s)&&(0,t.createElement)("div",{className:"smb-panels__item__content"},(0,t.createElement)(g.RichText.Content,{value:s})),!g.RichText.isEmpty(r)&&(0,t.createElement)("div",{className:"smb-panels__item__action"},(0,t.createElement)("div",{className:"smb-panels__item__link"},(0,t.createElement)(g.RichText.Content,{value:r}))))),h=_()("c-row__col",l),v=_()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===c});return(0,t.createElement)("div",{className:h},m?(0,t.createElement)("a",{className:v,href:m,target:"_self"===o?void 0:o,rel:"_self"===o?void 0:"noopener noreferrer"},b):(0,t.createElement)("div",{className:v},b))}},{attributes:{...S,linkURL:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"href",default:""},linkTarget:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"target",default:"_self"}},save(e){let{attributes:a}=e;const{titleTagName:l,title:n,summary:i,linkLabel:s,linkURL:r,linkTarget:m,imagePosition:o,imageID:c,imageURL:u}=a,p=()=>(0,t.createElement)(t.Fragment,null,!!c&&(0,t.createElement)("div",{className:"smb-panels__item__figure"},(0,t.createElement)("img",{src:u,alt:"",className:`wp-image-${c}`})),(0,t.createElement)("div",{className:"smb-panels__item__body"},!g.RichText.isEmpty(n)&&(0,t.createElement)(g.RichText.Content,{tagName:l,className:"smb-panels__item__title",value:n}),!g.RichText.isEmpty(i)&&(0,t.createElement)("div",{className:"smb-panels__item__content"},(0,t.createElement)(g.RichText.Content,{value:i})),!g.RichText.isEmpty(s)&&(0,t.createElement)("div",{className:"smb-panels__item__action"},(0,t.createElement)("div",{className:"smb-panels__item__link"},(0,t.createElement)(g.RichText.Content,{value:s})))));return(0,t.createElement)("div",{className:"c-row__col"},(0,t.createElement)((()=>r?(0,t.createElement)("a",{className:_()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===o}),href:r,target:"_self"===m?void 0:m,rel:"_self"===m?void 0:"noopener noreferrer"},(0,t.createElement)(p,null)):(0,t.createElement)("div",{className:_()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===o})},(0,t.createElement)(p,null))),null))}},{attributes:{...S,linkURL:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"href",default:""},linkTarget:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"target",default:"_self"}},save(e){let{attributes:a}=e;const{titleTagName:l,title:n,summary:i,linkLabel:s,linkURL:r,linkTarget:m,imagePosition:o,imageID:c,imageURL:u}=a;return(0,t.createElement)("div",{className:"c-row__col"},(p=(0,t.createElement)(t.Fragment,null,!!c&&(0,t.createElement)("div",{className:"smb-panels__item__figure"},(0,t.createElement)("img",{src:u,alt:"",className:`wp-image-${c}`})),(0,t.createElement)("div",{className:"smb-panels__item__body"},!g.RichText.isEmpty(n)&&(0,t.createElement)(g.RichText.Content,{tagName:l,className:"smb-panels__item__title",value:n}),!g.RichText.isEmpty(i)&&(0,t.createElement)("div",{className:"smb-panels__item__content"},(0,t.createElement)(g.RichText.Content,{value:i})),!g.RichText.isEmpty(s)&&(0,t.createElement)("div",{className:"smb-panels__item__action"},(0,t.createElement)("div",{className:"smb-panels__item__link"},(0,t.createElement)(g.RichText.Content,{value:s}))))),r?(0,t.createElement)("a",{className:_()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===o}),href:r,target:m},p):(0,t.createElement)("div",{className:_()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===o}),href:r,target:m},p)));var p}}],C={to:[{type:"block",blocks:["snow-monkey-blocks/panels-item"],transform:e=>(0,n.createBlock)("snow-monkey-blocks/panels-item",e)},{type:"block",blocks:["snow-monkey-blocks/panels-item-free"],transform:e=>(0,n.createBlock)("snow-monkey-blocks/panels-item-free",{},[(0,n.createBlock)("core/paragraph",{content:e.summary})])},{type:"block",blocks:["snow-monkey-blocks/panels-item-block-link"],transform:e=>(0,n.createBlock)("snow-monkey-blocks/panels-item-block-link",{linkURL:e.linkURL,linkTarget:e.linkTarget},[(0,n.createBlock)("core/paragraph",{content:e.summary})])}]};const{name:U}=m,H={icon:{foreground:"#cd162c",src:o},edit:function(e){let{attributes:a,setAttributes:n,isSelected:m,className:o}=e;const{titleTagName:c,title:d,summary:E,linkLabel:y,linkURL:f,linkTarget:w,imagePosition:T,imageID:R,imageURL:S,imageAlt:L,imageWidth:C,imageHeight:U,imageSizeSlug:H}=a,[P,B]=(0,t.useState)(!1),V=!!f,I=V&&m,{resizedImages:M}=(0,p.useSelect)((e=>{if(!R)return{resizedImages:{}};const{getMedia:t}=e("core"),a=t(R);if(!a)return{resizedImages:{}};const{getSettings:l}=e("core/block-editor"),{imageSizes:n}=l();return{resizedImages:s(n,a)}}),[R]),j=["div","h2","h3","none"],A=_()("c-row__col",o),O=_()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===T}),D=_()("smb-panels__item__action",{"smb-panels__item__action--nolabel":!y&&!m}),W=(0,t.useRef)(),Z=(0,g.useBlockProps)({className:A,ref:W}),F=e=>{let{url:t,opensInNewTab:a}=e;return n({linkURL:t,linkTarget:a?"_blank":"_self"})};return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(g.InspectorControls,null,(0,t.createElement)(u.PanelBody,{title:(0,i.__)("Block settings","snow-monkey-blocks")},(0,t.createElement)(u.BaseControl,{label:(0,i.__)("Title tag","snow-monkey-blocks"),id:"snow-monkey-blocks/panels-item-horizontal/title-tag-name"},(0,t.createElement)("div",{className:"smb-list-icon-selector"},(0,l.times)(j.length,(e=>{const a=c===j[e];return(0,t.createElement)(u.Button,{isPrimary:a,isSecondary:!a,onClick:()=>n({titleTagName:j[e]}),key:e},j[e])})))),(0,t.createElement)(z,{label:(0,i.__)("Images size","snow-monkey-blocks"),id:R,slug:H,onChange:e=>{let t=S;M[e]&&M[e].url&&(t=M[e].url);let a=C;M[e]&&M[e].width&&(a=M[e].width);let l=U;M[e]&&M[e].height&&(l=M[e].height),n({imageURL:t,imageWidth:a,imageHeight:l,imageSizeSlug:e})}}))),(0,t.createElement)(g.BlockControls,{gruop:"block"},(0,t.createElement)(u.ToolbarGroup,null,(0,t.createElement)(u.ToolbarButton,{icon:b,title:(0,i.__)("Image position","snow-monkey-blocks"),isActive:"left"===T,onClick:()=>n({imagePosition:"left"})}),(0,t.createElement)(u.ToolbarButton,{icon:h,title:(0,i.__)("Show avatar on right","snow-monkey-blocks"),isActive:"right"===T,onClick:()=>n({imagePosition:"right"})}))),(0,t.createElement)("div",Z,(0,t.createElement)("div",{className:O},(!!S||m)&&(0,t.createElement)("div",{className:"smb-panels__item__figure"},(0,t.createElement)(N,{src:S,id:R,alt:L,onSelect:e=>{const t=e.sizes&&e.sizes[H]?e.sizes[H].url:e.url,a=e.sizes&&e.sizes[H]?e.sizes[H].width:e.width,l=e.sizes&&e.sizes[H]?e.sizes[H].height:e.height;n({imageURL:t,imageID:e.id,imageAlt:e.alt,imageWidth:a,imageHeight:l})},onSelectURL:e=>{e!==S&&n({imageURL:e,imageID:0,imageSizeSlug:"large"})},onRemove:()=>n({imageURL:"",imageAlt:"",imageWidth:"",imageHeight:"",imageID:0}),isSelected:m})),(0,t.createElement)("div",{className:"smb-panels__item__body"},(!g.RichText.isEmpty(d)||m)&&"none"!==c&&(0,t.createElement)(g.RichText,{tagName:c,className:"smb-panels__item__title",placeholder:(0,i.__)("Write title…","snow-monkey-blocks"),value:d,onChange:e=>n({title:e})}),(!g.RichText.isEmpty(E)||m)&&(0,t.createElement)(g.RichText,{className:"smb-panels__item__content",placeholder:(0,i.__)("Write content…","snow-monkey-blocks"),value:E,onChange:e=>n({summary:e})}),(!g.RichText.isEmpty(y)||!!f||m)&&(0,t.createElement)("div",{className:D},(!g.RichText.isEmpty(y)||m)&&(0,t.createElement)(g.RichText,{className:"smb-panels__item__link",value:y,placeholder:(0,i.__)("Link","snow-monkey-blocks"),onChange:e=>n({linkLabel:r(e)})})),(P||I)&&(0,t.createElement)(u.Popover,{position:"bottom center",anchorRef:W.current,onClose:()=>B(!1)},(0,t.createElement)(x,{url:f,target:w,onChange:F}))))),(0,t.createElement)(g.BlockControls,{group:"block"},!V&&(0,t.createElement)(u.ToolbarButton,{icon:v,label:(0,i.__)("Link","snow-monkey-blocks"),"aria-expanded":P,onClick:()=>B(!P)}),I&&(0,t.createElement)(u.ToolbarButton,{isPressed:!0,icon:k,label:(0,i.__)("Unlink","snow-monkey-blocks"),onClick:()=>F("")})))},save:function(e){let{attributes:a,className:l}=e;const{titleTagName:n,title:i,summary:s,linkLabel:r,linkURL:m,linkTarget:o,imagePosition:c,imageID:u,imageURL:p,imageAlt:d,imageWidth:b,imageHeight:h}=a,v=_()("c-row__col",l),k=_()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===c}),E=_()("smb-panels__item__action",{"smb-panels__item__action--nolabel":!r}),y=!g.RichText.isEmpty(r)&&(0,t.createElement)("div",{className:"smb-panels__item__link"},(0,t.createElement)(g.RichText.Content,{value:r}));return(0,t.createElement)("div",g.useBlockProps.save({className:v}),(0,t.createElement)("div",{className:k},!!p&&(0,t.createElement)("div",{className:"smb-panels__item__figure"},(0,t.createElement)("img",{src:p,alt:d,width:!!b&&b,height:!!h&&h,className:`wp-image-${u}`})),(0,t.createElement)("div",{className:"smb-panels__item__body"},!g.RichText.isEmpty(i)&&"none"!==n&&(0,t.createElement)(g.RichText.Content,{tagName:n,className:"smb-panels__item__title",value:i}),!g.RichText.isEmpty(s)&&(0,t.createElement)("div",{className:"smb-panels__item__content"},(0,t.createElement)(g.RichText.Content,{value:s})),(!g.RichText.isEmpty(r)||!!m)&&(0,t.createElement)("div",{className:E},m?(0,t.createElement)("a",{href:m,target:"_self"===o?void 0:o,rel:"_self"===o?void 0:"noopener noreferrer"},y):(0,t.createElement)(t.Fragment,null,y)))))},deprecated:L,transforms:C};(e=>{if(!e)return;const{metadata:t,settings:a,name:l}=e;t&&(t.title&&(t.title=(0,i.__)(t.title,"snow-monkey-blocks"),a.title=t.title),t.description&&(t.description=(0,i.__)(t.description,"snow-monkey-blocks"),a.description=t.description),t.keywords&&(t.keywords=(0,i.__)(t.keywords,"snow-monkey-blocks"),a.keywords=t.keywords)),(0,n.registerBlockType)({name:l,...t},a)})(e)}()}();