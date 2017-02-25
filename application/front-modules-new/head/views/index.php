<header class="header">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
            <img alt="Brand" src="<?php echo THEME_FRONT; ?>images/logo.png">
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="schedule.html">Lịch Phát Sóng </a></li>
            <li><a href="#">Live TV</a></li>
          </ul>
          <ul class="nav hidden-sm navbar-time navbar-nav navbar-right">
            <li><span class="top-time">Bây giờ là 01:17 sáng</span></li>
            <li>
              <div class="top-weather-wrap">
                <div id="weather" class="top-weather"></div>
                <span class="js-geolocation">Cập Nhật Ngay</span>
              </div>
            </li>
          </ul>
          <form class="navbar-form navbar-right" role="search">
            <div class="navbar-form-search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm">
              </div>
              <button type="submit" class="btn btn-default"><i class="xgtv-search"></i></button>
            </div>
          </form>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>