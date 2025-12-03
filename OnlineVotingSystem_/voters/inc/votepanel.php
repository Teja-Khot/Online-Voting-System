<?php 
    require_once("inc/header.php");
    require_once("inc/navigation.php");
?>

<div class="row my-3">
    <div class="col-12">
        <h3 class="mb-4 text-danger fw-bold">🗳 Voters Panel</h3>

        <?php 
            // Fetch active elections
            $fetchingActiveElections = mysqli_query($db, "SELECT * FROM elections WHERE status = 'Active'") or die(mysqli_error($db));
            $totalActiveElections = mysqli_num_rows($fetchingActiveElections);

            if($totalActiveElections > 0) 
            {
                while($data = mysqli_fetch_assoc($fetchingActiveElections))
                {
                    $election_id = $data['id'];
                    $election_topic = $data['election_topic'];
                    $starting_date = $data['starting_date'];
                    $ending_date = $data['ending_date'];
        ?>

                    <div class="card shadow-lg border-0 my-4">
                        <div class="card-body">
                            <h5 class="card-title text-danger fw-bold">
                                <?php echo htmlspecialchars($election_topic); ?>
                            </h5>
                            <p class="card-text text-muted">
                                From: <b><?php echo htmlspecialchars($starting_date); ?></b> 
                                To: <b><?php echo htmlspecialchars($ending_date); ?></b>
                            </p>

                            <?php 
                                // fetch candidates for this election
                                $fetchCandidates = mysqli_query(
                                    $db,
                                    "SELECT * FROM candidate_details WHERE election_id = '".mysqli_real_escape_string($db, $election_id)."'"
                                ) or die(mysqli_error($db));

                                if(mysqli_num_rows($fetchCandidates) > 0)
                                {
                            ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle text-center">
                                            <thead>
                                                <tr>
                                                    <th>Candidate</th>
                                                    <th>Details</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                while($cand = mysqli_fetch_assoc($fetchCandidates))
                                                {
                                                    $candidate_id = $cand['id'];
                                                    $candidate_name = $cand['candidate_name'];
                                                    $candidate_details = $cand['candidate_details'];
                                            ?>
                                                <tr>
                                                    <td class="fw-semibold"><?php echo htmlspecialchars($candidate_name); ?></td>
                                                    <td><?php echo htmlspecialchars($candidate_details); ?></td>
                                                    <td>
                                                        <?php 
                                                            // check if current user already voted in this election
                                                            $voter_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
                                                            $checkIfVoteCasted = mysqli_query(
                                                                $db,
                                                                "SELECT * FROM votings WHERE election_id = '".mysqli_real_escape_string($db, $election_id)."' AND voters_id = '".mysqli_real_escape_string($db, $voter_id)."'"
                                                            ) or die(mysqli_error($db));
                                                            $isVoteCasted = mysqli_num_rows($checkIfVoteCasted);

                                                            if($isVoteCasted > 0)
                                                            {
                                                                $voteCastedData = mysqli_fetch_assoc($checkIfVoteCasted);
                                                                $voteCastedToCandidate = $voteCastedData['candidate_id'];

                                                                if($voteCastedToCandidate == $candidate_id)
                                                                {
                                                        ?>
                                                                    <img src="../assets/images/vote.png" width="80px;" alt="Voted">
                                                        <?php
                                                                } else {
                                                                    echo '<button class="btn btn-secondary btn-sm" disabled>Already Voted</button>';
                                                                }
                                                            } else {
                                                        ?>
                                                                <button class="btn btn-sm btn-danger" onclick="CastVote(<?php echo (int)$election_id; ?>, <?php echo (int)$candidate_id; ?>, <?php echo (int)$voter_id; ?>)"> Vote </button>
                                                        <?php
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                            <?php
                                } else {
                                    echo "<p class='text-muted'>No candidates found for this election.</p>";
                                }
                            ?>
                        </div>
                    </div>

        <?php
                }
            } else {
                echo "<p class='text-muted'>No active elections at this time.</p>";
            }
        ?>
    </div>
</div>

<!-- Theme styles -->
<style>
    .table thead th {
        background-color: #dc3545; /* red */
        color: white;
    }
</style>

<script>
    function CastVote(election_id, candidate_id, voter_id)
    {
        if(!confirm("Are you sure you want to cast your vote? This action cannot be undone.")) return;

        var fd = new FormData();
        fd.append('e_id', election_id);
        fd.append('c_id', candidate_id);
        fd.append('v_id', voter_id);

        fetch('inc/ajaxCalls.php', {
            method: 'POST',
            body: fd
        })
        .then(response => response.text())
        .then(txt => {
            if(txt.trim() === "Success")
            {
                location.assign("index.php?voteCasted=1");
            } else if (txt.trim() === "AlreadyVoted") {
                alert("You have already voted in this election.");
                location.reload();
            } else {
                alert("Error casting vote: " + txt);
            }
        })
        .catch(err => {
            console.error(err);
            alert("An error occurred while casting vote.");
        });
    }
</script>

<?php
    require_once("inc/footer.php");
?> 
