!function(){var e={901:function(e,t,n){"use strict";var r={};function a(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}n.r(r),n.d(r,{metadata:function(){return b},name:function(){return H},settings:function(){return I}});var o=window.wp.element,i=window.lodash,l=window.wp.blocks,s=(window.wp.richText,window.wp.i18n);function c(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function m(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?c(Object(n),!0).forEach((function(t){a(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):c(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var u=function(e,t){return t?(0,i.reduce)(e,(function(e,n){var r=(0,i.get)(t,["sizes",n.slug,"url"]),o=(0,i.get)(t,["media_details","sizes",n.slug,"source_url"]),l=(0,i.get)(t,["sizes",n.slug,"width"]),s=(0,i.get)(t,["media_details","sizes",n.slug,"width"]),c=(0,i.get)(t,["sizes",n.slug,"height"]),u=(0,i.get)(t,["media_details","sizes",n.slug,"height"]);return m(m({},e),{},a({},n.slug,{url:r||o,width:l||s,height:c||u}))}),{}):{}},b=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/items--item--standard","title":"Item (Standard)","description":"It is a child block of the items block.","category":"smb","parent":["snow-monkey-blocks/items"],"attributes":{"titleTagName":{"type":"string","default":"div"},"title":{"type":"string","source":"html","selector":".smb-items__item__title","default":""},"lede":{"type":"string","source":"html","selector":".smb-items__item__lede","default":""},"summary":{"type":"string","source":"html","selector":".smb-items__item__content","default":""},"url":{"type":"string","source":"attribute","selector":".smb-items__item__action a","attribute":"href","default":""},"target":{"type":"string","source":"attribute","selector":".smb-items__item__action a","attribute":"target","default":"_self"},"imageID":{"type":"number","default":0},"imageURL":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"src","default":""},"imageAlt":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"alt","default":""},"imageWidth":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"width","default":""},"imageHeight":{"type":"string","source":"attribute","selector":".smb-items__item__figure > img","attribute":"height","default":""},"imageSizeSlug":{"type":"string","default":"large"},"btnLabel":{"type":"string","source":"html","selector":".smb-items__item__btn > .smb-btn__label","default":""},"btnBackgroundColor":{"type":"string"},"btnTextColor":{"type":"string"},"btnSize":{"type":"string","default":""},"btnBorderRadius":{"type":"number"},"btnWrap":{"type":"boolean","default":false}},"supports":{"html":false}}'),d=(0,o.createElement)("svg",{viewBox:"0 0 24 24"},(0,o.createElement)("rect",{x:"1",y:"15.5",width:"10",height:"1"}),(0,o.createElement)("rect",{x:"1",y:"17.5",width:"8",height:"1"}),(0,o.createElement)("rect",{x:"1",y:"19.5",width:"8",height:"1"}),(0,o.createElement)("path",{d:"M1,4.06v8.88a.56.56,0,0,0,.56.56h8.88a.56.56,0,0,0,.56-.56V4.06a.56.56,0,0,0-.56-.56H1.56A.56.56,0,0,0,1,4.06m8.89,8.61H2.11a.29.29,0,0,1-.28-.28V4.61a.29.29,0,0,1,.28-.28H9.89a.29.29,0,0,1,.28.28v7.78a.29.29,0,0,1-.28.28"}),(0,o.createElement)("path",{d:"M1.83,10.05,4,8.45a.15.15,0,0,1,.16,0L5.85,9.52A.13.13,0,0,0,6,9.5l2.11-2a.14.14,0,0,1,.19,0l2.21,2.15v.84L8.32,8.32a.14.14,0,0,0-.19,0L6,10.34a.13.13,0,0,1-.17,0L4.18,9.29a.14.14,0,0,0-.16,0L1.83,10.88Z"}),(0,o.createElement)("rect",{x:"1",y:"3.5",width:"10",height:"10",fill:"none"}),(0,o.createElement)("rect",{x:"13",y:"15.5",width:"10",height:"1"}),(0,o.createElement)("rect",{x:"13",y:"17.5",width:"8",height:"1"}),(0,o.createElement)("rect",{x:"13",y:"19.5",width:"8",height:"1"}),(0,o.createElement)("path",{d:"M13,4.06v8.88a.56.56,0,0,0,.56.56h8.88a.56.56,0,0,0,.56-.56V4.06a.56.56,0,0,0-.56-.56H13.56a.56.56,0,0,0-.56.56m8.89,8.61H14.11a.29.29,0,0,1-.28-.28V4.61a.29.29,0,0,1,.28-.28h7.78a.29.29,0,0,1,.28.28v7.78a.29.29,0,0,1-.28.28"}),(0,o.createElement)("path",{d:"M13.83,10.05,16,8.45a.15.15,0,0,1,.16,0l1.67,1.07a.13.13,0,0,0,.17,0l2.11-2a.14.14,0,0,1,.19,0l2.21,2.15v.84L20.32,8.32a.14.14,0,0,0-.19,0l-2.11,2a.13.13,0,0,1-.17,0L16.18,9.29a.14.14,0,0,0-.16,0l-2.19,1.59Z"}),(0,o.createElement)("rect",{x:"13",y:"3.5",width:"10",height:"10",fill:"none"}));function g(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}var _=n(184),p=n.n(_),f=window.wp.components,h=window.wp.blockEditor,y=window.wp.data,v=window.wp.primitives,w=(0,o.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,o.createElement)(v.Path,{d:"M15.6 7.2H14v1.5h1.6c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.8 0 5.2-2.3 5.2-5.2 0-2.9-2.3-5.2-5.2-5.2zM4.7 12.4c0-2 1.7-3.7 3.7-3.7H10V7.2H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H10v-1.5H8.4c-2 0-3.7-1.7-3.7-3.7zm4.6.9h5.3v-1.5H9.3v1.5z"})),k=(0,o.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,o.createElement)(v.Path,{d:"M15.6 7.3h-.7l1.6-3.5-.9-.4-3.9 8.5H9v1.5h2l-1.3 2.8H8.4c-2 0-3.7-1.7-3.7-3.7s1.7-3.7 3.7-3.7H10V7.3H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H9l-1.4 3.2.9.4 5.7-12.5h1.4c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.9 0 5.2-2.3 5.2-5.2 0-2.9-2.4-5.2-5.2-5.2z"}));function E(){return E=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},E.apply(this,arguments)}var C=function(e){var t=e.id,n=e.src,r=e.allowedTypes,a=e.accept,i=e.onSelect,l=e.onSelectURL,c=e.onRemove;return(0,o.createElement)(h.BlockControls,{group:"inline"},(0,o.createElement)(h.MediaReplaceFlow,{mediaId:t,mediaURL:n,allowedTypes:r,accept:a,onSelect:i,onSelectURL:l}),!!n&&!!c&&(0,o.createElement)(f.ToolbarItem,{as:f.Button,onClick:c},(0,s.__)("Release","snow-monkey-blocks")))},S=function(e){var t=e.src,n=e.alt,r=e.id,a=e.style;return(0,o.createElement)("img",{src:t,alt:n,className:"wp-image-".concat(r),style:a})},x=function(e){var t=e.src,n=e.style;return(0,o.createElement)("video",{controls:!0,src:t,style:n})},R=(0,o.memo)((function(e){var t,n,r=e.id,a=e.src,l=e.alt,s=e.url,c=e.target,m=e.allowedTypes,u=e.accept,b=e.onSelect,d=e.onSelectURL,g=e.onRemove,_=e.mediaType,p=e.style,f=e.rel,h=e.linkClass;return"image"===_?(t=(0,o.createElement)(S,{src:a,alt:l,id:r,style:p}),n=f?(0,i.isEmpty)(f)?void 0:f:"_self"!==c&&c?"noopener noreferrer":void 0,s&&(t=(0,o.createElement)("span",{href:s,target:"_self"===c?void 0:c,rel:n,className:h},t))):"video"===_&&(t=(0,o.createElement)(x,{src:a,style:p})),(0,o.createElement)(o.Fragment,null,(0,o.createElement)(C,{id:r,src:a,allowedTypes:m,accept:u,onSelect:b,onSelectURL:d,onRemove:g}),t)}),(function(e,t){for(var n=0,r=Object.keys(e);n<r.length;n++){var a=r[n];if(e[a]!==t[a])return!1}return!0}));function T(e){var t=e.src,n=e.onSelect,r=e.onSelectURL,a=e.mediaType,i=e.allowedTypes,l=void 0===i?["image"]:i,c=!a&&t?"image":a,m=(0,s.__)("Media","snow-monkey-blocks");1===l.length&&("image"===l[0]?m=(0,s.__)("Image","snow-monkey-blocks"):"video"===l[0]&&(m=(0,s.__)("Video","snow-monkey-blocks")));var u=(0,o.useMemo)((function(){return l.map((function(e){return"".concat(e,"/*")})).join(",")}),[l]);return t?(0,o.createElement)(R,E({},e,{accept:u,mediaType:c})):(0,o.createElement)(h.MediaPlaceholder,{icon:"format-image",labels:{title:m},onSelect:n,onSelectURL:r,accept:u,allowedTypes:l})}var N=function(e){return"_self"!==e&&("_blank"===e||void 0)};function O(e){var t=e.url,n=e.target,r=e.onChange;return(0,o.createElement)(h.__experimentalLinkControl,{className:"wp-block-navigation-link__inline-link-input",value:{url:t,opensInNewTab:N(n)},onChange:r})}function z(e){var t=e.label,n=e.id,r=e.slug,a=e.onChange;if(!n)return null;var i=(0,y.useSelect)((function(e){var t=(0,e("core").getMedia)(n);if(!t)return{options:[]};var r=(0,e("core/block-editor").getSettings)().imageSizes,a=u(r,t);return{options:r.map((function(e){return!!a[e.slug]&&{value:e.slug,label:e.name}})).filter((function(e){return e}))}})).options;return 1>i.length?null:(0,o.createElement)(f.SelectControl,{label:t,value:r,options:i,onChange:a})}function j(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function B(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?j(Object(n),!0).forEach((function(t){a(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):j(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var P=[{attributes:B(B({},b.attributes),{},{url:{type:"string",default:""},target:{type:"string",default:"_self"}}),save:function(e){var t,n=e.attributes,r=e.className,i=n.titleTagName,l=n.title,s=n.lede,c=n.summary,m=n.url,u=n.target,b=n.imageID,d=n.imageURL,g=n.imageAlt,_=n.imageWidth,f=n.imageHeight,y=n.btnLabel,v=n.btnBackgroundColor,w=n.btnTextColor,k=n.btnSize,E=n.btnBorderRadius,C=n.btnWrap,S=p()("c-row__col",r),x=p()("smb-items__item__btn","smb-btn",(a(t={},"smb-btn--".concat(k),!!k),a(t,"smb-btn--wrap",C),t)),R={color:w||void 0},T={backgroundColor:v||void 0,borderRadius:void 0!==E?"".concat(E,"px"):void 0};return(0,o.createElement)("div",h.useBlockProps.save({className:S}),(0,o.createElement)("div",{className:"smb-items__item"},!!d&&(0,o.createElement)("div",{className:"smb-items__item__figure"},(0,o.createElement)("img",{src:d,alt:g,width:!!_&&_,height:!!f&&f,className:"wp-image-".concat(b)})),"none"!==i&&(0,o.createElement)(h.RichText.Content,{tagName:i,className:"smb-items__item__title",value:l}),!h.RichText.isEmpty(s)&&(0,o.createElement)("div",{className:"smb-items__item__lede"},(0,o.createElement)(h.RichText.Content,{value:s})),!h.RichText.isEmpty(c)&&(0,o.createElement)("div",{className:"smb-items__item__content"},(0,o.createElement)(h.RichText.Content,{value:c})),!h.RichText.isEmpty(y)&&!!m&&(0,o.createElement)("div",{className:"smb-items__item__action"},(0,o.createElement)("a",{className:x,href:m,style:T,target:"_self"===u?void 0:u,rel:"_self"===u?void 0:"noopener noreferrer"},(0,o.createElement)("span",{className:"smb-btn__label",style:R},(0,o.createElement)(h.RichText.Content,{value:y}))))))}}],L={to:[{type:"block",blocks:["snow-monkey-blocks/items--item--block-link"],transform:function(e){return(0,l.createBlock)("snow-monkey-blocks/items--item--block-link",e)}},{type:"block",blocks:["snow-monkey-blocks/items--banner"],transform:function(e){return(0,l.createBlock)("snow-monkey-blocks/items--banner",e)}},{type:"block",blocks:["snow-monkey-blocks/items--item--free"],transform:function(e){return(0,l.createBlock)("snow-monkey-blocks/items--item--free",{},[(0,l.createBlock)("core/paragraph",{content:e.summary})])}}]},H=b.name,I={icon:{foreground:"#cd162c",src:d},edit:function(e){var t,n,r,l=e.attributes,c=e.setAttributes,m=e.isSelected,b=e.className,d=l.titleTagName,_=l.title,v=l.lede,E=l.summary,C=l.url,S=l.target,x=l.imageID,R=l.imageURL,N=l.imageAlt,j=l.imageWidth,B=l.imageHeight,P=l.imageSizeSlug,L=l.btnLabel,H=l.btnBackgroundColor,I=l.btnTextColor,M=l.btnSize,U=l.btnBorderRadius,A=l.btnWrap,W=(n=(0,o.useState)(!1),r=2,function(e){if(Array.isArray(e))return e}(n)||function(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var r,a,o=[],_n=!0,i=!1;try{for(n=n.call(e);!(_n=(r=n.next()).done)&&(o.push(r.value),!t||o.length!==t);_n=!0);}catch(e){i=!0,a=e}finally{try{_n||null==n.return||n.return()}finally{if(i)throw a}}return o}}(n,r)||function(e,t){if(e){if("string"==typeof e)return g(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?g(e,t):void 0}}(n,r)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()),D=W[0],V=W[1],F=!!C,G=F&&m,Z=(0,y.useSelect)((function(e){if(!x)return{resizedImages:{}};var t=(0,e("core").getMedia)(x);if(!t)return{resizedImages:{}};var n=(0,e("core/block-editor").getSettings)().imageSizes;return{resizedImages:u(n,t)}}),[x]).resizedImages,J=["div","h2","h3","none"],$=p()("c-row__col",b),q=p()("smb-items__item__btn","smb-btn",(a(t={},"smb-btn--".concat(M),!!M),a(t,"smb-btn--wrap",A),t)),K={color:I||void 0},Q={backgroundColor:H||void 0,borderRadius:void 0!==U?"".concat(U,"px"):void 0},X=(0,o.useRef)(),Y=(0,h.useBlockProps)({className:$,ref:X}),ee=function(e){var t=e.url,n=e.opensInNewTab;return c({url:t,target:n?"_blank":"_self"})};return(0,o.createElement)(o.Fragment,null,(0,o.createElement)(h.InspectorControls,null,(0,o.createElement)(f.PanelBody,{title:(0,s.__)("Block Settings","snow-monkey-blocks")},(0,o.createElement)(f.BaseControl,{label:(0,s.__)("Title Tag","snow-monkey-blocks"),id:"snow-monkey-blocks/items--item--standard/title-tag-name"},(0,o.createElement)("div",{className:"smb-list-icon-selector"},(0,i.times)(J.length,(function(e){var t=d===J[e];return(0,o.createElement)(f.Button,{isPrimary:t,isSecondary:!t,onClick:function(){return c({titleTagName:J[e]})},key:e},J[e])})))),(0,o.createElement)(z,{label:(0,s.__)("Images size","snow-monkey-blocks"),id:x,slug:P,onChange:function(e){var t=R;Z[e]&&Z[e].url&&(t=Z[e].url);var n=j;Z[e]&&Z[e].width&&(n=Z[e].width);var r=B;Z[e]&&Z[e].height&&(r=Z[e].height),c({imageURL:t,imageWidth:n,imageHeight:r,imageSizeSlug:e})}})),(0,o.createElement)(f.PanelBody,{title:(0,s.__)("Button Settings","snow-monkey-blocks")},(0,o.createElement)(f.SelectControl,{label:(0,s.__)("Button size","snow-monkey-blocks"),value:M,onChange:function(e){return c({btnSize:e})},options:[{value:"",label:(0,s.__)("Normal size","snow-monkey-blocks")},{value:"little-wider",label:(0,s.__)("Litle wider","snow-monkey-blocks")},{value:"wider",label:(0,s.__)("Wider","snow-monkey-blocks")},{value:"more-wider",label:(0,s.__)("More wider","snow-monkey-blocks")},{value:"full",label:(0,s.__)("Full size","snow-monkey-blocks")}]}),(0,o.createElement)(f.RangeControl,{label:(0,s.__)("Border radius","snow-monkey-blocks"),value:U,onChange:function(e){return c({btnBorderRadius:e})},min:"0",max:"50",initialPosition:"6",allowReset:!0}),(0,o.createElement)(f.CheckboxControl,{label:(0,s.__)("Wrap","snow-monkey-blocks"),checked:A,onChange:function(e){return c({btnWrap:e})}}),(0,o.createElement)(h.__experimentalColorGradientControl,{label:(0,s.__)("Background Color","snow-monkey-blocks"),colorValue:H,onColorChange:function(e){return c({btnBackgroundColor:e})}}),(0,o.createElement)(h.__experimentalColorGradientControl,{label:(0,s.__)("Text Color","snow-monkey-blocks"),colorValue:I,onColorChange:function(e){return c({btnTextColor:e})}}),(0,o.createElement)(h.ContrastChecker,{backgroundColor:H,textColor:I}))),(0,o.createElement)("div",Y,(0,o.createElement)("div",{className:"smb-items__item"},(!!R||m)&&(0,o.createElement)("div",{className:"smb-items__item__figure"},(0,o.createElement)(T,{src:R,id:x,alt:N,onSelect:function(e){var t=e.sizes&&e.sizes[P]?e.sizes[P].url:e.url,n=e.sizes&&e.sizes[P]?e.sizes[P].width:e.width,r=e.sizes&&e.sizes[P]?e.sizes[P].height:e.height;c({imageURL:t,imageID:e.id,imageAlt:e.alt,imageWidth:n,imageHeight:r})},onSelectURL:function(e){e!==R&&c({imageURL:e,imageID:0,imageSizeSlug:"large"})},onRemove:function(){return c({imageURL:"",imageAlt:"",imageWidth:"",imageHeight:"",imageID:0})},isSelected:m})),(0,o.createElement)("div",{className:"smb-items__item__body"},"none"!==d&&(0,o.createElement)(h.RichText,{tagName:d,className:"smb-items__item__title",placeholder:(0,s.__)("Write title…","snow-monkey-blocks"),value:_,onChange:function(e){return c({title:e})}}),(!h.RichText.isEmpty(v)||m)&&(0,o.createElement)(h.RichText,{className:"smb-items__item__lede",placeholder:(0,s.__)("Write lede…","snow-monkey-blocks"),value:v,onChange:function(e){return c({lede:e})}}),(!h.RichText.isEmpty(E)||m)&&(0,o.createElement)(h.RichText,{className:"smb-items__item__content",placeholder:(0,s.__)("Write content…","snow-monkey-blocks"),value:E,onChange:function(e){return c({summary:e})}}),(!h.RichText.isEmpty(L)||m)&&(0,o.createElement)("div",{className:"smb-items__item__action"},(0,o.createElement)("span",{className:q,href:C,style:Q,target:"_self"===S?void 0:S,rel:"_self"===S?void 0:"noopener noreferrer"},(0,o.createElement)(h.RichText,{className:"smb-btn__label",style:K,value:L,placeholder:(0,s.__)("Button","snow-monkey-blocks"),onChange:function(e){return c({btnLabel:e})},withoutInteractiveFormatting:!0})),(D||G)&&(0,o.createElement)(f.Popover,{position:"bottom center",anchorRef:X.current,onClose:function(){return V(!1)}},(0,o.createElement)(O,{url:C,target:S,onChange:ee})))))),(0,o.createElement)(h.BlockControls,{group:"block"},!F&&(0,o.createElement)(f.ToolbarButton,{icon:w,label:(0,s.__)("Link","snow-monkey-blocks"),"aria-expanded":D,onClick:function(){return V(!D)}}),G&&(0,o.createElement)(f.ToolbarButton,{isPressed:!0,icon:k,label:(0,s.__)("Unlink","snow-monkey-blocks"),onClick:function(){return ee("")}})))},save:function(e){var t,n=e.attributes,r=e.className,i=n.titleTagName,l=n.title,s=n.lede,c=n.summary,m=n.url,u=n.target,b=n.imageID,d=n.imageURL,g=n.imageAlt,_=n.imageWidth,f=n.imageHeight,y=n.btnLabel,v=n.btnBackgroundColor,w=n.btnTextColor,k=n.btnSize,E=n.btnBorderRadius,C=n.btnWrap,S=p()("c-row__col",r),x=p()("smb-items__item__btn","smb-btn",(a(t={},"smb-btn--".concat(k),!!k),a(t,"smb-btn--wrap",C),t)),R={color:w||void 0},T={backgroundColor:v||void 0,borderRadius:void 0!==E?"".concat(E,"px"):void 0};return(0,o.createElement)("div",h.useBlockProps.save({className:S}),(0,o.createElement)("div",{className:"smb-items__item"},!!d&&(0,o.createElement)("div",{className:"smb-items__item__figure"},(0,o.createElement)("img",{src:d,alt:g,width:!!_&&_,height:!!f&&f,className:"wp-image-".concat(b)})),(0,o.createElement)("div",{className:"smb-items__item__body"},"none"!==i&&(0,o.createElement)(h.RichText.Content,{tagName:i,className:"smb-items__item__title",value:l}),!h.RichText.isEmpty(s)&&(0,o.createElement)("div",{className:"smb-items__item__lede"},(0,o.createElement)(h.RichText.Content,{value:s})),!h.RichText.isEmpty(c)&&(0,o.createElement)("div",{className:"smb-items__item__content"},(0,o.createElement)(h.RichText.Content,{value:c})),!h.RichText.isEmpty(y)&&!!m&&(0,o.createElement)("div",{className:"smb-items__item__action"},(0,o.createElement)("a",{className:x,href:m,style:T,target:"_self"===u?void 0:u,rel:"_self"===u?void 0:"noopener noreferrer"},(0,o.createElement)("span",{className:"smb-btn__label",style:R},(0,o.createElement)(h.RichText.Content,{value:y})))))))},deprecated:P,transforms:L};!function(e){if(e){var t=e.metadata,n=e.settings,r=e.name;t&&(t.title&&(t.title=(0,s.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,s.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,s.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,l.registerBlockType)(m({name:r},t),n)}}(r)},184:function(e,t){var n;!function(){"use strict";var r={}.hasOwnProperty;function a(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var o=typeof n;if("string"===o||"number"===o)e.push(n);else if(Array.isArray(n)){if(n.length){var i=a.apply(null,n);i&&e.push(i)}}else if("object"===o)if(n.toString===Object.prototype.toString)for(var l in n)r.call(n,l)&&n[l]&&e.push(l);else e.push(n.toString())}}return e.join(" ")}e.exports?(a.default=a,e.exports=a):void 0===(n=function(){return a}.apply(t,[]))||(e.exports=n)}()}},t={};function n(r){var a=t[r];if(void 0!==a)return a.exports;var o=t[r]={exports:{}};return e[r](o,o.exports,n),o.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var r in t)n.o(t,r)&&!n.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(901)}();