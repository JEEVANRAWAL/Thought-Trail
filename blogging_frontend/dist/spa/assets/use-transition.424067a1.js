import{y as S,o as U,q as b,am as w,g as T,m as q,an as A,a as H,ao as v,r as D,U as Q,ad as _,h as j,ap as k,aq as E,ar as G,c as F}from"./index.66e15d46.js";import{r as C,j as I}from"./scroll.e38c138f.js";function L(){let e;const o=T();function a(){e=void 0}return S(a),U(a),{removeTick:a,registerTick(n){e=n,b(()=>{e===n&&(w(o)===!1&&e(),e=void 0)})}}}function y(){let e=null;const o=T();function a(){e!==null&&(clearTimeout(e),e=null)}return S(a),U(a),{removeTimeout:a,registerTimeout(n,l){a(),w(o)===!1&&(e=setTimeout(n,l))}}}const z={modelValue:{type:Boolean,default:null},"onUpdate:modelValue":[Function,Array]},J=["beforeShow","show","beforeHide","hide"];function K({showing:e,canShow:o,hideOnRouteChange:a,handleShow:n,handleHide:l,processOnMount:f}){const r=T(),{props:i,emit:u,proxy:p}=r;let s;function c(t){e.value===!0?g(t):m(t)}function m(t){if(i.disable===!0||t!==void 0&&t.qAnchorHandled===!0||o!==void 0&&o(t)!==!0)return;const d=i["onUpdate:modelValue"]!==void 0;d===!0&&(u("update:modelValue",!0),s=t,b(()=>{s===t&&(s=void 0)})),(i.modelValue===null||d===!1)&&h(t)}function h(t){e.value!==!0&&(e.value=!0,u("beforeShow",t),n!==void 0?n(t):u("show",t))}function g(t){if(i.disable===!0)return;const d=i["onUpdate:modelValue"]!==void 0;d===!0&&(u("update:modelValue",!1),s=t,b(()=>{s===t&&(s=void 0)})),(i.modelValue===null||d===!1)&&$(t)}function $(t){e.value!==!1&&(e.value=!1,u("beforeHide",t),l!==void 0?l(t):u("hide",t))}function V(t){i.disable===!0&&t===!0?i["onUpdate:modelValue"]!==void 0&&u("update:modelValue",!1):t===!0!==e.value&&(t===!0?h:$)(s)}q(()=>i.modelValue,V),a!==void 0&&A(r)===!0&&q(()=>p.$route.fullPath,()=>{a.value===!0&&e.value===!0&&g()}),f===!0&&H(()=>{V(i.modelValue)});const M={show:m,hide:g,toggle:c};return Object.assign(p,M),M}const P=[];function R(e){return P.find(o=>o.contentEl!==null&&o.contentEl.contains(e))}function N(e,o){do{if(e.$options.name==="QMenu"){if(e.hide(o),e.$props.separateClosePopup===!0)return v(e)}else if(e.__qPortal===!0){const a=v(e);return a!==void 0&&a.$options.name==="QPopupProxy"?(e.hide(o),a):e}e=v(e)}while(e!=null)}function X(e,o,a){for(;a!==0&&e!==void 0&&e!==null;){if(e.__qPortal===!0){if(a--,e.$options.name==="QMenu"){e=N(e,o);continue}e.hide(o)}e=v(e)}}function O(e){for(e=e.parent;e!=null;){if(e.type.name==="QGlobalDialog")return!0;if(e.type.name==="QDialog"||e.type.name==="QMenu")return!1;e=e.parent}return!1}function Y(e,o,a,n){const l=D(!1),f=D(!1);let r=null;const i={},u=n==="dialog"&&O(e);function p(c){if(c===!0){C(i),f.value=!0;return}f.value=!1,l.value===!1&&(u===!1&&r===null&&(r=E(!1,n)),l.value=!0,P.push(e.proxy),I(i))}function s(c){if(f.value=!1,c!==!0)return;C(i),l.value=!1;const m=P.indexOf(e.proxy);m!==-1&&P.splice(m,1),r!==null&&(G(r),r=null)}return Q(()=>{s(!0)}),e.proxy.__qPortal=!0,_(e.proxy,"contentEl",()=>o.value),{showPortal:p,hidePortal:s,portalIsActive:l,portalIsAccessible:f,renderPortal:()=>u===!0?a():l.value===!0?[j(k,{to:r},a())]:void 0}}const Z={transitionShow:{type:String,default:"fade"},transitionHide:{type:String,default:"fade"},transitionDuration:{type:[String,Number],default:300}};function x(e,o=()=>{},a=()=>{}){return{transitionProps:F(()=>{const n=`q-transition--${e.transitionShow||o()}`,l=`q-transition--${e.transitionHide||a()}`;return{appear:!0,enterFromClass:`${n}-enter-from`,enterActiveClass:`${n}-enter-active`,enterToClass:`${n}-enter-to`,leaveFromClass:`${l}-leave-from`,leaveActiveClass:`${l}-leave-active`,leaveToClass:`${l}-leave-to`}}),transitionStyle:F(()=>`--q-transition-duration: ${e.transitionDuration}ms`)}}export{y as a,z as b,J as c,K as d,Z as e,x as f,Y as g,R as h,X as i,N as j,P as p,L as u};