<?php

include_once("db_connect.php");
?>

<?php

$count_query = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM projects");
$count = mysqli_fetch_array($count_query);
echo 'Total records: ' . $count['total_records'] . '<br>';
$total = $count['total_records'];


for($id = 1; $id < $total + 1; ++$id) {

  for($wg = 1; $wg < 9; ++$wg) {

    if(isset($_POST["ID".$id])) {
      $group = $_POST["ID".$id];

      $update_wg = "UPDATE projects SET workingGroup = $group WHERE projectID = $id;";
      if ($conn->query($update_wg) === TRUE) {
          } else {
          }
    } else {
      $update_wg = "UPDATE projects SET workingGroup = NULL WHERE projectID = $id;";

            if ($conn->query($update_wg) === TRUE) {
            } else {
            }
    }
  }
}

  echo "<script>window.location = './Admin_Home.php?wg=True'</script>";

 ?>
