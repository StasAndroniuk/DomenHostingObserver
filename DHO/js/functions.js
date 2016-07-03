 
function enableInputs(datapicker='#datepicker')
{
     $(document).ready(function() {
        
          $( datapicker).datepicker({dateFormat: "yy-mm-dd"});
  });
  
  
}


function getContent(req,obj)
{
    $('.menu>a').removeClass('active');
    $('#'+obj+'_but').addClass('active');
    var request=$.ajax({
        url:req,
        method:"GET",
        dataType:"html"
    });
    request.done(function( msg ) {
  $( "#content" ).html( msg );
    enableInputs();

});

  
}

function deleteObject(id,objName)
{
    if(confirm('Вы действительно хотите выполнить удаление?'))
    {   var request = "/DHO/modules/"+objName+"/module.php?action=delete&id="+id.toString();
        getContent(request,objName);
    }
    
}
function ActivateFormSubmit(objName, editForm)
{
    $(document).ready(function() { 
            
            $(editForm).ajaxForm({
                dataType:"html",
        success:function(msg){$(objName).html(msg);}
            }); 
        }); 
}
function showForm(n,height,name,objName) {
    
    var editForm=name+n.toString();
    var h=height+"px";
    $(editForm).animate({height:h},1000).css("display","block");
    
   enableInputs('#datepicker'+n.toString());
    
           ActivateFormSubmit(objName,editForm);         
    
}

function hideForm(n,name) {
    
    var editForm=name+n.toString();
    
    $(editForm).animate({height:"0px"},1000).css("display","none");
    
}

function SubInfo(objName)
{
    var state=$(objName+"  .sub-info").css("display");
    if(state=="none")
    {
        $(objName+" #sub-info").html("-");
        $(objName+"  .sub-info").show();
    }
    else
    {
          $(objName+" #sub-info").html("+");
        $(objName+"  .sub-info").hide();
    }
}

function ActiveByClick(objName,FormName)
{
    ActivateFormSubmit(objName,FormName);
    if($(objName+'Status').prop('checked')==true)
    $(objName+'Status').prop('checked',false);
    else
    $(objName+'Status').prop('checked',true);
    $(FormName).submit();
       
}

function GroupAction(objName)
{
    var action=$('#operation').val();
    if(action==0)return;
    if(action==1)
    {
        GroupDelete(objName);
    }
    if(action==2)
    {
        GroupActivate(objName);
    }
}

function GroupDelete(objName)
{
    if(!confirm("Вы делйствительно хотите выполнить удаление?"))return;
    var a=$("input[id^='"+objName+"Checker']");
    
    for(var i=0;i<a.length;i++)
    {
        if(a[i].checked) 
        {
            var id=a[i].id.replace(objName+'Checker','');
             var request = "/DHO/modules/"+objName+"/module.php?action=delete&id="+id.toString();
             $.ajax({
                        url:request,
                        method:"GET",
                        dataType:"html"
                    });
        }
       
    }
    
       $(document).ready(getContent('modules/'+objName+'/module.php',objName));
       
}
function GroupActivate(objName)
{
    var a=$("input[id^='"+objName+"Checker']");
     for(var i=0;i<a.length;i++)
    {
        if(a[i].checked) 
        {
            var id=a[i].id.replace(objName+'Checker','');
            var obj="#"+objName;
            ActiveByClick(obj+id.toString(),obj+'EF'+id.toString());
        }
       
    }
    
       $(document).ready(getContent('modules/'+objName+'/module.php',objName));
}

function PhoneMask()
{    
   $(document).ready( $("input[id^='phone']").inputmask("mask", {"mask": "+38 (099) 999-99-99", clearMaskOnLostFocus: false}));
}




