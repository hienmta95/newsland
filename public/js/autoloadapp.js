$(document).ready(function(){


    $("#app-apple_link").blur(function () {
        var apple_link = $("#app-apple_link").val();

        var nameList = apple_link.split ('/');
        var country =nameList[3];
        var id =nameList[nameList.length-1];
        var name_list= id.split ('?');
        var app_id = name_list[0];
        app_id = app_id.substring(2, app_id.length);
        apple_link=window.location.origin + '/api/v1/appinfos/ajax?app_id='+app_id
            +'&country='+country;
        // alert(apple_link);
        $.get(apple_link, function(data){
            var results = data.results;
            results = results[0];
            $("#app-app_id").val(app_id);
            $("#app-app_name").val(results.trackName);
            if(results.artworkUrl100){
                $("#app-app_icon").val(results.artworkUrl100);
            }else if(results.artworkUrl60){
                $("#app-app_icon").val(results.artworkUrl60);
            }else{
                $("#app-app_icon").val(results.artworkUrl512);
            }
            $("#app-country").val(country);
            $("#app-publisher").val(results.sellerName);
            var date = new Date(results.releaseDate);
            var dateString = date.getFullYear() + "-" + getTwoDigit(date.getMonth()+1) + "-" + getTwoDigit(date.getDate())  + " " + getTwoDigit(date.getHours()) + ":" + getTwoDigit(date.getMinutes()) + ":" + getTwoDigit(date.getSeconds());

            $("#app-published_at").val(dateString);
            $("#app-description").val(results.description);
            CKEDITOR.instances['app-description'].setData(results.description);

        });
    });
    lang_link=window.location.origin + '/api/v1/masters/lang';

    $("#tag-value").change(function () {
        // alert(apple_link);
        $.get(lang_link, function(data){

            for(var i=0; i <= data.length; i++){
                if($("#tag-value").val()==data[i].en){
                    $("#tag-value").val(data[i].en);
                    $("#tag-value_jp").val(data[i].jp);
                    $("#tag-value_cn").val(data[i].cn);
                    $("#tag-value_zh").val(data[i].zh);
                    $("#tag-value_kr").val(data[i].kr);
                }
            }
        });
    }).change();


    $("#tag-value_jp").change(function () {
        // alert(apple_link);
        $.get(lang_link, function(data){

            for(var i=0; i < data.length; i++){
                if($("#tag-value_jp").val()==data[i].jp){
                    $("#tag-value").val(data[i].en);
                    $("#tag-value_jp").val(data[i].jp);
                    $("#tag-value_cn").val(data[i].cn);
                    $("#tag-value_zh").val(data[i].zh);
                    $("#tag-value_kr").val(data[i].kr);
                }
            }
        });
    });


    $("#tag-value_cn").change(function () {
        // alert(apple_link);
        $.get(lang_link, function(data){

            for(var i=0; i <= data.length; i++){
                if($("#tag-value_cn").val()==data[i].cn){
                    $("#tag-value").val(data[i].en);
                    $("#tag-value_jp").val(data[i].jp);
                    $("#tag-value_cn").val(data[i].cn);
                    $("#tag-value_zh").val(data[i].zh);
                    $("#tag-value_kr").val(data[i].kr);
                }
            }
        });
    });


    $("#tag-value_zh").change(function () {
        // alert(apple_link);
        $.get(lang_link, function(data){

            for(var i=0; i <= data.length; i++){
                if($("#tag-value_zh").val()==data[i].zh){
                    $("#tag-value").val(data[i].en);
                    $("#tag-value_jp").val(data[i].jp);
                    $("#tag-value_cn").val(data[i].cn);
                    $("#tag-value_zh").val(data[i].zh);
                    $("#tag-value_kr").val(data[i].kr);
                }
            }
        });
    });


    $("#tag-value_kr").change(function () {
        // alert(apple_link);
        $.get(lang_link, function(data){

            for(var i=0; i <= data.length; i++){
                if($("#tag-value_kr").val()==data[i].kr){
                    $("#tag-value").val(data[i].en);
                    $("#tag-value_jp").val(data[i].jp);
                    $("#tag-value_cn").val(data[i].cn);
                    $("#tag-value_zh").val(data[i].zh);
                    $("#tag-value_kr").val(data[i].kr);
                }
            }
        });
    });

    function getTwoDigit(number){
        return ("0" + number).slice(-2)
    }

    $("#event-start_at").blur(function () {
        var start_time = $("#event-start_at").val();
        var reg = new RegExp('-', 'g');
        var start_time_stamp = Date.parse(start_time.replace(reg,"/"));
        var end_time = new Date(start_time_stamp + 86400000);
        var end_time_string = end_time.getFullYear() + "-" + getTwoDigit(end_time.getMonth()+1) + "-" + getTwoDigit(end_time.getDate())  + " " + getTwoDigit(end_time.getHours()) + ":" + getTwoDigit(end_time.getMinutes()) + ":" + getTwoDigit(end_time.getSeconds());
        $("#event-end_at").val(end_time_string);
    });


});