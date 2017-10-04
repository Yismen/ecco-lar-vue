<style>
    #back2Top {
    width: 40px;
    line-height: 40px;
    overflow: hidden;
    z-index: 999;
    display: none;
    cursor: pointer;
    -moz-transform: rotate(270deg);
    -webkit-transform: rotate(270deg);
    -o-transform: rotate(270deg);
    -ms-transform: rotate(270deg);
    transform: rotate(270deg);
    position: fixed;
    bottom: 50px;
    right: 0;
    background-color: #DDD;
    color: #555;
    text-align: center;
    font-size: 30px;
    text-decoration: none;
}
#back2Top:hover {
    background-color: #DDF;
    color: #000;
}
</style>

<a id="back2Top" title="Back to top" href="#">&#10148;</a>
@section('scripts')
    <script  type="text/javascript">
            console.log("scroll")
            $(window).scroll(function() {
                var height = $(window).scrollTop();
                    console.log("scroll")
                if (height > 100) {
                        console.log("show")
                    $('#back2Top').fadeIn();
                } else {
                        console.log("hide")
                    $('#back2Top').fadeOut();
                }
            });
            $(document).ready(function() {
                $("#back2Top").click(function(event) {
                    event.preventDefault();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    return false;
                });

            });
    </script>
@stop