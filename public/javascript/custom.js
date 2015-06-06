jQuery(document).ready(function($) {
    var color = "red";
    var css_url = "/css/style.css";
    $('head').append('<link rel="stylesheet" href="' + css_url + '" type="text/css" />');

})

function is_touch_device() {
    return !!('ontouchstart' in window);
}

/*--------------------------------------------------
 DROPDOWN MENU
 ---------------------------------------------------*/
/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

(function($){$.fn.superfish=function(op){var sf=$.fn.superfish,c=sf.c,$arrow=$(['<span class="',c.arrowClass,'"> &#187;</span>'].join("")),over=function(){var $$=$(this),menu=getMenu($$);clearTimeout(menu.sfTimer);$$.showSuperfishUl().siblings().hideSuperfishUl();},out=function(){var $$=$(this),menu=getMenu($$),o=sf.op;clearTimeout(menu.sfTimer);menu.sfTimer=setTimeout(function(){o.retainPath=($.inArray($$[0],o.$path)>-1);$$.hideSuperfishUl();if(o.$path.length&&$$.parents(["li.",o.hoverClass].join("")).length<1){over.call(o.$path);}},o.delay);},getMenu=function($menu){var menu=$menu.parents(["ul.",c.menuClass,":first"].join(""))[0];sf.op=sf.o[menu.serial];return menu;},addArrow=function($a){$a.addClass(c.anchorClass).append($arrow.clone());};return this.each(function(){var s=this.serial=sf.o.length;var o=$.extend({},sf.defaults,op);o.$path=$("li."+o.pathClass,this).slice(0,o.pathLevels).each(function(){$(this).addClass([o.hoverClass,c.bcClass].join(" ")).filter("li:has(ul)").removeClass(o.pathClass);});sf.o[s]=sf.op=o;$("li:has(ul)",this)[($.fn.hoverIntent&&!o.disableHI)?"hoverIntent":"hover"](over,out).each(function(){if(o.autoArrows){addArrow($(">a:first-child",this));}}).not("."+c.bcClass).hideSuperfishUl();var $a=$("a",this);$a.each(function(i){var $li=$a.eq(i).parents("li");$a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});});o.onInit.call(this);}).each(function(){var menuClasses=[c.menuClass];if(sf.op.dropShadows&&!($.browser.msie&&$.browser.version<7)){menuClasses.push(c.shadowClass);}$(this).addClass(menuClasses.join(" "));});};var sf=$.fn.superfish;sf.o=[];sf.op={};sf.IE7fix=function(){var o=sf.op;if($.browser.msie&&$.browser.version>6&&o.dropShadows&&o.animation.opacity!=undefined){this.toggleClass(sf.c.shadowClass+"-off");}};sf.c={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",arrowClass:"sf-sub-indicator",shadowClass:"sf-shadow"};sf.defaults={hoverClass:"sfHover",pathClass:"overideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},speed:"normal",autoArrows:true,dropShadows:true,disableHI:false,onInit:function(){},onBeforeShow:function(){},onShow:function(){},onHide:function(){}};$.fn.extend({hideSuperfishUl:function(){var o=sf.op,not=(o.retainPath===true)?o.$path:"";o.retainPath=false;var $ul=$(["li.",o.hoverClass].join(""),this).add(this).not(not).removeClass(o.hoverClass).find(">ul").hide().css("visibility","hidden");o.onHide.call($ul);return this;},showSuperfishUl:function(){var o=sf.op,sh=sf.c.shadowClass+"-off",$ul=this.addClass(o.hoverClass).find(">ul:hidden").css("visibility","visible");sf.IE7fix.call($ul);o.onBeforeShow.call($ul);$ul.animate(o.animation,o.speed,function(){sf.IE7fix.call($ul);o.onShow.call($ul);});return this;}});})(jQuery);

/*--------------------------------------------------
 ADDITIONAL CODE FOR DROPDOWN MENU
 ---------------------------------------------------*/
jQuery(document).ready(function($) {
    $('ul.menu').superfish({
        delay:       200,                            // one second delay on mouseout
        animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
        speed:       'fast',                          // faster animation speed
        autoArrows:  false                           // disable generation of arrow mark-up
    });
});


