
<?php
$controll = $this->uri->segment(1);
$pargam = $this->uri->segment(2);
if ($controll == "user" && $pargam == "login") {
    echo $template['body'];
} else {
    echo Modules::run('header/header/index');
    
    ?>
    
    <section>
       <section class="hbox stretch"> 
        <?php
        echo Modules::run('left/left/index');
        echo $template['body'];
        ?>
        </section>
    </section>
    </section>
    <?php
    echo Modules::run('footer/footer/index'); 
}
?>

<script> 
function changeTab($type){
    $( "#type" ).val($type);
    jumpPage("a");
} 
function editInfo(value,id,nameDB){  
	var html = ' <input type="text" id="txt_popular_'+id+'" name="txt_popular_'+id+'" value="'+value+'" /> <input type="button" class="bntAll" onclick="xl_editInfo('+id+',';
	html += "'"+nameDB+"'";
	html += ')" value="Save" />'; 
	$('#itemEdit_'+id).html(html);
}

function xl_editInfo(id,nameDB)
{ 
	var txt_popular = $( "#txt_popular_"+id ).val() ;
	if(txt_popular > 0 ){
    	var data 			= new Object();
    	var href 			= URL_DO_AJAX+'/saveInfo'; 
    	data.id		 		= id;
    	data.txt_popular 	= txt_popular ;
    	data.info 			= nameDB; //resolution
    	 
    	$.post(href, data, function(html){
    		html = '<label style=" background-color:#E7EAEE ; padding:5px" onclick="editInfo(';
    		html += "'"+txt_popular+"',"+id+","+"'"+nameDB+"');";
    		html += '"  >'+txt_popular+'</label>';
    		$('#itemEdit_'+id).html(html);
    	});
	} else alert('Enter the larger 0');
} 
function changeStatusID(status, obj_id) {
        if (confirm("Confirm change")) {
            var data = new Object();
            var href = URL_DO_AJAX+'/changeStatus';
            data.status = status;
            data.id = obj_id;
            $.post(href, data, function(html) { 
                jumpPage("a");
            }); 
        } 
}  
function jumpPage($type)
{
   
    var page1 = 1;
    var numPerPage1 = $( "#numPerPage" ).val();
    var listDate1 = $( "#listDate" ).val();
    var totalPage = $( "#totalPage" ).val();
    var search = $( "#search" ).val();
    var tyle = $( "#type" ).val(); 
    var arrSort = $( "#mulSort" ).val();
    
    if($type == 'left'){
        page1 = $( "#pageLeft" ).val();
    }
    
    if($type == 'right'){
        page1 = $( "#pageRight" ).val();
    }
    if(page1 != '' && page1 > 0 ){
        $.post(URL_DO_AJAX, {
            view: "ajax",
            numPerPage:numPerPage1,
            page: page1,
            listDate:listDate1,
            totalPage:totalPage,
            search:search,
            type:tyle,  
            arrSort:arrSort 
        }, function(data){ 
            $('#idList').empty().html(data);
        }, 'html');
        return true;
    } else return;
}
</script>

