﻿/**
 * Flatten height same as the highest element for each row.
 *
 * Copyright (c) 2011 Hayato Takenaka
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * @author: Hayato Takenaka (http://urin.take-uma.net)
 * @version: 0.0.2
**/
;(function($) {
	$.fn.tile = function(columns) {
		var tiles, max, c, h, last = this.length - 1, s;
		if(!columns) columns = this.length;
		this.each(function() {
			s = this.style;
			if(s.removeProperty) s.removeProperty("height");
			if(s.removeAttribute) s.removeAttribute("height");
		});
		return this.each(function(i) {
			c = i % columns;
			if(c == 0) tiles = [];
			tiles[c] = $(this);
			h = tiles[c].height();
			if(c == 0 || h > max) max = h;
			if(i == last || c == columns - 1)
				$.each(tiles, function() { this.height(max); });
				
			//仮でサイズによってタイトル画像を変えてみます。
			/*var wid = $(window).width();
		
			if(wid < 768){
				$(".shoparea h2 img.sp").attr({src: "resources/images/index/shopinfoTitle_sp.png"});
				$(".searcharea h2 img.sp").attr({src: "resources/images/index/searchTitle_sp.png"});
				$(".specialarea h2 img.sp").attr({src: "resources/images/index/specialTitle_sp.png"});
				$(".infoinarea h2 img.sp").attr({src: "resources/images/index/infoTitle_sp.png"});
				$(".workarea h2 img.sp").attr({src: "resources/images/index/artworkTitle_sp.png"});
				$(".taikenarea h2 img.sp").attr({src: "resources/images/index/taikenTitle_sp.png"});
				$(".bannerarea h2 img.sp").attr({src: "resources/images/index/bannerareaTitle_sp.png"});
				$(".interview_inner-0 .taiken img.sp").attr({src: "resources/images/interview/interviewTitle_sp.png"});
			}*/
			var wid = $(window).width();
		
			if(wid >= 1024){
				$.each(tiles, function() { this.height(124); });
			}

			if(wid < 1024 && wid > 480){
				$.each(tiles, function() { this.height(200); });
			}

			if(wid <= 480){
				$.each(tiles, function() { this.height(200); });
			}
		});
	};

	$.fn.blogdata = function(columns) {
		var tiles, max, c, h, last = this.length - 1, s;
		if(!columns) columns = this.length;
		this.each(function() {
			s = this.style;
			if(s.removeProperty) s.removeProperty("height");
			if(s.removeAttribute) s.removeAttribute("height");
		});
		return this.each(function(i) {
			c = i % columns;
			if(c == 0) tiles = [];
			tiles[c] = $(this);
			h = tiles[c].height();
			if(c == 0 || h > max) max = h;
			if(i == last || c == columns - 1)
				$.each(tiles, function() { this.height(max); });
				
			//仮でサイズによってタイトル画像を変えてみます。
			/*var wid = $(window).width();
		
			if(wid < 768){
				$(".shoparea h2 img.sp").attr({src: "resources/images/index/shopinfoTitle_sp.png"});
				$(".searcharea h2 img.sp").attr({src: "resources/images/index/searchTitle_sp.png"});
				$(".specialarea h2 img.sp").attr({src: "resources/images/index/specialTitle_sp.png"});
				$(".infoinarea h2 img.sp").attr({src: "resources/images/index/infoTitle_sp.png"});
				$(".workarea h2 img.sp").attr({src: "resources/images/index/artworkTitle_sp.png"});
				$(".taikenarea h2 img.sp").attr({src: "resources/images/index/taikenTitle_sp.png"});
				$(".bannerarea h2 img.sp").attr({src: "resources/images/index/bannerareaTitle_sp.png"});
				$(".interview_inner-0 .taiken img.sp").attr({src: "resources/images/interview/interviewTitle_sp.png"});
			}*/
			var wid = $(window).width();
		
			if(wid >= 1024){
				$.each(tiles, function() { this.height(255); });
			}

			if(wid < 1024 && wid > 480){
				$.each(tiles, function() { this.height(255); });
			}

			if(wid <= 480){
				$.each(tiles, function() { this.height(255); });
			}
		});
	};
})(jQuery);
