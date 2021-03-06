<?php
include("../navigation.php");

$env = parse_ini_file('../.env');
if (!isset($_SESSION['admin']) || $_SESSION['admin']!=1) {
die;
}
$workout_id=$_GET['workout_id'];

?>

<div class="container-fluid custom-margin-container">    
    <h2 class="custom-txt-center custom-margin-bottom-4">TERVETULOA ADMINISTRAATTORIN SIVULLE</h2>  

    <!--Row starts-->
    <div class="row mt-5"> 
        <div class="col-sm-2">
        </div>

        <div class="col-sm-8">  
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">                
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0"><script>showToday();</script></h6>
                            <small>VIIKKO <?php echo date("W");?></small>
                        </div>                   
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-condensed">                       
                        <div>
                            <h6 class="my-0 text-secondary">ADMIN: <span id="user_name"  style="color:black;"></span>
                                </h6>
                        </div>                                                         
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-condensed">                       
                        <div>
                            <h6 class="my-0"><a href="admin_page.php" class="text-danger">Selaa, muokaa, peruuta treenejä</a></h6>
                            <small class="text-muted">Selaa ja muokaa aikatauluja tai peruuta treenejä</small>
                        </div>                                                         
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><a href="new_change_workout.php" class="text-danger">Lisää uusi treeni</a></h6>
                            <small class="text-muted">Lisää tietoa uudesta treenistä aikatauluun</small>
                        </div>                    
                        </li>

                        <!--<li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><a href="" class="text-danger">Lisää uusi ohjaaja</a></h6>
                            <small class="text-muted">Lisää uusi ohjaaja työntekijätietokantaan</small>
                        </div>                    
                        </li>-->   
                        
                        <!--<li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><a href="get_participants.php" class="text-danger">Ilmoita aikataulun muutoksesta</a></h6>
                            <small class="text-muted">Lähetä viestejä aikataulun muutoksesta</small>
                        </div>                    
                        </li>-->  
                    </ul>               
                </div>
                
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-4 text-success">ILMOITA AIKATAULUN MUUTOKSESTA OSALLISTUJILLE</h4>

                    <!--Table starts-->
                    <div class="mb-3">
                        <div class="container">       
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead id="head_table">
                                        <tr>
                                            <th scope="col">Nimi</th>
                                            <th scope="col">Sähköpostiosoite</th>                                                                                                        
                                        </tr>                                   
                                    </thead>
                                    
                                    <tbody>                                   
                                
                                    <?php                                    
                                    $query_participants="SELECT `name`, email FROM workouts_registration
                                    LEFT JOIN users ON workouts_registration.participant_id = users.id 
                                    WHERE workout_id = '$workout_id'";
                                    $result_participants = $connect->query($query_participants);
                                    if ($result_participants->num_rows > 0) {
                                        while ($row = $result_participants->fetch_assoc()) {?>
                                        <tr>
                                        <td> <?= $row['name']?> </td>
                                        <td> <?= $row['email']?> </td>
                                        <tr>
                                        <?php  }
                                    
                                        }
                                    ?>                                   
                                    
                                    </tbody>         
                                </table>           
                            </div>
                        </div>
                    </div>
                    <!--Table ends-->            
                                
                    <p></p>
                </div>
            </div>            
        </div>

        <div class="col-sm-2">
        </div>
    </div>
    <!--Row ends-->

    <div class="custom-space">
        <p></p>
    </div> 

</div>


<script type="text/javascript" src="../forms/user_name.js"></script>
<?php
include("../footer.php");
?>