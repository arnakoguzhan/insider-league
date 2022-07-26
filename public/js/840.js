"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[840],{8840:(e,t,o)=>{o.r(t),o.d(t,{default:()=>u});var n=o(821),r=o(9358),l=o(7927),s=(0,n.createElementVNode)("title",null,"Fixtures",-1),i=(0,n.createElementVNode)("meta",{type:"description",content:"Home information","head-key":"description"},null,-1),c=(0,n.createElementVNode)("h1",{class:"font-bold text-lg mb-4"}," Fixtures ",-1),a={class:"mt-6"},d=(0,n.createTextVNode)(" Check standings ");const u={name:"Fixtures",props:{fixtures:Object,simulationUid:String},setup:function(e){return function(t,o){var u=(0,n.resolveComponent)("Head");return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createVNode)(u,null,{default:(0,n.withCtx)((function(){return[s,i]})),_:1}),(0,n.createElementVNode)("div",null,[c,(0,n.createVNode)((0,n.unref)(l.Z),{fixtures:e.fixtures,simulationUid:e.simulationUid},null,8,["fixtures","simulationUid"]),(0,n.createElementVNode)("div",a,[(0,n.createVNode)((0,n.unref)(r.Z),{href:"/".concat(e.simulationUid,"/standings"),color:"blue",key:"blue"},{default:(0,n.withCtx)((function(){return[d]})),_:1},8,["href"])])])],64)}}}},9358:(e,t,o)=>{o.d(t,{Z:()=>i});var n=o(821),r={class:"w-5 h-5 text-white animate-spin mr-2",fill:"none",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},l=[(0,n.createElementVNode)("circle",{class:"opacity-25",cx:"12",cy:"12",r:"10",stroke:"currentColor","stroke-width":"4"},null,-1),(0,n.createElementVNode)("path",{class:"opacity-75",d:"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z",fill:"currentColor"},null,-1)];const s={props:{href:{required:!1,type:String,default:null},type:{type:String,default:"button"},id:{type:String,required:!1},name:{type:String,required:!1},color:{type:String,default:"teal"},textColor:{type:String,default:"white"},size:{type:String,default:"md"},outline:Boolean,link:Boolean,isLoading:Boolean,icon:Boolean,round:Boolean},computed:{colorClasses:function(){var e=this.color,t=this.textColor,o="border focus:outline-none bg-".concat(e,"-600 text-").concat(t," border-").concat(e,"-600 hover:bg-").concat(e,"-700 hover:border-").concat(e,"-700"),n="border focus:outline-none  border-".concat(e,"-600 bg-white text-").concat(e,"-600 hover:bg-").concat(e,"-600 hover:border-").concat(e,"-600 hover:text-white"),r="text-".concat(t," hover:text-").concat(t,"-800");return this.outline?n:this.link?r:o},sizeClasses:function(){var e=this.icon,t={sm:"h-8 text-sm ".concat(e?"px-2":"px-4"),md:"h-10 ".concat(e?"px-3":"px-6"),lg:"text-lg h-12 ".concat(e?"px-4":"px-12")};return t[this.size]||t.md},btnClasses:function(){var e=this.round?"rounded-full":"rounded";return"".concat(this.colorClasses," ").concat(this.sizeClasses," ").concat(e)},buttonType:function(){return this.href?"Link":"button"}}};const i=(0,o(3744).Z)(s,[["render",function(e,t,o,s,i,c){return(0,n.openBlock)(),(0,n.createBlock)((0,n.resolveDynamicComponent)(c.buttonType),{class:(0,n.normalizeClass)(["font-medium flex items-center cursor-pointer",c.btnClasses]),href:o.href,type:o.type},{default:(0,n.withCtx)((function(){return[(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("svg",r,l,512)),[[n.vShow,o.isLoading]]),(0,n.renderSlot)(e.$slots,"default")]})),_:3},8,["href","type","class"])}]])},7243:(e,t,o)=>{o.d(t,{Z:()=>u});var n=o(821),r={class:"flex items-center space-x-4"},l={class:"flex items-center space-x-4"},s={class:"flex-shrink-0"},i=["src","alt"],c={class:"flex-1 min-w-0"},a={class:"text-sm font-medium text-gray-900"};const d={props:{team:{required:!0,type:Object,default:{}}}};const u=(0,o(3744).Z)(d,[["render",function(e,t,o,d,u,m){return(0,n.openBlock)(),(0,n.createElementBlock)("div",r,[(0,n.createElementVNode)("div",l,[(0,n.createElementVNode)("div",s,[(0,n.createElementVNode)("img",{class:"h-8 w-8 rounded-full",src:o.team.imageUrl,alt:o.team.name},null,8,i)]),(0,n.createElementVNode)("div",c,[(0,n.createElementVNode)("p",a,(0,n.toDisplayString)(o.team.name),1)])])])}]])},7927:(e,t,o)=>{o.d(t,{Z:()=>L});var n=o(821),r={class:"grid gap-y-6"},l={class:"bg-white border border-gray-200 rounded-lg p-5"},s={class:"text-lg leading-6 font-medium text-gray-900 mb-4"},i={class:"grid divide-y"},c={class:"grid grid-cols-5 py-2 first:pt-0 last:pb-0"},a={class:"col-span-2"},d={class:"flex items-center"},u=["onClick"],m=[(0,n.createElementVNode)("path",{d:"M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"},null,-1),(0,n.createElementVNode)("path",{"fill-rule":"evenodd",d:"M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z","clip-rule":"evenodd"},null,-1)],f={class:"col-span-2"},p={class:"grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"},h={class:"sm:col-span-6"},g={class:"block text-sm font-medium text-gray-900"},y=(0,n.createElementVNode)("span",{class:"text-gray-700"},"Host Goals",-1),v={key:0},x={class:"sm:col-span-6"},w={class:"block text-sm font-medium text-gray-900"},b=(0,n.createElementVNode)("span",{class:"text-gray-700"},"Guest Goals",-1),k={key:0},E={class:"flex justify-end mt-5"},C=(0,n.createTextVNode)(" Save ");var V=o(9038),N=o(7243),B={class:"overflow-auto max-h-screen w-full"};function S(e,t){var o=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),o.push.apply(o,n)}return o}function G(e){for(var t=1;t<arguments.length;t++){var o=null!=arguments[t]?arguments[t]:{};t%2?S(Object(o),!0).forEach((function(t){O(e,t,o[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(o)):S(Object(o)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(o,t))}))}return e}function O(e,t,o){return t in e?Object.defineProperty(e,t,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[t]=o,e}const D={props:{showing:{required:!0,type:Boolean},showClose:{type:Boolean,default:!0},backgroundClose:{type:Boolean,default:!0},css:{type:Object,required:!1}},computed:{customCSS:function(){return G(G({},{background:"",modal:"",close:""}),this.css)}},watch:{showing:function(e){return e?document.querySelector("body").classList.add("overflow-hidden"):document.querySelector("body").classList.remove("overflow-hidden")}},methods:{close:function(){document.querySelector("body").classList.remove("overflow-hidden"),this.$emit("close")},closeIfShown:function(){this.showClose&&this.backgroundClose&&this.close()}},mounted:function(){var e=this;this.showClose&&document.addEventListener("keydown",(function(t){"Escape"===t.key&&e.close()}))}};var j=o(3744);const M=(0,j.Z)(D,[["render",function(e,t,o,r,l,s){return(0,n.openBlock)(),(0,n.createBlock)(n.Transition,{name:"fade"},{default:(0,n.withCtx)((function(){return[o.showing?((0,n.openBlock)(),(0,n.createElementBlock)("div",{key:0,class:(0,n.normalizeClass)(["fixed inset-0 w-full h-screen flex items-center justify-center bg-smoke-800 z-50",s.customCSS.background]),onClick:t[1]||(t[1]=(0,n.withModifiers)((function(){return s.closeIfShown&&s.closeIfShown.apply(s,arguments)}),["self"]))},[(0,n.createElementVNode)("div",{class:(0,n.normalizeClass)(["relative max-h-screen w-full max-w-2xl bg-white shadow-lg rounded-lg p-8 flex",s.customCSS.modal])},[o.showClose?((0,n.openBlock)(),(0,n.createElementBlock)("button",{key:0,"aria-label":"close",class:(0,n.normalizeClass)(["absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4",s.customCSS.close]),onClick:t[0]||(t[0]=(0,n.withModifiers)((function(){return s.close&&s.close.apply(s,arguments)}),["prevent"]))}," × ",2)):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("div",B,[(0,n.renderSlot)(e.$slots,"default")])],2)],2)):(0,n.createCommentVNode)("",!0)]})),_:3})}]]);var z=o(9358);const H={data:function(){return{form:(0,V.cI)({fixtureId:null,editingHostGoals:null,editingGuestGoals:null}),showModal:!1}},methods:{showEditModal:function(e,t,o){this.showModal=!0,this.form.fixtureId=e,this.form.editingHostGoals=t,this.form.editingGuestGoals=o},closeEditModal:function(){this.showModal=!1,this.form.reset()},submitFixture:function(){console.log("submitFixture"),this.form.put("/".concat(this.simulationUid,"/fixtures/").concat(this.form.fixtureId),{preserveScroll:!0}),this.closeEditModal()}},props:{title:{type:String},fixtures:{type:Object,required:!0},simulationUid:{type:String,required:!0}},components:{TeamName:N.Z,Modal:M,Button:z.Z}},L=(0,j.Z)(H,[["render",function(e,t,o,V,N,B){var S=(0,n.resolveComponent)("TeamName"),G=(0,n.resolveComponent)("Button"),O=(0,n.resolveComponent)("Modal");return(0,n.openBlock)(),(0,n.createElementBlock)("div",r,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(o.fixtures,(function(e,r){return(0,n.openBlock)(),(0,n.createElementBlock)("div",l,[(0,n.createElementVNode)("h3",s,[(0,n.withDirectives)((0,n.createElementVNode)("span",null,(0,n.toDisplayString)(o.title),513),[[n.vShow,o.title]]),(0,n.withDirectives)((0,n.createElementVNode)("span",null,"Week "+(0,n.toDisplayString)(r),513),[[n.vShow,!o.title]])]),(0,n.createElementVNode)("div",i,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(e,(function(e){return(0,n.openBlock)(),(0,n.createElementBlock)("dl",c,[(0,n.createElementVNode)("div",a,[(0,n.createVNode)(S,{team:e.host},null,8,["team"])]),(0,n.withDirectives)((0,n.createElementVNode)("span",null,"-",512),[[n.vShow,!e.playedAt]]),(0,n.withDirectives)((0,n.createElementVNode)("span",d,[(0,n.createTextVNode)((0,n.toDisplayString)(e.hostGoals)+" - "+(0,n.toDisplayString)(e.guestGoals)+" ",1),((0,n.openBlock)(),(0,n.createElementBlock)("svg",{onClick:function(t){return B.showEditModal(e.id,e.hostGoals,e.guestGoals)},xmlns:"http://www.w3.org/2000/svg",class:"ml-2 text-blue-600 h-5 w-5",viewBox:"0 0 20 20",fill:"currentColor"},m,8,u))],512),[[n.vShow,e.playedAt]]),(0,n.createElementVNode)("div",f,[(0,n.createVNode)(S,{team:e.guest},null,8,["team"])])])})),256))]),(0,n.createVNode)(O,{showing:N.showModal,onClose:B.closeEditModal,showClose:!0,backgroundClose:!0},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",p,[(0,n.createElementVNode)("div",h,[(0,n.createElementVNode)("label",g,[y,(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":t[0]||(t[0]=function(e){return N.form.editingHostGoals=e}),type:"number",min:"0",class:"border p-3 w-full border-gray-300 rounded-md shadow-sm text-gray-900 sm:text-sm focus:ring-gray-500 focus:border-gray-500 mt-1"},null,512),[[n.vModelText,N.form.editingHostGoals]]),N.form.errors.editingHostGoals?((0,n.openBlock)(),(0,n.createElementBlock)("div",v,(0,n.toDisplayString)(N.form.errors.editingHostGoals),1)):(0,n.createCommentVNode)("",!0)])]),(0,n.createElementVNode)("div",x,[(0,n.createElementVNode)("label",w,[b,(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":t[1]||(t[1]=function(e){return N.form.editingGuestGoals=e}),type:"number",min:"0",class:"border p-3 w-full border-gray-300 rounded-md shadow-sm text-gray-900 sm:text-sm focus:ring-gray-500 focus:border-gray-500 mt-1"},null,512),[[n.vModelText,N.form.editingGuestGoals]]),N.form.errors.editingGuestGoals?((0,n.openBlock)(),(0,n.createElementBlock)("div",k,(0,n.toDisplayString)(N.form.errors.editingGuestGoals),1)):(0,n.createCommentVNode)("",!0)])])]),(0,n.createElementVNode)("div",E,[(0,n.createVNode)(G,{color:"blue",key:"submitFixture",onClick:B.submitFixture,isLoading:N.form.processing},{default:(0,n.withCtx)((function(){return[C]})),_:1},8,["onClick","isLoading"])])]})),_:1},8,["showing","onClose"])])})),256))])}]])}}]);