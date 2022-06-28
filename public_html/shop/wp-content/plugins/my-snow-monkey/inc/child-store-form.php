<?php

$stock_number = isset($_GET['number']) ? $_GET['number'] : "";
$company_name = isset($_GET['companyname']) ? $_GET['companyname'] : "";
$full_name = isset($_GET['name']) ? $_GET['name'] : "";

$param = [];
$param[] = $stock_number;
$param[] = $company_name;
$param[] = $full_name;

$param_json = json_encode($param);

?>

<script>
  var param = JSON.parse('<?php echo $param_json; ?>');
  //console.log(param[0]);
  $(function () {
    var inputNumber = $('#stock-number');
    var inputCompanyName = $('#company-name');
    var inputName = $('#full-name');
    inputNumber.val(param[0]).css('border', 'none');
    inputCompanyName.val(param[1]).css('border', 'none');
    inputName.val(param[2]).css('border', 'none');
  });
</script>