/***************************************************
 PORTFOLIO ITEM IMAGE HOVER
 ***************************************************/
$(window).load(function(){

    $(".portfolio-grid ul li .item-info-overlay").hide();

    if( is_touch_device() ){
        $(".portfolio-grid ul li").click(function(){

            var count_before = $(this).closest("li").prevAll("li").length;

            var this_opacity = $(this).find(".item-info-overlay").css("opacity");
            var this_display = $(this).find(".item-info-overlay").css("display");


            if ((this_opacity == 0) || (this_display == "none")) {
                $(this).find(".item-info-overlay").fadeTo(250, 1);
            } else {
                $(this).find(".item-info-overlay").fadeTo(250, 0);
            }

            $(this).closest("ul").find("li:lt(" + count_before + ") .item-info-overlay").fadeTo(250, 0);
            $(this).closest("ul").find("li:gt(" + count_before + ") .item-info-overlay").fadeTo(250, 0);

        });

    }
    else{
        $(".portfolio-grid ul li").hover(function(){
            $(this).find(".item-info-overlay").fadeTo(250, 1);
        }, function() {
            $(this).find(".item-info-overlay").fadeTo(250, 0);
        });

    }




});

/***************************************************
 DUPLICATE H3 & H4 IN PORTFOLIO
 ***************************************************/
$(window).load(function(){

    $(".item-info").each(function(i){
        $(this).next().prepend($(this).html())
    });
});

/***************************************************
 TOGGLE STYLE
 ***************************************************/
jQuery(document).ready(function($) {

    $(".toggle-container").hide();
    $(".trigger").toggle(function(){
        $(this).addClass("active");
    }, function () {
        $(this).removeClass("active");
    });
    $(".trigger").click(function(){
        $(this).next(".toggle-container").slideToggle();
    });
});

/***************************************************
 ACCORDION
 ***************************************************/
$(document).ready(function(){
    $('.trigger-button').click(function() {
        $(".trigger-button").removeClass("active")
        $('.accordion').slideUp('normal');
        if($(this).next().is(':hidden') == true) {
            $(this).next().slideDown('normal');
            $(this).addClass("active");
        }
    });
    $('.accordion').hide();
});

/*--------------------------------------------------
 ADDITIONAL CODE GRID LIST
 ---------------------------------------------------*/
(function($){
    $.fn.extend({
        bra_last_last_row: function() {
            return this.each(function() {
                $(this).each(function(){
                    var no_of_items = $(this).find("li").length;
                    var no_of_cols = Math.round($(this).width() / $(this).find(":first").width() );
                    var no_of_rows = Math.ceil(no_of_items / no_of_cols);
                    var last_row_start = (no_of_rows - 1) * no_of_cols - 1;
                    if (last_row_start < (no_of_cols - 1)) {
                        last_row_start = 0;
                        $(this).find("li:eq(" + last_row_start + ")").addClass("last-row");
                    }
                    $(this).find("li:nth-child(" + no_of_cols + "n+ " + no_of_cols + ")").addClass("last");
                    $(this).find("li:gt(" + last_row_start + ")").addClass("last-row");
                })
            }); // return this.each
        }
    });
})(jQuery);

jQuery(document).ready(function($) {
    $('.grid').bra_last_last_row();
    //$(window).resize(function() {
    //$('.grid').bra_last_last_row();
    //});
})

/***************************************************
 SELECT MENU ON SMALL DEVICES
 ***************************************************/
jQuery(document).ready(function($){

    var $menu_select = $("<select />");
    $("<option />", {"selected": "selected", "value": "", "text": "Site Navigation"}).appendTo($menu_select);
    $menu_select.appendTo("#primary-menu");

    $("#primary-menu ul li a").each(function(){
        var menu_url = $(this).attr("href");
        var menu_text = $(this).text();

        if ($(this).parents("li").length == 2) { menu_text = '- ' + menu_text; }
        if ($(this).parents("li").length == 3) { menu_text = "-- " + menu_text; }
        if ($(this).parents("li").length > 3) { menu_text = "--- " + menu_text; }
        $("<option />", {"value": menu_url, "text": menu_text}).appendTo($menu_select)
    })

    field_id = "#primary-menu select";
    $(field_id).change(function()
    {
        value = $(this).attr('value');
        window.location = value;
        //go

    });
})


