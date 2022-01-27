!function(){var e={559:function(e,t,n){"use strict";var o={};n.r(o),n.d(o,{metadata:function(){return a},name:function(){return h},settings:function(){return k}});var r=window.wp.element,l=window.lodash,i=window.wp.blocks,c=(window.wp.richText,window.wp.i18n),a=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/list","title":"Icon list","description":"Icons are displayed only on the actual screen.","category":"smb","attributes":{"content":{"type":"string","source":"html","selector":"ul","multiline":"li","default":""},"icon":{"type":"string","default":"angle-right"},"iconColor":{"type":"string"}},"supports":{"html":false},"example":{"attributes":{"content":"<li>Lorem ipsum dolor sit amet</li><li>consectetur adipiscing elit</li><li>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</li>"}},"style":"snow-monkey-blocks/list","editorStyle":"snow-monkey-blocks/list/editor","editorScript":"file:../../dist/block/list/editor.js"}'),s=(0,r.createElement)("svg",{viewBox:"0 0 24 24"},(0,r.createElement)("rect",{x:"7",y:"7",width:"13",height:"1"}),(0,r.createElement)("rect",{x:"3.5",y:"6.5",width:"2",height:"2",rx:"1"}),(0,r.createElement)("rect",{x:"7",y:"11.5",width:"13",height:"1"}),(0,r.createElement)("rect",{x:"3.5",y:"11",width:"2",height:"2",rx:"1"}),(0,r.createElement)("rect",{x:"7",y:"16",width:"13",height:"1"}),(0,r.createElement)("rect",{x:"3.5",y:"15.5",width:"2",height:"2",rx:"1"}));function u(){return u=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},u.apply(this,arguments)}var d=n(184),m=n.n(d),b=window.wp.components,p=window.wp.blockEditor,y=[{attributes:{...a.attributes},save(e){let{attributes:t}=e;const{content:n,icon:o,iconColor:l}=t;return(0,r.createElement)("div",{className:"smb-list","data-icon":o,"data-icon-color":l},(0,r.createElement)("ul",null,(0,r.createElement)(p.RichText.Content,{value:n})))}}];const{name:h}=a,k={icon:{foreground:"#cd162c",src:s},edit:function(e){let{attributes:t,setAttributes:n,className:o,clientId:i}=e;const{content:a,icon:s,iconColor:d}=t,y=[{value:"angle-right",label:(0,c.__)("angle-right","snow-monkey-blocks")},{value:"angle-double-right",label:(0,c.__)("angle-double-right","snow-monkey-blocks")},{value:"arrow-alt-circle-right",label:(0,c.__)("arrow-alt-circle-right","snow-monkey-blocks")},{value:"arrow-right",label:(0,c.__)("arrow-right","snow-monkey-blocks")},{value:"check",label:(0,c.__)("check","snow-monkey-blocks")},{value:"check-circle",label:(0,c.__)("check-circle","snow-monkey-blocks")},{value:"check-square",label:(0,c.__)("check-square","snow-monkey-blocks")},{value:"chevron-circle-right",label:(0,c.__)("chevron-circle-right","snow-monkey-blocks")},{value:"hand-point-right",label:(0,c.__)("hand-point-right","snow-monkey-blocks")}],h=m()("smb-list",o),k=(0,p.useBlockProps)({className:h});return(0,r.createElement)(r.Fragment,null,(0,r.createElement)(p.InspectorControls,null,(0,r.createElement)(p.__experimentalPanelColorGradientSettings,{title:(0,c.__)("Color","snow-monkey-blocks"),initialOpen:!1,settings:[{colorValue:d,onColorChange:e=>n({iconColor:e}),label:(0,c.__)("Icon color","snow-monkey-blocks")}],__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0}),(0,r.createElement)(b.PanelBody,{title:(0,c.__)("Block settings","snow-monkey-blocks")},(0,r.createElement)(b.BaseControl,{label:(0,c.__)("Icon","snow-monkey-blocks"),id:"snow-monkey-blocks/list/icon"},(0,r.createElement)("div",{className:"smb-list-icon-selector"},(0,l.times)(y.length,(e=>{const t=y[e].value,o=s===t;return(0,r.createElement)(b.Button,{isPrimary:o,onClick:()=>n({icon:t}),key:e},(0,r.createElement)("i",{className:`fas fa-${y[e].value}`,title:y[e].label}))})))))),(0,r.createElement)("div",u({},k,{"data-icon":s,"data-icon-color":d}),(0,r.createElement)("style",null,`.editor-styles-wrapper [data-block="${i}"] ul li::before, .customize-control-sidebar_block_editor [data-block="${i}"] ul li::before { border-color: ${d} }`),(0,r.createElement)(p.RichText,{tagName:"ul",multiline:"li",value:a,onChange:e=>n({content:e})})))},save:function(e){let{attributes:t,className:n}=e;const{content:o,icon:l,iconColor:i}=t,c=m()("smb-list",n);return(0,r.createElement)("div",u({},p.useBlockProps.save({className:c}),{"data-icon":l,"data-icon-color":i}),(0,r.createElement)("ul",null,(0,r.createElement)(p.RichText.Content,{value:o})))},deprecated:y};(e=>{if(!e)return;const{metadata:t,settings:n,name:o}=e;t&&(t.title&&(t.title=(0,c.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,c.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,c.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,i.registerBlockType)({name:o,...t},n)})(o)},184:function(e,t){var n;!function(){"use strict";var o={}.hasOwnProperty;function r(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var l=typeof n;if("string"===l||"number"===l)e.push(n);else if(Array.isArray(n)){if(n.length){var i=r.apply(null,n);i&&e.push(i)}}else if("object"===l)if(n.toString===Object.prototype.toString)for(var c in n)o.call(n,c)&&n[c]&&e.push(c);else e.push(n.toString())}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(n=function(){return r}.apply(t,[]))||(e.exports=n)}()}},t={};function n(o){var r=t[o];if(void 0!==r)return r.exports;var l=t[o]={exports:{}};return e[o](l,l.exports,n),l.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var o in t)n.o(t,o)&&!n.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(559)}();