<?php 
require_once '../config.php';
require '../includes/header.php';
require_once '../includes/session_control.php';
requireAdmin()
?>

<body>
    <section class="admin-dashboard">
        <div class="admin-header">
            <div class="user-info">
                <i class="fa-solid fa-user fa-2x"></i>
                <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>
            <h1>Admin Dashboard</h1>
        </div>

        <div class="dashboard-table">
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Number of Articles</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tech</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Space</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Science</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Future</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Energy</td>
                        <td>5</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <style>
        .admin-dashboard {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fafafa;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .admin-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .user-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .dashboard-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .dashboard-table th, .dashboard-table td {
            padding: 12px 20px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        .dashboard-table th {
            background-color: #7e3650;
            color: white;
        }

        .dashboard-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>

<?php 
    include('login_modal.php');   
    include('register_madal.php');   
?>

<?php include('../includes/indexfooter.php'); ?>

<script src="../js/scripts.js"></script>

