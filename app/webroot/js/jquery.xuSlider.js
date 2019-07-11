(function ( $, window, document, undefined ) {
    'use strict';
    // Create the defaults once
    var pluginName = 'xuSlider',
        defaults = {
            controlNav: true,
            directionNav: true,
            startAt: 0,
            animateTime: 700,
            slideshowSpeed: 2000,
            pauseOnHover: true,
            autoSlide: false
        };

    // The actual plugin constructor
    function Plugin( element, options ) {
        this.element = element;
        this.options = $.extend( {}, defaults, options);
        
        this._defaults = defaults;
        this._name = pluginName;
        
        this.init();
    }

    Plugin.prototype = {
        init: function() {
            var $el = this.$el = $(this.element);
            var options = this.options; 
            this.$sliders = $el.find('ul');
            this.unit = -$el.width();              
            this.autoTimer = null;
            
            this.evType = window.ontouchstart ? 'touchstart' : 'click';                  
            
            var $slidersAll = this.$slidersAll = this.$sliders.find('li');
            this.slidersNum = $slidersAll.length;
            
            
            $slidersAll.css({ width: -this.unit, height: $el.height() });
            this.slideRender();
            
            $slidersAll.eq(options.startAt).addClass('slider-active');
            options.controlNav && this.controlNav();      
            options.directionNav && this.directionNav();  
            options.autoSlide && this.autoSlide();        
            options.pauseOnHover && this.pauseOnHover();
        },
        
        slideRender: function() {
            this.$slidersAll.css({ float: 'left' });
            
            this.$sliders.remove().append(this.$slidersAll.eq(0).clone(true).addClass('clone'))
                .prepend(this.$slidersAll.eq(-1).clone(true).addClass('clone'))
                .css({ left: (this.options.startAt + 1) * this.unit, width: -(this.slidersNum + 2) * this.unit });
            
            this.$el.html($('<div class="viewport">').css({ position: 'relative', overflow: 'hidden' }).append(this.$sliders));
        },
        directionNav: function() {
            var self = this, delay = 200;
            self.$directionNav = $('<div class="direction-nav"><a href="javascript:;" class="prev"><i>Previous</i></a><a href="javascript:;" class="next"><i>next</i></a></div>');
            self.$directionNav.appendTo(self.$el)
                .on(self.evType, 'a', function() {
                    var el = this;
                    
                    self.clearAutoSlideTimer();
                    if(el.className.indexOf('next') !== -1) {
                        
                        el.timer !== null && clearTimeout(el.timer);                
                        el.timer = setTimeout(function() { self.next(); }, delay);
                    }else {
                        
                        el.timer !== null && clearTimeout(el.timer);
                        el.timer = setTimeout(function() {
                            self.options.startAt -= 1;
                            self.move(function() {
                                
                                -1 === self.options.startAt && (self.options.startAt = self.slidersNum - 1);
                            });
                        }, delay);
                    }
                });
        },
        controlNav: function() {
            var self = this, controlNav = '<ol class="control-nav">';
            for(var i = 0; i < this.slidersNum; i++) {
                controlNav += (self.options.startAt === i ? '<li class="active"' : '<li');
                controlNav += ' data-id="'+ i +'"><a href="javascript:;">'+ i +'</a></li>';
            }
            var $controlNav = $(controlNav).on(self.evType, 'li', function() {
                self.clearAutoSlideTimer();
              
                self.options.startAt = +this.dataset.id;
                self.move();
            }).appendTo(self.$el);
            self.$controlNavs = $controlNav.find('li');
        },
        move: function(callback, autoEmit) {
            var self = this, curr = self.options.startAt;
            
            self.$sliders.animate({
                left: (curr + 1) * self.unit
            }, self.options.animateTime, function() {
                if(typeof callback === 'function') {
                    callback(), curr = self.options.startAt;     
                    self.$sliders.css('left', (curr + 1) * self.unit);
                }
                self.$slidersAll.removeClass('slider-active').eq(curr).addClass('slider-active');
                //self.$controlNavs.removeClass('active')[curr].className = 'active';
                
                !autoEmit && self.options.autoSlide && self.autoSlide();
            });
        },
        next: function(autoEmit) {
            var self = this;
            self.options.startAt += 1;
            self.move(function() {
               
                self.slidersNum === self.options.startAt && (self.options.startAt = 0);
            }, autoEmit);
        },
        autoSlide: function() { 
            var self = this;
            self.clearAutoSlideTimer();
            self.autoTimer = setInterval(function() {
                
                self.next(true);
            }, self.options.slideshowSpeed); 
        },
        clearAutoSlideTimer: function() {
            this.autoTimer !== null && clearInterval(this.autoTimer);
        },
        pauseOnHover: function() {
           
            var self = this, options = self.options;
           
            self.$el.on('mouseenter', function() {
                options.pauseOnHover && self.clearAutoSlideTimer();
            }).on('mouseleave', function() {
              
                options.pauseOnHover && options.autoSlide && self.autoSlide();
            });
            
        }
    };

    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin( this, options ));
            }
        });
    };

})($, window);