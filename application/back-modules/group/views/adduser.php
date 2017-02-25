
    <section class="vbox">
              <section class="scrollable padder">
                <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                  <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="<?=base_url()."group"?>" >Group</a></li> 
                  <li><a href="<?=base_url()."group/adduser"?>" >Add Users for Group: <?=$nameGroup?></a></li> 
                </ul>
              
              
                    <header class="panel-heading">
                    <b>Add Users for Group: <?=$nameGroup?></b>
                    </header>
                    <form id="form1" method="get">
                         <!-- .nav-justified -->
                          <section class="panel panel-default">
                              
                            <div class="panel-body">
                              <div class="tab-content"> 
                              
                                    <div class="panel-body text-sm" style="background-color: white;">
                                            <select style="width: 400px; margin-right: 5px;" name="parent_content" id="select2-option" >                   
                                                    <option value="-1">Choose user ...</option> 
                                                    <?php
                                                    foreach($userList as $key=>$v){  
                                                        echo '<option  value="' . $v->id . '">' . $v->username . '</option>';
                                                    } ?>  
                                            </select> 
                                            <label>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="adduser('<?=$id?>')">
                                                <span aria-hidden="true">Add</span></button> 
                                            </label> 
                                      </div>
                              
                                <div class="tab-pane active" id="idList"> 
                                <!-- Table --> 
                                <?=$listTable?>
                                </div>
                              </div>
                            </div>
                            
                          </section>
                          <!-- / .nav-justified -->
                    </form>
            </section>
    </section>  

<script>
   
function adduser(idGroup) {
        var user_id = $("#select2-option").val();
        var data = new Object();
        var href = 'group/adduser/<?=$id?>';
        
        if(user_id == -1){
            alert("Please Choose user ...");
            return false;
        }
         
        data.insertUser = 'insertUser'; 
        data.view = 'insertUser';  
        data.admin_group_id = idGroup; 
        data.user_id = user_id; 
        $.post(href, data, function(html1) {
            $('#idList').empty().html(html1);
        });
        
   
}
 
function jumpPage($type) { 
    var page1 = 1;
    var numPerPage1 = $( "#numPerPage" ).val(); 
    var listDate1 = $( "#listDate" ).val();
    var totalPage = $( "#totalPage" ).val(); 
    var tyle = $( "#type" ).val(); 
    var arrSort = $( "#mulSort" ).val(); 
    if($type == 'left'){
        page1 = $( "#pageLeft" ).val();
    } 
    if($type == 'right'){
        page1 = $( "#pageRight" ).val();
    }
    if(page1 != '' && page1 > 0 ){
        $.post('group/adduser/<?=$id?>', {
            view: "ajax",
            numPerPage:numPerPage1,
            page: page1,
            listDate:listDate1,
            totalPage:totalPage, 
            type:tyle,  
            arrSort:arrSort 
        }, function(data){ 
            $('#idList').empty().html(data);
        }, 'html');
        return true;
    } else return;
}
</script>