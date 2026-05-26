<?php
class AdminModel extends CI_Model{
    
    function __construct() {
        parent::__construct();
        
	$this->load->helper('common_functions_helper'); // for password encription/ verification
	$this->load->helper('send_email_helper');
        
        ini_set('max_execution_time',300);
        ini_set('memory_limit', '64M'); //Raise to 512 MB
        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');
        ini_set("date.timezone", "Asia/Dubai");
		date_default_timezone_set('Asia/Dubai');
	
        //session_start();
    }
	
	
 public function getAdminMenu()
 {
 
 	$SQL = "SELECT  M.Id, S.MenuItemId, M.MenuItem AS MainMenu,M.ShowCount,M.linkPage, M.countTitle, M.countTable, M.countWhereClause,";
	$SQL .= " IFNULL (S.SubMenuItem,'NULL') AS SubMenuItem, ";
	$SQL .= " S.pageLink AS SubPageLink, M.FaIcon AS MainIcon, S.FaIcon AS SubIcon, M.Status AS MainStatus,S.Status AS SubStatus";
	$SQL .= " FROM sys_admin_menu AS M ";
	$SQL .=	"  LEFT JOIN sys_admin_sub_menu AS S on M.Id = S.MenuItemId";
	$SQL .=	"  ORDER BY S.MenuItemId, M.`Order`, S.SubMenuOrder";

	
	
	$data = array();
	$result = $this->db->query($SQL);
	
	if ($result->num_rows() > 0)
            $data = $result->result_array();  // returning the records as an array.
         
       // $dataReturn = array();
		//$dataReturn["admin_navigation"] = $data; 
	
		return $data;
 
 } 	
 
 public function getSubMenuItem($menuId)
 {
 	$SQL = "  SELECT  MenuItemId,  ";
    $SQL .= " IFNULL (SubMenuItem,'NULL') AS SubMenuItem, ";
	$SQL .= " pageLink AS SubPageLink, FaIcon AS SubIcon, Status AS SubStatus";
	$SQL .="  FROM sys_admin_sub_menu WHERE MenuItemId='{$menuId}'";
	$SQL .="  ORDER BY SubMenuOrder";
	

	$result = $this->db->query($SQL);
	return $result;
 
 }
 
public function adminLoginCheck($userId, $userPass)
    {
         
        $SQL  = "SELECT Id, UserId,Password,UserType, ProfilePhoto";
        $SQL .= "  FROM login WHERE UserId='$userId' AND Status='Active'  LIMIT 1";
	
        $data = array();
      
        $records = $this->db->query($SQL); // --- using db->query Method
        
        
        if($records->num_rows()<=0)
             return FALSE;
        
        else  // getting the password from table
        {
            $row=$records->row();
                {
                    $logPass=$row->Password;
                    $data['USER_TYPE'] = $row->UserType;
                    
                    if(!verifyPassword($userPass, $logPass))
                        {
                            
                            return FALSE;
                        }
                   else
                       
                   {  
                            $_SESSION['ADMIN_ID'] =$userId;
                            $_SESSION['ADMIN_PASS'] =$userPass;
                            $_SESSION['ADMIN_USER_TYPE'] =$row->UserType;
                            $_SESSION['ADMIN_LOGIN_ID'] =$row->Id;
                            $_SESSION['PROFILE_PHOTO'] = $row->ProfilePhoto;
                            $loginIP    = getRequestIPAddress();
                            $Id     = $row->Id;
                            
			    
                            //------------------ updating the Last Login IP address & User_Log table
                            $today = date('Y-m-d');
			    $logData= array (
                            'LastLoginIP' => $loginIP,
                            'LoginStatus' => '1',
			    'LastLoginDate'=>date("Y-m-d H:i:s")	
                            );
			    $this->db->where('Id',$Id);
                            $this->db->update('login',$logData);
                           

                           			   
                            //----- inseting into user_log table
                     
                            $insertData= array (
                            'UserId' => $Id,
                            'UserName' => $userId,
                            'UserType' => $row->UserType,
                            'LastLoginIP' => $loginIP,
                            'SessionId' => session_id(),
							'LastLoginDate'=>date("Y-m-d H:i:s")
			    
                            );
                            
                            $this->db->insert('sys_user_log',$insertData);
                            $_SESSION['ADMIN_USER_LOG_ID'] =  $this->db->insert_id(); // this is for inserting user actions into user_log_detail table

                    $admin_array = array('ADMIN_ID' => $userId, 'ADMIN_PASS' => $userPass, 'ADMIN_USER_TYPE' => $row->UserType, 'ADMIN_LOGIN_ID' => $row->Id, 'PROFILE_PHOTO' =>  $row->ProfilePhoto);
                    return  $admin_array;
                   }     
                }
           
        }
    }

    public function recordAdminActions($action) 
    {
        
         //----- inseting into user_log table
                     
                            $insertData= array (
                            'UserLogId' => $_SESSION['ADMIN_USER_LOG_ID'],
                            'UserName' => $_SESSION['ADMIN_ID'],
                            'Actions' => $action,
                            'ActionIP' => getRequestIPAddress(),
							'CreatedOn'=>date("Y-m-d H:i:s")	
                            );
                            
                            $this->db->insert('sys_user_log_detail',$insertData);
        
        
    }
    
