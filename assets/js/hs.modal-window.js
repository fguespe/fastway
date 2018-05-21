!function(e){"use strict";e.HSCore.components.HSModalWindow={_baseConfig:{bounds:100,debounce:50,overlayOpacity:.48,overlayColor:"#000000",speed:400,type:"onscroll",effect:"fadein",onOpen:function(){},onClose:function(){},onComplete:function(){}},_pageCollection:e(),init:function(o,t){var n=e(o);if(n.length)return(t=t&&e.isPlainObject(t)?e.extend({},this._baseConfig,t):this._baseConfig).selector=o,this._pageCollection=this._pageCollection.add(n.not(this._pageCollection)),t.autonomous?this.initAutonomousModalWindows(n,t):this.initBaseModalWindows(n,t)},initBaseModalWindows:function(o,t){return o.on("click",function(o){if("Custombox"in window){var n=e(this),a=n.data("modal-target"),l=n.data("modal-effect")||t.effect;a&&e(a).length&&(new Custombox.modal({content:{target:a,effect:l,onOpen:function(){t.onOpen.call(e(a))},onClose:function(){t.onClose.call(e(a))},onComplete:function(){t.onComplete.call(e(a))}},overlay:{color:n.data("overlay-color")||t.overlayColor,opacity:n.data("overlay-opacity")||t.overlayOpacity,speedIn:n.data("speed")||t.speed,speedOut:n.data("speed")||t.speed}}).open(),o.preventDefault())}})},initAutonomousModalWindows:function(o,t){var n=this;return o.each(function(o,a){var l=e(a);switch(l.data("modal-type")){case"hashlink":n.initHashLinkPopup(l,t);break;case"onscroll":n.initOnScrollPopup(l,t);break;case"beforeunload":n.initBeforeUnloadPopup(l,t);break;case"ontarget":n.initOnTargetPopup(l,t);break;case"aftersometime":n.initAfterSomeTimePopup(l,t)}})},initHashLinkPopup:function(o,t){var n=e(window.location.hash),a=e("#"+o.attr("id"));n.length&&n.attr("id")==o.attr("id")&&new Custombox.modal({content:{target:"#"+o.attr("id"),effect:o.data("effect")||t.effect,onOpen:function(){t.onOpen.call(e(a))},onClose:function(){t.onClose.call(e(a))},onComplete:function(){t.onComplete.call(e(a))}},overlay:{color:o.data("overlay-color")||t.overlayColor,opacity:o.data("overlay-opacity")||t.overlayOpacity,speedIn:o.data("speed")||t.speed,speedOut:o.data("speed")||t.speed}}).open()},initOnScrollPopup:function(o,t){var n=e(window),a=o.data("breakpoint")?o.data("breakpoint"):0,l=e("#"+o.attr("id"));n.on("scroll.popup",function(){n.scrollTop()+n.height()>=a&&(new Custombox.modal({content:{target:"#"+o.attr("id"),effect:o.data("effect")||t.effect,onOpen:function(){t.onOpen.call(e(l))},onClose:function(){t.onClose.call(e(l))},onComplete:function(){t.onComplete.call(e(l))}},overlay:{color:o.data("overlay-color")||t.overlayColor,opacity:o.data("overlay-opacity")||t.overlayOpacity,speedIn:o.data("speed")||t.speed,speedOut:o.data("speed")||t.speed}}).open(),n.off("scroll.popup"))}),n.trigger("scroll.popup")},initBeforeUnloadPopup:function(o,t){var n,a=0,l=e("#"+o.attr("id"));window.addEventListener("mousemove",function(i){n&&clearTimeout(n),n=setTimeout(function(){i.clientY<10&&!a&&(a++,new Custombox.modal({content:{target:"#"+o.attr("id"),effect:o.data("effect")||t.effect,onOpen:function(){t.onOpen.call(e(l))},onClose:function(){t.onClose.call(e(l))},onComplete:function(){t.onComplete.call(e(l))}},overlay:{color:o.data("overlay-color")||t.overlayColor,opacity:o.data("overlay-opacity")||t.overlayOpacity,speedIn:o.data("speed")||t.speed,speedOut:o.data("speed")||t.speed}}).open())},10)})},initOnTargetPopup:function(o,t){var n=o.data("target");n&&e(n).length&&appear({bounds:t.bounds,debounce:t.debounce,elements:function(){return document.querySelectorAll(n)},appear:function(a){new Custombox.modal({content:{target:"#"+o.attr("id"),effect:o.data("effect")||t.effect,onOpen:function(){t.onOpen.call(e(n))},onClose:function(){t.onClose.call(e(n))},onComplete:function(){t.onComplete.call(e(n))}},overlay:{color:o.data("overlay-color")||t.overlayColor,opacity:o.data("overlay-opacity")||t.overlayOpacity,speedIn:o.data("speed")||t.speed,speedOut:o.data("speed")||t.speed}}).open()}})},initAfterSomeTimePopup:function(o,t){var n=e("#"+o.attr("id"));setTimeout(function(){new Custombox.modal({content:{target:"#"+o.attr("id"),effect:o.data("effect")||t.effect,onOpen:function(){t.onOpen.call(e(n))},onClose:function(){t.onClose.call(e(n))},onComplete:function(){t.onComplete.call(e(n))}},overlay:{color:o.data("overlay-color")||t.overlayColor,opacity:o.data("overlay-opacity")||t.overlayOpacity,speedIn:o.data("speed")||t.speed,speedOut:o.data("speed")||t.speed}}).open()},o.data("delay")?o.data("delay"):10)}}}(jQuery);