/**
 * jQuery.timers - Timer abstractions for jQuery
 * Written by Blair Mitchelmore (blair DOT mitchelmore AT gmail DOT com)
 * Licensed under the WTFPL (http://sam.zoy.org/wtfpl/).
 * Date: 2009/02/08
 *
 * @author Blair Mitchelmore
 * @version 1.1.2
 *
 **/

jQuery.fn.extend({
	everyTime: function(interval, label, fn, times, belay) {
		return this.each(function() {
			jQuery.timer.add(this, interval, label, fn, times, belay);
		});
	},
	oneTime: function(interval, label, fn) {
		return this.each(function() {
			jQuery.timer.add(this, interval, label, fn, 1);
		});
	},
	stopTime: function(label, fn) {
		return this.each(function() {
			jQuery.timer.remove(this, label, fn);
		});
	}
});

jQuery.event.special

jQuery.extend({
	timer: {
		global: [],
		guid: 1,
		dataKey: "jQuery.timer",
		regex: /^([0-9]+(?:\.[0-9]*)?)\s*(.*s)?$/,
		powers: {
			// Yeah this is major overkill...
			'ms': 1,
			'cs': 10,
			'ds': 100,
			's': 1000,
			'das': 10000,
			'hs': 100000,
			'ks': 1000000
		},
		timeParse: function(value) {
			if (value == undefined || value == null)
				return null;
			var result = this.regex.exec(jQuery.trim(value.toString()));
			if (result[2]) {
				var num = parseFloat(result[1]);
				var mult = this.powers[result[2]] || 1;
				return num * mult;
			} else {
				return value;
			}
		},
		add: function(element, interval, label, fn, times, belay) {
			var counter = 0;
			
			if (jQuery.isFunction(label)) {
				if (!times) 
					times = fn;
				fn = label;
				label = interval;
			}
			
			interval = jQuery.timer.timeParse(interval);

			if (typeof interval != 'number' || isNaN(interval) || interval <= 0)
				return;

			if (times && times.constructor != Number) {
				belay = !!times;
				times = 0;
			}
			
			times = times || 0;
			belay = belay || false;
			
			var timers = jQuery.data(element, this.dataKey) || jQuery.data(element, this.dataKey, {});
			
			if (!timers[label])
				timers[label] = {};
			
			fn.timerID = fn.timerID || this.guid++;
			
			var handler = function() {
				if (belay && this.inProgress) 
					return;
				this.inProgress = true;
				if ((++counter > times && times !== 0) || fn.call(element, counter) === false)
					jQuery.timer.remove(element, label, fn);
				this.inProgress = false;
			};
			
			handler.timerID = fn.timerID;
			
			if (!timers[label][fn.timerID])
				timers[label][fn.timerID] = window.setInterval(handler,interval);
			
			this.global.push( element );
			
		},
		remove: function(element, label, fn) {
			var timers = jQuery.data(element, this.dataKey), ret;
			
			if ( timers ) {
				
				if (!label) {
					for ( label in timers )
						this.remove(element, label, fn);
				} else if ( timers[label] ) {
					if ( fn ) {
						if ( fn.timerID ) {
							window.clearInterval(timers[label][fn.timerID]);
							delete timers[label][fn.timerID];
						}
					} else {
						for ( var fn in timers[label] ) {
							window.clearInterval(timers[label][fn]);
							delete timers[label][fn];
						}
					}
					
					for ( ret in timers[label] ) break;
					if ( !ret ) {
						ret = null;
						delete timers[label];
					}
				}
				
				for ( ret in timers ) break;
				if ( !ret ) 
					jQuery.removeData(element, this.dataKey);
			}
		}
	}
});

jQuery(window).bind("unload", function() {
	jQuery.each(jQuery.timer.global, function(index, item) {
		jQuery.timer.remove(item);
	});
});

(function($) {
	$.fn.customFadeIn = function(speed, callback) {
		$(this).fadeIn(speed, function() {
			if(!$.support.opacity)
				$(this).get(0).style.removeAttribute('filter');
			if(callback != undefined)
				callback();
		});
	};
	$.fn.customFadeOut = function(speed, callback) {
		$(this).fadeOut(speed, function() {
			if(!$.support.opacity)
				$(this).get(0).style.removeAttribute('filter');
			if(callback != undefined)
				callback();
		});
	};
	$.fn.customFadeTo = function(speed,to,callback) {
		return this.animate({opacity: to}, speed, function() {
			if (to == 1 && jQuery.browser.msie)
				this.style.removeAttribute('filter');
			if (jQuery.isFunction(callback))
				callback();
		});
	};
})(jQuery);

/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright ? 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

//Global variable to check if window is already loaded
//Used for calling bj_headline after page has loaded
var window_loaded = false;
			
