
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">OC</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="dropdown <?=( ($this->uri->segment(1)=="administrator" || $this->uri->segment(1)=="administrator-list") && empty($this->uri->segment(2)) ) ? "active" : "";?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reservation <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url("/administrator");?>">Calendar</a></li>
            <li><a href="<?=base_url("/administrator-list/");?>">List</a></li>
          </ul>
        </li>
        <li class="<?=($this->uri->segment(2)=="leader") ? "active" : "";?>"><a href="<?=base_url("/administrator/leader");?>">Leaders</a></li>
        <li class="<?=($this->uri->segment(2)=="room") ? "active" : "";?>"><a href="<?=base_url("/administrator/room");?>">Rooms</a></li>
        <li class="<?=($this->uri->segment(2)=="area") ? "active" : "";?>"><a href="<?=base_url("/administrator/area");?>">Groups</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/login/adminLogout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
