var calck_frame = document.getElementById('calck_frame_slider');
noUiSlider.create(calck_frame, {
    start: 500,
    step: 1,
    connect: [true, false],
    range: {
        'min': 0,
        'max': 30000
    }
});

calck_frame.noUiSlider.on('update', function () {
    val = calck_frame.noUiSlider.get();
    val=Math.round(val);
    $('#calck_frame .calck_frame-item-inp').val((val).toLocaleString('ru'));
    // $('.calck_frame-item-inp').val(val);
    sum();
});


$('#calck_frame .calck_frame-item-inp').keyup(function(){
    thisValue = $(this).val($(this).val().replace(/[^0-9]/gi, ''));
    thisValue = $(this).val();

    if(thisValue.length > 1) {
        calck_frame.noUiSlider.set($.trim(thisValue));
        sum();
    }
});


// $('#calck_frame .calck_frame-item-inp').change(function(){
// 	calck_frame.noUiSlider.set($(this).val());
// 	sum();
// });

$('#calck_frame .calck_frame-btns a').click(function(e) {
    e.preventDefault();
    $('#calck_frame .calck_frame-btns a').removeClass('active');
    $(this).addClass('active');
    sum();

    if ($(this).text() === '1 week') {
        $('#calck_frame .percent').text('10%');
        sum();
    } else if ($(this).text() === '2 weeks') {
        $('#calck_frame .percent').text('25%');
        sum();
    } else if ($(this).text() === '1 month') {
        $('#calck_frame .percent').text('70%');
        sum();
    } else if ($(this).text() === '3 months') {
        $('#calck_frame .percent').text('250%');
        sum();
    } else {}
});

function sum() {
    var arr=new Array();
    arr[0]=new Array();
    arr[1]=new Array();
    arr[2]=new Array();
    arr[3]=new Array();
    arr[0][0]=0;
    arr[0][1]=0;
    arr[0][2]=1;
    arr[1][0]=0.0037;
    arr[1][1]=1;
    arr[1][2]=1;
    arr[2][0]=0.0086;
    arr[2][1]=1;
    arr[2][2]=1;
    arr[3][0]=0.0179;
    arr[3][1]=1;
    arr[3][2]=1;
    var input=Number($('#calck_frame .calck_frame-item-inp').val().replace(/\s/g, ''))*1;
    var index=$('#calck_frame .calck_frame-btns a.active').index()*1;
    var sum=input;

    var percent = $(".percent").html();
        percent = parseFloat(percent);


    for (var i = 1; i <= arr[index][2]; i++) {
        sum += sum / 100 * percent;
    }
    //if (arr[index][0]) sum += sum * arr[index][0];

    var sum1 = sum.toFixed(2).split(".");
    var sum2 = (sum - input).toFixed(2).split(".");

    $('#calck_frame .sum1').html(Number(sum1[0]).toLocaleString('ru'));
    $('#calck_frame .sum2').html(Number(sum2[0]).toLocaleString('ru'));
    $('#calck_frame .day').html($('#calck_frame .calck_frame-btns a.active').html());
    $('#calck_frame .bonus').html(arr[index][0]*100);
    if (arr[index][1]) $('#calck_frame .cap').html('��');
    else $('#calck_frame .cap').html('���');

    
}
