
//
$(document).ready(function () {

    $('body').css('background', 'rgb(238,240,38)');
    $('body').css('background', 'radial-gradient(circle, rgba(238,240,38,1) 0%, rgba(72,145,200,1) 100%)');
    $('main').css('background', 'url(fondo.png)');
    $('main').css('height', '870px');
    $('main').css('margin-bottom', '-150px');
    $('img').css('margin', '0px');
    $('p').css('color', 'black');
    $('a').css('color', 'black');
    $('footer').css('background', '#cfe2ff7d');
    $('footer').css('margin', '30px');

    $('.card').css('background', 'rgb(1 112 255 / 57%)');
    $('#result').css('background', 'white');
    $('.btn-primary').css('background', 'red');
    
    $('#out').hide()
    $("#barcode").focus();
    $("#name").focus();

    var timeout = null;
    name = $.trim($('#name').val());
        
    $('#barcode').keyup(function(){

        clearTimeout(timeout);

         timeout = setTimeout(function (){
            
            barcode = $.trim($('#barcode').val());
            console.log(barcode)

            $('#out').show()
            $('#inputs').hide()

            $.ajax({
                type: "POST",
                url: "abr_controller.php?op=enlist",
                dataType: "html",
                data:  {barcode:barcode},
                success: function (data) {
                    $('#result').empty();
                    $('#result').html(data);
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            });
            
 
            
        }, 1000);
    });
 
    $('#name').keyup(function (e) {
        name = $(this).val(); 
        //console.log(name.length)
        
        if (name.length == 0) {
            $('#product').hide()
            location.reload();
        }
        $.ajax({
            type: "POST",
            url: "abr_controller.php?op=barcode",
            dataType: "html",
            data:  {name:name},
            success: function (data) {
                //console.log(data)
                $('#product').show()
                $('#product').empty();
                $('#product').html(data);

                var count = $(".btn-primary").length;
                console.log(count)
                generate(count)
            }
        });
         
    });

    $('#btngenerate').click(function (e) { 
        e.preventDefault();
        $(location).attr('href','bargenerate.html');
    });

    $('#btnreader').click(function (e) { 
        e.preventDefault();
        $(location).attr('href','./');
    });
    
});

function generate(count) {
    //console.log(count+'funcion')
    for (let index = 1; index <= count; index++) {

        $(document).on("click", "#generate"+[index], function(){
        	refer = $.trim($('#refer'+[index]).val());
            $('#product').hide()
            $('#code').empty();	        
            $('#code').append('<div class="container"><img src="barcode.php?text='+refer+'&size=150&print=true&sizefactor=1.5" alt="" srcset=""></img></div>');
        });
        
    }
    
}