/***************************************************
 ADD MASK LAYER
 ***************************************************/
$(window).load(function(){
    var $item_mask = $("<div />", {"class": "item-mask"});
    $("ul.shaped .item-container, ul.comment-list .avatar").append($item_mask)
})

/***************************************************
Eric's Scripts
 ***************************************************/

$(document).ready(function($) {
    $('#adminCarouselListbox').change(function(){
        $('#adminCarouselImage').attr('src',$('#adminCarouselListbox option:selected').data('image'));
        $('#adminCarouselTextarea').val($('#adminCarouselListbox option:selected').data('caption'));

    });
    $('#adminAboutListbox').change(function(){
        $('#adminAboutTitle').val($('#adminAboutListbox option:selected').data('heading'));
        $('#adminAboutText').val($('#adminAboutListbox option:selected').data('caption'));
    });
    $('#adminBoardListbox').change(function(){
        $('#adminBoardImage').attr('src',$('#adminBoardListbox option:selected').data('image'));
        $('#adminBoardTextarea').val($('#adminBoardListbox option:selected').data('caption'));
       // $('#adminBoardPosition').val($('#adminBoardListbox option:selected').data('position'));
       // alert($('#adminBoardListbox option:selected').data('position'));
        $('#adminBoardPosition').val($('#adminBoardListbox option:selected').data('position'));
        $('#adminBoardTwitter').val($('#adminBoardListbox option:selected').data('twitter'));
        $('#adminBoardFacebook').val($('#adminBoardListbox option:selected').data('facebook'));
        $('#adminBoardName').val($('#adminBoardListbox option:selected').text());
        $('#adminBoardYear').val($('#adminBoardListbox option:selected').data('year'));
        //alert($('#adminBoardListbox option:selected').data('position'));


    });

    $('#fileUpload2').live('change', function(){
        var tmppath = URL.createObjectURL(event.target.files[0]);
        $('#adminBlogImageId').attr('src',tmppath);

    });
    $('#fileUpload3').live('change', function(){
        var tmppath = URL.createObjectURL(event.target.files[0]);
        $('#adminBoardImage').attr('src',tmppath);

    });
    $('#adminBoardYearTop').live('change', function(){
       var id = $('#adminBoardYearTop option:selected').val();
       // var currentUrl = window.location.href;
       // alert(currentUrl);
       // var nextUrl = currentUrl.replace('adminteam','');
       // alert(nextUrl);

        window.location.href = '/adminteam/' + id;



    });


    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           // 'X-XSRF-TOKEN': $('meta[name="xsrf-token"]').attr('content')
        }
    });

});

