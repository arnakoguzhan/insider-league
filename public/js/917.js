"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[917],{6917:(e,t,n)=>{n.r(t),n.d(t,{default:()=>f});var o=n(821),r=n(9038),l=n(1434),c=n(7243),a=(0,o.createElementVNode)("title",null,"Home",-1),s=(0,o.createElementVNode)("meta",{type:"description",content:"Home information","head-key":"description"},null,-1),i=(0,o.createElementVNode)("h1",{class:"font-bold text-lg mb-4"}," Teams ",-1),u={class:"flow-root mt-6 bg-gray-100 rounded-lg py-6 px-2"},d={role:"list",class:"-my-5 divide-y divide-gray-200"},m={class:"mt-6"},p=(0,o.createTextVNode)(" Generate fixtures ");const f={name:"Home",props:{teams:Array},setup:function(e){var t=(0,r.cI)(),n=function(){t.post("/generate-simulation")};return function(r,f){var h=(0,o.resolveComponent)("Head");return(0,o.openBlock)(),(0,o.createElementBlock)(o.Fragment,null,[(0,o.createVNode)(h,null,{default:(0,o.withCtx)((function(){return[a,s]})),_:1}),(0,o.createElementVNode)("div",null,[i,(0,o.createElementVNode)("div",u,[(0,o.createElementVNode)("ul",d,[((0,o.openBlock)(!0),(0,o.createElementBlock)(o.Fragment,null,(0,o.renderList)(e.teams,(function(e){return(0,o.openBlock)(),(0,o.createElementBlock)("li",{key:e.handle,class:"py-4"},[(0,o.createVNode)((0,o.unref)(c.Z),{team:e},null,8,["team"])])})),128))])]),(0,o.createElementVNode)("div",m,[(0,o.createElementVNode)("form",{onSubmit:f[0]||(f[0]=(0,o.withModifiers)((function(){return(0,o.unref)(n)&&(0,o.unref)(n).apply(void 0,arguments)}),["prevent"]))},[(0,o.createVNode)((0,o.unref)(l.Z),{color:"blue",key:"generateFixture",type:"submit",isLoading:(0,o.unref)(t).processing},{default:(0,o.withCtx)((function(){return[p]})),_:1},8,["isLoading"])],32)])])],64)}}}},1434:(e,t,n)=>{n.d(t,{Z:()=>a});var o=n(821),r={class:"w-5 h-5 text-white animate-spin mr-2",fill:"none",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},l=[(0,o.createElementVNode)("circle",{class:"opacity-25",cx:"12",cy:"12",r:"10",stroke:"currentColor","stroke-width":"4"},null,-1),(0,o.createElementVNode)("path",{class:"opacity-75",d:"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z",fill:"currentColor"},null,-1)];const c={props:{href:{required:!1,type:String,default:null},type:{type:String,default:"button"},id:{type:String,required:!1},name:{type:String,required:!1},color:{type:String,default:"teal"},textColor:{type:String,default:"white"},size:{type:String,default:"md"},outline:Boolean,link:Boolean,isLoading:Boolean,icon:Boolean,round:Boolean},computed:{colorClasses:function(){var e=this.color,t=this.textColor,n="border focus:outline-none bg-".concat(e,"-600 text-").concat(t," border-").concat(e,"-600 hover:bg-").concat(e,"-700 hover:border-").concat(e,"-700"),o="border focus:outline-none  border-".concat(e,"-600 bg-white text-").concat(e,"-600 hover:bg-").concat(e,"-600 hover:border-").concat(e,"-600 hover:text-white"),r="text-".concat(t," hover:text-").concat(t,"-800");return this.outline?o:this.link?r:n},sizeClasses:function(){var e=this.icon,t={sm:"h-8 text-sm ".concat(e?"px-2":"px-4"),md:"h-10 ".concat(e?"px-3":"px-6"),lg:"text-lg h-12 ".concat(e?"px-4":"px-12")};return t[this.size]||t.md},btnClasses:function(){var e=this.round?"rounded-full":"rounded";return"".concat(this.colorClasses," ").concat(this.sizeClasses," ").concat(e)},buttonType:function(){return this.href?"Link":"button"}}};const a=(0,n(3744).Z)(c,[["render",function(e,t,n,c,a,s){return(0,o.openBlock)(),(0,o.createBlock)((0,o.resolveDynamicComponent)(s.buttonType),(0,o.mergeProps)({class:["font-medium flex items-center cursor-pointer",s.btnClasses],href:n.href,type:n.type},(0,o.toHandlers)(e.$listeners)),{default:(0,o.withCtx)((function(){return[(0,o.withDirectives)(((0,o.openBlock)(),(0,o.createElementBlock)("svg",r,l,512)),[[o.vShow,n.isLoading]]),(0,o.renderSlot)(e.$slots,"default")]})),_:3},16,["href","type","class"])}]])},7243:(e,t,n)=>{n.d(t,{Z:()=>d});var o=n(821),r={class:"flex items-center space-x-4"},l={class:"flex items-center space-x-4"},c={class:"flex-shrink-0"},a=["src","alt"],s={class:"flex-1 min-w-0"},i={class:"text-sm font-medium text-gray-900"};const u={props:{team:{required:!0,type:Object,default:{}}}};const d=(0,n(3744).Z)(u,[["render",function(e,t,n,u,d,m){return(0,o.openBlock)(),(0,o.createElementBlock)("div",r,[(0,o.createElementVNode)("div",l,[(0,o.createElementVNode)("div",c,[(0,o.createElementVNode)("img",{class:"h-8 w-8 rounded-full",src:n.team.imageUrl,alt:n.team.name},null,8,a)]),(0,o.createElementVNode)("div",s,[(0,o.createElementVNode)("p",i,(0,o.toDisplayString)(n.team.name),1)])])])}]])}}]);