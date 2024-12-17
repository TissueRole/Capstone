<?php
    include 'connection.php';
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $sql = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User details not found.";
        exit();
    }


    $question_sql = "SELECT * FROM questions WHERE user_id = {$_SESSION['user_id']} ORDER BY created_at DESC";
    $question_result = $conn->query($question_sql);


    $reply_sql = "SELECT r.*, q.title FROM reply r
                  JOIN questions q ON r.question_id = q.question_id
                  WHERE r.user_id = {$_SESSION['user_id']} ORDER BY r.created_at DESC";
    $reply_result = $conn->query($reply_sql);


    $active_section = isset($_GET['section']) ? $_GET['section'] : 'profile'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .navbar-bg{
            background-color:rgba(247, 195, 95, 1);
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgba(40, 167, 69, .9);
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block;
        }
        .sidebar a:hover {
            background-color: rgba(40, 167, 69, 1);
        }
        .sidebar .active {
            background-color: rgba(40, 167, 69, 1);
            font-weight: bold;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top  px-5 bg-success text-white">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-white mx-5" aria-current="page" href="Forum/community.php">Farming Community</a>
                </li>
                <li class="nav-item mx-3"> 
                    <a class="nav-link fw-bold fs-5" href="php/simulator.php">Simulator</a> 
                </li> 
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-white me-5" aria-current="page" href="modulepage.php">Module</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="sidebar pt-5 d-flex flex-column ">
        <div class="flex-grow-1">
            <a class="nav-link ps-4 mt-4 text-white <?php echo ($active_section == 'profile') ? 'active' : ''; ?>" href="?section=profile">Profile</a>
            <a class="nav-link ps-4 text-white <?php echo ($active_section == 'settings') ? 'active' : ''; ?>" href="?section=settings">Settings</a>
            <a class="nav-link ps-4 text-white" href="logout.php">Logout</a>
        </div>
    </div>
    <div class="main-content">
        <div class="container">
            <?php if ($active_section == 'profile'): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5>Your Profile</h5>
                    </div>
                    <div class="card-body">
                        <h5>Profile Information</h5>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                        <hr>

                        <h5>Your Questions in the Farming Community</h5>
                        <?php if ($question_result->num_rows > 0): ?>
                            <ul class="list-group">
                                <?php while ($question = $question_result->fetch_assoc()): ?>
                                    <li class="list-group-item">
                                        <a href="Forum/thread.php?id=<?php echo $question['question_id']; ?>" class="text-decoration-none">
                                            <strong><?php echo htmlspecialchars($question['title']); ?></strong>
                                        </a>
                                        <p><?php echo htmlspecialchars($question['body']); ?></p>
                                        <small>Asked on: <?php echo $question['created_at']; ?></small>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else: ?>
                            <p>No questions found.</p>
                        <?php endif; ?>
                        <hr>
                        <h5>Your Replies in the Farming Community</h5>
                        <?php if ($reply_result->num_rows > 0): ?>
                            <ul class="list-group">
                                <?php while ($reply = $reply_result->fetch_assoc()): ?>
                                    <li class="list-group-item">
                                        <strong>In Question: 
                                            <a href="thread.php?id=<?php echo $reply['question_id']; ?>" class="text-decoration-none">
                                                <?php echo htmlspecialchars($reply['title']); ?>
                                            </a>
                                        </strong>
                                        <p><?php echo htmlspecialchars($reply['body']); ?></p>
                                        <small>Replied on: <?php echo $reply['created_at']; ?></small>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else: ?>
                            <p>No replies found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php elseif ($active_section == 'settings'): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header navbar-bg bg-success text-white">
                        <h5>Account Settings</h5>
                    </div>
                    <div class="card-body">
                        <h5>Update Profile</h5>
                        <form action="User/editprofile.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                            </div>
                            <button type="submit" class="btn btn-success">Update Profile</button>
                        </form>
                        <hr>

                        <h5>Change Password</h5>
                        <form action="User/changepassword.php" method="POST">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            </div>
                            <button type="submit" class="btn btn-primary" name="change_password">Change Password</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
