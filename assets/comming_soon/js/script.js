'use strict';
$(document).ready(function () {
    $(".bar").on('click',function() {
        $(".menu-collapsed").toggleClass("menu-expanded");
        $(".home .content").toggleClass("animated fadeOut animated");
        $(".subscribe").toggleClass("animated2 fadeOut animated2");
    });
    $(".subscribe h4 i").on('click',function() {
        $(".subscribe").toggleClass("aa");
        $(".subscribe h4 i").toggleClass("fa-minus fa-plus");
    });
    if ( $(window).width() < 768 ) {
        $(".subscribe").toggleClass("aa");
        $(".subscribe h4 i").toggleClass("fa-minus fa-plus");
        $(".subscribe h4").on('click',function() {
            $(".subscribe").toggleClass("aa");
            $(".subscribe h4 i").toggleClass("fa-minus fa-plus");
        });
    }
    $('.ssa').addClass('mast__title');
    $('.sa').addClass('mast__text');
    var s,
        spanizeLetters = {
            settings: {
                letters: $('.js-spanize')
            },
            init: function() {
                s = this.settings;
                this.bindEvents();
            },
            bindEvents: function(){
                s.letters.html(function (i, el) {
                    //spanizeLetters.joinChars();
                    var spanizer = $.trim(el).split("");
                    return '<span>' + spanizer.join('</span><span>') + '</span>';
                });
            }
        };
    spanizeLetters.init();
});