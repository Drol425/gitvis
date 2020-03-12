<?php
    include('dbcon.php');
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    //$query = mysqli_query($db, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
   // $userdata = mysqli_fetch_assoc($query);
$query =  $DB->query("SELECT id FROM users WHERE id =?", array($_COOKIE['id']));
    if($query[0]['id'] !== $_COOKIE['id'])
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Хм, что-то не получилось";
    }
    else
    {

      if(isset($_POST['submit']) AND isset($_POST['time']) AND isset($_POST['geo'])){
      $geo = $_POST['geo'];
      $time = $_POST['time'];
      $pieces = explode("+", $geo);
        $DB->query("INSERT INTO `h6072_diplo`.`tags` (`id`, `id_user`, `x`, `y`, `times`, `text`) VALUES (?, ?, ?, ?, ?, ?)",array(NULL,$_COOKIE['id'],$pieces[0],$pieces[1],$time,'1' ));
      header("Location: search.php");
      }

    ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web::chychka</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 col-lg-2 navbar-container navbar-block">
            <!-- Вертикальное меню -->
            <nav class="navbar navbar-expand-md">
              <a class="navbar-brand team-title" href="#"><img class="logoImg" src="logo.png" alt="web::chychka"></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbar">
                <!-- Пункты вертикального меню -->
                <ul class="navbar-nav">
                  <li class="nav-item">
                                    <a class="nav-link" href="https://emocion.lk3.ru/index.php"><i class="fa fa-tasks fa-2x" aria-hidden="true"></i><p>Tasks</p></a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="https://emocion.lk3.ru/docs/index.php"><i class="fa fa-pie-chart fa-2x" aria-hidden="true"></i>
                    <p>Statistics</p></a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
          <div class="col-md-9 col-lg-10 content-container tasks-block">
                <div class="header-buttons">
                    <div class="time-block">
                        <button style="background: none;" onclick="StartStop()"><span class="round-button"><i id="btnStartStop" class="fa fa-play paddForPlay fa-2x"></i></span></button>
                        <form name=MyForm>
                            <input class="task-time" name=stopwatch size=10 value="00:00:00" disabled>
                        </form>                          
                    </div>
                    <p class="task-name">Task name</p>

                    <button class="btn-add" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="container-fluid">
                <div id="backlog" class="column col-md-3">
                    <p>Backlog</p>
                    <?php
                      $id_mm = $query[0]['id'];
                      $SELECT_SET =  $DB->query("SELECT * FROM `tasks` WHERE id_user = ?",array($id_mm));
                      foreach ($SELECT_SET as $value) {
                          ?>
                           <div class="portlet" id="1"><div class="portlet-header"><h5><?php echo $value['name']; ?></h5><div class="task-controls"><button><i class="fa fa-clock-o fa-1x"></i></button><button><i onclick="deletes(<?php echo $value['id']; ?>)" class="fa fa-trash-o fa-1x" ></i></button></div></div><div class="portlet-content"><?php echo $value['text']; ?></div></div>
                          <?php
                      }
                        //SELECT * FROM `tasks`
                    ?>
                   
                </div>
                
                <div id="todo" class="column col-md-3">
                    <p>To-do</p>
                </div>
                
                <div id="inprogress" class="column col-md-3">
                    <p>In Progress</p>
                </div>

                <div id="done" class="column col-md-3">
                    <p>Done</p>
                </div>
            </div>
          </div>
        </div>
      </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control mb-1" id="taskName" placeholder="Name of task">
                    <textarea class="form-control" id="infoTask" rows="3" placeholder="Info about task"></textarea>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="addTaskBtn" onclick="res()" data-dismiss="modal" aria-label="Close" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div>

        <script type="text/javascript">

        function res(){
          var title = $("#taskName").val();
          var text = $("#infoTask").val();

       $.ajax({
          type: "POST",
          url: "some.php",
          data: { name: "<?php echo $query[0]['id']; ?>", text: text,title: title }
          }).done(function( msg ) {
        });
        }
       function deletes(ids){
          //alert(ids);
                 $.ajax({
          type: "POST",
          url: "delete.php",
          data: { name: "<?php echo $query[0]['id']; ?>",deletes: ids }
          }).done(function( msg ) {

            location.reload();
        });

        }
        </script>
        
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="index.js"></script>
<script src="addtask.js"></script>
</body> 
</html>
<?php

}}else{


header("Location: login.php");

} 
?>