<?php 
    require_once("../../admin/inc/config.php");

    // Basic server-side validation
    if(isset($_POST['e_id']) && isset($_POST['c_id']) && isset($_POST['v_id']))
    {
        $e_id = intval($_POST['e_id']);
        $c_id = intval($_POST['c_id']);
        $v_id = intval($_POST['v_id']);

        // check if voter already casted vote for this election
        $chk = mysqli_query($db, "SELECT * FROM votings WHERE election_id = '".mysqli_real_escape_string($db, $e_id)."' AND voters_id = '".mysqli_real_escape_string($db, $v_id)."'") or die(mysqli_error($db));
        if(mysqli_num_rows($chk) > 0)
        {
            echo "AlreadyVoted";
            exit;
        }

        $vote_date = date("Y-m-d");
        $vote_time = date("H:i:s");

        $insert = "INSERT INTO votings (election_id, voters_id, candidate_id, vote_date, vote_time) VALUES ('".mysqli_real_escape_string($db, $e_id)."', '".mysqli_real_escape_string($db, $v_id)."', '".mysqli_real_escape_string($db, $c_id)."', '".mysqli_real_escape_string($db, $vote_date)."', '".mysqli_real_escape_string($db, $vote_time)."')";

        if(mysqli_query($db, $insert))
        {
            echo "Success";
        } else {
            echo "Error";
        }
    } else {
        echo "Invalid";
    }

?>