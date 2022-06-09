!function(){var e={184:function(e,t){var n;!function(){"use strict";var o={}.hasOwnProperty;function l(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var r=typeof n;if("string"===r||"number"===r)e.push(n);else if(Array.isArray(n)){if(n.length){var a=l.apply(null,n);a&&e.push(a)}}else if("object"===r)if(n.toString===Object.prototype.toString)for(var s in n)o.call(n,s)&&n[s]&&e.push(s);else e.push(n.toString())}}return e.join(" ")}e.exports?(l.default=l,e.exports=l):void 0===(n=function(){return l}.apply(t,[]))||(e.exports=n)}()}},t={};function n(o){var l=t[o];if(void 0!==l)return l.exports;var r=t[o]={exports:{}};return e[o](r,r.exports,n),r.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var o in t)n.o(t,o)&&!n.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){"use strict";var e={};n.r(e),n.d(e,{metadata:function(){return r},name:function(){return y},settings:function(){return f}});var t=window.wp.element,o=(window.lodash,window.wp.blocks),l=(window.wp.richText,window.wp.i18n),r=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/btn-box","title":"Button box","description":"It is a button with micro copy.","category":"smb","attributes":{"lede":{"type":"string","source":"html","selector":".smb-btn-box__lede","default":""},"note":{"type":"string","source":"html","selector":".smb-btn-box__note","default":""},"backgroundColor":{"type":"string"},"btnLabel":{"type":"string","source":"html","selector":".smb-btn__label","default":""},"btnURL":{"type":"string","source":"attribute","selector":".smb-btn","attribute":"href","default":""},"btnTarget":{"type":"string","source":"attribute","selector":".smb-btn","attribute":"target","default":"_self"},"btnBackgroundColor":{"type":"string"},"btnTextColor":{"type":"string"},"btnSize":{"type":"string","default":""},"btnBorderRadius":{"type":"number"},"btnWrap":{"type":"boolean","default":false}},"supports":{"html":false},"example":{"attributes":{"lede":"Lorem ipsum dolor sit amet","note":"consectetur adipiscing elit","btnLabel":"button","btnURL":"https://2inc.org"}},"style":"snow-monkey-blocks/btn-box","editorScript":"file:../../dist/block/btn-box/editor.js"}'),a=(0,t.createElement)("svg",{viewBox:"0 0 24 24"},(0,t.createElement)("path",{d:"M18,8H6A1,1,0,0,0,5,9v6a1,1,0,0,0,1,1H18a1,1,0,0,0,1-1V9A1,1,0,0,0,18,8Zm0,5.8A1.15,1.15,0,0,1,16.91,15H6.55a.57.57,0,0,1-.55-.6V9.64A.57.57,0,0,1,6.55,9h10.9a.57.57,0,0,1,.55.6Z"}),(0,t.createElement)("rect",{x:"9.5",y:"11.54",width:"5",height:"1"}),(0,t.createElement)("path",{d:"M23,3H1A1,1,0,0,0,0,4V20a1,1,0,0,0,1,1H23a1,1,0,0,0,1-1V4A1,1,0,0,0,23,3Zm0,16.47a.52.52,0,0,1-.52.53h-21A.52.52,0,0,1,1,19.47V4.53A.52.52,0,0,1,1.52,4h21a.52.52,0,0,1,.52.53Z"}));function s(){return s=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},s.apply(this,arguments)}var c=n(184),i=n.n(c),b=window.wp.components,m=window.wp.blockEditor,u=window.wp.primitives,d=(0,t.createElement)(u.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(u.Path,{d:"M15.6 7.2H14v1.5h1.6c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.8 0 5.2-2.3 5.2-5.2 0-2.9-2.3-5.2-5.2-5.2zM4.7 12.4c0-2 1.7-3.7 3.7-3.7H10V7.2H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H10v-1.5H8.4c-2 0-3.7-1.7-3.7-3.7zm4.6.9h5.3v-1.5H9.3v1.5z"})),p=(0,t.createElement)(u.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(u.Path,{d:"M15.6 7.3h-.7l1.6-3.5-.9-.4-3.9 8.5H9v1.5h2l-1.3 2.8H8.4c-2 0-3.7-1.7-3.7-3.7s1.7-3.7 3.7-3.7H10V7.3H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H9l-1.4 3.2.9.4 5.7-12.5h1.4c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.9 0 5.2-2.3 5.2-5.2 0-2.9-2.4-5.2-5.2-5.2z"}));function g(){const e={disableCustomColors:!(0,m.useSetting)("color.custom"),disableCustomGradients:!(0,m.useSetting)("color.customGradient")},n=(0,m.useSetting)("color.palette.custom"),o=(0,m.useSetting)("color.palette.theme"),r=(0,m.useSetting)("color.palette.default"),a=(0,m.useSetting)("color.defaultPalette");e.colors=(0,t.useMemo)((()=>{const e=[];return o&&o.length&&e.push({name:(0,l._x)("Theme","Indicates this palette comes from the theme.","snow-monkey-blocks"),colors:o}),a&&r&&r.length&&e.push({name:(0,l._x)("Default","Indicates this palette comes from WordPress.","snow-monkey-blocks"),colors:r}),n&&n.length&&e.push({name:(0,l._x)("Custom","Indicates this palette comes from the theme.","snow-monkey-blocks"),colors:n}),e}),[r,o,n]);const s=(0,m.useSetting)("color.gradients.custom"),c=(0,m.useSetting)("color.gradients.theme"),i=(0,m.useSetting)("color.gradients.default"),b=(0,m.useSetting)("color.defaultGradients");return e.gradients=(0,t.useMemo)((()=>{const e=[];return c&&c.length&&e.push({name:(0,l._x)("Theme","Indicates this palette comes from the theme.","snow-monkey-blocks"),gradients:c}),b&&i&&i.length&&e.push({name:(0,l._x)("Default","Indicates this palette comes from WordPress.","snow-monkey-blocks"),gradients:i}),s&&s.length&&e.push({name:(0,l._x)("Custom","Indicates this palette is created by the user.","snow-monkey-blocks"),gradients:s}),e}),[s,c,i]),e}window.wp.data;const _=e=>"_self"!==e&&("_blank"===e||void 0);function h(e){const{url:n,target:o,onChange:l}=e;return(0,t.createElement)(m.__experimentalLinkControl,{className:"wp-block-navigation-link__inline-link-input",value:{url:n,opensInNewTab:_(o)},onChange:l})}const v=r.attributes;var k=[{attributes:{...v,btnURL:{type:"string",default:""},btnTarget:{type:"string",default:"_self"}},supports:{align:["wide","full"]},save(e){let{attributes:n,className:o}=e;const{lede:l,note:r,backgroundColor:a,btnLabel:s,btnURL:c,btnTarget:b,btnBackgroundColor:u,btnTextColor:d,btnSize:p,btnBorderRadius:g,btnWrap:_}=n,h=i()("smb-btn-box",o),v=i()("smb-btn",{[`smb-btn--${p}`]:!!p,"smb-btn--wrap":_}),k={backgroundColor:a||void 0},y={backgroundColor:u||void 0,borderRadius:void 0!==g?`${g}px`:void 0};return"is-style-ghost"===n.className&&(y.borderColor=u||void 0),(0,t.createElement)("div",m.useBlockProps.save({className:h,style:k}),(0,t.createElement)("div",{className:"c-container"},!m.RichText.isEmpty(l)&&(0,t.createElement)("div",{className:"smb-btn-box__lede"},(0,t.createElement)(m.RichText.Content,{value:l})),(0,t.createElement)("div",{className:"smb-btn-box__btn-wrapper"},(0,t.createElement)("a",{className:v,href:c,style:y,target:"_self"===b?void 0:b,rel:"_self"===b?void 0:"noopener noreferrer"},(0,t.createElement)("span",{className:"smb-btn__label",style:{color:d}},(0,t.createElement)(m.RichText.Content,{value:s})))),!m.RichText.isEmpty(r)&&(0,t.createElement)("div",{className:"smb-btn-box__note"},(0,t.createElement)(m.RichText.Content,{value:r}))))}},{attributes:{...v,btnURL:{type:"string",default:""},btnTarget:{type:"string",default:"_self"}},supports:{align:["wide","full"]},save(e){let{attributes:n}=e;const{lede:o,note:l,backgroundColor:r,btnLabel:a,btnURL:s,btnTarget:c,btnBackgroundColor:b,btnTextColor:u,btnSize:d}=n;return(0,t.createElement)("div",{className:"smb-btn-box",style:{backgroundColor:r}},(0,t.createElement)("div",{className:"c-container"},!m.RichText.isEmpty(o)&&(0,t.createElement)("div",{className:"smb-btn-box__lede"},(0,t.createElement)(m.RichText.Content,{value:o})),(0,t.createElement)("div",{className:"smb-btn-box__btn-wrapper"},(0,t.createElement)("a",{className:i()("smb-btn",{[`smb-btn--${d}`]:!!d}),href:s,style:{backgroundColor:b},target:"_self"===c?void 0:c,rel:"_self"===c?void 0:"noopener noreferrer"},(0,t.createElement)("span",{className:"smb-btn__label",style:{color:u}},(0,t.createElement)(m.RichText.Content,{value:a})))),!m.RichText.isEmpty(l)&&(0,t.createElement)("div",{className:"smb-btn-box__note"},(0,t.createElement)(m.RichText.Content,{value:l}))))}},{attributes:{...v,btnURL:{type:"string",default:""},btnTarget:{type:"string",default:"_self"}},save(e){let{attributes:n}=e;const{lede:o,note:l,backgroundColor:r,btnLabel:a,btnURL:s,btnTarget:c,btnBackgroundColor:i,btnTextColor:b}=n,u={};r&&"null"!==r&&(u.backgroundColor=r);const d={};i&&"null"!==i&&(d.btnBackgroundColor=i);const p={};return b&&"null"!==b&&(p.btnTextColor=b),(0,t.createElement)("div",{className:"smb-btn-box",style:u},(0,t.createElement)("div",{className:"c-container"},!m.RichText.isEmpty(o)&&(0,t.createElement)("div",{className:"smb-btn-box__lede"},(0,t.createElement)(m.RichText.Content,{value:o})),(0,t.createElement)("a",{className:"smb-btn smb-btn--full",href:s,target:c,style:d},(0,t.createElement)("span",{className:"smb-btn__label",style:p},(0,t.createElement)(m.RichText.Content,{value:a}))),!m.RichText.isEmpty(l)&&(0,t.createElement)("div",{className:"smb-btn-box__note"},(0,t.createElement)(m.RichText.Content,{value:l}))))}},{attributes:{...v,btnURL:{type:"string",default:""},btnTarget:{type:"string",default:"_self"}},supports:{align:["wide","full"]},save(e){let{attributes:n}=e;const{lede:o,note:l,backgroundColor:r,btnLabel:a,btnURL:s,btnTarget:c,btnBackgroundColor:b,btnTextColor:u,btnSize:d}=n;return(0,t.createElement)("div",{className:"smb-btn-box",style:{backgroundColor:r}},(0,t.createElement)("div",{className:"c-container"},!m.RichText.isEmpty(o)&&(0,t.createElement)("div",{className:"smb-btn-box__lede"},(0,t.createElement)(m.RichText.Content,{value:o})),(0,t.createElement)("div",{className:"smb-btn-box__btn-wrapper"},(0,t.createElement)("a",{className:i()("smb-btn",{[`smb-btn--${d}`]:!!d}),href:s,target:c,style:{backgroundColor:b}},(0,t.createElement)("span",{className:"smb-btn__label",style:{color:u}},(0,t.createElement)(m.RichText.Content,{value:a})))),!m.RichText.isEmpty(l)&&(0,t.createElement)("div",{className:"smb-btn-box__note"},(0,t.createElement)(m.RichText.Content,{value:l}))))}}];const{name:y}=r,f={icon:{foreground:"#cd162c",src:a},styles:[{name:"default",label:(0,l.__)("Default","snow-monkey-blocks"),isDefault:!0},{name:"ghost",label:(0,l.__)("Ghost","snow-monkey-blocks")}],edit:function(e){let{attributes:n,setAttributes:o,isSelected:r,className:a}=e;const{lede:c,note:u,backgroundColor:_,btnLabel:v,btnURL:k,btnTarget:y,btnBackgroundColor:f,btnTextColor:x,btnSize:w,btnBorderRadius:C,btnWrap:E}=n,[T,R]=(0,t.useState)(!1),N=!!k,S=N&&r,B=i()("smb-btn-box",a),L=i()("smb-btn",{[`smb-btn--${w}`]:!!w,"smb-btn--wrap":E}),H={backgroundColor:_||void 0},P={backgroundColor:f||void 0,borderRadius:void 0!==C?`${C}px`:void 0};n.className&&n.className.split(" ").includes("is-style-ghost")&&(P.borderColor=f||void 0);const I=(0,t.useRef)(),O=(0,m.useBlockProps)({className:B,style:H,ref:I}),z=e=>{let{url:t,opensInNewTab:n}=e;o({btnURL:t,btnTarget:n?"_blank":"_self"})};return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(m.InspectorControls,null,(0,t.createElement)(m.__experimentalPanelColorGradientSettings,{title:(0,l.__)("Color","snow-monkey-blocks"),initialOpen:!1,settings:[{colorValue:_,onColorChange:e=>o({backgroundColor:e}),label:(0,l.__)("Background color","snow-monkey-blocks")}],__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0}),(0,t.createElement)(b.PanelBody,{title:(0,l.__)("Button settings","snow-monkey-blocks")},(0,t.createElement)(b.SelectControl,{label:(0,l.__)("Button size","snow-monkey-blocks"),value:w,onChange:e=>o({btnSize:e}),options:[{value:"",label:(0,l.__)("Normal size","snow-monkey-blocks")},{value:"little-wider",label:(0,l.__)("Litle wider","snow-monkey-blocks")},{value:"wider",label:(0,l.__)("Wider","snow-monkey-blocks")},{value:"more-wider",label:(0,l.__)("More wider","snow-monkey-blocks")},{value:"full",label:(0,l.__)("Full size","snow-monkey-blocks")}]}),(0,t.createElement)(b.RangeControl,{label:(0,l.__)("Border radius","snow-monkey-blocks"),value:C,onChange:e=>o({btnBorderRadius:e}),min:"0",max:"50",initialPosition:"6",allowReset:!0}),(0,t.createElement)(b.CheckboxControl,{label:(0,l.__)("Wrap","snow-monkey-blocks"),checked:E,onChange:e=>o({btnWrap:e})}),(0,t.createElement)(m.__experimentalColorGradientControl,s({label:(0,l.__)("Background color","snow-monkey-blocks"),colorValue:f,onColorChange:e=>o({btnBackgroundColor:e})},g(),{__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0})),(0,t.createElement)(m.__experimentalColorGradientControl,s({label:(0,l.__)("Text color","snow-monkey-blocks"),colorValue:x,onColorChange:e=>o({btnTextColor:e})},g(),{__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0})),(0,t.createElement)(m.ContrastChecker,{backgroundColor:f,textColor:x}))),(0,t.createElement)("div",O,(0,t.createElement)("div",{className:"c-container"},(!m.RichText.isEmpty(c)||r)&&(0,t.createElement)(m.RichText,{className:"smb-btn-box__lede",value:c,onChange:e=>o({lede:e}),placeholder:(0,l.__)("Write lede…","snow-monkey-blocks")}),(0,t.createElement)("div",{className:"smb-btn-box__btn-wrapper"},(0,t.createElement)("span",{className:L,href:k,style:P,target:"_self"===y?void 0:y,rel:"_self"===y?void 0:"noopener noreferrer"},(0,t.createElement)(m.RichText,{className:"smb-btn__label",value:v,placeholder:(0,l.__)("Button","snow-monkey-blocks"),onChange:e=>o({btnLabel:e}),style:{color:x},withoutInteractiveFormatting:!0}))),(!m.RichText.isEmpty(u)||r)&&(0,t.createElement)(m.RichText,{className:"smb-btn-box__note",value:u,onChange:e=>o({note:e}),placeholder:(0,l.__)("Write note…","snow-monkey-blocks")}))),(0,t.createElement)(m.BlockControls,{group:"block"},!N&&(0,t.createElement)(b.ToolbarButton,{icon:d,label:(0,l.__)("Link","snow-monkey-blocks"),"aria-expanded":T,onClick:()=>R(!T)}),S&&(0,t.createElement)(b.ToolbarButton,{isPressed:!0,icon:p,label:(0,l.__)("Unlink","snow-monkey-blocks"),onClick:()=>z("")})),(T||S)&&(0,t.createElement)(b.Popover,{position:"bottom center",anchorRef:I.current,onClose:()=>R(!1)},(0,t.createElement)(h,{url:k,target:y,onChange:z})))},save:function(e){let{attributes:n,className:o}=e;const{lede:l,note:r,backgroundColor:a,btnLabel:s,btnURL:c,btnTarget:b,btnBackgroundColor:u,btnTextColor:d,btnSize:p,btnBorderRadius:g,btnWrap:_}=n,h=i()("smb-btn-box",o),v=i()("smb-btn",{[`smb-btn--${p}`]:!!p,"smb-btn--wrap":_}),k={backgroundColor:a||void 0},y={backgroundColor:u||void 0,borderRadius:void 0!==g?`${g}px`:void 0};return n.className&&n.className.split(" ").includes("is-style-ghost")&&(y.borderColor=u||void 0),(0,t.createElement)("div",m.useBlockProps.save({className:h,style:k}),(0,t.createElement)("div",{className:"c-container"},!m.RichText.isEmpty(l)&&(0,t.createElement)("div",{className:"smb-btn-box__lede"},(0,t.createElement)(m.RichText.Content,{value:l})),(0,t.createElement)("div",{className:"smb-btn-box__btn-wrapper"},(0,t.createElement)("a",{className:v,href:c,style:y,target:"_self"===b?void 0:b,rel:"_self"===b?void 0:"noopener noreferrer"},(0,t.createElement)("span",{className:"smb-btn__label",style:{color:d}},(0,t.createElement)(m.RichText.Content,{value:s})))),!m.RichText.isEmpty(r)&&(0,t.createElement)("div",{className:"smb-btn-box__note"},(0,t.createElement)(m.RichText.Content,{value:r}))))},deprecated:k};(e=>{if(!e)return;const{metadata:t,settings:n,name:r}=e;t&&(t.title&&(t.title=(0,l.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,l.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,l.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,o.registerBlockType)({name:r,...t},n)})(e)}()}();