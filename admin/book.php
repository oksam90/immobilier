<?php 
include('db_connect.php');
	$rid = '';

$calc_days = abs(strtotime($_GET['out']) - strtotime($_GET['in'])) ; 
 $calc_days =floor($calc_days / (60*60*24)  );
?>
<div class="container-fluid">
	
	<form action="" id="manage-check">
		<input type="hidden" name="cid" value="<?php echo isset($_GET['cid']) ? $_GET['cid']: '' ?>">
		<input type="hidden" name="rid" value="<?php echo isset($_GET['rid']) ? $_GET['rid']: '' ?>">


		<div class="form-group">
			<label for="name">Nom</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="contact">Contact #</label>
			<input type="text" name="contact" id="contact" class="form-control" value="<?php echo isset($meta['contact_no']) ? $meta['contact_no']: '' ?>" required>
		</div>
		<div class="form-group">
            <label>Nationalité* </label>
            <label class="radio-inline">
                <input type="radio" name="nation"  value="Senegal" checked="">Sénégal
            </label>
            <label class="radio-inline">
                <input type="radio" name="nation"  value="Non Senegal ">Non Sénégal 
            </label>  
        </div>
		<div class="form-group">
            <label>Type de Pièce d'Identité* </label>
                <select name="Tpiece"  class="form-control" required>
					<option value selected ></option>
                    <option value="CNI">Carte d'Identité Nationale</option>
                    <option value="Passport">Passport</option>
					<option value="PC">Permis de Conduire</option>
                 </select>
        </div>
		<div class="form-group">
			<label for="date_in">Date d'arrivée</label>
			<input type="date" name="date_in" id="date_in" class="form-control" value="<?php echo isset($_GET['in']) ? date("Y-m-d",strtotime($_GET['in'])): date("Y-m-d") ?>" required readonly>
		</div>
		<div class="form-group">
			<label for="date_in_time">Heure d'arrivée</label>
			<input type="time" name="date_in_time" id="date_in_time" class="form-control" value="<?php echo isset($_GET['date_in']) ? date("H:i",strtotime($_GET['date_in'])): date("H:i") ?>" required>
		</div>
		<div class="form-group">
			<label for="days">Jours de séjour</label>
			<input type="number" min ="1" name="days" id="days" class="form-control" value="<?php echo isset($_GET['in']) ? $calc_days: 1 ?>" required readonly>
		</div>
	</form>
</div>
<script>
	$('#manage-check').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'admin/ajax.php?action=save_book',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp >0){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
					end_load()
					$('.modal').modal('hide')
					},1500)
				}
			}
		})
	})
</script>