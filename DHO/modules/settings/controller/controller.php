<?php



class SettingsController
{
    private $model;
    
    public function __construct()
    {
         $this->model=new SettingsModel();
    }
    public function GetSettings()
    {
      return $this->model->GetSettings();
    }
    public function View($settings)
    {
        require($_SERVER[DOCUMENT_ROOT].'/DHO/modules/settings/view/view.phtml'); 
    }
    public function GetPostData($data)
    {
      $keys=array_keys($data);
      foreach ($keys as $key) {
          $settings[$key]=strip_tags($data[$key]);
      }
      return $settings;
    }
    public function SaveSettings($settings)
    {
       $this->model->SaveSettings($settings);
    }
    
    
}








?>