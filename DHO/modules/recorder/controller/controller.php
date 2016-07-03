<?php

class RecorderController
{
    private $model;
    
    public function __construct()
    {
        $this->model=new RecorderModel();
    }
    
    public function View($recorder)
    {
        
        require($_SERVER[DOCUMENT_ROOT].'/DHO/modules/recorder/view/view.phtml');
    }
    public function AddFormView()
    {
        require($_SERVER[DOCUMENT_ROOT].'/DHO/modules/recorder/view/new.phtml');
    }
    public function GetRecorderList()
    {
        return $this->model->GetRecorderList();
    }
    public function CheckRecorderData($data)
    {
        $recorder['recorder_id']=strip_tags($data['recorder_id']);
        $recorder['name']=strip_tags($data['name']);
        $recorder['login']=strip_tags($data['login']);
        $recorder['pass']=strip_tags($data['pass']);
        
        return $recorder;
    }
    public function SaveChanges($recorder)
    {
        $this->model->SaveChanges($recorder);
    }
    public function GetRecorderById($id)
    {
        return $this->model->GetRecorderById($id);
    }
    public function DeleteRecorder($id)
    {
        $this->model->DeleteRecorder($id);
    }
    public function AddRecorder($recorder)
    {
         $this->model->AddRecorder($recorder); 
         
    }

}

?>