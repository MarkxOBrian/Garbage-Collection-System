
<?php
require_once '../../core/init.php';
$idl = $_POST['comp_id'];
$id = (int)$idl;
$sql = "SELECT * FROM company_reg WHERE comp_id = '$id'";
$result = $db->query($sql);
$company = mysqli_fetch_assoc($result);

?>

<?php 
 ob_start();
?>


<!-- Modal -->
<div class="modal fade details-1" id="details-1" tableindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <H3 class="">Company Details</H3>
        <button type="button" class="close" onclick="closeModal()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div>
          
        </div>
        <div class="col-md-6">
        <p><?= $company['comp_dtls']; ?></p>
        </div>
        <div class="col-md-6">
          <img src="<?= $company['comp_logo']; ?>" height="250px" width="250px">
        </div>
        </div>
      

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="closeModal()" >Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  function closeModal() {
    $('#details-1').modal('hide');
    setTimeout(function(){

      $('#details-1').remove();
      $('.modal-bacdrop').remove();
    },500);
  }
</script>

<?php echo ob_get_clean(); ?>