(function($){
	$.fn.bj_contentslider = function(options) {
		var opts = $.extend($.fn.bj_contentslider.defaults,options);
		
		var current_index = 0;
		var content_length = 0;
		var bj_contentslider;
		var bj_contentslider_titles;
		var bj_contentslider_contents;
		var is_animating = false;
		var width;
		
		function showContent(content_id){
			if(!$(content_id).hasClass("bj-contentslider-content-current")){
				is_animating = true;
				$(".bj-contentslider-content-current",bj_contentslider).animate({left:'-'+width+'px',opacity:0},opts.roller_interval,'easeInSine',function(){
					$(this).removeClass("bj-contentslider-content-current").addClass("bj-contentslider-content").css({left:(width+30)+'px',opacity:1});
				});
				$(content_id).animate({left:'0'},opts.roller_interval,'easeInSine',function(){
					$(this).removeClass("bj-contentslider-content").addClass("bj-contentslider-content-current");
					is_animating = false;
				});
			}
		}
		function showNext(){
			
		}
		function showPrev(){
			
		}
		
		function buildLayout(){
			
		}
/* ========= Main plugin code ===================================== */
		return this.each(function() {
			bj_contentslider = $(this);
			width = bj_contentslider.parent().innerWidth();
			if(opts.load_style){width = width - 40;}
			bj_contentslider_titles = $(".bj-contentslider-title",bj_contentslider);
			bj_contentslider_contents = $(".bj-contentslider-content",bj_contentslider);
			
			//$(".bj-contentslider-contents,.venus-contentslider",bj_contentslider).css({width:width+'px'});
			bj_contentslider_contents.each(function(){
				$(this).css({left:(width+30)+'px'});
			});
			bj_contentslider_titles.each(function(idx,val){
				var a = $("a",(this));
				var target = a.attr("href");
				a.click(function(){
					if(!is_animating){
						$("a.current",bj_contentslider_titles).removeClass("current");
						$(this).addClass("current");
						showContent(target);
					}
				});
				a.attr("href","javascript:void(0)");
			});
			
			if(!window_loaded) {
				$(window).load(function(){
					window_loaded = true;
					buildLayout();
				});
			} else {
				buildLayout();
			}
		});
		
	}
	
	$.fn.bj_contentslider.defaults = {
		roller_interval : 500,
		load_style : 0
	}
})(jQuery);

/*
cbb function by Roger Johansson, http://www.456bereastreet.com/
*/
var cbb = {
	init : function() {
	// Check that the browser supports the DOM methods used
		if (!document.getElementById || !document.createElement || !document.appendChild) return false;
		var oElement, oOuter, oI1, oI2, tempId;
	// Find all elements with a class name of cbb
		var arrElements = document.getElementsByTagName('*');
		var oRegExp = new RegExp("(^|\\s)cbb(\\s|$)");
		for (var i=0; i<arrElements.length; i++) {
	// Save the original outer element for later
			oElement = arrElements[i];
			if (oRegExp.test(oElement.className)) {
	// 	Create a new element and give it the original element's class name(s) while replacing 'cbb' with 'cb'
				oOuter = document.createElement('div');
				oOuter.className = oElement.className.replace(oRegExp, '$1cb$2');
	// Give the new div the original element's id if it has one
				if (oElement.getAttribute("id")) {
					tempId = oElement.id;
					oElement.removeAttribute('id');
					oOuter.setAttribute('id', '');
					oOuter.id = tempId;
				}
	// Change the original element's class name and replace it with the new div
				oElement.className = 'i3';
				oElement.parentNode.replaceChild(oOuter, oElement);
	// Create two new div elements and insert them into the outermost div
				oI1 = document.createElement('div');
				oI1.className = 'i1';
				oOuter.appendChild(oI1);
				oI2 = document.createElement('div');
				oI2.className = 'i2';
				oI1.appendChild(oI2);
	// Insert the original element
				oI2.appendChild(oElement);
	// Insert the top and bottom divs
				cbb.insertTop(oOuter);
				cbb.insertBottom(oOuter);
			}
		}
	},
	insertTop : function(obj) {
		var oOuter, oInner;
	// Create the two div elements needed for the top of the box
		oOuter=document.createElement("div");
		oOuter.className="bt"; // The outer div needs a class name
	    oInner=document.createElement("div");
	    oOuter.appendChild(oInner);
		obj.insertBefore(oOuter,obj.firstChild);
	},
	insertBottom : function(obj) {
		var oOuter, oInner;
	// Create the two div elements needed for the bottom of the box
		oOuter=document.createElement("div");
		oOuter.className="bb"; // The outer div needs a class name
	    oInner=document.createElement("div");
	    oOuter.appendChild(oInner);
		obj.appendChild(oOuter);
	},
	// addEvent function from http://www.quirksmode.org/blog/archives/2005/10/_and_the_winner_1.html
	addEvent : function(obj, type, fn) {
		if (obj.addEventListener)
			obj.addEventListener(type, fn, false);
		else if (obj.attachEvent) {
			obj["e"+type+fn] = fn;
			obj[type+fn] = function() { obj["e"+type+fn]( window.event ); }
			obj.attachEvent("on"+type, obj[type+fn]);
		}
	}
};

cbb.addEvent(window, 'load', cbb.init);