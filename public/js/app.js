//Ajax
function do_post(path,obj,callback){
	$.post( path, obj).done(function( data ) {
        //var data = $.parseJSON(data);
        callback(data);
    });
} 