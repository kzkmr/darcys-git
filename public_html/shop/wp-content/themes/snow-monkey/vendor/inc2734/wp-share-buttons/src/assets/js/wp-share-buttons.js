!function(){"use strict";class t{constructor(t){let e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};this.button=t,this.countComponent=this.button.querySelector(".wp-share-button__count"),this.buttonComponent=this.button.querySelector(".wp-share-button__button");const n={post_id:this.button.getAttribute("data-wp-share-buttons-postid")};this.params={};for(const t in n)this.params[t]=void 0!==e[t]?e[t]:n[t];this.button.getAttribute("data-wp-share-buttons-has-cache")||this.countComponent&&this.count(),this.popup()}count(){}popup(){}}class e{constructor(t){let e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"jsonp",n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};this.target=t,this.type=e,this.data=n}request(t){const e=new XMLHttpRequest,n=Object.keys(this.data).map((t=>`${t}=${this.data[t]}`)).join("&"),o=`${this.target}?${n}`;e.onreadystatechange=()=>{4===e.readyState&&200===e.status&&t.done(JSON.parse(e.response))},e.open("GET",o,!0),e.send(null)}}class n{constructor(t,e,n,o){t.addEventListener("click",(s=>{s.preventDefault(),window.open(t.getAttribute("href"),e,`width=${parseInt(n)}, height=${parseInt(o)}, menubar=no, toolbar=no, scrollbars=yes`)}),!1)}}class o extends t{count(){new e(inc2734_wp_share_buttons_facebook.endpoint,"json",{action:inc2734_wp_share_buttons_facebook.action,_ajax_nonce:inc2734_wp_share_buttons_facebook._ajax_nonce,post_id:this.params.post_id,url:this.params.url}).request({done:t=>this.countComponent.textContent=t.count})}popup(){new n(this.buttonComponent,"Share on Facebook",670,400)}}class s extends t{count(){new e(inc2734_wp_share_buttons_twitter.endpoint,"json",{action:inc2734_wp_share_buttons_twitter.action,_ajax_nonce:inc2734_wp_share_buttons_twitter._ajax_nonce,post_id:this.params.post_id,url:this.params.url}).request({done:t=>this.countComponent.textContent=t.count})}popup(){new n(this.buttonComponent,"Share on Twitter",550,400)}}class a extends t{count(){new e(inc2734_wp_share_buttons_hatena.endpoint,"json",{action:inc2734_wp_share_buttons_hatena.action,_ajax_nonce:inc2734_wp_share_buttons_hatena._ajax_nonce,post_id:this.params.post_id,url:this.params.url}).request({done:t=>this.countComponent.textContent=t.count})}popup(){new n(this.buttonComponent,"Hatena Bookmark",510,420)}}class c extends t{popup(){new n(this.buttonComponent,"Send to LINE",670,530)}}class r extends t{popup(){new n(this.buttonComponent,"Pocket",550,350)}}class u extends t{}class i extends t{count(){new e(inc2734_wp_share_buttons_feedly.endpoint,"json",{action:inc2734_wp_share_buttons_feedly.action,_ajax_nonce:inc2734_wp_share_buttons_feedly._ajax_nonce,post_id:this.params.post_id,url:this.params.url}).request({done:t=>this.countComponent.textContent=t.count})}}class p{constructor(t){document.querySelector(".wp-share-buttons-copy-message")||t.addEventListener("click",(()=>{const e=t.getAttribute("data-title"),n=t.getAttribute("data-url");let o=t.getAttribute("data-hashtags");if(o){o=o.split(",");for(let t=0;t<o.length;t++)o[t]=`#${o[t].trim()}`;o=o.join(" ")}const s=document.createElement("input"),a=`${e} ${n} ${o}`;s.value=a.trim(),s.style.position="fixed",s.style.top="100%",document.body.appendChild(s),s.select();const c=document.execCommand("copy");s.remove();const r=c?inc2734_wp_share_buttons.copy_success:inc2734_wp_share_buttons.copy_failed,u=document.createElement("div");return u.classList.add("wp-share-buttons-copy-message"),u.textContent=r,document.body.appendChild(u),setTimeout((()=>u.remove()),2e3),c}),!1)}}document.addEventListener("DOMContentLoaded",(()=>{const t=document.querySelectorAll(".wp-share-button--facebook");[].slice.call(t).forEach((t=>new o(t)));const e=document.querySelectorAll(".wp-share-button--twitter");[].slice.call(e).forEach((t=>new s(t)));const n=document.querySelectorAll(".wp-share-button--hatena");[].slice.call(n).forEach((t=>new a(t)));const l=document.querySelectorAll(".wp-share-button--line");[].slice.call(l).forEach((t=>new c(t)));const h=document.querySelectorAll(".wp-share-button--pocket");[].slice.call(h).forEach((t=>new r(t)));const _=document.querySelectorAll(".wp-share-button--pinterest");[].slice.call(_).forEach((t=>new u(t)));const d=document.querySelectorAll(".wp-share-button--feedly");[].slice.call(d).forEach((t=>new i(t)));const b=document.querySelectorAll(".wp-share-button--copy");[].slice.call(b).forEach((t=>new p(t)))}))}();
