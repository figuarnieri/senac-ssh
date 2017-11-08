<script>
    $('[data-menu]').mouseover(function(e){
        $('.header--menu').addClass('header--menu-active');
    }).mouseout(function(e){
        $('.header--menu').removeClass('header--menu-active');
    });
	$('[data-passchange]').click(function(e){
		$(this).closest('.cf').slideUp(400).prev().slideDown(400);
	});

	$('[data-multichange="all"]').change(function(e){
		if($(this).is(':checked')){
			$('.list--table td [type="checkbox"]').each(function(f,g){
				if(!$(g).is(':checked')){
					$(g).trigger('click');
				}
			});
		} else {
			$('.list--table td [type="checkbox"]').each(function(f,g){
				if($(g).is(':checked')){
					$(g).trigger('click');
				}
			});
		}
	});
	$('[data-selectchange]').change(function(e) {
		$(this).closest('form').trigger('submit');
	});
	$('[data-user-status]').click(function(e){
		if($(this).hasClass('fa-check-circle')){
			$(this).removeClass('fa-check-circle').addClass('fa-times-circle').attr({'data-tipfy':'Inativo'});
		} else {
			$(this).addClass('fa-check-circle').removeClass('fa-times-circle').attr({'data-tipfy':'Ativo'});
		}
		$('.tipfy--wrap').remove();
	});
	$('.list--table td [type="checkbox"]').change(function(e){
		if($('.list--table td [type="checkbox"]:not(:checked)').length === $('.list--table td [type="checkbox"]').length){
			$('.list--tools').slideUp(200);
		} else {
			$('.list--tools').slideDown(200);
		}
	});
	$('[data-login]').click(function(e){
		e.preventDefault();
		var btnText = $(this).text()
		if($(this).hasClass('login--area-active')) return;
		$('[data-login]').each(function(f, g){
			$($(g).data('login')).hide(600);
			$(this).removeClass('login--area-active');
		});
		if(btnText.toLowerCase() === 'cadastro'){
			$($(this).data('login')).show(600);
			$(this).addClass('login--area-active');
		} else {
			$($(this).data('login')).show(600);
			$('.login--tabs .login--area:first-child').addClass('login--area-active');
		}
	});
	$('[data-showpass]').mousedown(function(){
		$(this).addClass('fa-eye-slash').removeClass('fa-eye');
		$(this).prev().attr('type','text');
	}).mouseup(function(){
		$(this).addClass('fa-eye').removeClass('fa-eye-slash');
		$(this).prev().attr('type','password');
	});
	$('[data-keypass]').keyup(function(){
		if($(this).val()!==''){
			$(this).next().removeClass('d-n');
		} else {
			$(this).next().addClass('d-n');
		}
	});
	setTimeout(() => {
		$('.login--alert').slideUp(600);
	}, 2000);

	new Maskfy('[data-mask]');
	new Tipfy('[data-tipfy]');
    new Validity('form:not([method="post"])');
</script>
</body>
</html>
<?php 

?>