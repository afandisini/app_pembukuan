	</div>
		<?php $peng = $this->m_pengaturan->tampil_pengaturan();?>
		<footer class="main-footer">
			<strong class="font-weight-light"><?php echo $this->config->item('pembuatan');?>. </strong><span class="font-weight-bold"><?php $x=$peng->row_array(); ?></span>
			<?php foreach ($peng->result_array() as $i) : $pnm=$i['pengaturan_nama'];?><?php echo $pnm;?>
			<div class="float-right d-none d-sm-block">
			<span class="text-sm font-weight-light"><?php echo $this->config->item('nama_app') . '  ' . $this->config->item('versi');?></span>
			</div>
			<?php endforeach; ?>
		</footer>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>     

    <!-- Select2 -->
	<script>
		//Initialize Select2 Elements
		$('.select2').select2()
		//Initialize Select2 Elements
		$('.select2bs4').select2({
		theme: 'bootstrap4'
		})
		function number_format (number, decimals, dec_point, thousands_sep) {
			// Strip all characters but numerical ones.
			number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
			var n = !isFinite(+number) ? 0 : +number,
				prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
				sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
				dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
				s = '',
				toFixedFix = function (n, prec) {
					var k = Math.pow(10, prec);
					return '' + Math.round(n * k) / k;
				};
			// Fix for IE parseFloat(0.55).toFixed(0) = 0;
			s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
			if (s[0].length > 3) {
				s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
			}
			if ((s[1] || '').length < prec) {
				s[1] = s[1] || '';
				s[1] += new Array(prec - s[1].length + 1).join('0');
			}
			return s.join(dec);
		}
	</script>
	<script>
	    function jam() {
            var e = document.getElementById('jam'),
            d = new Date(), h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());
            e.innerHTML = h +':'+ m +':'+ s;
            setTimeout('jam()', 1000);
        }
        function set(e) {
            e = e < 10 ? '0'+ e : e;
            return e;
        }
    </script>
	<script type="application/javascript">
        //angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
		$(document).ready(function(){setTimeout(function(){$(".alert-danger").slideUp('slow');}, 2000);})
		//angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
		setTimeout(function(){$(".alert-danger").slideUp('slow');}, 5000);
		$(document).ready(function(){setTimeout(function(){$(".alert-success").slideUp('slow');}, 2000);})
		setTimeout(function(){$(".alert-success").slideUp('slow');}, 5000);
		$(document).ready(function(){setTimeout(function(){$(".alert-warning").slideUp('slow');}, 2000);})
		setTimeout(function(){$(".alert-warning").slideUp('slow');}, 5000);
		$(document).ready(function(){setTimeout(function(){$(".alert-info").slideUp('slow');}, 2000);})
		setTimeout(function(){$(".alert-info").slideUp('slow');}, 5000);
		$(document).ready(function(){setTimeout(function(){$(".alert-error").slideUp('slow');}, 2000);})
		setTimeout(function(){$(".alert-error").slideUp('slow');}, 5000);
		$(document).ready(function(){setTimeout(function(){$(".box_success").slideUp('slow');}, 2000);})
		setTimeout(function(){$(".box_success").slideUp('slow');}, 5000);
		$(document).ready(function(){setTimeout(function(){$(".box_danger").slideUp('slow');}, 2000);})
		setTimeout(function(){$(".box_danger").slideUp('slow');}, 5000);
		$(document).ready(function(){setTimeout(function(){$(".box_warning").slideUp('slow');}, 2000);})
		setTimeout(function(){$(".box_warning").slideUp('slow');}, 5000);
    </script>
	<script>
		var $title = $("a,input,p,label,textarea[title],img,.btn-group,button,.select2-selection,label,.input-group-text"); 
		$.each($title, function(index, value) {
			$(this).tooltip({
				show: {
					effect: "slideUp",
					delay: 350
				},
				hide: {
					effect: "swing",
					delay: 350
			}
			});  
		});
	</script>

