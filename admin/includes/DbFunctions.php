<?php
  

    class DbFunctions{

        
        private $conn;

        

        function __construct()
        {
            require_once 'DbConfig.php';
            $database = new DbConfig();
            $this->conn = $database->dbConnect();
        }

       
        //User login
        public function user_login_as_master($username, $password){

            $password = md5($password);
            $sql = "SELECT * FROM user WHERE username = ? AND password = ? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($username,$password));
            $result = $stmt->fetch();
            return $result;
        }

        //Register as Master User
        public function user_registration($lastname,$firstname,$middlename,$username,$password){
            
            $password = md5($password);

            $sql = "INSERT INTO user(lastname,firstname,middlename,username,password)VALUES(?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($lastname,$firstname,$middlename,$username,$password));
            $result = $stmt->fetch();
            return $result;

        }

        //check admin username
        public function chekcAdminUserName($username){

            $sql = "SELECT * FROM user WHERE username = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($username));
            $result = $stmt->fetch();
            return $result;
        }

        //display my accounts
        public function displayMyaccounts(){

            $sql = "SELECT * FROM user ORDER BY lastname";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->fetchAll();
            return $result;
        }

        //get single account
        public function getSingleAdminAccounts($id){

            $sql = "SELECT * FROM user WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch();
            return $result;
        }

        //delete single account
        public function deleteSingleAdminAccount($id){

            $sql = "DELETE FROM user WHERE id  = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch();
            return $result;
        }

        //update admin account
        public function updateAdminAccount($id,$lastname,$firstname,$middlename,$username,$password){
            
            $password = md5($password);

            $sql = "UPDATE user SET lastname = ?, firstname = ?, middlename = ?, username = ?, 
                password = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($lastname,$firstname,$middlename,$username,$password,$id));
            $result = $stmt->fetch();
            return $result;

        }

    
        //get total products
        public function get_total_products(){

            $sql = "SELECT * FROM products";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->rowCount();
            return $result;
        }

       //Total number stocks    
        public function count_total_number_of_stocks()
        {
            $sql = "SELECT sum(quantity) FROM products";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->fetchAll();

            foreach($result as $rows){
                echo $rows["sum(quantity)"];
            }
        }
        
        //Compute total Cost Price
        public function total_cost_price()
        {
            $sql = "SELECT sum(product_price) FROM product";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->fetchAll();
            foreach($result as $rows){
                echo $rows["sum(product_price)"];
            }

        }

        //get single product 
        public function get_single_product($rowID){

            $sql = "SELECT * FROM product INNER JOIN product_pricing ON product_pricing.id = product.product_id WHERE product_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($rowID));
            $result = $stmt->fetch();
            return $result;
        }
       
        //update quantity
        public function update_quantity($rowID, $quantity){

            $sql = "UPDATE product SET quantity WHERE product_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($quantity,$rowID));
            $result = $stmt->fetch();
            return $result;
        }


        //Branch Management
        public function get_all_branch($start,$limit){

            $sql = "SELECT * FROM branch LIMIT $start,$limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($start,$limit));
            $result = $stmt->fetchAll();
            return $result;
        }

         //get all products under
         public function get_all_products_in_branch($id,$limit){

           
            $sql = "SELECT product.*
            , product_pricing.*
                FROM product
                JOIN product_pricing 
                    ON product.product_id = product_pricing.id
                    WHERE product.branch_id = $id LIMIT $limit";
           
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->fetchAll();
            return $result;

            
        }

        //count products ny branch
        public function count_products_in_branch($id){

            $sql = "SELECT count(branch_id) AS id FROM product WHERE branch_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetchAll();
            $total = $result[0]['id'];
            return $total;
            return $result;

        }

        //get single branch name
        public function get_branch_name($id){

            $sql = "SELECT * FROM branch WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch();
            return $result;
        }

        //Create branch
        public function create_branch($branch_name, $address){

            $sql = "INSERT INTO branch(branch_name,address)VALUES(?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_name,$address));
            $result = $stmt->fetch();
            return $result;
        }

        //get single branch
        public function get_single_branch($rowID){

            $sql = "SELECT * FROM branch WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($rowID));
            $result = $stmt->fetch();
            return $result;
        }

        //branch delete
        public function delete_branch($rowID){

            $sql = "DELETE FROM branch WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($rowID));
            $result = $stmt->fetch();
            return $result;
        }

        //update branch
        public function update_branch_info($rowID,$branch_name,$address){

            $sql = "UPDATE branch SET branch_name = ?, address = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_name,$address,$rowID));
            $result = $stmt->fetch();
            return $result;
        }

        //check if branch is exists
        public function check_branch_if_exists($branch_name){

            $sql = "SELECT * FROM branch WHERE branch_name = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_name));
            $result = $stmt->fetch();
            return $result;

        }

        //User Management
        public function fetch_branch_to_user_registration(){

            $sql = "SELECT * FROM branch";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->fetchAll();

                $output = "";
                foreach($result as $row){
                    $output .= '<option value="'.$row["id"].'">'.$row["branch_name"]. ' ' .$row["address"].'</option>';
                }
                return $output;
            return $result;
        }

        //create user
        public function create_bakers_account($branch_id, $lastname,$firstname,$middlename,$fullname,$username,$password){

            $sql = "INSERT INTO bakers_account(branch_id, lastname, firstname, middlename, fullname, 
            username, password)VALUES(?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$lastname,$firstname,$middlename,$fullname,$username,$password));
            $result = $stmt->fetch();
            return $result;
        }

        //check username if exists
        public function check_bakers_username_if_exists($username){

            $sql = "SELECT * FROM bakers_account WHERE username = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($username));
            $result = $stmt->fetch();
            return $result;
        }

        //get all bakers account
        public function get_all_bakers_account($start,$limit){

            $sql = "SELECT * FROM bakers_account INNER JOIN branch ON branch.id = bakers_account.branch_id LIMIT $start, $limit";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($start,$limit));
            $result = $stmt->fetchAll();
            return $result;
        }

        //get single bakers account
        public function get_single_bakers_account($rowID){

            $sql = "SELECT * FROM bakers_account WHERE branch_id = ?";
          //  $sql = "SELECT * FROM bakers_account INNER JOIN branch ON branch.id = bakers_account.branch_id WHERE branch_id = ?";
               
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($rowID));
            $result = $stmt->fetch();
            return $result;
        }

        //update bakers account
        public function update_bakers_account_info($rowID,$branch_id,$lastname,$firstname,$middlename,$username,$password){

            $sql = "UPDATE bakers_account SET branch_id = ?, lastname = ?, firstname = ?, middlename = ?, username = ?, password = ? WHERE branch_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$lastname,$firstname,$middlename,$username,$password,$rowID));
            $result = $stmt->fetch();
            return $result;
        }

        //delete bakers account
        public function delete_bakers_account($rowID){

            $sql = "DELETE FROM bakers_account WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($rowID));
            $result = $stmt->fetch();
            return $result;
        }

        //get branch details
        public function get_branch_details_by_user($branch_id){

            $sql = "SELECT * FROM branch WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id));
            $result = $stmt->fetch();
            return $result; 
        }


        ///////////////////////Product Management///////////////////////////////////////

        //get all products
        public function getAllProducts($branch_id,$start,$limit){

            $sql = "SELECT * FROM products WHERE branch_id = $branch_id ORDER BY product_name ASC LIMIT  $start, $limit ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($start,$limit));
            $result = $stmt->fetchAll();
            return $result;
        }

        //get total
        public function getTotalProducts(){

            $sql = "SELECT count(id) AS id FROM products";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->fetchAll();
            $total = $result[0]['id'];
            return $total;
            return $result;

        }

        //add products
        public function add_products($product_name,$begining,$from_branch,$num_of_kilos,
                        $quantity,$total,$unsold_goods,$pullout,$price,$sales,$date){

            $sql = "INSERT INTO products(product_name,beginning,from_branch,num_of_kilos,
            quantity,total,unsold_goods,pullout,price,sales,date)VALUES(?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($product_name,$begining,$from_branch,$num_of_kilos,
            $quantity,$total,$unsold_goods,$pullout,$price,$sales,$date));
            $result = $stmt->fetch();
            return $result;

        }

         
        ///generate report
        public function generate_report($startDate,$endDate){
            
           
	        $sql = "SELECT * FROM products WHERE date >= '$startDate' AND date <= '$endDate'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->fetchAll();
            return $result;
        }


         //display expenses
         public function displayExpenses($branch_id){

            $sql = "SELECT * FROM expenses WHERE branch_id = ? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id));
            $result = $stmt->fetchAll();
            return $result;
        }

         //display name
         public function getNameOfBranch($branch_id){

            $sql = "SELECT * FROM branch WHERE id = ? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id));
            $result = $stmt->fetch();
            return $result;
        }

         //display expenses
         public function displayCahsAdvance($branch_id){

            $sql = "SELECT * FROM cash_advance WHERE branch_id = ? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id));
            $result = $stmt->fetchAll();
            return $result;
        }

        //get notifications
        //get all notification
      public function get_all_unread_notification(){

      
          $sql = "SELECT * FROM report WHERE seen = 'no' ORDER BY date";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute(array());
          $result = $stmt->fetchAll();
          return $result;
        }

         //Generate Report
         public function GenerateReport($branch_id,$startDate){

            $sql = "SELECT * FROM report WHERE branch_id = ? AND date =? ORDER BY product_name ASC ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$startDate));
            $result = $stmt->fetchAll();
            return $result;
        }

           //compute total sales
           public function compute_total_sales($branch_id,$startDate){

           
            $sql = "SELECT sum(sales) FROM report WHERE branch_id = ? AND date =? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$startDate));
            $result = $stmt->fetch();
            $total = $result["sum(sales)"];
            return $total;
            return $result;

        }

         //compute total expenses
         public function compute_total_expenses($branch_id,$startDate){

           
            $sql = "SELECT sum(amount) FROM expenses WHERE branch_id = ? AND created_at =? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$startDate));
            $result = $stmt->fetch();
            $total = $result["sum(amount)"];
            return $total;
            return $result;
		}
		
		//actual cash
		public function actual_cash($branch_id,$date){
		    
		    $sql = "SELECT * FROM actual_cash WHERE branch_id = ? AND date =? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$date));
            $result = $stmt->fetch();
            return $result;
		}

        //compute total cash advance
        public function compute_total_CA($branch_id,$startDate){

           
            $sql = "SELECT sum(amount) FROM cash_advance WHERE branch_id = ? AND created_at =? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$startDate));
            $result = $stmt->fetch();
            $total = $result["sum(amount)"];
            return $total;
            return $result;
        }
        
        //display category
        public function display_category(){
        
            $sql = "SELECT * FROM category ORDER BY category_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->fetchAll();
            return $result;
            
        }
        
        //add category
        public function add_category($category_name,$price){
            
            $sql = "INSERT INTO category(category_name,price)VALUES(?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($category_name,$price));
            $result = $stmt->fetch();
            return $result;
        }
        
        //get single category
        public function get_single_category($id){
            
            $sql = "SELECT * FROM category WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch();
            return $result;
        }
        
        //edit category
        public function edit_category($id,$category_name,$price){
            
            $sql = "UPDATE category SET category_name = ?, price = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($category_name,$price,$id));
            $result = $stmt->fetch();
            return $result;
            
        }
        
        //delete category
        public function delete_category($id){
            
            $sql = "DELETE FROM category WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch();
            return $result;
        }
        
         //generate cash advance
        public function generateCashAdvance($from,$to,$branch_id){

            //$sql = "SELECT * FROM cash_advance WHERE branch_id = ? AND created_at = ? AND created_at = ?";
            $sql = "SELECT * FROM cash_advance WHERE created_at >= '$from' AND created_at <= '$to' AND branch_id = $branch_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->fetchAll();
            return $result;

        }
        
          //delete category
        public function delete_report($id){
            
            $sql = "DELETE FROM report WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch();
            return $result;
        }
      
    }
    






















   
?>