    public function updateLoginStatus($loginId) {
        
            $logData= array (
            'LoginStatus' => '0'        
            );
            $this->db->where('Id',$loginId);
            $this->db->update('login',$logData);
            
            
            $data= array (
            'LogOutTime'=>date("Y-m-d H:i:s")       
            );
            
            $this->db->where('Id',$_SESSION['ADMIN_USER_LOG_ID']);
            $this->db->update('sys_user_log',$data);
            
            
        
    }    
    
  public function saveChangePassword($pass,$NewPassword)
  {
	   $db			 = new Database();
       $userId       = $_SESSION['ADMIN_ID'];
       $userpassword = $db->getFieldValueById("login","Password","UserId='{$userId}'");
      
       
       $newuserPassword=encriptPassword($NewPassword);
       if($userpassword!=encriptPassword($pass))   
                 return array("msg"=>"Invalid current password","status"=>false);
       else
             {  
                
                $insertData = array 
                        (
                            "Password"=>$newuserPassword
                         );
                
                
                    $this->db->where('UserId', $userId);
                    $res = $this->db->update('login',$insertData);
        
                    
                    $action = "Password changed for user {$userId}";
                    $this->recordAdminActions($action);
        
                    
                    return array("msg"=>"Password has been successfully changed!","status"=>true);
                    
             }
        
    }
 
   public function getUserList($userName,$location,$status)
      {
       
       
        $where ="";
        
        if($location!="All")
            $where .= " WHERE Location LIKE '" . $location ."%'";
        
         if($userName!="All")    
        {
             if($where =="")
                $where .= " WHERE UserName LIKE '" . $userName ."%'";
             else
                $where .= " AND UserName LIKE '" . $userName ."%'";  
      
        }
       
        
        if($status!="All")    
        {
            
            if($status=="Active")
                $status=1;
            else
               $status=0; 
            
             if($where =="")
                $where .= " WHERE Status=" . $status;
             else
                $where .= " AND Status =" . $status;  
      
        }
        
       
        $SQL ="SELECT * FROM user";
        $SQL .=$where;
        
        $resultCount =$this->db->query($SQL); 
        $totalData = $resultCount->num_rows();
        
	$start =0;
	$limit =3;
	
        
        
        if(isset($_GET['start']))
                $start = $_GET['start'];
        if(isset($_GET['limit']))
                $limit =$_GET['limit'];
        
	$SQL = "SELECT * FROM user " ;
        $SQL .=$where;
        $SQL .= " ORDER BY Id DESC LIMIT " . $start . ", " . $limit;
	
	$result=$this->db->query($SQL);
        $data = array();
        
        if ($result->num_rows() > 0)
            $data = $result->result_array();  // returning the records as an array.
         
        $dataReturn = array();
        $dataReturn['total']= $totalData;
        $dataReturn['results']= $data;
        
        return $dataReturn;
     
          
          
      }
      
   
    public function deleteUser($id)
    {
        // getting the user name for action recording
        $SQL ="SELECT UserName FROM user ";
        $SQL .=" WHERE Id =" . $id;
        
        $result =$this->db->query($SQL); 
        $deleteUserName ="";
        if($result->num_rows()>0)
        {
            foreach ($result->result() as $row) 
                 $deleteUserName = $row->UserName;
            
        }
        
        $action = "User Name: " . $deleteUserName. " deleted.";
        $this->recordAdminActions($action);
        
        // deleting user name
        $this->db->where('Id', $id);
        $res = $this->db->delete('user');
        
        
        return $res;
        
    }  
    
   public function saveUser()
   {
        $userName              = strip_slashes(htmlspecialchars($_POST['txtUserName']));
        $location              = strip_slashes(htmlspecialchars($_POST['cmbLocation']));
        $userType              = strip_slashes(htmlspecialchars($_POST['cmbUserType']));
        $password              = strip_slashes(htmlspecialchars(encriptPassword($_POST['txtPassword'])));
        
	$status                = strip_slashes(htmlspecialchars($_POST['rdoStatus']));
        $ID                    = (int)$_POST['hidIDField'];
        
        
        //------------------------- saving location in the user_location table if does not exist ----
        
        
        $SQL = "SELECT * FROM user_location ";
        $SQL .= " WHERE UCASE(Location)='" . strtoupper($location) . "'"; 
        
        $resultCount =$this->db->query($SQL); 
        if($resultCount->num_rows()==0)
        {
             $locationData= array (
                 'Location' => $location
             );
            $this->db->insert('user_location',$locationData);
        }
        
      
        if($ID==0)
            { 
                $insertData= array (
                'UserName' => $userName,
                'Location' => $location,  
                'Password' => $password,
                'UserType' => $userType,
                'Status' => $status,
                'CreatedBy' => $_SESSION['ADMIN_ID']    
                );
                
              $this->db->insert('user',$insertData);
              
              $action = "New User : " . $userName . " Created.";
              $this->recordAdminActions($action);
              
              
            }
       else if($ID>0)
            {
                $insertData= array (
                'UserName' => $userName,
                'Location' => $location,    
                'Status' => $status,
                'UserType' => $userType,
                'ModifiedBy' => $_SESSION['ADMIN_ID'],
                'ModifiedOn' =>date("Y-m-d H:i:s")    
                );
               $this->db->where('Id', $ID);
               $this->db->update('`user`', $insertData);
              
            }
  
             $action = "Chaged User : " . $userName . " details.";
             $this->recordAdminActions($action);
             
             return "true";
        
        
   }  
 
