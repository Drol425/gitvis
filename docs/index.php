<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Sortable - Portlets</title>
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
              <a class="navbar-brand team-title" href="#">Web::chychka</a>
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
                        <button><a href="#" class="round-button"><i class="fa fa-play fa-2x"></i></a></button>
                        <p class="task-time">00:00:00</p>
                    </div>
                    <p class="task-name">Task name</p>
                </div>
                <div>

                  <div>
                    <div class="">
                      <div class="">
                        <div class="card shadow">
                          <div class="card-block">
                            <div id="revenue-column-chart"></div>
                          </div>
                        </div>
                      </div>
                    </div> <!-- row -->
              
                    <div class="">
                      <div class="">
                        <div class="card shadow">
                          <div class="card-block">
                            <div id="products-revenue-pie-chart"></div>
                          </div>
                        </div>
                      </div>
              
                    </div> <!-- row -->
                  </div> <!-- container -->
                </body>
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
                ...
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div>
    <script src="tether.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="index.js"></script>
</body> 
</html>