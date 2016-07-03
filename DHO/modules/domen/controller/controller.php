<?php

 
class DomenController
{
     private $model;
    
    public function __construct()
    {
        $this->model=new DomenModel();
    }
    
    public function View($domen)
    {
        
        require($_SERVER[DOCUMENT_ROOT].'/DHO/modules/domen/view/view.phtml');
    }
    public function AddFormView()
    {
        $info=$this->GetDomenComponents();
        require($_SERVER[DOCUMENT_ROOT].'/DHO/modules/domen/view/new.phtml');
    }
    public function GetDomenList()
    {
       
       return $this->model->GetDomenList();      
       
    }
    public function GetDomenById($id)
    {
        return $this->model->GetDomenById($id);
    }
    public function CheckDomenData($data)
    {
        $domen['domen_id']=strip_tags($data['domen_id']);
       
        if($data['active']==1)
            $domen['status']=1;
        else
            $domen['status']=0;
       
            $t=split('-',$data['date_of_end']);
            $t[0]=(int)$t[0]+(int)$data['extend'];
            $domen['date_of_end']=$t[0].'-'.$t[1].'-'.$t[2];
       
          
        $domen['comment']=$data['comment'];
       
        return $domen;
               
    
    }
    public function SaveDomen($domen)
    {
          $this->model->SaveDomen($domen);
    }
    public function GetDomenComponents()
    {
         return $this->model->GetDomenComponents();
    }
    public function AddDomen($data)
    {
        $this->model->AddDomen($data);
    }
    public function DeleteDomen($id)
    {
          $this->model->DeleteDomen($id);
    }
}







?>