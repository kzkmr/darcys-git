!function(){var e={171:function(e,t,n){"use strict";var o={};n.r(o),n.d(o,{metadata:function(){return i},name:function(){return f},settings:function(){return h}});var r=window.wp.element,l=(window.lodash,window.wp.blocks),a=(window.wp.richText,window.wp.i18n),i=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/limited-datetime","title":"Limited DateTime","description":"Only the set period is displayed","category":"smb","attributes":{"isUseStartDate":{"type":"boolean","default":false},"startDate":{"type":"string","default":null},"isUseEndDate":{"type":"boolean","default":false},"endDate":{"type":"string","default":null}},"supports":{"alignWide":false,"customClassName":false,"className":false},"example":{"innerBlocks":[{"name":"core/paragraph","attributes":{"content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"}}]},"editorStyle":"snow-monkey-blocks/limited-datetime/editor","editorScript":"file:../../dist/block/limited-datetime/editor.js"}'),s=(0,r.createElement)("svg",{viewBox:"0 0 24 24"},(0,r.createElement)("path",{d:"M3,4V20a1,1,0,0,0,1,1H20a1,1,0,0,0,1-1V4a1,1,0,0,0-1-1H4A1,1,0,0,0,3,4ZM19.5,20H4.5a.5.5,0,0,1-.5-.5V7.5A.5.5,0,0,1,4.5,7h15a.5.5,0,0,1,.5.5v12A.5.5,0,0,1,19.5,20Z"}),(0,r.createElement)("rect",{x:"5.5",y:"10.5",width:"2",height:"2",rx:"0.5"}),(0,r.createElement)("rect",{x:"9.17",y:"10.5",width:"2",height:"2",rx:"0.5"}),(0,r.createElement)("rect",{x:"12.83",y:"10.5",width:"2",height:"2",rx:"0.5"}),(0,r.createElement)("rect",{x:"16.5",y:"10.5",width:"2",height:"2",rx:"0.5"}),(0,r.createElement)("rect",{x:"5.5",y:"14.5",width:"2",height:"2",rx:"0.5"}),(0,r.createElement)("rect",{x:"9.17",y:"14.5",width:"2",height:"2",rx:"0.5"}),(0,r.createElement)("rect",{x:"12.83",y:"14.5",width:"2",height:"2",rx:"0.5"}),(0,r.createElement)("rect",{x:"16.5",y:"14.5",width:"2",height:"2",rx:"0.5"})),c=n(184),d=n.n(c),m=window.moment,u=n.n(m),p=window.wp.blockEditor,w=window.wp.components,k=window.wp.data,y=window.wp.date;function b(e){let{currentDate:t,onChange:n,onReset:o}=e;const l=(0,y.__experimentalGetSettings)(),i=/a(?!\\)/i.test(l.formats.time.toLowerCase().replace(/\\\\/g,"").split("").reverse().join(""));return(0,r.createElement)("div",{className:"smb-date-time-picker"},(0,r.createElement)(w.DateTimePicker,{currentDate:t,onChange:n,is12Hour:i}),(0,r.createElement)("div",{className:"smb-date-time-picker__action"},(0,r.createElement)("div",null,t),(0,r.createElement)(w.Button,{isSmall:!0,onClick:o},(0,a.__)("Clear","snow-monkey-editor"))))}const{name:f}=i,h={icon:{foreground:"#cd162c",src:s},edit:function(e){let{attributes:t,setAttributes:n,className:o,clientId:l}=e;const{isUseStartDate:i,startDate:s,isUseEndDate:c,endDate:m}=t,y=(0,k.useSelect)((e=>{const{getBlock:t}=e("core/block-editor"),n=t(l);return!(!n||!n.innerBlocks.length)}),[l]),f=d()("smb-limited-datetime",o),h=(0,p.useBlockProps)(),_=(0,p.useInnerBlocksProps)({className:f},{renderAppender:y?void 0:p.InnerBlocks.ButtonBlockAppender});let g=(0,a.__)("Not been set.","snow-monkey-blocks");i&&(g=null!==s?u()(s).format("YYYY/MM/DD ddd HH:mm"):(0,a.__)("Not initialized properly.","snow-monkey-blocks"));let E=(0,a.__)("Not been set.","snow-monkey-blocks");return c&&(E=null!==m?u()(m).format("YYYY/MM/DD ddd HH:mm"):(0,a.__)("Not initialized properly.","snow-monkey-blocks")),(0,r.createElement)(r.Fragment,null,(0,r.createElement)(p.InspectorControls,null,(0,r.createElement)(w.PanelBody,{title:(0,a.__)("Block settings","snow-monkey-blocks")},(0,r.createElement)(w.BaseControl,{label:(0,a.__)("Start datetime","snow-monkey-blocks"),id:"snow-monkey-blocks/limited-datetime/is-use-start-date"},(0,r.createElement)(w.CheckboxControl,{label:(0,a.__)("Use start datetime","snow-monkey-blocks"),checked:i,onChange:e=>n({isUseStartDate:e})}),(0,r.createElement)(b,{currentDate:s,onChange:e=>n({startDate:e}),onReset:()=>n({startDate:null})})),(0,r.createElement)(w.BaseControl,{label:(0,a.__)("End datetime","snow-monkey-blocks"),id:"snow-monkey-blocks/limited-datetime/is-use-end-date"},(0,r.createElement)(w.CheckboxControl,{label:(0,a.__)("Use end datetime","snow-monkey-blocks"),checked:c,onChange:e=>n({isUseEndDate:e})}),(0,r.createElement)(b,{currentDate:m,onChange:e=>n({endDate:e}),onReset:()=>n({startDate:null})})))),(0,r.createElement)("div",h,(0,r.createElement)(w.Placeholder,{className:"smb-limited-datetime-placeholder",icon:"calendar-alt",label:(0,a.__)("Only the set period is displayed","snow-monkey-blocks")},(0,r.createElement)("div",{className:"c-row c-row--lg-margin"},(0,r.createElement)("div",{className:"c-row__col c-row__col--1-1 c-row__col--lg-1-2"},(0,r.createElement)("dl",null,(0,r.createElement)("dt",null,(0,a.__)("Start datetime","snow-monkey-blocks")),(0,r.createElement)("dd",null,g))),(0,r.createElement)("div",{className:"c-row__col c-row__col--1-1 c-row__col--lg-1-2"},(0,r.createElement)("dl",null,(0,r.createElement)("dt",null,(0,a.__)("End datetime","snow-monkey-blocks")),(0,r.createElement)("dd",null,E))))),(0,r.createElement)("div",_)))},save:function(){return(0,r.createElement)(p.InnerBlocks.Content,null)}};(e=>{if(!e)return;const{metadata:t,settings:n,name:o}=e;t&&(t.title&&(t.title=(0,a.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,a.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,a.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,l.registerBlockType)({name:o,...t},n)})(o)},184:function(e,t){var n;!function(){"use strict";var o={}.hasOwnProperty;function r(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var l=typeof n;if("string"===l||"number"===l)e.push(n);else if(Array.isArray(n)){if(n.length){var a=r.apply(null,n);a&&e.push(a)}}else if("object"===l)if(n.toString===Object.prototype.toString)for(var i in n)o.call(n,i)&&n[i]&&e.push(i);else e.push(n.toString())}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(n=function(){return r}.apply(t,[]))||(e.exports=n)}()}},t={};function n(o){var r=t[o];if(void 0!==r)return r.exports;var l=t[o]={exports:{}};return e[o](l,l.exports,n),l.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var o in t)n.o(t,o)&&!n.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(171)}();