<div class="preloader" style="background-image: url({{ asset('img/preloader.gif') }})"></div>

<script>

    // document.onreadystatechange = function() {
    //     if (document.readyState !== "complete") {
    //         document.querySelector(
    //             "body").style.display = "none";
    //         document.querySelector(
    //             ".preloader").style.display = "block";
    //     } else {
    //         document.querySelector(
    //             ".preloader").style.display = "none";
    //         document.querySelector(
    //             "body").style.display = "block";
    //     }
    // };
    $( window ).on('load',function() {
        $('.preloader').fadeOut(200);
    });
</script>
