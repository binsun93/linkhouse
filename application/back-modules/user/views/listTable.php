
<div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th onclick="multiSort(this, function(){alert('single')}, function(){alert('double')}, 'id')" style="width: 60px; color: blue;" class="th-sortable" data-toggle="class">ID
                            <span class="th-sort" id="iconSort_id" style="<?=!isset($orderBy['id'])?"display: none;":""?>">
                                <i class="fa fa-sort-down text<?=$orderBy['id']=="asc"?"-active":""?>"></i>
                                <i class="fa fa-sort-up text<?=($orderBy['id']=="desc" || !isset($orderBy['id']))?"-active":""?>"></i>
                                <i class="fa fa-sort"></i>
                              </span>
                        </th>
                        <th >Fullname</th>
                        <th >Username</th>
                        <th >Email</th>
                        <th >Last Connection </th> 
                        <th >Group</th>
                        <th >Publish</th>
                        <th >Tool</th>
                      </tr>
                    </thead>
                    
                    
                    
                    <tbody>

                    <?php
                    $start = $i = (($page-1)*$numRowForPage)+1;
                    
                    if (!empty($content)) {
                        foreach ($content as $row) { 
                        ?>
                        <tr id="<?php echo 'tr_' . $row->id; ?>">
                            <td><?=$i++?></td>
                            <td><?php echo $row->id; ?></td>   
                            
                            <td><a style="color: blue;" href="<?php echo base_url() . 'user/addedit/' . $row->id; ?>"><?php echo $row->fullname; ?></a></td>
                            <td><a style="color: blue;" href="<?php echo base_url() . 'user/addedit/' . $row->id; ?>"><?php echo $row->username; ?></a></td>
                            <td><a style="color: blue;" href="<?php echo base_url() . 'user/addedit/' . $row->id; ?>"><?php echo $row->email; ?></a></td>
                                                            							<td>								Date: <b><?php echo $row->last_connection; ?></b><br />								Ip: <b><?php echo $row->ip_connection; ?></b>                            </td>   
                            <td><a style="color: blue;" href="<?php echo base_url() . 'group/addedit/' . $row->user_group_id; ?>"><?php echo $row->groups_name; ?></a></td> 
                            <td>
                               
                                <div class="btn-group">
        		                  <i  data-toggle="dropdown">
                                    <?php
                                    if($row->publish == 0){
                                        ?><a href="javascript:void(0)"  title="Unpublish"><img src="<?=$this->config->item('img_path')?>150x150/icon/error.png" height="20px" width="20px" /></a><?php
                                    }
                                    if($row->publish == 1){
                                        ?><a href="javascript:void(0)"  title="Publish"><img src="<?=$this->config->item('img_path')?>150x150/icon/success.png" height="20px" width="20px" /></a> <?php
                                    }
                                    if($row->publish == 2){
                                        ?><a href="javascript:void(0)"  title="Deleted"><img src="<?=$this->config->item('img_path')?>150x150/icon/trash.png" height="20px" width="20px" /></a><?php
                                    } 
                                    ?>
                                  </i>
        		                  <ul class="dropdown-menu"> 
                                    <?php 
                                    if($row->publish != 0){
                                        ?><li><a id="td_<?php echo $row->id; ?>" href="javascript:change(0 ,'<?=$row->id?>')">
                                        <img src="<?=$this->config->item('img_path')?>150x150/icon/error.png" height="20px" width="20px" />
                                        UnPublish</a></li><?php
                                    }
                                    if($row->publish != 1){
                                        ?><li><a id="td_<?php echo $row->id; ?>" href="javascript:change(1 ,'<?=$row->id?>')">
                                         <img src="<?=$this->config->item('img_path')?>150x150/icon/success.png" height="20px" width="20px" />
                                         Publish</a></li><?php
                                    }
                                    if($row->publish != 2){
                                        ?><li><a id="td_<?php echo $row->id; ?>" href="javascript:deleteBanner(<?php echo $row->id; ?>);">
                                        <img src="<?=$this->config->item('img_path')?>150x150/icon/trash.png" height="20px" width="20px" />
                                        Delete</a></li><?php
                                    } 
                                    ?>
                                    </ul>
        		                </div>
                                
                                
                            </td>
                            <td>
                                <span>
                                    <a href="<?php echo base_url() . 'user/addedit/' . $row->id; ?>" title="Edit">
                                        <img src="<?=$this->config->item('img_path')?>150x150/icon/edit-icon.png" height="20px" width="20px" />
                                    </a>
                                     
                                    
                                    <?php 
                                     if ($this->session->userdata("have_history_page") == TRUE) {
                                            $urlLog = "history?optionsFilter=item&type=All&set_of_component=User ( fullname: ".$row->fullname." )&module_item=2%40%40tbl_users%40%40id%40%40User&filter_module_item=fullname&search=".$row->fullname;
                                            ?>
                                            <a href="<?php echo base_url() . $urlLog; ?>" title="Log History">
                                                <img src="<?=$this->config->item('img_path')?>150x150/icon/history.png" height="20px" width="20px" />
                                            </a>
                                            <?php
                                            
                                         
                                            $urlLog = "history?optionsFilter=user&type=All&user_id=".$row->id;
                                            ?>
                                            <a href="<?php echo base_url() . $urlLog; ?>" title="History Action">
                                                <img src="<?=$this->config->item('img_path')?>150x150/icon/history1.png" height="20px" width="20px" />
                                            </a> 
                                            <?php
                                     } 
                                     ?>
                                    
                                     
                                     
                                </span>
                            </td>                
                        </tr>
                        
                        <?php
                    }}$end = $i-1;
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- page num -->
            
                <div class="boxAll pageNum" >
                    <div class="page">
                        <?php
                        
                        $buildLink = $this->load->library('Model_Build');
                       
                        $buildLink->buildPage($numRowForPage , $page , $start , $end , $totalRow);
                        ?>
                    </div>
                </div>
                <input type="hidden" name="mulSort" id="mulSort" value="<?=$mulSort?>" />
                <!-- en page num -->
<script>


$(function() {
      $('#numPerPage').change(function() {
            $('#form1').submit();
      });
});
$(function() {
      $('#txtpage').change(function() {
            $('#form1').submit();
      });
});


</script>