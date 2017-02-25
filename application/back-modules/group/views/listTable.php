
<div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th onclick="multiSort(this, function(){alert('single')}, function(){alert('double')}, 'admin_group_id')" style="width: 60px; color: blue;" class="th-sortable" data-toggle="class">ID
                            <span class="th-sort" id="iconSort_admin_group_id" style="<?=!isset($orderBy['admin_group_id'])?"display: none;":""?>">
                                <i class="fa fa-sort-down text<?=$orderBy['admin_group_id']=="asc"?"-active":""?>"></i>
                                <i class="fa fa-sort-up text<?=($orderBy['admin_group_id']=="desc" || !isset($orderBy['admin_group_id']))?"-active":""?>"></i>
                                <i class="fa fa-sort"></i>
                              </span>
                        </th>
                        <th >Name</th> 
                        <th >Status</th>
                        <th >Tool</th>
                      </tr>
                    </thead>
                    
                    
                    
                    <tbody>

                    <?php
                    $start = $i = (($page-1)*$numRowForPage)+1;
                    $user = $this->load->model('admins/admins_model'); 
                    if (!empty($content)) {
                        foreach ($content as $row) { 
                        ?>
                        <tr id="<?php echo 'tr_' . $row->id; ?>">
                            <td><?=$i++?></td>
                            <td><?php echo $row->admin_group_id; ?></td>   
                            <td>									
                                <a style='color:blue;' href="<?php echo base_url() . 'group/addedit/' . $row->admin_group_id; ?>" title="<?php echo $row->name; ?>">                                       <?php echo $row->name; ?>&nbsp;&nbsp;&nbsp;
                                    <span class="badge badge-sm up bg-danger m-l-n-sm count"><?=$user->count_all_user("admin_group_id = ".$row->admin_group_id)?></span>                                    
                                </a>							 							
                            </td> 
                            <td>
                               
                                <div class="btn-group">
        		                  <i  data-toggle="dropdown">
                                    <?php
                                    if($row->status == 0){
                                        ?><a href="javascript:void(0)"  title="Unpublish"><img src="<?=THEME_ADMIN?>images/error.png" height="20px" width="20px" /></a><?php
                                    }
                                    if($row->status == 1){
                                        ?><a href="javascript:void(0)"  title="Publish"><img src="<?=THEME_ADMIN?>images/success.png" height="20px" width="20px" /></a> <?php
                                    }
                                    if($row->status == 2){
                                        ?><a href="javascript:void(0)"  title="Deleted"><img src="<?=THEME_ADMIN?>images/trash.png" height="20px" width="20px" /></a><?php
                                    } 
                                    ?>
                                  </i>
        		                  <ul class="dropdown-menu"> 
                                    <?php 
                                    if($row->status != 0){
                                        ?><li><a id="td_<?php echo $row->admin_group_id; ?>" href="javascript:change(0 ,'<?=$row->admin_group_id?>')">
                                        <img src="<?=THEME_ADMIN?>images/error.png" height="20px" width="20px" />
                                        UnPublish</a></li><?php
                                    }
                                    if($row->status != 1){
                                        ?><li><a id="td_<?php echo $row->admin_group_id; ?>" href="javascript:change(1 ,'<?=$row->admin_group_id?>')">
                                         <img src="<?=THEME_ADMIN?>images/success.png" height="20px" width="20px" />
                                         Publish</a></li><?php
                                    }
                                    if($row->status != 2){
                                        ?><li><a id="td_<?php echo $row->admin_group_id; ?>" href="javascript:deleteBanner(<?php echo $row->admin_group_id; ?>);">
                                        <img src="<?=THEME_ADMIN?>images/trash.png" height="20px" width="20px" />
                                        Delete</a></li><?php
                                    } 
                                    ?>
                                    </ul>
        		                </div>
                                
                                
                            </td>
                            <td>
                                <span>
                                    <a href="<?php echo base_url() . 'group/addedit/' . $row->admin_group_id; ?>" title="Edit">
                                        <img src="<?=THEME_ADMIN?>images/edit-icon.png" height="20px" width="20px" />
                                    </a>  
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