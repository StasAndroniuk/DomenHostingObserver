<?php

class HostingController
{
    private $model;
    public function __construct()
    {
        $this->model=new HostingModel();
    }
    public function GetHostingList()
    {
        return $this->model->GetHostingList();
    }
    public function AddFormView($owners)
    {
      require_once($_SERVER[DOCUMENT_ROOT].'/DHO/modules/hosting/view/new.phtml');
    }
    public function View($hosting)
    {
        require($_SERVER[DOCUMENT_ROOT].'/DHO/modules/hosting/view/view.phtml');
    }
    public function GetOwnerList()
    {
      return $this->model->GetOwnerList();
    }
    public function CheckHostingData($data)
    {
             $hosting['name']=strip_tags($data['hosting_name']);
             $hosting['date_of_end']=strip_tags($data['date_of_end']);
             $hosting['login']=strip_tags($data['login']);
             $hosting['pass']=strip_tags($data['pass']);
             $hosting['owner_id']=strip_tags($data['owner_id']);
             $hosting['user_name']=strip_tags($data['user_name']);
             if($data['status']==1)
                $hosting['status']=1;
             else 
                $hosting['status']=0;
             $hosting['comment']=strip_tags($data['comment']);
             
             return $hosting;
    }
    public function AddNewHosting($hosting)
    {
       $this->model->AddNewHosting($hosting);
    }
    public function GetHostingById($id)
    {
      return $this->model->GetHostingById($id);
    }
    public function GetCorrectedHosting($data)
    {
        $hosting['hosting_id']=strip_tags($data['hosting_id']);
        
        $date=new DateTime(strip_tags($data['date_of_end']));
        $date->modify('+'.strip_tags($data['year']).' year');
        $date->modify('+'.strip_tags($data['month']).' month');     
        
        $hosting['date_of_end']=$date->format('Y-m-d');
        $hosting['status']= $data['status']==1?1:0;
        $hosting['comment']=strip_tags($data['comment']);
        $hosting['login']=strip_tags($data['login']);
        $hosting['pass']=strip_tags($data['pass']);
        $hosting['user_name']=strip_tags($data['user_name']);
        return $hosting;
        
    }
    public function SaveHosting($hosting)
    {
        $this->model->SaveHosting($hosting);
    }
    public function DeleteHosting($id)
    {
          $this->model->DeleteHosting($id);
    }
}



?>