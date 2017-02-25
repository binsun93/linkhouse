<section class="vbox">
          <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
              <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> Home</a></li>
              <li><a href="<?=base_url().$this->uri->segment(1)?>" >User</a></li>
              <li><a href="<?=base_url().$this->uri->segment(1)?>" >Add/Edit</a></li>
              <?php
              if (isset($id) && $id > 0) {
                    ?> 
                    <li><a href="<?=base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)?>" >ID: <?=$this->uri->segment(3)?></a></li>
            
                    <?php
                } 
              ?>
            </ul>
            
            
            

    <form action="<?php
    if (isset($id) && $id > 0) {
        echo 'user/addedit/' . $id;
    } else {
        echo 'user/addedit';
    }
    ?>" method="post" id="formadd" onsubmit="return mysubmit();" enctype="multipart/form-data">
                <section class="panel panel-default">
                    <header class="panel-heading bg-light">
                      <b><?=$title?></b>
                    </header>
                    
                    <div class="panel-body">
                        <?php
                        if ($this->session->userdata('message_success')) {
                            ?>
                            <div  style="color: green; font-size: 16px;" >
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
                                <div class="col-xs-6">
                                    <label class="col-lg-2 control-label">Fullname</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" placeholder="Fullname..." id="fullname" name="fullname" value="<?php echo (!empty($obj[0]->fullname)) ? $obj[0]->fullname : ''; ?>"  type="text" style="width: 350px;"/>
                                    </div>                  
                                    <br /><br />
                                    
                                    <label class="col-lg-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" placeholder="Email..." id="email" name="email" value="<?php echo (!empty($obj[0]->email)) ? $obj[0]->email : ''; ?>" type="text"  style="width: 350px;"/>
                                    </div> 
                                    <br /><br /> 
                                 </div>
                                
                                <div class="col-xs-6">
                                    <label class="col-lg-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" placeholder="Username..." id="username" name="username" value="<?php echo (!empty($obj[0]->username)) ? $obj[0]->username : ''; ?>" type="text"  style="width: 350px;"/>
                                    </div> 
                                    <br /><br />
                                    <label class="col-lg-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                    <?php
                                    
                                    if (isset($id) && $id > 0) { ?> 
                                            <input class="form-control" placeholder="*******************" id="password" name="password"   type="text"  style="width: 350px;"/>
                                    <?php } else { ?> 
                                            <input class="form-control" placeholder="Password..." id="password" name="password"   type="text"  style="width: 350px;"/>
                                    <?php } ?>
                                        </div> 
                                    <br /><br />
                                    
                                </div>
                            </div>
                        </div>
                            <br /><br />
                             <div class="form-group">
                                <label class="col-sm-2 control-label">Group</label>
                                <div class="col-sm-10">
                                  <div class="m-b"> 
                                    <select name="user_group_id" id="select2-option" style="width:260px" >  
                                        <option value="0">No Group</option>
                                        <?php
                                        foreach ($group as $row) {
                                            $selcet_pro = '';
                                            if (!empty($obj[0]) && $obj[0]->user_group_id == $row->id_user_group)
                                                $selcet_pro = 'selected="selected" ';
                                            echo '<option ' . $selcet_pro . ' value="' . $row->id_user_group . '">' . $row->name . '</option>';
                                        }
                                        ?>  
                                    </select>  
                                  </div>
                                </div>
                            </div>
                             <br /><br />
                             
                            <div class="form-group">
                              <label class="col-lg-2 control-label"></label>
                              <div class="col-lg-10">
                                    <p>
                                        <input name="publish" type="radio" value="1" <?php echo (!empty($obj[0]) && $obj[0]->publish == 1) ? "checked='checked'" : ''; ?>/> 
                                        <img src="<?=$this->config->item('img_path')?>150x150/icon/success.png" height="20px" width="20px" style="margin-top: -8px;" />
                                        Publish
                                        <input name="publish" type="radio" value="0" <?php echo (empty($obj[0]) || $obj[0]->publish == 0) ? "checked='checked'" : ''; ?>/> 
                                        <img src="<?=$this->config->item('img_path')?>150x150/icon/error.png" height="20px" width="20px" style="margin-top: -8px;"  />
                                        Unpublish
                                        <?php
                                        if (isset($id) && $id > 0) {
                                            ?>
                                            <input name="publish" type="radio" value="2" <?php echo (!empty($obj[0]) && $obj[0]->publish == 2) ? "checked='checked'" : ''; ?>/> 
                                            <img src="<?=$this->config->item('img_path')?>150x150/icon/trash.png" height="20px" width="20px" style="margin-top: -8px;"  />
                                            Trash 
                                            <?php   
                                        }
                                        ?>                                     
                                    </p>        
                              </div>
                            </div>
                            
                            <br /><br /><br />
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
 	