function SaveCarouselEdits()
{
    var itemId = $('#adminCarouselListbox option:selected').val();
    var caption = $('#adminCarouselTextarea').val();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var xsrfToken = $('meta[name="xsrf-token"]').attr('content');
    var url = "../updateCarouselItem/" + itemId;
    //alert('here');
    $.ajax({
        type: "POST",
        url: url,
        beforeSend: function(xhr) {

            //xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
            xhr.setRequestHeader("X-XSRF-TOKEN", xsrfToken);
        },
        data: {caption: caption, itemId:itemId},//, _token: csrfToken},
        success: function (data) {
            //alert(data);
            //var obj=JSON.parse(data);
           // alert(obj.caption);
            if(data!=='false') {
                $('#adminCarouselListbox option:selected').data('caption', caption);
                $('#adminCarouselListbox option:selected').attr('data-caption', caption);
                $('#carouselCaption' + itemId).html(caption);
                //alert('Data was updated');
            }
            else
            {
                alert('Data could not be saved');
            }

        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}

function DeleteCarouselItem()
{
    var itemId = $('#adminCarouselListbox option:selected').val();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    var url = "../deleteCarouselItem";
    $.ajax({
        type: "POST",
        url: url,
        data: {itemId:itemId,_token: csrfToken},
        success: function (data) {
            //alert(data);
            //var obj=JSON.parse(data);
            // alert(obj.caption);
            if(data!=='false') {
                window.location.reload();
                //alert('Data was updated');
            }
            else
            {
                alert('Data could not be saved');
            }

        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}

function uploadCarouselImage()  //not working
{
    var fd = new FormData();
    var fdExists=false;
    var url = "../uploadCarouselItem";
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var xsrfToken = $('meta[name="xsrf-token"]').attr('content');


    //fd.append('file-0',$('#fileUpload1')[0].files[0]);
    alert(csrfToken);
    alert(xsrfToken);
   // alert($('#carouselUploadForm').serialize());
   // "#carouselUploadForm").ajaxSubmit({url: url, type: 'post'});
   $.each($('#fileUpload1')[0].files, function(i,file){
        fd.append('file-'+i,file);
        fdExists=true;
       alert('hello');
    });
    fd.append('_token',csrfToken);
    fd.append('random','myvalue');

    if(fdExists)
    {

        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader("X-XSRF-TOKEN", xsrfToken);
                xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
            },
            type: "POST",
            url: url,
            data: fd,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                //alert(data);
                //var obj=JSON.parse(data);
                // alert(obj.caption);
                if(data!=='false') {
                    alert(data);

                    alert('Data was updated');
                }
                else
                {
                    alert('Data could not be saved');
                }

            },
            error: function(xhr, status, error){

                alert('error');
                alert(xhr.responseText);
            }
        });

    }
}


function SaveAboutEdits()
{
    var heading = $('#adminAboutTitle').val();
    var html_text = $('#adminAboutText').val();
    var itemId =  $('#adminAboutListbox option:selected').val();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var url = "../updateAboutItem/" + itemId;
    //alert(title);
    //alert(text);
    //alert(itemId);
    $.ajax({
        type: "POST",
        url: url,
        data: {heading: heading, html_text: html_text,itemId:itemId,_token: csrfToken},
        success: function (data) {
            //alert(data);
            var obj=JSON.parse(data);
            obj.heading;
            if(data!=='false') {
                $('#adminAboutlListbox option:selected').data('heading', heading);
                $('#adminAboutListbox option:selected').attr('data-heading', heading);
                $('#adminAboutlListbox option:selected').data('caption', html_text);
                $('#adminAboutListbox option:selected').attr('data-caption', html_text);
                $('#adminAboutTitlePresent' + itemId).html(heading);
                $('#adminAboutTextPresent' + itemId).html(html_text);
                //$('#carouselCaption' + itemId).html(caption);
               // alert('Data was updated');
            }
            else
            {
                alert('Data could not be saved');
            }

        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}
function StartBlogEntry()
{
   // $('#newBlogDiv').show();
    $('#newBlogDiv').height('auto');
    //alert('yo');
}
function PostBlogEntry()
{
    var html_text = $('#adminBlogEntry').val();
    var image_url = $('#adminBlogImageId').attr('src');
    var heading = $('#adminBlogHeadingId').val();

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var url = "../insertBlog";

    $.ajax({
        type: "POST",
        url: url,
        data: {heading: heading, html_text: html_text,image_url: image_url,_token: csrfToken},
        success: function (data) {
            //alert(data);
            var obj=JSON.parse(data);
            obj.heading;
            if(data!=='false') {

               // alert('Data was updated');
                window.location.reload();
            }
            else
            {
                alert('Data could not be saved');
            }

        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}

function StartCommentEntry(id)
{
    $('#newComment' + id).height('auto');

}
function CancelBlogEntry()
{
    //$('#newBlogDiv').hide();
    $('#newBlogDiv').height(0);
}
function CancelCommentEntry(id)
{
    //$('#newBlogDiv').hide();
    $('#newComment' + id).height(0);
}
function PostCommentEntry(id)
{
    var html_text = $('#adminCommentEntry'+id).val();


    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var url = "../insertComment";

    $.ajax({
        type: "POST",
        url: url,
        data: {html_text: html_text,blog_id: id,_token: csrfToken},
        success: function (data) {
            //alert(data);
            var obj=JSON.parse(data);
            obj.heading;
            if(data!=='false') {

                //alert('Data was updated');
                window.location.reload();
            }
            else
            {
                alert('Data could not be saved');
            }

        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}

function DeleteComment(id)
{
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var url = "../deleteComment";

    $.ajax({
        type: "POST",
        url: url,
        data: {id: id,_token: csrfToken},
        success: function (data) {
            //alert(data);
            var obj=JSON.parse(data);
            obj.heading;
            if(data!=='false') {

                //alert('Data was updated');
                window.location.reload();
            }
            else
            {
                alert('Data could not be saved');
            }

        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}

function MoveBlogUp(id)
{
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var url = "../moveBlogUp";

    $.ajax({
        type: "POST",
        url: url,
        data: {id: id,_token: csrfToken},
        success: function (data) {
            //alert(data);

            if(data!=='false') {

                //alert('Data was updated');
                window.location.reload();
            }
            else
            {
                alert('Data could not be saved');
            }

        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}

function PromoteToHomePage(id)
{
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var url = "../promoteToHomepage";

    $.ajax({
        type: "POST",
        url: url,
        data: {id: id,_token: csrfToken},
        success: function (data) {
            //alert(data);

            if(data!=='false') {

                //alert('Data was updated');
                window.location.reload();
            }
            else
            {
                alert('Data could not be saved');
            }

        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}
function RemoveFromHomePage(id)
{
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var url = "../removeFromHomepage";

    $.ajax({
        type: "POST",
        url: url,
        data: {id: id,_token: csrfToken},
        success: function (data) {
            //alert(data);

            if(data!=='false') {

                //alert('Data was updated');
                window.location.reload();
            }
            else
            {
                alert('Data could not be saved');
            }

        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}
function UpdateAddress(){
    var address = $('#address').val();

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var url = "../updateAddress" ;
    //alert(title);
    //alert(text);
    //alert(itemId);
    $.ajax({
        type: "POST",
        url: url,
        data: {html_text: address,_token: csrfToken},
        success: function (data) {
            //alert(data);

            if(data!=='false') {
                window.location.reload();

                // alert('Data was updated');
            }
            else
            {
                alert('Data could not be saved');
            }

        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}

function UpdateBoardMember(){
    var id =  $('#adminBoardListbox option:selected').val();
    var year = $('#adminBoardYear').val();
    var name = $('#adminBoardName').val();
    var description = $('#adminBoardTextarea').val();
    var position = $('#adminBoardPosition').val();
    var twitter = $('#adminBoardTwitter').val();
    var facebook = $('#adminBoardFacebook').val();


    var url = "../updateTeam" ;

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    //alert(title);
    //alert(text);
    //alert(itemId);
    $.ajax({
        type: "POST",
        url: url,
        data: {id:id,year:year,name: name,description:description,position:position,twitter:twitter,facebook:facebook,_token: csrfToken},
        success: function (data) {
            //alert(data);

            if(data!=='false') {
                window.location.reload();

                // alert('Data was updated');
            }
            else
            {
                alert('Data could not be saved');
            }

        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}

function searchEventsByDateRange()
{
    var valFrom = $('#from').val();
    var valTo = $('#to').val();
    //alert(valFrom);
   // alert(valTo);
    var url = "../getEventsForDateRange" ;

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: "POST",
        url: url,
        data: {from:valFrom,to:valTo,_token: csrfToken},
        success: function (data) {
           // alert(data);
            $('#adminEventListbox').children().remove().end();
            var events = jQuery.parseJSON(data);
            $.each(events,function(){
                var t = this.event_date.split(/[- :]/);

                // Apply each element to the Date function
                var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                $('#adminEventListbox').append('<option>' + d.toFormattedString() + ' - ' + this.event_name + '</option>');
            });




        },
        error: function(xhr, status, error){

            alert('error');
            alert(xhr.responseText);
        }
    });
}
/************************************
 * Method extensions
 */

String.prototype.padLeft = function (length, character) {
    return new Array(length - this.length + 1).join(character || ' ') + this;
};

Date.prototype.toFormattedString = function () {
    return [String(this.getMonth()+1).padLeft(2, '0'),
            String(this.getDate()).padLeft(2, '0'),
            String(this.getFullYear())].join("/");
};
Date.prototype.addMonths = function(number) {
    var end = new Date(+this);
    end.setMonth(end.getMonth() + number);
    return end;


};
Date.prototype.addYears = function(number) {
    var end = new Date(+this);
    end.setFullYear(end.getFullYear() + number );
    return end;


};


