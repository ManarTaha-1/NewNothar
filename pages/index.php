<?php
    
    require_once '../config.php';

    require '../includes/indexheader.php';
 
?>
<body>
    
    <section class="about" id="about">
        <div class="vid-container">
            <div class="video">
                <video playsinline="" muted="" autoplay="" loop=""> <source src="../videos/video.mp4" type="video/mp4">Your browser does not support video tag</video>
                <h2>About</h2>
            </div>
        </div>
        <div class="who">
            <p><b style=" color:#7e3650 ; font-size: 30px;">Nothar</b> is a knowledge platform that showcases articles in various fields. <br>
                It was created by  <b style=" color:#7e3650 ;">Manar Taha</b> &amp;&amp; <b style=" color:#7e3650 ;">Heba-t-Allah</b> to reach the largest possible number of people. <br> The platform provides you with articles in various fields.
                These articles explain some of the phenomena
                occurring around us.
                We can’t predict the future, but we can engage with what’s already possible—or will be soon—and choose a course that values and lifts up people and planet. As we face challenges, we believe we can solve them together.
                You can easily view our articles on the platform. We hope you enjoy and like them.</p>
        </div>
        <div class="team">
        <h2>The Editorial Team</h2>
        </div>
        <div class="row">
            <div class="team_card">
                <div class="team_box">
                    <img src="../images/manar.png" alt="">
                    <span class="card-text" >
                        <h3>Manar Taha</h3>   
                    </span>
                </div>
            </div>
            <div class="team_card" >
                <div class="team_box">
                    <img src="../images/heba.png" alt="">
                    <span class="card-text" >
                        <h3>Heba-t-Allah</h3>  
                    </span>
                </div>
            </div>
        </div>
    </section>

<?php 
    include('login_modal.php');   
    include('register_madal.php');   
?>


<?php include('../includes/indexfooter.php'); ?>

<script src="../js/scripts.js"></script>
    </body>


