<form action="/leader/index/editProfile/" id="leader-form" class="form1" name="leader_form" method="post">

  <div class="col-md-6">
<?php if($leader['id']):?>
    <input name="leader[id]" value="<?=$leader['id']?>" type="hidden">
<?php endif;?>
          <div class="form-group col-md-3">
              <label for="exampleInputEmail1">Title</label>
              <select class="form-control" name="leader[title]">
                <option value=""></option>
                <option value="Mục Sư">Mục Sư</option>
                <option value="MS">MS</option>
                <option value="Pastor">Pastor</option>
              </select>
          </div>

          <div class="form-group col-md-3">
              <label for="exampleInputEmail1">First name</label>
              <input type="text" class="form-control" name="leader[firstname]" id="firstname" placeholder="First Name" required value="<?=$leader['firstname']?>">
          </div>

          <div class="form-group col-md-3">
              <label for="exampleInputEmail1">Middle</label>
              <input type="text" class="form-control" name="leader[middlename]" id="middlename" placeholder="Middle" required value="<?=$leader['middlename']?>">
          </div>

          <div class="form-group col-md-3">
              <label for="exampleInputEmail1">Last name</label>
              <input type="text" class="form-control" name="leader[lastname]" id="lastname" placeholder="Last Name" required value="<?=$leader['lastname']?>">
          </div>

          <div class="form-group col-md-6">
              <label for="exampleInputEmail1">Phone</label>
              <input type="text" class="form-control" name="leader[phone]" id="phone" placeholder="(xxx)-xxx-xxxx" value="<?=$leader['phone']?>">
          </div>

          <div class="form-group col-md-6">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" name="leader[email]" id="email" placeholder="example@email.com" value="<?=$leader['email']?>">
          </div>

          <div class="form-group col-md-6">
              <label for="exampleInputEmail1">Password</label>
              <input type="password" class="form-control" name="leader[password]" id="password" placeholder="password">
              <?php if($leader['id']):?><p class="help-block">Leave blank if you don't want to change it.</p><?php endif;?>
          </div>

          <div class="form-group col-md-6">
              <label for="exampleInputEmail1">Confirm Password</label>
              <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="confirm password">
          </div>

  </div>

  <div class="col-md-6">
          <div class="form-group col-md-12">
              <label for="exampleInputEmail1">Areas</label>
              <select multiple class="form-control" size="10" name="leader[area][]">
                <?php foreach($areas->result() as $row):?>
                  <option value="<?=$row->id?>" <?=in_array($row->id, $leader['area']) ? "selected" : "";?>><?=$row->title?></option>
                <?php endforeach;?>
              </select>
          </div>
  </div>

  <div class="col-md-12">
          <div class="form-group col-md-12 text-center">
            <button type="submit" class="btn btn-primary" data-loading-text="Adding ..." id="add-btn">Save</button>
          </div>
  </div>

</form>
