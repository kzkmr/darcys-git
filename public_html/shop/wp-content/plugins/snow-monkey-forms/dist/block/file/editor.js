!function(){"use strict";var e={d:function(t,n){for(var o in n)e.o(n,o)&&!e.o(t,o)&&Object.defineProperty(t,o,{enumerable:!0,get:n[o]})},o:function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r:function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}};!function(e,t,n){var o={};n.r(o),n.d(o,{metadata:function(){return a},name:function(){return _},settings:function(){return k}});var r=window.wp.blocks,l=window.wp.i18n,a=JSON.parse('{"apiVersion":2,"name":"snow-monkey-forms/control-file","category":"snow-monkey-forms","parent":["snow-monkey-forms/noparent"],"attributes":{"name":{"type":"string","default":""},"id":{"type":"string","default":""},"controlClass":{"type":"string","default":""},"description":{"type":"string","default":""},"validations":{"type":"string","default":"{}"}},"supports":{"customClassName":false},"style":"snow-monkey-forms/file","editorScript":"file:../../dist/block/file/editor.js"}'),s=window.wp.element;function i(){return i=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},i.apply(this,arguments)}var c=window.wp.blockEditor,m=window.wp.components,d=window.wp.compose;const u=e=>{let{value:t,onChange:n}=e;const o={};return""===t&&(o.borderColor="#d94f4f"),(0,s.createElement)(m.TextControl,{label:(0,l.__)("name","snow-monkey-forms"),help:(0,l.__)("Required. Input a unique machine-readable name.","snow-monkey-forms"),value:t,onChange:n,required:!0,style:o})},f=e=>{let{value:t,onChange:n}=e;return(0,s.createElement)(m.TextControl,{label:(0,l.__)("id","snow-monkey-forms"),value:t,onChange:n})},p=e=>{let{value:t,onChange:n}=e;return(0,s.createElement)(m.TextControl,{label:(0,l.__)("class","snow-monkey-forms"),help:(0,l.__)("Separate multiple classes with spaces.","snow-monkey-forms"),value:t,onChange:n})};var w=window.lodash,y=(0,d.createHigherOrderComponent)((e=>t=>{const{attributes:n,setAttributes:o}=t,{validations:r}=n;if(void 0===r)return(0,s.createElement)(e,t);const a=JSON.parse(r);return(0,s.createElement)(s.Fragment,null,(0,s.createElement)(c.InspectorControls,null,(0,s.createElement)(m.PanelBody,{title:(0,l.__)("Validation","snow-monkey-forms")},(0,s.createElement)(m.ToggleControl,{label:(0,l.__)("Required","snow-monkey-forms"),checked:!!a.required,onChange:e=>{o({validations:JSON.stringify((0,w.merge)(a,{required:e}))})}}))),(0,s.createElement)(e,t))}),"withValidations"),g=(0,d.compose)(y)((e=>{let{attributes:t,setAttributes:n}=e;const{name:o,id:r,controlClass:a,description:d}=t;(0,s.useEffect)((()=>{""===o&&n({name:`file-${((new Date).getTime()+Math.floor(8999*Math.random()+1e3)).toString(32)}`})}));const w=(0,c.useBlockProps)({className:"smf-placeholder"});return(0,s.createElement)(s.Fragment,null,(0,s.createElement)(c.InspectorControls,null,(0,s.createElement)(m.PanelBody,{title:(0,l.__)("Attributes","snow-monkey-forms")},(0,s.createElement)(u,{value:o,onChange:e=>n({name:e})}),(0,s.createElement)(f,{value:r,onChange:e=>n({id:e})}),(0,s.createElement)(p,{value:a,onChange:e=>n({controlClass:e})})),(0,s.createElement)(m.PanelBody,{title:(0,l.__)("Block settings","snow-monkey-forms")},(0,s.createElement)(m.TextControl,{label:(0,l.__)("Description","snow-monkey-forms"),value:d,onChange:e=>n({description:e})}))),(0,s.createElement)("div",i({},w,{"data-name":o}),(0,s.createElement)("div",{className:"smf-file-control"},(0,s.createElement)("label",{htmlFor:r||void 0},(0,s.createElement)("input",{type:"file",name:o,disabled:"disabled",id:r||void 0,className:`smf-file-control__control ${a}`}),(0,s.createElement)("span",{className:"smf-file-control__label"},(0,l.__)("Choose file","snow-monkey-forms")),(0,s.createElement)("span",{className:"smf-file-control__filename"},(0,l.__)("No file chosen","snow-monkey-forms")))),d&&(0,s.createElement)("div",{className:"smf-control-description"},d)))}));const{name:_}=a,k={title:(0,l.__)("File","snow-monkey-forms"),icon:function(){return(0,s.createElement)("svg",{viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",style:{color:"#cd162c"}},(0,s.createElement)("path",{d:"M12.4542 6.58541L12.6615 7H13.125H19C19.6904 7 20.25 7.55964 20.25 8.25V17.75C20.25 18.4404 19.6904 19 19 19H5C4.30964 19 3.75 18.4404 3.75 17.75V6C3.75 5.30964 4.30964 4.75 5 4.75H10.7639C11.2374 4.75 11.6702 5.0175 11.882 5.44098L12.4542 6.58541Z",fill:"none",stroke:"currentColor",strokeWidth:"1.5"}))},edit:g,save:()=>null};(e=>{if(!e)return;const{metadata:t,settings:n,name:o}=e;t&&(t.title&&(t.title=(0,l.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,l.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,l.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,r.registerBlockType)({name:o,...t},n)})(o)}(0,0,e)}();