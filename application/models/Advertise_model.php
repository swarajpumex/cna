<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertise_model extends CI_Model {

	var $table = 'advertise';

        var $column_order = array('Name','Photo','CreatedOn','Status'); //set column field database for datatable orderable
	var $column_search = array('Name','Status'); //set column field database for datatable searchable.
	var $order = array('Id' => 'desc'); // default order

	 
	 function __construct()  // CONSTRUCTOR FUNCTION START
	 {
        parent::__construct();
        $this->load->helper('common_functions_helper'); // for password encription/ verification
        //
        // for file uploads
        ini_set('max_execution_time',300);
        ini_set('memory_limit', '64M'); //Raise to 512 MB
        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');
        ini_set("date.timezone", "Asia/Kolkata");
      
    } // --CONSTRUCTOR FUNCTION ENDS

 
 function getDataTables()
	{

	   $this->getDataTableQuery();
		
		if($_POST['length'] != -1)  // commented for working
			$this->db->limit($_POST['length'], $_POST['start']); // commented for working
		
		
		$query = $this->db->get();
		return $query->result();
	}
 
 private function getDataTableQuery()
	{
		
		$this->db->from($this->table);

		//$this->db->where("Id =",$releaseid);
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
		 if(isset($_POST['search']) && $_POST['search']['value']!="" )
		 {
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					//$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. this is not working
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					{
						//$this->db->group_end(); //close bracket. this is not working
					}
			}
		 } // isset ending	
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
 
 
 function countFiltered()
	{
		$this->getDataTableQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAll()
	{
		//$this->db->where("UserId !=","shameel");
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function getById($id)
	{
		$this->db->from($this->table);
		$this->db->where('Id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function saveData($data, $id)
	{
            	if($id==0)
		{
			$this->db->insert($this->table, $data);
			$insertId = $this->db->insert_id();
                        $action = "New user created.";
                        $this->recordAdminActions($action);
                        return $insertId;
		}
		else
			{
				$this->db->update($this->table, $data, array('Id' =>$id)); // 3rd argument is where
				$action = "User data changed.";
                                $this->recordAdminActions($action);
                                return $this->db->affected_rows();
          		}	
	}
     
       public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
        
        
        public function deleteUserPhoto($id)
        {
            
                $db  = new Database();
                
                // deleting the Profile photo
                $upload_dir ='./uploads/profile_image/'; // upload directory
                $photo = $db->getFieldValueById($this->table, "ProfilePhoto", "Id={$id}");
                $sex = $db->getFieldValueById($this->table, "Sex", "Id='{$id}'");
                $userId = $db->getFieldValueById($this->table, "UserId", "Id='{$id}'");
                
                $db =NULL;
                
                $defaultImage = "user_default_male.png";
                
                if($sex=="Female")
                    $defaultImage = "user_default_female.png";
                    
                $data = array(
                        'ProfilePhoto' => $defaultImage 
                );
                
                $this->db->update($this->table, $data, array('Id' =>$id)); // 3rd argument is where
		$action = "User profile photo deleted for user :{$userId}.";
                $this->recordAdminActions($action);
                                
                if($photo!="user_default_female.png" && $photo!="user_default_male.png")
                {
                    $file = $upload_dir . $photo;
                    unlink($file);
                    
                }
                else
                {
                    return "Error! There is no profile image for this user. ";
                    
                    
                }
                
                
               if($userId == $_SESSION["ADMIN_ID"]) // checking the login user id to change profile pic
                    $_SESSION['PROFILE_PHOTO'] =$defaultImage;
               
               
               return "../../uploads/profile_image/" . $defaultImage;
        }

	public function deleteData($id)
	{
                $db  = new Database();
                // checking if currently loged in
                   /* $status = $db->getFieldValueById($this->table, "LoginStatus", "Id='{$id}'");
                if($status==1)
                    return "Error! Can't delete, you are currently loged in.";
                

                // deleting the Profile photo
                $upload_dir ='./uploads/profile_image/'; // upload directory
                $photo = $db->getFieldValueById($this->table, "ProfilePhoto", "Id='{$id}'");
                
                $db =NULL;
                
                if($photo!="user_default_female.png" && $photo!="user_default_male.png")
                {
                    $file = $upload_dir . $photo;
                    unlink($file);
                    
                }*/
		$this->db->where('Id', $id);
		$this->db->delete($this->table);
                return TRUE;
	}

    public function recordAdminActions($action) 
    {
        
         //----- inseting into user_log table
                     
                            $insertData= array (
                            'UserLogId' => $_SESSION['ADMIN_USER_LOG_ID'],
                            'UserName' => $_SESSION['ADMIN_ID'],
                            'Actions' => $action,
                            'ActionIP' => getRequestIPAddress()    
                            );
                            
                            $this->db->insert('sys_user_log_detail',$insertData);
        
        
    }  
 
 

} // CLASS ENDING