 public function getUserLocation()
       {
        $SQL = "SELECT Id, Location FROM user_location " ;
        $SQL .= " WHERE status=1";
    
	$result=$this->db->query($SQL);
        $data = array();
        
        if ($result->num_rows() > 0)
            $data = $result->result_array();  // returning the records as an array.
         
        $dataReturn = array();
        $dataReturn['success']= "true";
        $dataReturn['location']= $data;
        
        return $dataReturn;
           
       }
   
    public function updateUserStatus($id,$status)
    {
        $insertData= array (
                'Status' => $status,
                'ModifiedBy' => $_SESSION['ADMIN_ID'],
                'ModifiedOn' =>date("Y-m-d H:i:s")    
                );
        
               $this->db->where('Id', $id);
               $res= $this->db->update('user', $insertData);
              
        
    }
    
    
    public function  getEditUserData($editId)
    {
         
        $SQL = "SELECT Id,UserName,Location, UserType, Status FROM `user`";
        $SQL .= " WHERE Id = " . $editId;
        
        $records = $this->db->query($SQL);  
                   
        if($records->num_rows()>0)
            {
            foreach ($records->result() as $row)
                    {
                        $data[] =$row;
                    }
                    return $data;
            }
        
    }
	 public function saveProduct()
     {
        $productName              = strip_slashes(htmlspecialchars($_POST['txtUserName']));
        $productPrice             = strip_slashes(htmlspecialchars($_POST['cmbLocation']));
        $description            = strip_slashes(htmlspecialchars($_POST['cmbUserType']));
        $cookedBy             = strip_slashes(htmlspecialchars(encriptPassword($_POST['txtPassword'])));
        
		$status                = strip_slashes(htmlspecialchars($_POST['rdoStatus']));
        $ID                    = (int)$_POST['hidIDField'];
        
        
        //------------------------- saving location in the user_location table if does not exist ----
        
        
       /*$SQL = "SELECT * FROM user_location ";
        $SQL .= " WHERE UCASE(Location)='" . strtoupper($location) . "'"; 
        
        $resultCount =$this->db->query($SQL); 
        if($resultCount->num_rows()==0)
        {
             $locationData= array (
                 'Location' => $location
             );
            $this->db->insert('user_location',$locationData);
        }
        */
      
        if($ID==0)
            { 
                $insertData= array (
                'product_name' => $productName,
                'product_price' => $productPrice,  
                'description' => $description,
                'cookedby' => $cookedBy,
                'Status' => $status,
                'CreatedBy' => $_SESSION['ADMIN_ID']    
                );
                
              $this->db->insert('product',$insertData);
              
              $action = "New User : " . $userName . " Created.";
              $this->recordAdminActions($action);
              
              
            }
       else if($ID>0)
            {
                $insertData= array (
               'product_name' => $productName,
                'product_price' => $productPrice,  
                'description' => $description,
                'cookedby' => $cookedBy,
                'Status' => $status,
                'ModifiedBy' => $_SESSION['ADMIN_ID'],
                'ModifiedOn' =>date("Y-m-d H:i:s")    
                );
               $this->db->where('Id', $ID);
               $this->db->update('`product`', $insertData);
              
            }
  
            // $action = "Chaged User : " . $userName . " details.";
             $this->recordAdminActions($action);
             
             return "true";
        
        
   }
    public function deleteProduct($id)
    {
        // getting the product name for action recording
        $SQL ="SELECT product_name FROM product ";
        $SQL .=" WHERE Id =" . $id;
        
        $result =$this->db->query($SQL); 
        $deleteProductName ="";
        if($result->num_rows()>0)
        {
            foreach ($result->result() as $row) 
                 $deleteProductName = $row->product_name;
            
        }
        
        $action = "Product: " . $deleteProductName. " deleted.";
        $this->recordAdminActions($action);
        
        // deleting user name
        $this->db->where('Id', $id);
        $res = $this->db->delete('product');
        
        
        return $res;
        
    }    
    public function updateProductStatus($id,$status)
    {
        $insertData= array (
                'Status' => $status,
                'ModifiedBy' => $_SESSION['ADMIN_ID'],
                'ModifiedOn' =>date("Y-m-d H:i:s")    
                );
        
               $this->db->where('Id', $id);
               $res= $this->db->update('product', $insertData);
              
        
    }
 
	
 }// class ending