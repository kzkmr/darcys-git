!function(){var e={137:function(e,o,t){"use strict";var n={};t.r(n),t.d(n,{metadata:function(){return s},name:function(){return f},settings:function(){return C}});var r=window.wp.element,l=(window.lodash,window.wp.blocks),a=(window.wp.richText,window.wp.i18n),i="#cd162c",s=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/spider-contents-slider-item","title":"Slide","description":"It is a child block of the contents slider block.","category":"smb","parent":["snow-monkey-blocks/spider-contents-slider"],"attributes":{"sliderId":{"type":"string","source":"attribute","selector":".spider__slide","attribute":"data-id","default":""},"contentPosition":{"type":"string","default":""},"contentPadding":{"type":"string"},"border":{"type":"object","default":{"color":"","width":1,"radius":0}},"boxShadow":{"type":"object","default":{"color":"","opacity":0.1,"blur":10,"position":""}},"style":{"type":"object","default":{"color":{"background":"#eeeeee"}}}},"supports":{"html":false,"color":{"text":true,"gradients":true}},"editorScript":"file:../../../dist/block/spider-contents-slider/item/editor.js"}'),c=(0,r.createElement)("svg",{viewBox:"0 0 24 24"},(0,r.createElement)("path",{d:"M5,5.78V18.22a.78.78,0,0,0,.78.78H18.22a.78.78,0,0,0,.78-.78V5.78A.78.78,0,0,0,18.22,5H5.78A.78.78,0,0,0,5,5.78m12.44,12H6.56a.38.38,0,0,1-.39-.39V6.56a.38.38,0,0,1,.39-.39H17.44a.38.38,0,0,1,.39.39V17.44a.38.38,0,0,1-.39.39"}),(0,r.createElement)("path",{d:"M6.17,14.16l3.06-2.23a.22.22,0,0,1,.22,0l2.34,1.5a.21.21,0,0,0,.24,0l3-2.83a.19.19,0,0,1,.27,0l3.09,3v1.16l-3.09-3a.18.18,0,0,0-.27,0l-3,2.82a.19.19,0,0,1-.24,0L9.45,13.11a.18.18,0,0,0-.22,0L6.17,15.33Z"}),(0,r.createElement)("path",{d:"M2.22,5H0V6.17H1.44a.38.38,0,0,1,.39.39V17.44a.38.38,0,0,1-.39.39H0V19H2.22A.78.78,0,0,0,3,18.22V5.78A.78.78,0,0,0,2.22,5Z"}),(0,r.createElement)("path",{d:"M24,17.83H22.56a.38.38,0,0,1-.39-.39V6.56a.38.38,0,0,1,.39-.39H24V5H21.78a.78.78,0,0,0-.78.78V18.22a.78.78,0,0,0,.78.78H24Z"}));function d(){return d=Object.assign||function(e){for(var o=1;o<arguments.length;o++){var t=arguments[o];for(var n in t)Object.prototype.hasOwnProperty.call(t,n)&&(e[n]=t[n])}return e},d.apply(this,arguments)}var u=t(184),p=t.n(u),m=t(685),b=t.n(m),h=window.wp.blockEditor,g=window.wp.components,y=window.wp.data;function v(){const e={disableCustomColors:!(0,h.useSetting)("color.custom"),disableCustomGradients:!(0,h.useSetting)("color.customGradient")},o=(0,h.useSetting)("color.palette.custom"),t=(0,h.useSetting)("color.palette.theme"),n=(0,h.useSetting)("color.palette.default"),l=(0,h.useSetting)("color.defaultPalette");e.colors=(0,r.useMemo)((()=>{const e=[];return t&&t.length&&e.push({name:(0,a._x)("Theme","Indicates this palette comes from the theme.","snow-monkey-blocks"),colors:t}),l&&n&&n.length&&e.push({name:(0,a._x)("Default","Indicates this palette comes from WordPress.","snow-monkey-blocks"),colors:n}),o&&o.length&&e.push({name:(0,a._x)("Custom","Indicates this palette comes from the theme.","snow-monkey-blocks"),colors:o}),e}),[n,t,o]);const i=(0,h.useSetting)("color.gradients.custom"),s=(0,h.useSetting)("color.gradients.theme"),c=(0,h.useSetting)("color.gradients.default"),d=(0,h.useSetting)("color.defaultGradients");return e.gradients=(0,r.useMemo)((()=>{const e=[];return s&&s.length&&e.push({name:(0,a._x)("Theme","Indicates this palette comes from the theme.","snow-monkey-blocks"),gradients:s}),d&&c&&c.length&&e.push({name:(0,a._x)("Default","Indicates this palette comes from WordPress.","snow-monkey-blocks"),gradients:c}),i&&i.length&&e.push({name:(0,a._x)("Custom","Indicates this palette is created by the user.","snow-monkey-blocks"),gradients:i}),e}),[i,s,c]),e}function k(e){let{settings:o}=e;return(0,r.createElement)(g.PanelBody,{title:(0,a.__)("Border","snow-monkey-blocks"),initialOpen:!1},(0,r.createElement)(g.BaseControl,null,o.map(((e,o)=>e.hasOwnProperty("colorValue")&&e.hasOwnProperty("onColorChange")?(0,r.createElement)(h.__experimentalColorGradientControl,d({key:o,label:(0,a.__)("Color","snow-monkey-blocks"),disableAlpha:!1,colorValue:e.colorValue,onColorChange:e.onColorChange},v(),{__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0})):e.hasOwnProperty("widthValue")&&e.hasOwnProperty("onWidthChange")?(0,r.createElement)(g.RangeControl,{key:o,label:(0,a.__)("Width","snow-monkey-blocks"),value:Number(e.widthValue.toFixed(1)),onChange:e.onWidthChange,min:0,max:5}):e.hasOwnProperty("radiusValue")&&e.hasOwnProperty("onRadiusChange")?(0,r.createElement)(g.RangeControl,{key:o,label:(0,a.__)("Radius","snow-monkey-blocks"),value:Number(e.radiusValue.toFixed(1)),onChange:e.onRadiusChange,min:0,max:50}):(0,r.createElement)(r.Fragment,{key:o})))))}function w(e){let{settings:o}=e;return(0,r.createElement)(g.PanelBody,{title:(0,a.__)("Box Shadow","snow-monkey-blocks"),initialOpen:!1},(0,r.createElement)(g.BaseControl,null,o.map(((e,o)=>{return e.hasOwnProperty("colorValue")&&e.hasOwnProperty("onColorChange")?(0,r.createElement)(h.__experimentalColorGradientControl,d({key:o,label:(0,a.__)("Color","snow-monkey-blocks"),disableAlpha:!1,colorValue:e.colorValue,onColorChange:e.onColorChange},v(),{__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0})):e.hasOwnProperty("opacityValue")&&e.hasOwnProperty("onOpacityChange")?(0,r.createElement)(g.RangeControl,{key:o,label:(0,a.__)("Opacity","snow-monkey-blocks"),value:Number(e.opacityValue.toFixed(1)),onChange:e.onOpacityChange,min:0,max:1,step:.1}):e.hasOwnProperty("horizontalValue")&&e.hasOwnProperty("onHorizontalChange")?(0,r.createElement)(g.RangeControl,{key:o,label:(0,a.__)("Horizontal","snow-monkey-blocks"),value:e.horizontalValue,onChange:e.onHorizontalChange,min:null!==(t=null==e?void 0:e.min)&&void 0!==t?t:-100,max:null!==(n=null==e?void 0:e.max)&&void 0!==n?n:100}):e.hasOwnProperty("verticalValue")&&e.hasOwnProperty("onVerticalChange")?(0,r.createElement)(g.RangeControl,{key:o,label:(0,a.__)("Vertical","snow-monkey-blocks"),value:e.verticalValue,onChange:e.onVerticalChange,min:null!==(l=null==e?void 0:e.min)&&void 0!==l?l:-100,max:null!==(i=null==e?void 0:e.max)&&void 0!==i?i:100}):e.hasOwnProperty("blurValue")&&e.hasOwnProperty("onBlurChange")?(0,r.createElement)(g.RangeControl,{key:o,label:(0,a.__)("Blur","snow-monkey-blocks"),value:e.blurValue,onChange:e.onBlurChange,min:null!==(s=null==e?void 0:e.min)&&void 0!==s?s:0,max:null!==(c=null==e?void 0:e.max)&&void 0!==c?c:100}):e.hasOwnProperty("spreadValue")&&e.hasOwnProperty("onSpreadChange")?(0,r.createElement)(g.RangeControl,{key:o,label:(0,a.__)("Spread","snow-monkey-blocks"),value:e.spreadValue,onChange:e.onSpreadChange,min:null!==(u=null==e?void 0:e.min)&&void 0!==u?u:-100,max:null!==(p=null==e?void 0:e.max)&&void 0!==p?p:100}):e.hasOwnProperty("positionValue")&&e.hasOwnProperty("onPositionChange")?(0,r.createElement)(g.SelectControl,{key:o,label:(0,a.__)("Position","snow-monkey-blocks"),value:e.positionValue,onChange:e.onPositionChange,options:[{value:"",label:(0,a.__)("Outline","snow-monkey-blocks")},{value:"inset",label:(0,a.__)("Inset","snow-monkey-blocks")}]}):(0,r.createElement)(r.Fragment,{key:o});var t,n,l,i,s,c,u,p}))))}var _=[{attributes:{...s.attributes},save(e){var o;let{attributes:t,className:n}=e;const{sliderId:l,contentPosition:a,contentPadding:i,border:s,boxShadow:c,style:u}=t,m=p()("spider__slide",n),g=p()("smb-spider-contents-slider__item",{[`smb-spider-contents-slider__item--p-${i}`]:!!i}),y={background:(null==u||null===(o=u.color)||void 0===o?void 0:o.background)||void 0,borderColor:s.color||void 0,borderWidth:s.color&&s.width||void 0,borderRadius:s.radius||void 0,boxShadow:c.color?`0 0 ${c.blur}px ${b()(c.color,c.opacity)}`:void 0};return(0,r.createElement)("div",d({},h.useBlockProps.save({className:m}),{"data-id":l,"data-content-position":(null==a?void 0:a.replace(" ","-"))||void 0,style:y}),(0,r.createElement)("div",{className:g},(0,r.createElement)(h.InnerBlocks.Content,null)))}}];const{name:f}=s,C={icon:{foreground:i,src:c},edit:function(e){var o,t;let{attributes:n,setAttributes:l,className:i,isSelected:s,clientId:c}=e;const{sliderId:u,contentPosition:m,contentPadding:v,border:_,boxShadow:f,style:C,backgroundColor:x}=n,P=(0,r.useRef)(),V=(0,y.useSelect)((e=>{var o,t;return!(null===(o=e("core/block-editor").getBlock(c))||void 0===o||null===(t=o.innerBlocks)||void 0===t||!t.length)}),[c]);(0,r.useEffect)((()=>{if(s){var e,o;const t=P.current.parentNode,n=t.parentNode,r=n.parentNode.parentNode,l=null===(e=r.style.getPropertyValue("--spider-reference-width"))||void 0===e?void 0:e.replace("px",""),a=(null===(o=r.style.getPropertyValue("--spider-canvas-width"))||void 0===o?void 0:o.replace("px",""))/2-l/2,i=t.getBoundingClientRect().left,s=i+t.offsetWidth,c=n.getBoundingClientRect().left;(c+n.offsetWidth<s||c>i)&&(n.scrollLeft=t.offsetLeft-a)}}),[c,s,u]);const S=p()("spider__slide",i),O=p()("smb-spider-contents-slider__item",{[`smb-spider-contents-slider__item--p-${v}`]:!!v}),E=(0,h.useBlockProps)({className:S}),B=(0,h.useInnerBlocksProps)({className:O},{renderAppender:V?h.InnerBlocks.DefaultBlockAppender:h.InnerBlocks.ButtonBlockAppender}),I={backgroundColor:!x&&(null==C||null===(o=C.color)||void 0===o?void 0:o.background)||void 0,background:!x&&(null==C||null===(t=C.color)||void 0===t?void 0:t.gradient)||void 0,borderColor:_.color||void 0,borderWidth:_.color&&_.width||void 0,borderRadius:_.radius||void 0,boxShadow:f.color?`0 0 ${f.blur}px ${b()(f.color,f.opacity)}`:void 0};return(0,r.createElement)(r.Fragment,null,(0,r.createElement)(h.InspectorControls,null,(0,r.createElement)(k,{settings:[{colorValue:_.color,onColorChange:e=>{const o={..._};o.color=e,l({border:o})}},{widthValue:_.width,onWidthChange:e=>{const o={..._};o.width=e,l({border:o})}},{radiusValue:_.radius,onRadiusChange:e=>{const o={..._};o.radius=e,l({border:o})}}]}),(0,r.createElement)(g.PanelBody,{title:(0,a.__)("Dimensions","snow-monkey-blocks"),initialOpen:!1},(0,r.createElement)(g.SelectControl,{label:(0,a.__)("Padding","snow-monkey-blocks"),value:v,options:[{value:"",label:(0,a.__)("None","snow-monkey-blocks")},{value:"s",label:(0,a.__)("S","snow-monkey-blocks")},{value:"m",label:(0,a.__)("M","snow-monkey-blocks")},{value:"l",label:(0,a.__)("L","snow-monkey-blocks")}],onChange:e=>l({contentPadding:e})})),(0,r.createElement)(w,{settings:[{colorValue:f.color,onColorChange:e=>{const o={...f};o.color=e,l({boxShadow:o})}},{opacityValue:f.opacity,onOpacityChange:e=>{const o={...f};o.opacity=e,l({boxShadow:o})}},{blurValue:f.blur,onBlurChange:e=>{const o={...f};o.blur=e,l({boxShadow:o})},max:10}]})),!!m&&(0,r.createElement)(h.BlockControls,{group:"block"},(0,r.createElement)(h.__experimentalBlockAlignmentMatrixControl,{label:(0,a.__)("Change content position","snow-monkey-blocks"),value:m,onChange:e=>{l({contentPosition:e})},isDisabled:!V})),(0,r.createElement)("div",d({},E,{"data-id":u,"data-content-position":(null==m?void 0:m.replace(" ","-"))||void 0,style:I}),(0,r.createElement)("div",d({},B,{ref:P}))))},save:function(e){var o;let{attributes:t,className:n}=e;const{sliderId:l,contentPosition:a,contentPadding:i,border:s,boxShadow:c,style:u,backgroundColor:m}=t,g=p()("spider__slide",n),y=p()("smb-spider-contents-slider__item",{[`smb-spider-contents-slider__item--p-${i}`]:!!i}),v={background:!m&&(null==u||null===(o=u.color)||void 0===o?void 0:o.background)||void 0,borderColor:s.color||void 0,borderWidth:s.color&&s.width||void 0,borderRadius:s.radius||void 0,boxShadow:c.color?`0 0 ${c.blur}px ${b()(c.color,c.opacity)}`:void 0};return(0,r.createElement)("div",d({},h.useBlockProps.save({className:g}),{"data-id":l,"data-content-position":(null==a?void 0:a.replace(" ","-"))||void 0,style:v}),(0,r.createElement)("div",h.useInnerBlocksProps.save({className:y})))},deprecated:_,variations:[{name:"full-height",title:(0,a.__)("Full height","snow-monkey-blocks"),isDefault:!0,icon:{foreground:i,src:c},scope:["inserter","transform"]},{name:"alignmentable",title:(0,a.__)("Alignmentable","snow-monkey-blocks"),icon:{foreground:i,src:c},attributes:{contentPosition:"center-center"},scope:["inserter","transform"]}]};(e=>{if(!e)return;const{metadata:o,settings:t,name:n}=e;o&&(o.title&&(o.title=(0,a.__)(o.title,"snow-monkey-blocks"),t.title=o.title),o.description&&(o.description=(0,a.__)(o.description,"snow-monkey-blocks"),t.description=o.description),o.keywords&&(o.keywords=(0,a.__)(o.keywords,"snow-monkey-blocks"),t.keywords=o.keywords)),(0,l.registerBlockType)({name:n,...o},t)})(n)},184:function(e,o){var t;!function(){"use strict";var n={}.hasOwnProperty;function r(){for(var e=[],o=0;o<arguments.length;o++){var t=arguments[o];if(t){var l=typeof t;if("string"===l||"number"===l)e.push(t);else if(Array.isArray(t)){if(t.length){var a=r.apply(null,t);a&&e.push(a)}}else if("object"===l)if(t.toString===Object.prototype.toString)for(var i in t)n.call(t,i)&&t[i]&&e.push(i);else e.push(t.toString())}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(t=function(){return r}.apply(o,[]))||(e.exports=t)}()},685:function(e){"use strict";var o=function(e){return parseInt(e,16)};e.exports=function(e,t){var n,r,l=function(e){return"#"===e.charAt(0)?e.slice(1):e}(e),a=function(e){var t=e.g,n=e.b,r=e.a;return{r:o(e.r),g:o(t),b:o(n),a:+(o(r)/255).toFixed(2)}}({r:(r=3===(n=l).length||4===n.length)?"".concat(n.slice(0,1)).concat(n.slice(0,1)):n.slice(0,2),g:r?"".concat(n.slice(1,2)).concat(n.slice(1,2)):n.slice(2,4),b:r?"".concat(n.slice(2,3)).concat(n.slice(2,3)):n.slice(4,6),a:(r?"".concat(n.slice(3,4)).concat(n.slice(3,4)):n.slice(6,8))||"ff"});return function(e,o){var t,n=e.r,r=e.g,l=e.b,a=e.a,i=(t=o,!isNaN(parseFloat(t))&&isFinite(t)?o:a);return"rgba(".concat(n,", ").concat(r,", ").concat(l,", ").concat(i,")")}(a,t)}}},o={};function t(n){var r=o[n];if(void 0!==r)return r.exports;var l=o[n]={exports:{}};return e[n](l,l.exports,t),l.exports}t.n=function(e){var o=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(o,{a:o}),o},t.d=function(e,o){for(var n in o)t.o(o,n)&&!t.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:o[n]})},t.o=function(e,o){return Object.prototype.hasOwnProperty.call(e,o)},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t(137)}();