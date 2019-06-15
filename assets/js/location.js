$(document).ready(function(){
	storeLocation();
});

function storeLocation(){
    $.ajax({
        type:'GET',
        dataType: 'json',
        url:'/location/set',
        success:function(msg){
			if(msg.status === 'success') {
                $.each($('li.location'), function() {
                    var current = $(this);
                    if(current.text() == msg.city) {
                        current.html(current.text() + ' <i class="fa fa-check"></i>')
                    }
                });
			}
        }
    });
}
