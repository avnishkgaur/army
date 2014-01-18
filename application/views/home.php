<div id="wrap">
    <div class="container row-fluid">
      <div class="row">
        <div class="masthead">
          <ul class="nav nav-pills pull-right">
            <li class="active"><a href="#"><i class="icon-home icon-white"></i> Home</a></li>
            <li><a href="<?php echo base_url('settings'); ?>"><i class="icon-wrench"></i> Settings</a></li>
            <li><a href="<?php echo base_url('logout'); ?>"><i class="icon-share-alt"></i> Logout</a></li>
          </ul>
          <div class="pull-left">
            <a href="<?php echo base_url('home'); ?>"><img src="<?php echo base_url('assets/img/logo.png'); ?>" style="height:25px;padding-right:20px;" /></a>
          </div>
<div class="input-append">
  <input class="input-xlarge" id="appendedInputButton" type="text" placeholder="Search people, news or information..">
  <button class="btn" type="button"><i class="icon-search"></i> Search</button>
</div>
        </div>
      </div>
      <div class="row">
      <div class="span9">
        <?php 
        if($this->session->userdata('role')==2){
          ?>
        <hr>
        <?php
        if($this->session->flashdata('uploadmsg')){
          echo '<div class="alert alert-success">'.$this->session->flashdata('uploadmsg').'</div>';          
        }
        ?>
        <a class="btn btn-info btn-block" id="sharebtn"><i class="icon-pencil icon-white"></i> Add new document</a>
        <div id="sharer" style="display:none">
          <div class="tabbable">
            <br>
            <a class="pull-right close-icon" id="closesharer"></a>
            <ul class="nav nav-tabs" id="stabs">
              <li class="active"><a href="#tab1" data-toggle="tab">Upload</a></li>
              <li><a href="#tab2" data-toggle="tab">Create</a></li>
            </ul>
            <div class="tab-content" style="overflow:visible">
              <div class="tab-pane active" id="tab1"><br />
                <form action="uploadnow" method="post" enctype="multipart/form-data">
                  <input class="form-control" type="text" name="title" id="title" placeholder="Enter Document Title"><br />
                  <input class="form-control" type="file" name="userfile" size="20" /><br />
                  <textarea rows="3" class="form-control" name="desc" id="desc" style="max-width:100%" placeholder="Optional Description"></textarea>
                  <p>
                    <br />
                    <select name="visibility" id="visibility" class="form-control" style="width:400px;float:left;">
                      <option value="1">Visible to All</option>
                      <option value="2">Officers</option>
                      <option value="3">Workers</option>
                      <option value="4">Employees</option>
                      <option value="5">Private</option>
                    </select>
                    <input type="submit" value="upload" class="btn btn-primary pull-right" />
                  </p>
                </form>
              </div>
              <div class="tab-pane" id="tab2">
                <textarea rows="3" class="input-block-level" style="max-width:100%"></textarea>
                <p>I'm in Section 1.</p>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <?php
        } else{
          echo "<br /><hr><br />";
        }
        ?>

        <div class="row-fluid">
          <?php
          $role = (int)$this->session->userdata('role');
          foreach ($content as $key => $value) {
            $vis = (int)$value["visible"];
              if($vis==1){
                $visname='All';
              } elseif ($vis==2) {
                $visname='Officers';
              } elseif ($vis==3) {
                $visname='Workers';
              } elseif ($vis==4) {
                $visname='Employees';
              } else{
                $visname='Private';
              }
            if(($role==$vis)||($vis==1)){
              if($vis==1){
                echo '<div class="panel panel-primary">';
              } elseif ($vis==2) {
                echo '<div class="panel panel-success">';
              } elseif ($vis==3) {
                echo '<div class="panel panel-info">';
              } elseif ($vis==4) {
                echo '<div class="panel panel-warning">';
              } else {
                echo '<div class="panel panel-danger">';
              }
              echo '<div class="panel-heading">';
              echo character_limiter(ucwords($value["title"]),30).'<span style="float:right;">Visible to '.$visname.'<span>';
              echo '</div>';
              echo '<div class="panel-body">';
              echo '<h5><span class="text-muted">File Link - </span><a href="'.base_url('uploads').'/'.$value["filename"].'">'.ucwords($value["title"]).'</a></h5>';
              echo '<h5><span class="text-muted">Shared on - </span>'.date("F j, Y - g:i a",strtotime($value["added_on"])).'</h5>';
              echo '<h5><span class="text-muted">Shared by - </span>'.ucwords($value["added_by"]).'</h5>';
              if(strlen($value["description"])>3){
                echo '<h5><span class="text-muted">Description - </span>'.$value["description"].'</h5>';                
              }
              echo '</div>';
              echo '</div>';
              echo '<hr />';                      
            }
          }
          ?>
        </div>
        <hr>
        <div class="footer">
          <p>&copy; Sensei 2013</p>
        </div>
      </div>
      <div class="span3">
                <iframe src="http://localhost:3000" width="100%" height="600px"></iframe>
      </div>
      </div>
    </div>
  </div>
