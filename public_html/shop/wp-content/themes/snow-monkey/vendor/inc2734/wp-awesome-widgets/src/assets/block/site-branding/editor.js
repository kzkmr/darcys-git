!function(){"use strict";var e={n:function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,{a:n}),n},d:function(t,n){for(var i in n)e.o(n,i)&&!e.o(t,i)&&Object.defineProperty(t,i,{enumerable:!0,get:n[i]})},o:function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r:function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}},t={};e.r(t),e.d(t,{metadata:function(){return a},name:function(){return p},settings:function(){return u}});var n=window.wp.blocks,i=window.wp.i18n,r=window.wp.element,o=window.wp.primitives,s=(0,r.createElement)(o.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,r.createElement)(o.Path,{d:"M12 3c-5 0-9 4-9 9s4 9 9 9 9-4 9-9-4-9-9-9zm0 1.5c4.1 0 7.5 3.4 7.5 7.5v.1c-1.4-.8-3.3-1.7-3.4-1.8-.2-.1-.5-.1-.8.1l-2.9 2.1L9 11.3c-.2-.1-.4 0-.6.1l-3.7 2.2c-.1-.5-.2-1-.2-1.5 0-4.2 3.4-7.6 7.5-7.6zm0 15c-3.1 0-5.7-1.9-6.9-4.5l3.7-2.2 3.5 1.2c.2.1.5 0 .7-.1l2.9-2.1c.8.4 2.5 1.2 3.5 1.9-.9 3.3-3.9 5.8-7.4 5.8z"})),a=JSON.parse('{"name":"wp-awesome-widgets/site-branding","title":"[WPAW] Site branding","description":"","category":"widgets","textdomain":"inc2734-wp-awesome-widgets","attributes":{"description":{"type":"string"},"clientId":{"type":"string"}},"supports":{"anchor":true,"customClassName":false}}'),c=window.wp.serverSideRender,d=e.n(c),w=window.wp.blockEditor,l=window.wp.components;const{name:p}=a,u={icon:s,edit:function(e){let{setAttributes:t,attributes:n,clientId:o}=e;const{description:s}=n;return(0,r.useEffect)((()=>{n.clientId||t({clientId:o})}),[o]),(0,r.createElement)(r.Fragment,null,(0,r.createElement)(w.InspectorControls,null,(0,r.createElement)(l.PanelBody,{title:(0,i.__)("Block Settings","inc2734-wp-awesome-widgets")},(0,r.createElement)(l.TextareaControl,{label:(0,i.__)("Site description","inc2734-wp-awesome-widgets"),help:(0,i.__)("HTML use allowed.","inc2734-wp-awesome-widgets"),value:s,onChange:e=>t({description:e})}))),(0,r.createElement)(l.Disabled,null,(0,r.createElement)(d(),{block:"wp-awesome-widgets/site-branding",attributes:n})))},save:function(){return(0,r.createElement)("div",{"data-dynamic-block":"wp-awesome-widgets/site-branding","data-version":"1"})}};(e=>{if(!e)return;const{metadata:t,settings:r,name:o}=e;t&&(t.title&&(t.title=(0,i.__)(t.title,"inc2734-wp-awesome-widgets"),r.title=t.title),t.description&&(t.description=(0,i.__)(t.description,"inc2734-wp-awesome-widgets"),r.description=t.description),t.keywords&&(t.keywords=(0,i.__)(t.keywords,"inc2734-wp-awesome-widgets"),r.keywords=t.keywords)),(0,n.registerBlockType)({name:o,...t},r)})(t)}();