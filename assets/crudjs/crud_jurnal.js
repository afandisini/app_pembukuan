$(document).ready(function(){
	listJurnal();		
	var table = $('#jurnalTable').dataTable({     
		"bPaginate": false,
		"bInfo": false,
		"bFilter": false,
		"bLengthChange": false,
		"pageLength": 5		
	}); 
	// list all employee in datatable
	function listJurnal(){
		$.ajax({
			type  : 'ajax',
			url   : 'admin/jurnal/lihatJurnal',
			async : false,
			dataType : 'json',
			success : function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<tr id="'+data[i].jurnal_id+'">'+
							'<td>'+data[i].jurnal_nama+'</td>'+
							'<td>'+data[i].jurnal_ket+'</td>'+
							'<td>'+data[i].pelanggan_id+'</td>'+		                        
							'<td>'+data[i].jurnal_masuk+'</td>'+
							'<td>'+data[i].jurnal_keluar+'</td>'+
							'<td>'+data[i].kategori_id+'</td>'+
							'<td>'+data[i].jurnal_tgl+'</td>'+
							'<td style="text-align:right;">'+
								'<a href="javascript:void(0);" class="btn btn-info btn-sm editRecord" data-jurnal_id="'+data[i].jurnal_id+'" data-jurnal_nama="'+data[i].jurnal_nama+'" data-jurnal_ket="'+data[i].jurnal_ket+'" data-pelanggan_id="'+data[i].pelanggan_id+'" data-jurnal_masuk="'+data[i].jurnal_masuk+'" data-jurnal_keluar="'+data[i].jurnal_keluar+'" data-kategori_id="'+data[i].kategori_id+'" data-jurnal_tgl="'+data[i].jurnal_tgl+'">Edit</a>'+' '+
								'<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-jurnal_id="'+data[i].jurnal_id+'">Delete</a>'+
							'</td>'+
							'</tr>';
				}
				$('#listRecords').html(html);					
			}

		});
	}
	// save new employee record
	$('#simpanJnlForm').submit('click',function(){
		var jnlNama = $('#jurnal_nama').val();
		var jnlKet = $('#jurnal_ket').val();
		var jnlPelid = $('#pelanggan_id').val();
		var jnlJmsk = $('#jurnal_masuk').val();
		var jnlJklr = $('#jurnal_keluar').val();
		var jnljkid = $('#kategori_id').val();
		var jnljtgl = $('#jurnal_tgl').val();
		$.ajax({
			type : "POST",
			url  : "admin/jurnal/simpanJurnal",
			dataType : "JSON",
			data : {jurnal_nama:jnlNama, jurnal_ket:jnlKet, pelanggan_id:jnlPelid, jurnal_masuk:jnlJmsk, jurnal_keluar:jnlJklr, kategori_id:jnljkid, jurnal_tgl:jnljtgl},
			success: function(data){
				$('#jurnal_nama').val("");
				$('#jurnal_ket').val("");
				$('#pelanggan_id').val("");
				$('#jurnal_masuk').val("");
				$('#jurnal_keluar').val("");
				$('#kategori_id').val("");
				$('#jurnal_tgl').val("");
				$('#addJnlModal').modal('hide');
				listJurnal();
			}
		});
		return false;
	});
	// show edit modal form with emp data
	$('#listRecords').on('click','.editRecord',function(){
		$('#editJnlModal').modal('show');
		$("#empId").val($(this).data('id'));
		$("#empName").val($(this).data('name'));
		$("#empAge").val($(this).data('age'));
		$("#empDesignation").val($(this).data('designation'));
		$("#empSkills").val($(this).data('skills'));
		$("#empAddress").val($(this).data('address'));
	});
	// save edit record
	 $('#editEmpForm').on('submit',function(){
		var empId = $('#empId').val();
		var empName = $('#empName').val();
		var empAge = $('#empAge').val();
		var empDesignation = $('#empDesignation').val();
		var empSkills = $('#empSkills').val();
		var empAddress = $('#empAddress').val();			
		$.ajax({
			type : "POST",
			url  : "admin/jurnal/updateJurnal",
			dataType : "JSON",
			data : {id:empId, name:empName, age:empAge, designation:empDesignation, skills:empSkills, address:empAddress},
			success: function(data){
				$("#empId").val("");
				$("#empName").val("");
				$('#empAge').val("");
				$("#empSkills").val("");
				$('#empDesignation').val("");
				$("#empAddress").val("");
				$('#editEmpModal').modal('hide');
				listJurnal();
			}
		});
		return false;
	});
	// show delete form
	$('#listRecords').on('click','.deleteRecord',function(){
		var empId = $(this).data('id');            
		$('#deleteEmpModal').modal('show');
		$('#deleteEmpId').val(empId);
	});
	// delete emp record
	 $('#deleteEmpForm').on('submit',function(){
		var empId = $('#deleteEmpId').val();
		$.ajax({
			type : "POST",
			url  : "admin/jurnal/hapusJurnal",
			dataType : "JSON",  
			data : {id:empId},
			success: function(data){
				$("#"+empId).remove();
				$('#deleteEmpId').val("");
				$('#deleteEmpModal').modal('hide');
				listJurnal();
			}
		});
		return false;
	});
});