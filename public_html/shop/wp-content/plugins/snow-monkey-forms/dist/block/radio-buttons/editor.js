!function(){var e={109:function(e,t,n){"use strict";var o={};n.r(o),n.d(o,{metadata:function(){return l},name:function(){return _},settings:function(){return k}});var r=window.wp.blocks,a=window.wp.i18n,l=JSON.parse('{"apiVersion":2,"name":"snow-monkey-forms/control-radio-buttons","category":"snow-monkey-forms","parent":["snow-monkey-forms/noparent"],"attributes":{"name":{"type":"string","default":""},"value":{"type":"string","default":""},"disabled":{"type":"boolean","default":false},"options":{"type":"string","default":""},"direction":{"type":"string","default":""},"description":{"type":"string","default":""},"validations":{"type":"string","default":"{}"}},"supports":{"customClassName":false},"style":"snow-monkey-forms/radio-buttons","editorScript":"file:../../dist/block/radio-buttons/editor.js"}'),s=window.wp.element;function i(){return i=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},i.apply(this,arguments)}var c=n(184),u=n.n(c),m=window.wp.blockEditor,d=window.wp.components,f=window.wp.compose;const p=e=>{let{value:t,onChange:n}=e;const o={};return""===t&&(o.borderColor="#d94f4f"),(0,s.createElement)(d.TextControl,{label:(0,a.__)("name","snow-monkey-forms"),help:(0,a.__)("Required. Input a unique machine-readable name.","snow-monkey-forms"),value:t,onChange:n,required:!0,style:o})},y=e=>{let{value:t,onChange:n,multiple:o=!1}=e;const r=o?d.TextareaControl:d.TextControl;return(0,s.createElement)(r,{label:(0,a.__)("value","snow-monkey-forms"),help:(0,a.__)("Optional. Initial value.","snow-monkey-forms"),value:t,onChange:n})},v=e=>{let{value:t,onChange:n}=e;const o={};return""===t&&(o.borderColor="#d94f4f"),(0,s.createElement)(d.TextareaControl,{label:(0,a.__)("options","snow-monkey-forms"),value:t,help:(0,a.sprintf)(// translators: %1$s: line-break-char
(0,a.__)('Required. Enter in the following format: "value" : "label"%1$s or value%1$s',"snow-monkey-forms"),"↵"),onChange:n,required:!0,style:o})};var b=window.lodash;var w=(0,f.createHigherOrderComponent)((e=>t=>{const{attributes:n,setAttributes:o}=t,{validations:r}=n;if(void 0===r)return(0,s.createElement)(e,t);const l=JSON.parse(r);return(0,s.createElement)(s.Fragment,null,(0,s.createElement)(m.InspectorControls,null,(0,s.createElement)(d.PanelBody,{title:(0,a.__)("Validation","snow-monkey-forms")},(0,s.createElement)(d.ToggleControl,{label:(0,a.__)("Required","snow-monkey-forms"),checked:!!l.required,onChange:e=>{o({validations:JSON.stringify((0,b.merge)(l,{required:e}))})}}))),(0,s.createElement)(e,t))}),"withValidations"),g=(0,f.compose)(w)((e=>{let{attributes:t,setAttributes:n}=e;const{name:o,value:r,options:l,direction:c,description:f}=t;(0,s.useEffect)((()=>{""===o&&n({name:`radio-buttons-${((new Date).getTime()+Math.floor(8999*Math.random()+1e3)).toString(32)}`}),""===l&&n({options:'value1\n"value2" : "label2"\n"value3" : "label3"'})}));const w=function(e){const t=e.replace(/\r?\n/g,"\n").split("\n");return(0,b.uniqBy)(t.map((e=>{const t=(()=>{try{return JSON.parse(`{ ${e} }`)}catch(t){return{[e]:e}}})();return{value:Object.keys(t)[0],label:Object.values(t)[0]}})),"value").map((e=>{const t={};return t[e.value]=e.label,t}))}(l),g=u()("smf-radio-buttons-control",{[`smf-radio-buttons-control--${c}`]:!!c}),_=(0,m.useBlockProps)({className:"smf-placeholder"});return(0,s.createElement)(s.Fragment,null,(0,s.createElement)(m.InspectorControls,null,(0,s.createElement)(d.PanelBody,{title:(0,a.__)("Attributes","snow-monkey-forms")},(0,s.createElement)(p,{value:o,onChange:e=>n({name:e})}),(0,s.createElement)(v,{value:l,onChange:e=>n({options:e})}),(0,s.createElement)(y,{value:r,onChange:e=>n({value:e})})),(0,s.createElement)(d.PanelBody,{title:(0,a.__)("Block settings","snow-monkey-forms")},(0,s.createElement)(d.SelectControl,{label:(0,a.__)("Direction","snow-monkey-forms"),value:c,options:[{value:"",label:(0,a.__)("Default","snow-monkey-forms")},{value:"horizontal",label:(0,a.__)("Horizontal","snow-monkey-forms")},{value:"vertical",label:(0,a.__)("Vertical","snow-monkey-forms")}],onChange:e=>n({direction:e})}),(0,s.createElement)(d.TextControl,{label:(0,a.__)("Description","snow-monkey-forms"),value:f,onChange:e=>n({description:e})}))),(0,s.createElement)("div",i({},_,{"data-name":o}),(0,s.createElement)("div",{className:g},(0,s.createElement)("div",{className:"smf-radio-buttons-control__control"},w.map((e=>{const t=Object.keys(e)[0],n=Object.values(e)[0];return(0,s.createElement)("div",{className:"smf-label",key:t},(0,s.createElement)("label",{htmlFor:`${o}-${t}`},(0,s.createElement)("span",{className:"smf-radio-button-control"},(0,s.createElement)("input",{type:"radio",name:o,value:t,checked:t===r,disabled:"disabled",className:"smf-radio-button-control__control",id:`${o}-${t}`}),(0,s.createElement)("span",{className:"smf-radio-button-control__label"},n))))})))),f&&(0,s.createElement)("div",{className:"smf-control-description"},f)))}));const{name:_}=l,k={title:(0,a.__)("Radio buttons","snow-monkey-forms"),icon:function(){return(0,s.createElement)("svg",{viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",style:{color:"#cd162c"}},(0,s.createElement)("circle",{cx:"12",cy:"12",r:"3",fill:"currentColor"}),(0,s.createElement)("circle",{cx:"12",cy:"12",r:"8",fill:"none",stroke:"currentColor",strokeWidth:"1.5"}))},edit:g,save:()=>null};(e=>{if(!e)return;const{metadata:t,settings:n,name:o}=e;t&&(t.title&&(t.title=(0,a.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,a.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,a.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,r.registerBlockType)({name:o,...t},n)})(o)},184:function(e,t){var n;!function(){"use strict";var o={}.hasOwnProperty;function r(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var a=typeof n;if("string"===a||"number"===a)e.push(n);else if(Array.isArray(n)){if(n.length){var l=r.apply(null,n);l&&e.push(l)}}else if("object"===a)if(n.toString===Object.prototype.toString)for(var s in n)o.call(n,s)&&n[s]&&e.push(s);else e.push(n.toString())}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(n=function(){return r}.apply(t,[]))||(e.exports=n)}()}},t={};function n(o){var r=t[o];if(void 0!==r)return r.exports;var a=t[o]={exports:{}};return e[o](a,a.exports,n),a.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var o in t)n.o(t,o)&&!n.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(109)}();