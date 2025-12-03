<?php 
    require_once("inc/header.php");
    require_once("inc/navigation.php");

    // Assume voter info stored in session
    $voter_name  = isset($_SESSION['username']) ? $_SESSION['username'] : "Voter";
    $voter_email = isset($_SESSION['email']) ? $_SESSION['email'] : "";

    // --- Quick stats ---
    $totalElections = mysqli_num_rows(mysqli_query($db, "SELECT * FROM elections"));
    $activeElections = mysqli_num_rows(mysqli_query($db, "SELECT * FROM elections WHERE status='Active'"));

    $voter_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
    $votesCast = mysqli_num_rows(mysqli_query($db, "SELECT * FROM votings WHERE voters_id = '$voter_id'"));
?>
<div class="container my-4">

    <!-- Welcome Card -->
    <div class="card shadow-lg border-0 mb-4 bg-danger text-white">
        <div class="card-body">
            <h2 class="mb-2">Welcome, <?php echo htmlspecialchars($voter_name); ?> 👋</h2>
            <?php if($voter_email != "") { ?>
                <p class="mb-0">You are logged in as <b><?php echo htmlspecialchars($voter_email); ?></b></p>
            <?php } ?>
            <p class="mt-2">Cast your vote and let your voice be heard!</p>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row text-center mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h1 class="text-danger"><?php echo $totalElections; ?></h1>
                    <p class="text-muted">Total Elections</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h1 class="text-danger"><?php echo $activeElections; ?></h1>
                    <p class="text-muted">Active Elections</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h1 class="text-danger"><?php echo $votesCast; ?></h1>
                    <p class="text-muted">Your Votes Cast</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Voter Panel -->
    <style>
        /* Make table headers red */
        .table thead th {
            background-color: #dc3545; /* Bootstrap danger red */
            color: white;
        }
    </style>

    <?php require_once("inc/votepanel.php"); ?>

</div>

<?php require_once("inc/footer.php"); ?>
