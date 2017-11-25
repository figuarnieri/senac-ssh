</div>
<script>
    $('[data-nav]').click(function(e){
        $('body').toggleClass('navactive');
    });
	$('[data-passchange]').click(function(e){
		$(this).closest('.cf').slideUp(400).prev().slideDown(400);
	});
	$('[data-selectchange]').change(function(e) {
		$(this).closest('form').trigger('submit');
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
    /*$('[data-confirm]').on('click', function(e){
    	e.preventDefault();
    	var link = $(this).attr('href');
    	var del = confirm('deleta mesmo?');
    	var tr = $(this).closest('tr');
    	if(del){
    		$.ajax({
    			  url: link
    			, success: function(e){
    				var parser = new DOMParser();
					var html = parser.parseFromString(e, "text/html");
    				var msg = $('.list--error', html).addClass('msg--init d-n').parent()[0].outerHTML;
    				setTimeout(function() {
	    				$('.msg--init').slideUp(400).parent().after(msg);
	    				tr.fadeOut(600);
    				}, 1000);
    			}
    		});
    	}
    })*/
	$('.login--alert').on('click', function(e){
		$(this).slideUp(600);
	});
	setTimeout(function() {
		$('.login--alert:not(.login--alert-fixed)').slideUp(600);
	}, 3000);


	new Tipfy('[data-tipfy]');
	new Maskfy('[data-mask]');
</script>
<link rel="stylesheet" href="dist/css/theme/extra/responsive.min.css">
</body>
</html>