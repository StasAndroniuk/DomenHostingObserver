<?php

class CheckerController
{
    private $model;
    public function __construct()
    {
        $this->model=new CheckerModel();
    }
    public function GetOwnerList()
    {
        return $this->model->GetOwnerList();
    }
    public function getOwnerEmails($id)
    {
         return $this->model->GetOwnerEmails($id);
         
    }
    public function GetHostingForWarnings($id)
    {
      return $this->model->GetHostingForWarnings($id);
    }
    public function GetDomenForWarnings($id)
    {
        return $this->model->GetDomenForWarnings($id);
    }
    private function GetAdminEmail()
    {
        return $this->model->GetAdminEmail();
    }
    public function SendEmails($owners)
    {
       $admin['email']=$this->GetAdminEmail();
       $admin['hostings']['first_warning']=array();
       $admin['hostings']['second_warning']= array();
       $admin['domens']['first_warning']=array();
       $admin['domens']['second_warning']= array();
        foreach ($owners as $owner) {
            if(count($owner['hostings'])>0)
            {  
               if(count($owner['hostings']['first_warning'])>0)
               $admin['hostings']['first_warning']=array_merge( $admin['hostings']['first_warning'], $owner['hostings']['first_warning']);
               if(count($owner['hostings']['second_warning'])>0)
               $admin['hostings']['second_warning']=array_merge( $admin['hostings']['second_warning'], $owner['hostings']['second_warning']);
            }
            if(count($owner['domens'])>0)
           {
                if(count($owner['domens']['first_warning'])>0)
                $admin['domens']['first_warning']=array_merge( $admin['domens']['first_warning'], $owner['domens']['first_warning']);
                if(count($owner['domens']['second_warning'])>0)
                $admin['domens']['second_warning']=array_merge( $admin['domens']['second_warning'], $owner['domens']['second_warning']);
           }
           $this->PrepareMessage($owner);
      
           $this->PrepareMessage($admin,$admin['email']);
           
        }
        
        
    }
    private function PrepareMessage($owner, $emails='')
    {
        if($emails=='') $emails=$this->getOwnerEmails($owner['owner_id']);
       
        if(count($owner['hostings'])>0)
            { 
               if(count($owner['hostings']['first_warning'])>0)
               {
                  
                   $message=$this->model->MakeMessage($owner['name'],'first_warning',$owner['hostings']['first_warning'],'hostings');
                   $this->Send($message,$emails);
               }
               if(count($owner['hostings']['second_warning'])>0)
               {
                  
                   $message=$this->model->MakeMessage($owner['name'],'second_warning',$owner['hostings']['second_warning'],'hostings');
                   $this->Send($message,$emails);
               }
            }
            if(count($owner['domens'])>0)
            {
               if(count($owner['domens']['first_warning'])>0)
               {
                   
                   $message=$this->model->MakeMessage($owner['name'],'first_warning',$owner['domens']['first_warning'],'domens');
                   $this->Send($message,$emails);
               }
               if(count($owner['domens']['second_warning'])>0)
               {
                   
                   $message=$this->model->MakeMessage($owner['name'],'second_warning',$owner['domens']['second_warning'],'domens');
                   $this->Send($message,$emails);
               }
            }
    }
    private function Send($message,$to)
    {
           
         $emailNum=count($to);
         $str='';
         for($i=0;$i<$emailNum;$i++)
         {
           $str.=$to[$i]['email'];
           if($i<$emailNum-1)
                  $str.=', ';
         }
         $headers  = 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    
        $headers.= 'From: DHObserver@service.com' . "\r\n" .
                 'Reply-To: DHObserver@service.comr' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

   
        $subject='Окончание срока действия';
        mail($str,$subject,$message,$headers);
    }
    
   
}



?>