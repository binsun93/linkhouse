
<div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th onclick="multiSort(this, function(){alert('single')}, function(){alert('double')}, '<?php echo $dTbl['module_id']; ?>')" style="width: 60px; color: blue;" class="th-sortable" data-toggle="class">ID
                        <span class="th-sort" id="iconSort_<?php echo $dTbl['module_id']; ?>" style="<?=!isset($orderBy[$dTbl['module_id']])?"display: none;":""?>">
                                <i class="fa fa-sort-down text<?=$orderBy[$dTbl['module_id']]=="asc"?"-active":""?>"></i>
                                <i class="fa fa-sort-up text<?=($orderBy[$dTbl['module_id']]=="desc" || !isset($orderBy[$dTbl['module_id']]))?"-active":""?>"></i>
                                <i class="fa fa-sort"></i>
                              </span>
                        </th>
                        <th >Url</th>
                        <th >Info</th>  
                        <th >Date</th>  
                        <th >Status</th>
                        <th >Tool</th>
                      </tr>
                    </thead> 
                    <tbody>

                    <?php
                    $start = $i = (($page-1)*$numRowForPage)+1; 
                    $buildLink = $this->load->library('Model_Build'); 
                    if (!empty($content)) {
                        foreach ($content as $row) {
							if($row->create_by){
								$this->_model->getDB()->from('tbg_admin');
								$this->_model->getDB()->where('id',$row->create_by);
								$ad_cre = current($this->_model->getDB()->get()->result());
							}
							if($row->publish_by){
								$this->_model->getDB()->from('tbg_admin');
								$this->_model->getDB()->where('id',$row->publish_by);
								$ad_pub = current($this->_model->getDB()->get()->result());
							}
							if($row->modify_by){
								$this->_model->getDB()->from('tbg_admin');
								$this->_model->getDB()->where('id',$row->modify_by);
								$ad_modify = current($this->_model->getDB()->get()->result());
							}
                        ?>
                        <tr id="<?php echo 'tr_' . $dTbl['module_id']; ?>">
                            <td><?=$i++?></td>
                            <td><?php echo $row->$dTbl['module_id']; ?></td>   
                           
                            <td> 
                                <a style="color: blue;" href="<?php echo base_url() . $dTbl['module_controler'].'/addedit/' . $row->$dTbl['module_id']; ?>" title="<?php echo $row->name; ?>">
                                    Url thực: <b><?php echo  $row->realurl; ?></b> <br />
                                    Đổi thành: <b><?php echo  $row->aliasurl; ?></b> <br />
                                </a>
                            </td>   
                            <td> 
                                <a style="color: blue;" href="<?php echo base_url() . $dTbl['module_controler'].'/addedit/' . $row->$dTbl['module_id']; ?>" title="<?php echo $row->email; ?>">
                                    Title: <b><?php echo  $row->mtitle; ?></b> <br />
                                    Description: <b><?php echo  $row->mdescription; ?></b> <br />
                                    Keyword: <b><?php echo  $row->mkeyword; ?></b> <br /> 
                                </a>
                            </td>   
                            <?php echo $buildLink->toolDefault($row , $dTbl, $ad_cre, $ad_pub, $ad_modify); ?> 
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