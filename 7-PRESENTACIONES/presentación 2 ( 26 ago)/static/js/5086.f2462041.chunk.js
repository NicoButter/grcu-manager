"use strict";(self.webpackChunk_genially_view_client=self.webpackChunk_genially_view_client||[]).push([[5086],{89690:(e,t,n)=>{n.d(t,{Z:()=>a});var i=n(45992),o=n(62772),r=n(11833);const a=e=>{let{title:t,frontImageSrc:n,coverImageSrc:a,fitImages:s,flipped:l,burned:d,onClick:c}=e;const u=Boolean(d),m=Boolean(l);return(0,i.jsxs)(r.Ox,{role:"button",$burned:u,$flipped:m,onClick:e=>{e.stopPropagation(),c&&c()},"aria-label":`Card showing ${m?"front":"back"} side with title: ${t}`,"aria-disabled":u,tabIndex:u?-1:0,children:[(0,i.jsx)("img",{style:{opacity:m?1:0,position:"absolute",top:0,left:0,width:"100%",height:"100%",objectFit:s?"contain":"cover",transition:`opacity ${r.uD}ms steps(1)`},src:n,alt:"front"}),(0,i.jsx)("img",{style:{opacity:m?0:1,position:"absolute",top:0,left:0,width:"100%",height:"100%",objectFit:s?"contain":"cover",transition:`opacity ${r.uD}ms steps(1)`},src:a,alt:"cover"}),t&&(0,i.jsx)(r.aW,{hidden:!m,children:(0,i.jsx)(o.m_,{text:t,placement:o.m_.Position.TOP,fallbackPlacements:[o.m_.Position.TOP],renderReferencePortalNode:document.querySelector("body"),children:(0,i.jsx)(r.hE,{"data-testid":"card-title",children:t})})})]})}},11833:(e,t,n)=>{n.d(t,{Ox:()=>l,aW:()=>a,hE:()=>s,rl:()=>o,uD:()=>r});var i=n(37577);const o=1e3,r=o/3.4,a=i.Ay.div({display:"flex",justifyContent:"center",alignItems:"center",flexShrink:0,position:"absolute",paddingLeft:"12px",paddingRight:"12px",bottom:0,left:0,userSelect:"none",minHeight:"25%",top:"75%",width:"100%",backgroundColor:"rgba(18,18,18,0.5)"}),s=i.Ay.p({color:"white",fontSize:12,textAlign:"center",fontStyle:"normal",fontWeight:400,lineHeight:"16px",overflow:"hidden",textOverflow:"ellipsis",wordWrap:"break-word",whiteSpace:"nowrap",pointerEvents:"none"}),l=i.Ay.div`
  @keyframes rotate-out {
    0% {
      transform: rotateY(0deg);
    }
    33% {
      transform: rotateY(90deg);
    }
    100% {
      transform: rotateY(0deg);
    }
  }

  @keyframes rotate-in {
    0% {
      transform: rotateY(0deg);
    }
    33% {
      transform: rotateY(90deg);
    }
    100% {
      transform: rotateY(0deg);
    }
  }

  @keyframes pulse {
    0% {
      transform: scale(1);
    }
    12% {
      transform: scale(1.05, 1.05);
    }
    40% {
      transform: scale(1.05, 1.05);
    }
    100% {
      transform: scale(1);
    }
  }

  position: relative;
  overflow: hidden;
  flex-shrink: 0;
  width: 100%;
  height: 100%;
  container-type: size;

  cursor: ${e=>{let{$flipped:t,$burned:n}=e;return t||n?"default":"pointer"}};

  animation-name: ${e=>{let{$flipped:t}=e;return t?"rotate-out":"rotate-in"}}
    ${e=>{let{$burned:t}=e;return t?",pulse":""}};
  animation-duration: ${o}ms;
  animation-delay: 0ms, ${o}ms;
  animation-iteration-count: 1;
  animation-timing-function: ease-out, ease-in-out;
  perspective: 1500px;

  border-radius: 9%;
  @supports (container-type: size) {
    border-radius: 6cqmin;
  }

  /* HACK: We need to set border as important because .genially-embed is reseting our borders in the View */
  border: 1px solid
    ${e=>{let{theme:t,$flipped:n}=e;return n?t.color.border.primary.disabled():t.color.border.primary.default()}} !important;
  outline: 1px white solid;

  filter: ${e=>{let{$flipped:t}=e;return t?"":"drop-shadow(0px 1px 4px rgba(0, 15, 51, 0.2))"}};

  &:hover {
    filter: ${e=>{let{$flipped:t}=e;return t?"":"drop-shadow(rgba(0, 15, 51, 0.3) 0px 1px 8px)"}};
    border-color: ${e=>{let{theme:t,$flipped:n}=e;return n?t.color.border.primary.disabled():t.color.border.primary.hover()}} !important;
  }

  ${a} {
    visibility: ${e=>{let{$flipped:t}=e;return t?"initial":"hidden"}};
    transition: visibility ${r}ms steps(1);
    z-index: 1;
  }

  &:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    z-index: 2;
    width: 100%;
    height: 100%;
    opacity: ${e=>{let{$burned:t}=e;return t?"0.4":"0"}};
    transition: opacity ${o}ms steps(1);
    transition-delay: ${o}ms;
    background-color: white;
    pointer-events: none;
  }
`},56292:(e,t,n)=>{n.d(t,{x:()=>c});var i=n(45992),o=n(40671),r=n(99049),a=n(76838),s=n(37577);const l=s.Ay.div`
  container-type: size;
  height: 100%;
  padding: 8px;
`,d=s.Ay.div`
  --contained-gap: 16px;

  display: grid;
  grid-template-columns: repeat(${e=>e.numColumns}, minmax(0, 1fr));
  grid-template-rows: repeat(${e=>e.numRows}, 1fr);
  grid-auto-flow: column;
  height: 100%;
  gap: var(--contained-gap);

  @supports (container-type: size) {
    --contained-gap: 4cqmin;
  }
`,c=(s.Ay.canvas({width:"100%",height:"100%",pointerEvents:"none",position:"absolute",top:0,left:0,zIndex:3}),e=>{let{items:t,renderItem:n,keyExtractor:s,getComputedStyles:c,forcedRows:u}=e;const m=(0,a.f)(t.length,u);return(0,i.jsx)(l,{children:(0,i.jsx)(d,{numColumns:m.numColumns,numRows:m.numRows,children:(0,i.jsx)(o.N,{children:t.map(((e,t)=>(0,i.jsx)(r.P.div,{layout:!0,style:c?c(e,t):void 0,initial:{opacity:0,scale:.7},animate:{opacity:1,scale:1},transition:{type:"spring",ease:"easeInOut",stiffness:30,damping:10},"data-testid":`grid-item-${s(e)}`,children:n(e)},s(e))))})})})})},30555:(e,t,n)=>{n.d(t,{B:()=>r,u:()=>s});var i=n(54072);const o=e=>null!==e,r=e=>{if(e&&"action"in e){const{action:t}=e;return t&&"source"in t&&t.source?t.source:""}if(e&&"data"in e){const{data:t}=e;return t&&"source"in t&&t.source?t.source:""}return""},a=(e,t)=>{var n;const i=null===(n=e.image)||void 0===n?void 0:n.source,o=r(e.audio);return i?{id:t,src:i,title:e.title,altText:e.image.altText||"",audioSource:o}:null},s=function(e){let t=arguments.length>1&&void 0!==arguments[1]&&arguments[1];return e.flatMap((e=>{const n=(0,i.Ak)(),o=a(e,`${n}-original`),s=t?a(e,`${n}-pair`):((e,t)=>{var n,i;const o=null===(n=e.imagePair)||void 0===n?void 0:n.source;if(!o)return null;const a=r(e.audioPair);return{id:t,src:o,title:e.titlePair||e.title,altText:(null===(i=e.imagePair)||void 0===i?void 0:i.altText)||"",audioSource:a}})(e,`${n}-pair`);return[o,s]})).filter(o)}},76838:(e,t,n)=>{n.d(t,{f:()=>o,v:()=>i});const i=e=>{if("auto"===e)return;const t=Number(e);if(!Number.isNaN(t))return t;console.warn("Cannot parse row distribution. Setting to auto",e)},o=(e,t)=>t?((e,t)=>e<t?{numColumns:1,numRows:e}:{numColumns:Math.ceil(e/t),numRows:t})(e,t):(e=>{if(e<4)return{numColumns:1,numRows:e};let t=4;for(;e%t!==0&&t<7;)t+=1;return{numColumns:t,numRows:Math.ceil(e/t)}})(e)},22705:(e,t,n)=>{n.r(t),n.d(t,{geniallyFindThePairViewScript:()=>C});var i=n(45992),o=n(10285),r=n(66264),a=n(84054),s=n(41381),l=n(17588),d=n(37577),c=n(89690),u=n(56292);var m;!function(e){e.FACEDOWN="faceDown",e.FACEUP="faceUp",e.BURNED="burned"}(m||(m={}));const p=e=>e.replace("-original","-pair");var f=n(11833);const g=(e,t)=>{const n=e%2===1,i=t%2===1;return n&&!i?1:!n&&i?-1:e-t},h=e=>{let{theme:t,images:n,coverImageSrc:o,fitImages:r,rowsDitributionFromConfig:a,onSuccess:s,onFailure:h,onGameWon:b,onFaceUp:v}=e;const{shuffledCards:y,isFaceUp:w,isBurned:x,onPick:C}=((e,t,n,i,o)=>{const r=(0,l.useMemo)((()=>{const t=e.map((e=>{return Object.assign(Object.assign({},e),{id:e.id,pairId:e.id.includes("-pair")?(t=e.id,t.replace("-pair","-original")):p(e.id)});var t}));for(let e=t.length-1;e>0;e-=1){const n=Math.floor(Math.random()*(e+1));[t[e],t[n]]=[t[n],t[e]]}return t}),[e]),[a,s]=(0,l.useState)((()=>{const e=new Map;return r.forEach((t=>{e.set(t.id,{id:t.id,status:m.FACEDOWN,pairId:t.pairId})})),e})),d=(0,l.useCallback)((e=>{var t;return(null===(t=a.get(e))||void 0===t?void 0:t.status)===m.FACEUP}),[a]),c=(0,l.useCallback)((e=>{var t;return(null===(t=a.get(e))||void 0===t?void 0:t.status)===m.BURNED}),[a]);return{shuffledCards:r,isFaceUp:d,isBurned:c,onPick:e=>{const r=a.get(e);if(r.status!==m.FACEDOWN)return;const l=[...a.values()].filter((e=>e.status===m.FACEUP));if(0===l.length)a.set(r.id,Object.assign(Object.assign({},r),{status:m.FACEUP}));else if(1===l.length){const e=l[0];e.pairId===r.id?(a.set(e.id,Object.assign(Object.assign({},e),{status:m.BURNED})),a.set(r.id,Object.assign(Object.assign({},r),{status:m.BURNED})),t()):(a.set(r.id,Object.assign(Object.assign({},r),{status:m.FACEUP})),n())}else 2===l.length&&(l.forEach((e=>{a.set(e.id,Object.assign(Object.assign({},e),{status:m.FACEDOWN}))})),a.set(r.id,Object.assign(Object.assign({},r),{status:m.FACEUP})));o(r.id),s(new Map(a)),[...a.values()].every((e=>e.status===m.BURNED))&&i()}}})(n,(()=>{setTimeout((()=>{s()}),f.rl)}),(()=>{setTimeout((()=>{h()}),f.rl)}),(()=>{setTimeout((()=>{b()}),f.rl)}),(e=>{v(e)})),[E,j]=(0,l.useState)((()=>Array.from({length:y.length},((e,t)=>t))));return(0,l.useEffect)((()=>{j((e=>[...e].sort(g).reverse()))}),[]),(0,i.jsx)(d.NP,{theme:t,children:(0,i.jsx)(u.x,{items:y,forcedRows:a,renderItem:e=>(0,i.jsx)(c.Z,{title:e.title,frontImageSrc:e.src,coverImageSrc:o,fitImages:r,flipped:w(e.id)||x(e.id),burned:x(e.id),onClick:()=>C(e.id)}),keyExtractor:e=>e.id,getComputedStyles:(e,t)=>({order:E[t]})})})};var b=n(30555),v=n(76838),y=function(e,t,n,i){return new(n||(n=Promise))((function(o,r){function a(e){try{l(i.next(e))}catch(t){r(t)}}function s(e){try{l(i.throw(e))}catch(t){r(t)}}function l(e){var t;e.done?o(e.value):(t=e.value,t instanceof n?t:new n((function(e){e(t)}))).then(a,s)}l((i=i.apply(e,t||[])).next())}))};const w="https://audios.genial.ly/59e059d30b9c21060cb4c2ec/de8b3efe-c4df-48ff-8bbb-2b3e940663d3.wav",x="https://audios.genial.ly/59e059d30b9c21060cb4c2ec/23fe908b-44e2-4972-981f-d857c429b126.wav",C=(e,t)=>{e.slide.audioRequirement=a.w.ShowMute;const n=e.config.itemList,l=(0,b.u)(n,e.config.identicalImages);(0,s.p)({getTargetNodeItem:()=>e.item,initialState:void 0,renderApp:()=>{const{coverImage:n,fitImages:a,numRows:s,onEndAction:d}=e.config,c=e.item,u=[];c.on(r.q.Unmount,(()=>y(void 0,void 0,void 0,(function*(){u.forEach((e=>e)),u.length=0})))),t.preloadAudio(w),t.preloadAudio(x),l.forEach((e=>{t.preloadAudio(e.audioSource)}));const m=()=>{t.playAudio({source:w})},p=()=>{t.playAudio({source:x})},f=()=>{null===d||void 0===d||d.run()};return()=>{let e=[];return(0,i.jsx)(h,{theme:t.theme,images:l,coverImageSrc:String(n.source),fitImages:a,rowsDitributionFromConfig:(0,v.v)(s),onSuccess:m,onFailure:p,onGameWon:f,onFaceUp:n=>{const i=l.find((e=>e.id===n));if(!i)return;e.forEach((e=>{e.completed||t.playAudio(Object.assign(Object.assign({},e),{playMode:o.F.PlayStop}))})),e.length=0;const r={source:i.audioSource,playMode:o.F.PlayRestart},a=t.playAudio(r);e.push(Object.assign(Object.assign({},r),{refId:a.refId,completed:!1}));const s=t.onActionComplete(a.refId,(t=>{e=e.map((e=>Object.assign(Object.assign({},e),{completed:e.refId===t})))}));u.push(s)}})}}})(e,t)}},41381:(e,t,n)=>{n.d(t,{p:()=>a});var i=n(70377),o=n(66264),r=n(60708);function a(e){let{getTargetNodeItem:t,renderApp:n,renderThumbnailApp:a,initialState:s}=e,l=!1;const d=[],c=e=>{d.push(e)};return e=>{const u=t(e.config),m=null===u||void 0===u?void 0:u.parentSlide;function p(){if(!u)return;let e=null;if("idOfFreeNode"in u)e=document.getElementById(u.idOfFreeNode);else{const t=document.createElement("div");t.innerHTML=u.source;let n=t.getElementsByClassName("genially-widget-app");n.length||(n=t.getElementsByClassName("genially-widget-gallery"));const{id:i}=n[0];if(!i)return;e=document.getElementById(i)}if(e){const t=o=>{if(l){const r=n({setState:t,onUnmount:c});i.render(r(o),e)}else console.warn('"rerender" was called when the widget was already unmounted. This is a no-op. Did you forget to dispose of an event handler with "onUnmount"?')};l=!0,t(s),d.push((()=>{i.unmountComponentAtNode(e)}))}}function f(){l=!1,d.forEach((e=>{e()})),d.length=0}null===u||void 0===u||u.on(o.q.Mount,(()=>{p()})),null===u||void 0===u||u.on(o.q.Unmount,(()=>{f()})),u&&"isTransversal"in u&&u.isTransversal?p():null===m||void 0===m||m.on(r.m.Entering,(()=>{l||p()})),null===m||void 0===m||m.on(r.m.Exited,(()=>{u&&"isTransversal"in u&&u.isTransversal||l&&f()})),null===m||void 0===m||m.on(r.m.ThumbnailMount,(()=>{!function(){if(!a||!u||!("idOfThumbnailFreeNode"in u))return;const e=document.getElementsByClassName(u.idOfThumbnailFreeNode);Array.from(e).forEach((e=>{i.unmountComponentAtNode(e)}))}(),function(){if(!a||!u||!("idOfThumbnailFreeNode"in u))return;const e=document.getElementsByClassName(u.idOfThumbnailFreeNode);Array.from(e).forEach((e=>{i.render(a(),e)}))}()}))}}}}]);
//# sourceMappingURL=https://s3-static-genially.genially.com/view/static/js/5086.f2462041.chunk.js.map