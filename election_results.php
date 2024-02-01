<?php

include 'includes/conn.php';
include 'includes/header.php';
include 'includes/anon_header.php';

function generateRow($conn)
{
    $contents = '';

    $sql = "SELECT * FROM positions ORDER BY priority ASC";
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
        $id = $row['id'];
        $contents .= '
            <tr>
                <td colspan="2" align="center" style="font-size:25px;"><b>' . $row['description'] . '</b></td>
            </tr>
            <tr>
                <td width="60%"><b>Candidates</b></td>
                <td width="20%"><b>Votes</b></td>
                <td width="20%"><b>Image</b></td>
            </tr>
        ';

        $sql = "SELECT * FROM candidates WHERE position_id = '$id' ORDER BY lastname ASC";
        $cquery = $conn->query($sql);
        while ($crow = $cquery->fetch_assoc()) {
            $sql = "SELECT * FROM votes WHERE candidate_id = '" . $crow['id'] . "'";
            $vquery = $conn->query($sql);
            $votes = $vquery->num_rows;
            $image = (!empty($crow['photo'])) ? 'images/'.$crow['photo'] : 'images/profile.jpg';

            $contents .= '
                  <tr style="background: rgb(198, 196, 196);">
                      <td>' . $crow['firstname'] . ", " . $crow['lastname'] . '</td>
                      <td>' . $votes . '</td>
                      <td>
                      <img src="' . $image . '" width="100px" height="100px">
                      </td>
                  </tr>
                  <tr>
                      <td colspan="2"><b>' . $crow['firstname'] . ", " . $crow['lastname'] . ' Voters [Identity Hidden]</b></td>
                  </tr>
                  <tr>
                      <td colspan="2">
                          <table class="table table-hover table-bordered text-start m-2 rounded ">
                              <tr>
                                  <td><b>ID</b></td>
                              </tr>';

            $sql = "SELECT Votes.*, Voters.voters_id, C.firstname,C.lastname FROM votes Votes INNER JOIN voters Voters ON Voters.id=Votes.voters_id INNER JOIN candidates C ON C.id=Votes.candidate_id WHERE Votes.candidate_id='" . $crow['id'] . "'";
            $votersQuery = $conn->query($sql);
            while ($voterRow = $votersQuery->fetch_assoc()) {
                $contents .= '
                      <tr>
                          <td>' . $voterRow['voters_id'] . '</td>
                      </tr>
                  ';
            }

            $contents .= '
                          </table>
                      </td>
                  </tr>
              ';
        }
    }

    return $contents;
}

$parse = parse_ini_file('admin/config.ini', FALSE, INI_SCANNER_RAW);
$title = $parse['election_title'];
$content = '';
$content .= '
      <h2 align="center">' . $title . '</h2>
      <h4 align="center">Election Results</h4>
      <table class="table table-hover table-bordered text-start">  
  ';
$content .= generateRow($conn);
$content .= '</table>';

?>

<div class="c-container">
    <?php

    echo $content;

    ?>
</div>



<?php include 'includes/anon_footer.php'; ?>
