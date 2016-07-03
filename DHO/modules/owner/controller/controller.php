<?php


class ownerController 
{
    private $moduleName;
    private $model;
    public function __construct()
    {
        $this->model = new owner_model();
        $this->moduleName='Владельцы';
    }
    public function GetModuleName()
    {
        return $this->moduleName;
    }
    
    public function GetOwnerList()
    {
        return $this->model->getOwnerList();
    }
    public function view($owner)
    {
        
        require($_SERVER[DOCUMENT_ROOT].'/DHO/modules/owner/view/view.phtml');
    }
    public function AddFormView()
    {
        require($_SERVER[DOCUMENT_ROOT].'/DHO/modules/owner/view/new.phtml');
    }
    public function DisplayError($error)
    {
       require($_SERVER[DOCUMENT_ROOT].'/DHO/modules/owner/view/error.phtml');
    }
    public function getOwnerById($id)
    {
        return $this->model->getOwnerById($id);
    }
    public function CheckOwnerData($data)
    {       
        
        if(Validation::IsId($data['owner_id'])==1)
        {
           $owner['owner_id']=$data['owner_id'];
        }
        else
        {
            $error['is_error']=1;
            $error['error_message']="Owner_Id is wrong!";
            return $error;
        }
        if(Validation::IsName($data['firstname'])==1)
        {
             $owner['firstname']=$data['firstname'];
        }
        else
        {
            $error['is_error']=1;
            $error['error_message']="Firstname contains invalid symbols!";
            return $error;
        }
        if(Validation::IsName($data['lastname'])==1)
        {
            $owner['lastname']=strip_tags($data['lastname']);
        }
        else
        {
            $error['is_error']=1;
            $error['error_message']="Lastname contains invalid symbols!";
            return $error;
        }        
        for($i=0;$i<3;$i++)
        {
            if(Validation::isEmail($data['email'.$i])==1)
            {
                $owner['emails'][$i]['email']=strip_tags($data['email'.$i]);
                $owner['emails'][$i]['emailId']=strip_tags($data['emailId'.$i]);
            }
            else
            {
                $error['is_error']=1;
                $error['error_message']='Email '.$i.' has wrong format!';
                return $error;
            } 
        }
        for($i=0;$i<3;$i++)
        {
            if(Validation::IsPhone($data['phone'.$i])==1)
            {
                $owner['phones'][$i]['phone']=strip_tags($data['phone'.$i]);
                $owner['phones'][$i]['phoneId']=strip_tags($data['phoneId'.$i]);
            }
             else
            {
                $error['is_error']=1;
                $error['error_message']='Phone number '.$i.' has invalid symbols!';
                return $error;
            } 
        }
       
       return $owner;
    }
    public function EditOwnerData($owner)
    {
        $this->model->EditOwnerData($owner);
    }
    public function AddnewOwner($owner)
    {
        $new_owner_id=$this->model->AddNewOwner($owner);       
    }
    public function DeleteOwner($id)
    {
        $this->model->DeleteOwner($id);
    }
    
}


?>