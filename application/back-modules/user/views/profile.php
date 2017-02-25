<section class="vbox">
          <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
              <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> Home</a></li> 
               <li><a href="<?=base_url().$this->uri->segment(1)?>" >Profile</a></li> 
            </ul>
            
            
            

    <form  method="post" id="formadd" onsubmit="return mysubmit();" enctype="multipart/form-data">
                <section class="panel panel-default">
                    <header class="panel-heading bg-light">
                      <b>My Profile</b>
                    </header>
                    
                    <div class="panel-body">
                        <?php
                        if ($this->session->userdata('message_success')) {
                            ?>
                            <div class="red" style="color: green; font-size: 16px;" >
                                <?php echo $this->session->userdata('message_success'); ?>
                            </div>
                            <?php
                            $this->session->unset_userdata('message_success');
                        }
                        if ($this->session->userdata('message_error')) {
                            ?>
                            <div style="color:red;">
                                <?php echo $this->session->userdata('message_error'); ?>
                            </div>
                            <?php
                            $this->session->unset_userdata('message_error');
                        }
                        ?>
                        <!-- info user -->
                        
                        
                        <div class="well" style="padding: 9px;  margin-bottom: 0px">
                            <div class="row"> 
                                 <label class="col-lg-2 control-label">Old Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" placeholder="Old password" id="old_password" name="old_password" value="<?php echo (!empty($obj[0]->link_en)) ? $obj[0]->link_en : ''; ?>"  type="password" style="width: 350px;"/>
                                </div>
                                
                                <br />
                                
                                <label class="col-lg-2 control-label">New Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" placeholder="New password" id="new_password" name="new_password" value="<?php echo (!empty($obj[0]->link_en)) ? $obj[0]->link_en : ''; ?>"  type="password" style="width: 350px;"/>
                                </div>
                                
                                <br />
                                
                                <label class="col-lg-2 control-label">Re-Enter New Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" placeholder="Re-Enter password" id="new_password_again" name="new_password_again" value="<?php echo (!empty($obj[0]->link_en)) ? $obj[0]->link_en : ''; ?>"  type="password" style="width: 350px;"/>
                                </div>
                                
                                
                            </div>
                        </div>
                              <br />
                        <!-- //////////////////////////////////////////////////////////// -->
                                <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-success">Save</button>
                                  </div>
                                </div>
                       
                              
                    </div>
                </section>

    </form>
</section>
    </section>

<script type='text/javascript'>
     
    function mysubmit() {
        // check value before submit
        var error = false;
        var message_error = '';
        
        if ($("#old_password").val() == "" || $("#new_password").val() == "" || $("#new_password_again").val() == "" ) {
            error = true;
            message_error += "Can not Empty.\n";
        }
        
        if ($("#new_password").val() != $("#new_password_again").val()) {
            error = true;
            message_error += "New Password & Re-Enter New Password must be the same.\n";
        }
         
       
        // end check
        if (error == true) {
            alert(message_error);
            return false;

        } else {
            return true;
        }
    }
</script>		
