</div>
<script>
    $('[data-nav]').click(function(e){
        $('body').toggleClass('navactive');
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
	$('[data-file]').on('change', function(e){
		var that = $(this)
		, img = that.parent().children('img')
		, file = this.files[0]
		;
		console.log(file);
		if(file){
			var src = URL.createObjectURL(this.files[0]);
			that.parent().removeClass('form--thumb-empty fa fa-shopping-bag fa-camera');
			if(img.length){
				img.attr({'src': src});
			} else {
				that.before('<img width="100%" height="auto" class="img-responsive" src="'+src+'" />');
			}
		} else {
			that.parent().addClass('form--thumb-empty fa fa-shopping-bag');
			img.remove();
		}
	});
	$('[data-search-filter]').on('input', function(e){
        document.querySelectorAll('.list--table tr').forEach(function(item) {
            if(item.querySelector('th')) return;
            var regex = new RegExp(e.target.value, 'gi');
            var txt = item.textContent.replace(/\n./g, ' ').replace(/\s\s+/g, ' ');
            regex.test(txt) ? item.closest('tr').classList.remove('d-n') : item.closest('tr').classList.add('d-n');
        });
    });

	setTimeout(function() {
		$('.login--alert:not(.login--alert-fixed)').slideUp(600);
	}, 2000);


	new Tipfy('[data-tipfy]');
	new Maskfy('[data-mask]');
</script>
<link rel="stylesheet" href="dist/css/theme/extra/responsive.min.css">
</body>
</html>