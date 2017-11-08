<script>
    $('[data-menu]').mouseover(function(e){
        $('.header--menu').addClass('header--menu-active');
    }).mouseout(function(e){
        $('.header--menu').removeClass('header--menu-active');
    });
    new Validity('form:not([method="post"])');
</script>
</body>
</html>
<?php 

?>