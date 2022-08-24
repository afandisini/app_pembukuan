		<style>.main-footer {background-color: #f8f9fa;color: #869099;padding: 1rem;}</style>
		<?php $peng = $this->m_pengaturan->tampil_pengaturan();?>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            <span class="text-sm font-weight-light"><?php echo $this->config->item('nama_app') . '  ' . $this->config->item('versi');?></span>
            </div>
            <strong class="font-weight-light"><?php echo $this->config->item('pembuatan');?>. </strong><span class="font-weight-bold"><?php $x=$peng->row_array(); ?></span>
            <?php foreach ($peng->result_array() as $i) : $pnm=$i['pengaturan_nama'];?><?php echo $pnm;?><?php endforeach; ?>
        </footer>

    <!-- Select2 -->
	<script src="<?php echo base_url().'assets/adminlte/plugins/select2/js/select2.full.min.js'?>"></script>
	<script src="<?php echo base_url().'assets/js/jquery.price_format.min.js'?>"></script>
    <script type="text/javascript">
		//datatable
		$(function () {
		$('#mydata').DataTable({
			'responsive': true, 
			language: {url: '<?= base_url('assets/id.json');?>'},
			dom: 'Bfrtip',
			buttons: [
                    {extend: 'excelHtml5', text:'<i class="fas fa-file-excel mr-2"></i> Excel', className: 'btn btn-success btn-sm', footer: true},
                    {extend: 'pdfHtml5', text:'<i class="fas fa-file-pdf mr-2"></i> PDF', className: 'btn btn-danger btn-sm', footer: true},
                    {extend: 'print', text:'<i class="fas fa-print mr-2"></i> Cetak', className: 'btn btn-success btn-sm', footer: true}
                ]
			}).buttons().container().appendTo('#mydata_wrapper .col-ms-6:eq(0)');
		});
	</script>
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
				sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
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
    </script>
	<script>
		var toggleSwitch=document.querySelector(".theme-switch input[type=\"checkbox\"]"),currentTheme=localStorage.getItem("theme"),mainHeader=document.querySelector(".main-header");currentTheme&&"dark"===currentTheme&&(!document.body.classList.contains("dark-mode")&&document.body.classList.add("dark-mode"),mainHeader.classList.contains("navbar-light")&&(mainHeader.classList.add("navbar-dark"),mainHeader.classList.remove("navbar-light")),toggleSwitch.checked=!0);function switchTheme(a){a.target.checked?(!document.body.classList.contains("dark-mode")&&document.body.classList.add("dark-mode"),mainHeader.classList.contains("navbar-light")&&(mainHeader.classList.add("navbar-dark"),mainHeader.classList.remove("navbar-light")),localStorage.setItem("theme","dark")):(document.body.classList.contains("dark-mode")&&document.body.classList.remove("dark-mode"),mainHeader.classList.contains("navbar-dark")&&(mainHeader.classList.add("navbar-light"),mainHeader.classList.remove("navbar-dark")),localStorage.setItem("theme","light"))}toggleSwitch.addEventListener("change",switchTheme,!1);
	</script>	
	<script src="<?php echo base_url().'assets/adminlte/dist/js/moment.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.price_format.min.js'?>"></script>
	<script src="<?php echo base_url().'assets/adminlte/plugins/daterangepicker/daterangepicker.js'?>"></script>
