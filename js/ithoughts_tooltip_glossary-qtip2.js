(function($){
    var baseTouch = ( navigator.userAgent.match(/Android/i)
                     || navigator.userAgent.match(/webOS/i)
                     || navigator.userAgent.match(/iPhone/i)
                     || navigator.userAgent.match(/iPad/i)
                     || navigator.userAgent.match(/iPod/i)
                     || navigator.userAgent.match(/BlackBerry/i) ) ? 1 : 0;
    $(document).ready(function(){
        $('span[class^=ithoughts_tooltip_glossary-]').each(function(){
            var ajaxPostData = $.extend( {action: 'ithoughts_tt_gl_get_term_details'}, $(this).data() );
            var qtipstyle    = ($(this).data('qtipstyle')) ? $(this).data('qtipstyle') : ithoughts_tt_gl.qtipstyle;

            // If set to click, disable glossary link
            if( ithoughts_tt_gl.qtiptrigger == 'click' ){
                $(this).children('a').click(function(e){
                    e.preventDefault();
                });
            } else if( ithoughts_tt_gl.qtiptrigger == 'responsive' ){
                var self = $(this);
                self.touch = baseTouch;

                //Detect touch/click out
                $(document).click(function(event) { 
                    if(!$(event.target).closest(self).length) {
                        self.data("expanded", false);
                        self.triggerHandler("responsiveout");
                    }
                });

                self.children('a').click(function(e){
                    if(!self.data("expanded") && self.touch != 0){
                        self.data("expanded", true);
                        self.triggerHandler("responsive");
                        e.preventDefault();
                    }
                }).bind("touchstart", function(e){
                    self.touch = 1
                }).bind("touchend", function(e){
                    self.touch = 2;
                }).mouseover(function(e){
                    self.triggerHandler("responsive");
                }).mouseleave(function(e){
                    self.triggerHandler("responsiveout");
                }).focus(function(e){
                    self.triggerHandler("responsive");
                }).focusout(function(e){
                    self.triggerHandler("responsiveout");
                });
            }

            var tipClass = 'qtip-' + qtipstyle + ((ithoughts_tt_gl.qtipshadow === "1") ? " qtip-shadow" : "" ) + ((ithoughts_tt_gl.qtiprounded === "1") ? " qtip-rounded" : "" ) + " " ;
            var specific;
            if($(this).hasClass("ithoughts_tooltip_glossary-glossary")){
                specific = {
                    content: {
                        text: 'Loading glossary term',
                        ajax: {
                            url     : ithoughts_tt_gl.admin_ajax,
                            type    : 'POST',
                            data    : ajaxPostData,
                            dataType: 'json',
                            loading : false,
                            success : function(resp, status){
                                if( resp.success ) {
                                    this.set( 'content.title', resp.data.title );
                                    this.set( 'content.text',  resp.data.content );
                                } else {
                                    this.set( 'content.text', 'Error' );
                                }
                            }
                        },
                        title: { text: 'Please wait' }
                    },
                    style: {
                        classes: tipClass + "ithoughts_tooltip_glossary-glossary"
                    }
                };
            } else if($(this).hasClass("ithoughts_tooltip_glossary-tooltip")){
                specific = {
                    style: {
                        classes: tipClass + "ithoughts_tooltip_glossary-tooltip"
                    },
                    content: {
                        text: window.decodeURIComponent(this.getAttribute("data-tooltip-content")),
                        title: { text: $(this).text() }
                    }
                };
            } else if($(this).hasClass("ithoughts_tooltip_glossary-mediatip")){
                specific = {
                    style: {
                        classes: tipClass + "ithoughts_tooltip_glossary-mediatip",
                        //width:"350px"
                    },
                    position:{
                        adjust: {
                            scroll: false
                        }
                    },
                    content: {
                        text: "<img src=\"" + this.getAttribute("data-mediatip-image") + "\" alt=\"" + $(this).text() + "\">",
                        title: { text: $(this).text() }
                    },
                    events:{
                        show: function(){
                            $(this).qtip().reposition();
                        }
                    }
                };
            } else
                return;
            
            if(this.getAttribute("data-tooltip-autoshow") == "true")
                specific["show"] = $.extend(true, specific["show"], {ready: true});
            if(this.getAttribute("data-tooltip-nosolo") == "true")
                specific["show"] = $.extend(true, specific["show"], {solo: false});
            if(this.getAttribute("data-tooltip-nohide") == "true")
                specific = $.extend(true, specific, {hide: "someevent", show: {event: "someevent"}});
            if(this.getAttribute("data-tooltip-id"))
                specific = $.extend(true, specific, {id: this.getAttribute("data-tooltip-id")});

            var opts = $.extend(true, {
                prerender: true,
                position: {
                    at      : 'top center', // Position the tooltip above the link
                    my      : 'bottom center',
                    viewport: $("body"),       // Keep the tooltip on-screen at all times
                    effect  : false,           // Disable positioning animation
                },
                show: {
                    event: ithoughts_tt_gl.qtiptrigger,
                    solo:  true // Only show one tooltip at a time
                },
                //hide: 'unfocus',
                hide: (ithoughts_tt_gl.qtiptrigger == 'responsive') ? "responsiveout" : 'mouseleave',
                style: tipClass
            }, specific);
            $(this).qtip(opts);

            //Remove title for tooltip, causing double tooltip
            $(this).find("a[title]").removeAttr("title");


            glossaryIndex = $("#glossary-index");
            // Tile-based glossary
            // TODO: add resize
            if(glossaryIndex){
                var bodydiv = glossaryIndex.find("#glossary-container");
                switch(glossaryIndex.data("type")){
                    case "tile":{
                        var headTiles = glossaryIndex.find("header p[data-empty=\"false\"]");
                        headTiles.click(function(e){
                            glossaryIndex.find('article[data-active="true"]').attr("data-active", false);
                            var newDisplayed = glossaryIndex.find('article[data-chartype="' + $(e.target).data("chartype") + '"]');
                            newDisplayed.attr("data-active", "true");
                            bodydiv.animate({
                                height: newDisplayed.outerHeight(true)
                            },{
                                duration: 500,
                                queue: false,
                                step:function(){
                                    bodydiv.css("overflow","visible");
                                },
                                complete: function() {
                                    bodydiv.css("overflow","visible");
                                }
                            });
                        });
                    } break;
                }
            }
        });
    });
})(jQuery);
