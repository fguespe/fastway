!function(s){"use strict";s.HSCore.helpers.HSFocusState={init:function(){var t=s('.js-focus-state input:not([type="checkbox"], [type="radio"]), .js-focus-state textarea, .js-focus-state select');t.length&&(t.on("focusin",function(){s(this).closest(".js-focus-state").addClass("u-focus-state")}),t.on("focusout",function(){s(this).closest(".js-focus-state").removeClass("u-focus-state")}))}}}(jQuery);