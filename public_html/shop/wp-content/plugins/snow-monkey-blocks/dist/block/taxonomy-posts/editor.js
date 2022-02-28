!function(){"use strict";var e={n:function(t){var o=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(o,{a:o}),o},d:function(t,o){for(var n in o)e.o(o,n)&&!e.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:o[n]})},o:function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r:function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}};!function(e,t,o){var n={};o.r(n),o.d(n,{metadata:function(){return m},name:function(){return w},settings:function(){return _}});var l=window.wp.element,a=window.lodash,s=window.wp.blocks,r=(window.wp.richText,window.wp.i18n);const i=function(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null;return e=Number(e),(isNaN(e)||e<t)&&(e=t),null!==o&&e>o&&(e=o),e},c=e=>{const t=e.map((e=>({children:[],parent:null,...e}))),o=(0,a.groupBy)(t,"parent");if(o.null&&o.null.length)return t;const n=e=>e.map((e=>{const t=o[e.id];return{...e,children:t&&t.length?n(t):[]}}));return n(o[0]||[])};var m=JSON.parse('{"name":"snow-monkey-blocks/taxonomy-posts","title":"Taxonomy posts","description":"You can display recent posts linked to any taxonomy.","category":"smb","attributes":{"taxonomy":{"type":"string","default":null},"termId":{"type":"number","default":0},"postsPerPage":{"type":"number","default":6},"layout":{"type":"string","default":"rich-media"},"ignoreStickyPosts":{"type":"boolean","default":true},"smCols":{"type":"number","default":0},"noPostsText":{"type":"string","default":""},"itemTitleTagName":{"type":"string","default":"h3"},"itemThumbnailSizeSlug":{"type":"string","default":"large"},"forceDisplayItemMeta":{"type":"boolean","default":false},"forceDisplayItemTerms":{"type":"boolean","default":false},"categoryLabelTaxonomy":{"type":"string","default":""},"arrows":{"type":"boolean","default":false},"dots":{"type":"boolean","default":true},"interval":{"type":"number","default":0},"anchor":{"type":"string","default":""}},"supports":{"anchor":true},"example":{"attributes":{"postsPerPage":3,"taxonomy":"category","termId":0}},"editorScript":"file:../../dist/block/taxonomy-posts/editor.js"}'),y=(0,l.createElement)("svg",{viewBox:"0 0 24 24"},(0,l.createElement)("rect",{x:"3",y:"6.5",width:"4",height:"1"}),(0,l.createElement)("rect",{x:"9",y:"6.5",width:"13",height:"1"}),(0,l.createElement)("rect",{x:"3",y:"11.5",width:"4",height:"1"}),(0,l.createElement)("rect",{x:"9",y:"11.5",width:"13",height:"1"}),(0,l.createElement)("rect",{x:"3",y:"16.5",width:"4",height:"1"}),(0,l.createElement)("rect",{x:"9",y:"16.5",width:"13",height:"1"})),u=window.wp.data,d=window.wp.serverSideRender,b=o.n(d),k=window.wp.blockEditor,g=window.wp.components,p=[{attributes:{...m.attributes,myAnchor:{type:"string",default:""}},migrate:e=>(e.anchor=e.myAnchor,e),save:()=>null}];const{name:w}=m,_={icon:{foreground:"#cd162c",src:y},keywords:[(0,r.__)("Posts list","snow-monkey-blocks"),(0,r.__)("Recent posts","snow-monkey-blocks"),(0,r.__)("Latest posts","snow-monkey-blocks")],edit:function(e){let{attributes:t,setAttributes:o}=e;const{taxonomy:n,termId:s,postsPerPage:m,layout:y,ignoreStickyPosts:d,smCols:p,noPostsText:w,itemTitleTagName:_,itemThumbnailSizeSlug:h,forceDisplayItemMeta:f,forceDisplayItemTerms:x,categoryLabelTaxonomy:v,arrows:T,dots:E,interval:C}=t,{taxonomiesTerms:S,taxonomies:P}=(0,u.useSelect)((e=>{const{getTaxonomies:t,getEntityRecords:o}=e("core"),n=(t({per_page:-1})||[]).filter((e=>e.visibility.show_ui)),l=n.map((e=>{const t=o("taxonomy",e.slug,{per_page:-1})||[];return 0<t.length?{taxonomy:e.slug,terms:t}:{}})).filter((e=>e));return{taxonomiesTerms:l,taxonomies:n}}),[]),I=(0,u.useSelect)((e=>{const{getSettings:t}=e("core/block-editor"),{imageSizes:o}=t();return o.map((e=>({value:e.slug,label:e.name})))}),[]),D=(0,l.useMemo)((()=>{const e=P.map((e=>({value:e.slug,label:e.name})));return e.unshift({value:"",label:(0,r.__)("Default (Taxonomy selected in this block)","snow-monkey-blocks")}),e}),[P]),N=(0,a.find)(S,{taxonomy:n}),L=N?(0,a.find)(N.terms,["id",i(s)]):[],B=["h2","h3","h4"];return(0,l.createElement)(l.Fragment,null,(0,l.createElement)(k.InspectorControls,null,(0,l.createElement)(g.PanelBody,{title:(0,r.__)("Block settings","snow-monkey-blocks")},!S.length&&(0,l.createElement)(g.BaseControl,{label:(0,r.__)("Loading taxonomies…","snow-monkey-blocks"),id:"snow-monkey-blocks/taxonomy-posts/taxonomies"},(0,l.createElement)(g.Spinner,null)),S.map((e=>{const t=(0,a.find)(P,["slug",e.taxonomy]);return!!t&&(0,l.createElement)(g.TreeSelect,{key:`${t.slug}-${s}`,label:t.name,noOptionLabel:"-",onChange:e=>{o({taxonomy:t.slug,termId:i(e)})},selectedId:s,tree:c(e.terms)})})),(0,l.createElement)(g.RangeControl,{label:(0,r.__)("Number of posts","snow-monkey-blocks"),value:m,onChange:e=>o({postsPerPage:i(e,1,12)}),min:"1",max:"12"}),(0,l.createElement)(g.SelectControl,{label:(0,r.__)("Layout","snow-monkey-blocks"),value:y,onChange:e=>o({layout:e}),options:[{value:"rich-media",label:(0,r.__)("Rich media","snow-monkey-blocks")},{value:"simple",label:(0,r.__)("Simple","snow-monkey-blocks")},{value:"text",label:(0,r.__)("Text","snow-monkey-blocks")},{value:"text2",label:(0,r.__)("Text 2","snow-monkey-blocks")},{value:"panel",label:(0,r.__)("Panels","snow-monkey-blocks")},{value:"carousel",label:(0,r.sprintf)(// translators: %1$s: Layout
(0,r.__)("Carousel (%1$s)","snow-monkey-blocks"),(0,r.__)("Rich media","snow-monkey-blocks"))},{value:"large-image",label:(0,r.__)("Large image","snow-monkey-blocks")}]}),"carousel"===y&&(0,l.createElement)(l.Fragment,null,(0,l.createElement)(g.ToggleControl,{label:(0,r.__)("Display arrows","snow-monkey-blocks"),checked:T,onChange:e=>o({arrows:e})}),(0,l.createElement)(g.ToggleControl,{label:(0,r.__)("Display dots","snow-monkey-blocks"),checked:E,onChange:e=>o({dots:e})}),(0,l.createElement)(g.RangeControl,{label:(0,r.__)("Autoplay Speed in seconds","snow-monkey-blocks"),help:(0,r.__)('If "0", no scroll.',"snow-monkey-blocks"),value:C,onChange:e=>o({interval:i(e,0,10)}),min:"0",max:"10"})),(0,l.createElement)(g.BaseControl,{label:(0,r.__)("Title tag of each items","snow-monkey-blocks"),id:"snow-monkey-blocks/taxonomy-posts/item-title-tag-name"},(0,l.createElement)("div",{className:"smb-list-icon-selector"},(0,a.times)(B.length,(e=>{const t=_===B[e];return(0,l.createElement)(g.Button,{isPrimary:t,isSecondary:!t,onClick:()=>o({itemTitleTagName:B[e]}),key:e},B[e])})))),(0,l.createElement)(g.SelectControl,{label:(0,r.__)("Images size of each items","snow-monkey-blocks"),value:h,options:I,onChange:e=>o({itemThumbnailSizeSlug:e})}),(0,l.createElement)(g.ToggleControl,{label:(0,r.__)("Force display meta of each items","snow-monkey-blocks"),help:(0,r.__)("If it's already displayed, this setting will be ignored.","snow-monkey-blocks"),checked:f,onChange:e=>o({forceDisplayItemMeta:e})}),(0,l.createElement)(g.ToggleControl,{label:(0,r.__)("Force display category label of each items","snow-monkey-blocks"),help:(0,r.__)("If it's already displayed, this setting will be ignored.","snow-monkey-blocks"),checked:x,onChange:e=>o({forceDisplayItemTerms:e})}),(0,l.createElement)(g.SelectControl,{label:(0,r.__)("Taxonomy to use for the category label","snow-monkey-blocks"),help:(0,r.__)("If no category labels are displayed, this setting will be ignored.","snow-monkey-blocks"),value:v,options:D,onChange:e=>o({categoryLabelTaxonomy:e})}),("rich-media"===y||"panel"===y)&&(0,l.createElement)(g.SelectControl,{label:(0,r.__)("Number of columns displayed on mobile device","snow-monkey-blocks"),value:p,onChange:e=>o({smCols:i(e)}),options:[{value:0,label:(0,r.__)("Default","snow-monkey-blocks")},{value:1,label:(0,r.__)("1 column","snow-monkey-blocks")},{value:2,label:(0,r.__)("2 columns","snow-monkey-blocks")}]}),(0,l.createElement)(g.ToggleControl,{label:(0,r.__)("Ignore sticky posts","snow-monkey-blocks"),checked:d,onChange:e=>o({ignoreStickyPosts:e})}),(0,l.createElement)(g.TextareaControl,{label:(0,r.__)("Text if no posts matched","snow-monkey-blocks"),help:(0,r.__)("Allow HTML","snow-monkey-blocks"),value:w||"",onChange:e=>o({noPostsText:e})}))),L&&N?(0,l.createElement)(g.Disabled,null,(0,l.createElement)(b(),{block:"snow-monkey-blocks/taxonomy-posts",attributes:t})):(0,l.createElement)(g.Placeholder,{icon:"editor-ul",label:(0,r.__)("Taxonomy posts","snow-monkey-blocks")},(0,l.createElement)(g.Spinner,null)))},save:function(){return(0,l.createElement)("div",{"data-dynamic-block":"snow-monkey-blocks/taxonomy-posts","data-version":"2"})},deprecated:p};(e=>{if(!e)return;const{metadata:t,settings:o,name:n}=e;t&&(t.title&&(t.title=(0,r.__)(t.title,"snow-monkey-blocks"),o.title=t.title),t.description&&(t.description=(0,r.__)(t.description,"snow-monkey-blocks"),o.description=t.description),t.keywords&&(t.keywords=(0,r.__)(t.keywords,"snow-monkey-blocks"),o.keywords=t.keywords)),(0,s.registerBlockType)({name:n,...t},o)})(n)}(0,0,e)}();