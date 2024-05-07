$(document).ready(function() {
    $('figcaption').html('Image1_title <br> Image 1');
    $('#rstBtn').click(function() {
            $( "#slider_opct" ).slider( "value" , 0);
            $("#opacity").html(0);
            $( "#slider_saturation" ).slider( "value" , 0);
            $("#Saturation").html(0);
            $( "#slider_brightness" ).slider( "value", 0 );
            $("#Brightness").html(0);
            $( "#slider_hueRotate" ).slider( "value", 0 );
            $("#hueRotate").html(0);
            $( "#slider_grayscale" ).slider( "value", 0 );
            $("#grayscale").html(0);
            $( "#slider_blur" ).slider( "value", 0 );
            $("#blur").html(0);
            $('#mImage').css({
                WebkitFilter :  'opacity(1)'
            });
        }
    );
 
    $('img').on({
        'click' : function() {
            if ($(this).attr('src') === 'FP_images/small/painting1.jpg') {
                $('#mImage').attr('src', 'FP_images/medium/painting1.jpg');
                $('figcaption').html('Image1_title <br> Image 1');
                $('#mImage').attr('alt', 'Image 1');
                $('figure').attr('title', 'Image1_title');
 
            } 
            else if ($(this).attr('src') === 'FP_images/small/painting2.jpg') {
                $('#mImage').attr('src', 'FP_images/medium/painting2.jpg');
                $('figcaption').html('Image2_title <br> Image 2');
                $('#mImage').attr('alt', 'Image 2');
                $('figure').attr('title', 'Image1_title');
            } 
            else if ($(this).attr('src') === 'FP_images/small/painting3.jpg') {
                $('#mImage').attr('src', 'FP_images/medium/painting3.jpg');
                $('figcaption').html('Image3_title <br> Image 3');
                $('#mImage').attr('alt', 'Image 3');
                $('figure').attr('title', 'Image3_title');
            }
               
            else if ($(this).attr('src') === 'FP_images/small/painting4.jpg') {
                $('#mImage').attr('src', 'FP_images/medium/painting4.jpg');
                $('figcaption').html('Image4_title <br> Image 4');
                $('#mImage').attr('alt', 'Image 4');
                $('figure').attr('title', 'Image4_title');
            }
                
            else if ($(this).attr('src') === 'FP_images/small/painting5.jpg') {
                $('#mImage').attr('src', 'FP_images/medium/painting5.jpg');
                $('figcaption').html('Image5_title <br> Image 5');
                $('#mImage').attr('alt', 'Image 5');
                $('figure').attr('title', 'Image5_title');
            }
                
        }
    });
    
    //Opacity Controller
    $(".input").slider({
        slide : function(event, ui) { 
            if (event.target.id == 'slider_opct') {
                $("#opacity").html(ui.value); 
                op_val = ui.value/100;
            } else if (event.target.id == 'slider_saturation') {
                $("#Saturation").html(ui.value);
                sat_val = ui.value/100;
            } else if (event.target.id == 'slider_brightness') {
                $("#Brightness").html(ui.value);
                brght_val = ui.value/100;
            } else if (event.target.id == 'slider_hueRotate') {
                $("#hueRotate").html(ui.value);
                hue_val = ui.value;
            } else if (event.target.id == 'slider_grayscale') {
                $("#grayscale").html(ui.value);
                grey_val = ui.value/100;
            } else if (event.target.id == 'slider_blur') {
                $("#blur").html(ui.value);
                blur_val = ui.value;
            } 
 
 
 
$('#mImage').css({
                WebkitFilter :  'opacity('+op_val+') saturate('+sat_val+') ' +
                                'brightness('+brght_val+') hue-rotate('+hue_val+'deg) ' +
                                'grayscale('+grey_val+') blur('+blur_val+'px)'
            });
        } 
    });
 
    var op_val = $( "#slider_opct" ).slider( "value" );
    $("#opacity").html(op_val);
    var sat_val = $( "#slider_saturation" ).slider( "value" );
    $("#Saturation").html(sat_val);
    var brght_val = $( "#slider_brightness" ).slider( "value" );
    $("#Brightness").html(brght_val);
    var hue_val = $( "#slider_hueRotate" ).slider( "value" );
    $("#hueRotate").html(hue_val);
    var grey_val = $( "#slider_grayscale" ).slider( "value" );
    $("#grayscale").html(grey_val);
    var blur_val = $( "#slider_blur" ).slider( "value" );
    $("#blur").html(blur_val);
});
