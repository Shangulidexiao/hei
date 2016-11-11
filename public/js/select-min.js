/**
 * @fileOverview \u9009\u62e9\u6846\u547d\u540d\u7a7a\u95f4\u5165\u53e3\u6587\u4ef6
 * @ignore
 */define("bui/select",["bui/common","bui/select/select","bui/select/combox","bui/select/suggest"],function(e){var t=e("bui/common"),n=t.namespace("Select");return t.mix(n,{Select:e("bui/select/select"),Combox:e("bui/select/combox"),Suggest:e("bui/select/suggest")}),n}),define("bui/select/select",["bui/common","bui/picker"],function(e){"use strict";function i(e){if($.isPlainObject(e)){var n=[];return t.each(e,function(e,t){n.push({value:t,text:e})}),n}var r=[];return t.each(e,function(e,n){t.isString(e)?r.push({value:e,text:e}):r.push(e)}),r}var t=e("bui/common"),n=e("bui/picker").ListPicker,r=t.prefix,s=t.Component,o=n,u=r+"select-input",a=s.Controller.extend({initializer:function(){var e=this,t=e.get("multipleSelect"),n,s=e.get("picker");s?e.get("valueField")&&s.set("valueField",e.get("valueField")):(n=t?"listbox":"simple-list",s=new o({children:[{xclass:n,elCls:r+"select-list",store:e.get("store"),items:i(e.get("items"))}],valueField:e.get("valueField")}),e.set("picker",s)),t&&s.set("hideEvent","")},renderUI:function(){var e=this,t=e.get("picker"),n=e._getTextEl();t.set("trigger",e.getTrigger()),t.set("triggerEvent",e.get("triggerEvent")),t.set("autoSetValue",e.get("autoSetValue")),t.set("textField",n),t.render(),e.set("list",t.get("list"))},bindUI:function(){var e=this,t=e.get("picker"),n=t.get("list"),r=n.get("store");t.on("selectedchange",function(t){e.fire("change",{text:t.text,value:t.value,item:t.item})}),n.on("itemsshow",function(){e._syncValue()}),t.on("show",function(){e.get("forceFit")&&t.set("width",e.get("el").outerWidth())})},containsElement:function(e){var t=this,n=t.get("picker");return s.Controller.prototype.containsElement.call(this,e)||n.containsElement(e)},getTrigger:function(){return this.get("el")},_uiSetItems:function(e){if(!e)return;var t=this,n=t.get("picker"),r=n.get("list");r.set("items",i(e)),t._syncValue()},_syncValue:function(){var e=this,t=e.get("picker"),n=e.get("valueField");n&&t.setSelectedValue($(n).val())},_uiSetName:function(e){var t=this,n=t._getTextEl();e&&n.attr("name",e)},_uiSetWidth:function(e){var t=this;if(e!=null){if(t.get("inputForceFit")){var n=t._getTextEl(),r=t.get("el").find(".x-icon"),i=n.outerWidth()-n.width(),s=e-r.outerWidth()-i;n.width(s)}if(t.get("forceFit")){var o=t.get("picker");o.set("width",e)}}},_uiSetDisabled:function(e){var t=this,n=t.get("picker"),r=t._getTextEl();n.set("disabled",e),r&&r.attr("disabled",e)},_getTextEl:function(){var e=this,t=e.get("el");return t.is("input")?t:t.find("input")},destructor:function(){var e=this,t=e.get("picker");t&&t.destroy()},_getList:function(){var e=this,t=e.get("picker"),n=t.get("list");return n},getSelectedValue:function(){return this.get("picker").getSelectedValue()},setSelectedValue:function(e){var t=this,n=t.get("picker");n.setSelectedValue(e)},getSelectedText:function(){return this.get("picker").getSelectedText()}},{ATTRS:{picker:{},list:{},valueField:{},store:{},focusable:{value:!0},autoSetValue:{value:!0},multipleSelect:{value:!1},inputForceFit:{value:!0},name:{},items:{sync:!1},inputCls:{value:u},forceFit:{value:!0},events:{value:{change:!1}},tpl:{view:!0,value:'<input type="text" readonly="readonly" class="'+u+'"/><span class="x-icon x-icon-normal"><i class="icon icon-caret icon-caret-down"></i></span>'},triggerEvent:{value:"click"}}},{xclass:"select"});return a}),define("bui/select/tag",["bui/common","bui/list"],function(e){var t=e("bui/common"),n=e("bui/list"),r=t.KeyCode,i="warn",s=function(){};return s.ATTRS={showTag:{value:!1},tagItemTpl:{value:"<li>{value}<button>\u00d7</button></li>"},tagList:{value:null},tagPlaceholder:{value:"\u8f93\u5165\u6807\u7b7e"},separator:{value:";"}},t.augment(s,{__renderUI:function(){var e=this,t=e.get("showTag"),n=e.get("tagPlaceholder"),r=e.getTagInput();t&&!r.attr("placeholder")&&(r.attr("placeholder",n),e.set("inputForceFit",!1))},__bindUI:function(){var e=this,t=e.get("showTag"),n=e.getTagInput();t&&(n.on("keydown",function(t){if(!n.val()){var s=e.get("tagList"),o=s.getLastItem(),u=e.get("picker");t.which==r.DELETE||t.which==r.BACKSPACE?(s.hasStatus(o,i)?e._delTag(o):s.setItemStatus(o,i,!0),u.hide()):s.setItemStatus(o,i,!1)}}),n.on("change",function(t){setTimeout(function(){var t=n.val();t&&e._addTag(t)})}))},__syncUI:function(){var e=this,t=e.get("showTag"),n=e.get("valueField");t&&n&&e._setTags($(n).val())},_setTags:function(e){var n=this,r=n.get("tagList"),i=n.get("separator"),s=e.split(i);r||(r=n._initTagList()),e&&t.each(s,function(e){r.addItem({value:e})})},_addTag:function(e){var t=this,n=t.get("tagList"),r=t.getTagInput(),i=n.getItem(e);i?t._blurItem(n,i):(n.addItem({value:e}),t._synTagsValue()),r.val("")},_blurItem:function(e,t){e.setItemStatus(t,"active",!0),setTimeout(function(){e.setItemStatus(t,"active",!1)},400)},_delTag:function(e){var t=this,n=t.get("tagList");n.removeItem(e),t._synTagsValue()},getTagsValue:function(){var e=this,n=e.get("tagList"),r=n.getItems(),i=[];return t.each(r,function(e){i.push(e.value)}),i.join(e.get("separator"))},_initTagList:function(){var e=this,t=e.getTagInput(),r=new n.SimpleList({elBefore:t,itemTpl:e.get("tagItemTpl"),idField:"value"});return r.render(),e._initTagEvent(r),e.set("tagList",r),r},_initTagEvent:function(e){var t=this;e.on("itemclick",function(e){var n=$(e.domTarget);n.is("button")&&t._delTag(e.item)})},getTagInput:function(){var e=this,t=e.get("el");return t.is("input")?t:t.find("input")},_synTagsValue:function(){var e=this,t=e.get("valueField");t&&$(t).val(e.getTagsValue())}}),s}),define("bui/select/combox",["bui/common","bui/select/select"],function(e){var t=e("bui/common"),n=e("bui/select/select"),r=e("bui/select/tag"),i=t.prefix+"combox-input",s=n.extend([r],{renderUI:function(){var e=this,t=e.get("picker");t.set("autoFocused",!1)},_uiSetItems:function(e){var n=this;for(var r=0;r<e.length;r++){var i=e[r];t.isString(i)&&(e[r]={value:i,text:i})}s.superclass._uiSetItems.call(n,e)},bindUI:function(){var e=this,t=e.get("picker"),n=t.get("list"),r=t.get("textField");$(r).on("keyup",function(e){var t=n.getSelected();t&&n.clearItemStatus(t)}),t.on("show",function(){n.clearSelected()})},_uiSetValueField:function(){},getTrigger:function(){return this._getTextEl()}},{ATTRS:{tpl:{view:!0,value:'<input type="text" class="'+i+'"/>'},inputCls:{value:i},autoSetValue:{value:!1}}},{xclass:"combox"});return s}),define("bui/select/suggest",["bui/common","bui/select/combox"],function(e){"use strict";var t=e("bui/common"),n=e("bui/select/combox"),r=200,i="",s=n.extend({bindUI:function(){var e=this,t=e.get("el").find("input"),n=e.get("triggerEvent")==="keyup"?"keyup":"keyup click";t.on(n,function(){e._start()})},_start:function(){var e=this;e._timer=e.later(function(){e._updateContent()},r)},_updateContent:function(){var e=this,t=e.get("data"),n=e.get("el").find("input"),r;if(!t&&n.val()===e.get("query"))return;e.set("query",n.val()),r=n.val();if(!t&&!r)return;var i=e.get("cacheable"),s=e.get("url"),o=e.get("data");if(i&&s){var u=e.get("dataCache");u[r]!==undefined?e._handleResponse(u[r]):e._requestData()}else s?e._requestData():o&&e._handleResponse(o,!0)},_getStore:function(){var e=this,t=e.get("picker"),n=t.get("list");if(n)return n.get("store")},_requestData:function(){var e=this,t=e.get("el").find("input"),n=e.get("callback"),r=e.get("store"),i={};i[t.attr("name")]=t.val(),r?(i.start=0,r.load(i,n)):$.ajax({url:e.get("url"),type:"post",dataType:e.get("dataType"),data:i,success:function(t){e._handleResponse(t),n&&n(t)}})},_handleResponse:function(e,t){var n=this,r=t?n._getFilterItems(e):e;n.set("items",r),n.get("cacheable")&&(n.get("dataCache")[n.get("query")]=r)},_getItemText:function(e){var t=this,n=t.get("picker"),r=n.get("list");return r?r.getItemText(e):""},_getFilterItems:function(e){function u(e,n){t.isString(n)?r.push(e):r.push(n)}var n=this,r=[],i=n.get("el").find("input"),s=i.val(),o=n.get("data");return e=e||[],t.each(e,function(e){var r=t.isString(e)?e:n._getItemText(e);o?r.indexOf($.trim(s))!==-1&&u(r,e):u(r,e)}),r},later:function(e,t,n){t=t||0;var r=n?setInterval(e,t):setTimeout(e,t);return{id:r,interval:n,cancel:function(){this.interval?clearInterval(r):clearTimeout(r)}}}},{ATTRS:{data:{value:null},query:{value:i},cacheable:{value:!1},dataCache:{shared:!1,value:{}},dataType:{value:"jsonp"},url:{},callback:{},triggerEvent:{valueFn:function(){return this.get("data")?"click":"keyup"}},autoSetValue:{value:!1}}},{xclass:"suggest"});return s});
