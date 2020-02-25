<?php

    class bakersFunctions{

        private $conn;


        function __construct()
        {
            require_once 'includes/DbConfig.php';
                $database = new DbConfig();
                $this->conn = $database->dbConnect();
        }

          //login as baker
          public function login_as_baker($username,$password){

            $sql = "SELECT * FROM bakers_account WHERE username = ? AND password = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($username,$password));
            $result = $stmt->fetch();
            return $result;
        }

                //add products
        public function add_products($branch_id,$product_name,$beginning,$from_branch,$num_of_kilos,
                $quantity,$total,$unsold_goods,$price,$pullout,$sales,$date){

            $sql = "INSERT INTO products(branch_id,product_name,beginning,from_branch,num_of_kilos,
            quantity,total,unsold_goods,price,pullout,sales,date)VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$product_name,$beginning,$from_branch,$num_of_kilos,
            $quantity,$total,$unsold_goods,$price,$pullout,$sales,$date));
            $result = $stmt->fetch();
            return $result;

        }

        

        ///////////////////////Product Management///////////////////////////////////////

        //get all products
        public function getAllProducts($branch_id,$start,$limit){

            $sql = "SELECT * FROM products WHERE branch_id = $branch_id  ORDER BY product_name LIMIT  $start, $limit ";
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

        //get branch name
        public function getBranchName($branch_id){

            $sql = "SELECT * FROM branch WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id));
            $result = $stmt->fetch();
            return $result;
        }


        //get single product
        public function getSingleProduct($id){

            $sql = "SELECT * FROM products WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch();
            return $result;
        }
       

        //edit products
        public function edit_products($id,$product_name,$beginning,$from_branch,$num_of_kilos,
                $quantity,$total,$unsold_goods,$price,$pullout,$sales,$date){

            $sql = "UPDATE  products SET product_name = ?, beginning = ?, from_branch = ?,num_of_kilos = ?,
            quantity = ?,total = ?,unsold_goods = ?, price = ?, pullout = ?, sales = ?,date = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($product_name,$beginning,$from_branch,$num_of_kilos,
            $quantity,$total,$unsold_goods,$price,$pullout,$sales,$date,$id));
            $result = $stmt->fetch();
            return $result;

        }
       
        //delete
        public function delete_single_product($id){

            $sql = "DELETE FROM products WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch();
            return $result;
        }

        //Generate Report
        public function bakerGenerateReport($branch_id,$startDate){

            $sql = "SELECT * FROM products WHERE branch_id = ? AND date =? ORDER BY product_name ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$startDate));
            $result = $stmt->fetchAll();
            return $result;
        }

        //compute total sales
        public function compute_total_sales($branch_id,$startDate){

           
            $sql = "SELECT sum(sales) FROM products WHERE branch_id = ? AND date =? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$startDate));

			for($i=0; $rows = $stmt->fetch(); $i++){
			echo $rows['sum(sales)'];
			}
        }

        //display expenses
        public function displayExpenses($branch_id){

            $sql = "SELECT * FROM expenses WHERE branch_id = ? ORDER BY created_at DESC ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id));
            $result = $stmt->fetchAll();
            return $result;
        }

        //report status
        public function check_report_status($branch_id,$startDate){

            $sql = "SELECT * FROM report WHERE branch_id = ? AND date = ? AND  status = 'done' ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$startDate));
            $result = $stmt->fetch();
            return $result;
        }

        public function status($branch_id, $startDate){

            $sql = "SELECT * FROM report WHERE branch_id = ? AND date =?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id, $startDate));
            $result = $stmt->fetch();
            return $result;
        }

            //add reports
        public function add_reports($branch_id,$product_name,$beginning,$from_branch,$num_of_kilos,
            $quantity,$total,$unsold_goods,$price,$pullout,$sales,$date){

                $status = "done";
                $seen = "no";

                $sql = "INSERT INTO report(branch_id,product_name,beginning,from_branch,num_of_kilos,
                quantity,total,unsold_goods,price,pullout,sales,date,status,seen)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array($branch_id,$product_name,$beginning,$from_branch,$num_of_kilos,
                $quantity,$total,$unsold_goods,$price,$pullout,$sales,$date,$status,$seen));
                $result = $stmt->fetch();
                return $result;

        }

         //add reports
         public function check_reportsIfExists($branch_id,$product_name,$beginning,$from_branch,$num_of_kilos,
         $quantity,$total,$unsold_goods,$price,$pullout,$sales,$date){

             $status = "done";
             $seen = "no";

             $sql = "SELECT * FROM report WHERE branch_id = ? AND product_name = ? AND beginning = ? AND from_branch = ? AND num_of_kilos = ? AND
             quantity = ? AND total = ? AND unsold_goods = ? AND  price = ? AND pullout = ? AND sales =? AND date = ? AND status = ? AND seen = ?";
             $stmt = $this->conn->prepare($sql);
             $stmt->execute(array($branch_id,$product_name,$beginning,$from_branch,$num_of_kilos,
             $quantity,$total,$unsold_goods,$price,$pullout,$sales,$date,$status,$seen));
             $result = $stmt->fetch();
             return $result;

     }
     
     //insert cash on hand
     public function insert_actual_cash($branch_id,$amount,$date){
         
         $sql = "INSERT INTO actual_cash(branch_id,amount,date)VALUES(?,?,?)";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute(array($branch_id,$amount,$date));
         $result = $stmt->fetch();
         return $result;
     }
      //check cash on hand
     public function check_insert_actual_cash($branch_id,$amount,$date){
         
         $sql = "SELECT * FROM actual_cash WHERE branch_id = ? AND amount = ? AND date = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute(array($branch_id,$amount,$date));
         $result = $stmt->fetch();
         return $result;
     }
     
       //update cash on hand
     public function update_insert_actual_cash($branch_id,$date,$amount){
         
         $sql = "UPDATE actual_cash SET amount = ? WHERE branch_id = ? AND date = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute(array($amount,$branch_id,$date));
         $result = $stmt->fetch();
         return $result;
     }

        //insert expenses
        public function insertBakerExpenses($branch_id,$name,$amount,$created_at){

            $sql = "INSERT INTO expenses(branch_id,name,amount,created_at)VALUES(?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$name,$amount,$created_at));
            $result = $stmt->fetch();
            return $result;

        }

        //get single expense
        public function getSingleExpense($branch_id,$id){

            $sql = "SELECT * FROM expenses WHERE branch_id = ? AND id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$id));
            $result = $stmt->fetch();
            return $result;
        }

        //check if exists
        public function checkExpensesIfAlreadyExists($branch_id,$name,$amount,$created_at){

            $sql = "SELECT * FROM expenses WHERE  branch_id = ? AND name = ? AND amount = ? AND created_at = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$name,$amount,$created_at));
            $result = $stmt->fetch();
            return $result;
        }

        //edit if exists
        public function editExpenses($id,$name,$amount,$created_at){

            $sql = "UPDATE expenses SET name = ?, amount =?, created_at = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($name,$amount,$created_at,$id));
            $result = $stmt->fetch();
            return $result;
        }

        //delete expenses
        public function deleteExpenses($id){

            $sql = "DELETE FROM expenses WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id));
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

        //insert expenses
        public function insertBakerCashAdvance($branch_id,$name,$amount,$created_at){

            $sql = "INSERT INTO cash_advance(branch_id,name,amount,created_at)VALUES(?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$name,$amount,$created_at));
            $result = $stmt->fetch();
            return $result;

        }

        //check if exists
        public function checkCashAdavnceIfAlreadyExists($branch_id,$name,$amount,$created_at){

            $sql = "SELECT * FROM cash_advance WHERE  branch_id = ? AND name = ? AND amount = ? AND created_at = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$name,$amount,$created_at));
            $result = $stmt->fetch();
            return $result;
        }

        //get single cash
        public function getSingleCashAdvance($branch_id,$id){

            $sql = "SELECT * FROM cash_advance WHERE branch_id = ? AND id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$id));
            $result = $stmt->fetch();
            return $result;
        }

        //edit if exists
        public function editCA($id,$name,$amount,$created_at){

            $sql = "UPDATE cash_advance SET name = ?, amount =?, created_at = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($name,$amount,$created_at,$id));
            $result = $stmt->fetch();
            return $result;
        }

         //delete C.A
         public function deleteCA($id){

            $sql = "DELETE FROM cash_advance WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch();
            return $result;
        }

         //compute total expenses
         public function compute_total_expenses($branch_id,$startDate){

           
            $sql = "SELECT sum(amount) FROM expenses WHERE branch_id = ? AND created_at =? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$startDate));

			for($i=0; $rows = $stmt->fetch(); $i++){
			echo $rows['sum(amount)'];
			}
        }

        //compute total cash advance
        public function compute_total_CA($branch_id,$startDate){

           
            $sql = "SELECT sum(amount) FROM cash_advance WHERE branch_id = ? AND created_at =? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($branch_id,$startDate));

			for($i=0; $rows = $stmt->fetch(); $i++){
			echo $rows['sum(amount)'];
			}
        }
        
         //fetch cat
        public function fetchCategory(){

            $sql = "SELECT * FROM category ORDER BY category_name";
           $stmt = $this->conn->prepare($sql);
           $stmt->execute(array());
           $result = $stmt->fetchAll();

               $output = "";
               foreach($result as $row){
                   $output .= '<option value="'.$row["id"].'">'.$row["category_name"].' ₱ '.$row["price"];'</option>';
               }
               return $output;
           return $result;
       }

       //get price
       public function get_price($product_id){

         $sql = "SELECT * FROM category WHERE id = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute(array($product_id));
         $result = $stmt->fetch();
         return $result;
       }
       
       //my cash
       public function getMyCash($branch_id){
           
           $sql = "SELECT * FROM actual_cash WHERE branch_id = ? ORDER BY date DESC";
           $stmt = $this->conn->prepare($sql);
           $stmt->execute(array($branch_id));
            $result = $stmt->fetchAll();
             return $result;
       }
       
       //get single my cash
       public function singleMyCash($branch_id,$id){
           
           $sql = "SELECT * FROM actual_cash WHERE branch_id = ? AND id = ?";
           $stmt = $this->conn->prepare($sql);
         $stmt->execute(array($branch_id,$id));
         $result = $stmt->fetch();
         return $result;
       }
       
       //edit my cash
       public function editMyCash($id,$amount){
           
            $sql = "UPDATE actual_cash SET amount =? WHERE id =?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($amount,$id));
            $result = $stmt->fetch();
            return $result;
         
       }

       
       //search production
        function searchNow($keyword,$branch_id){

            $sql = "SELECT * FROM products WHERE date LIKE ? AND branch_id = ? ORDER BY product_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($keyword,$branch_id));
            $search_result = $stmt->fetchAll();
            return $search_result;
        }
    }
?>