<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; 
   charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="author" content="">
   <title>Book Template</title>

   
   <!-- Google fonts used in this theme  -->
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>  

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <!-- Bootstrap core CSS -->
   <link href="../bootstrap3_bookTheme/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap theme CSS -->
   <link href="../bootstrap3_bookTheme/theme.css" rel="stylesheet">
</head>

<body>

<?php include 'book-header.inc.php'; ?>
   
<div class="container">
   <div class="row">  <!-- start main content row -->

      <div class="col-md-2">  <!-- start left navigation rail column -->
         <?php include 'book-left-nav.inc.php'; ?>
      </div>  <!-- end left navigation rail --> 

      <div class="col-md-10">  <!-- start main content column -->
        
         <!-- Customer panel  -->
         <div class="panel panel-danger spaceabove">           
           <div class="panel-heading"><h4>My Customers</h4></div>
           <table class="table">
             <tr>
               <th>Name</th>
               <th>Email</th>
               <th>University</th>
               <th>City</th>
             </tr>

			<?php
				$txt_file    = file_get_contents('../data/customers.txt');
				$rows        = explode("\n", $txt_file);

				for ($i = 0; $i < count($rows) - 1; $i ++)
				{
					$row_data = explode(',', $rows[$i]);
					print "
						<tr>
							<td>
								<a href='book.php?customerid=$row_data[0]'> $row_data[1] $row_data[2] </a>
							</td>
							<td>$row_data[3]</td>
							<td>$row_data[4]</td>
							<td>$row_data[6]</td>
						</tr>
					";
				}
			?>
			 
           </table>
         </div>           
               

		<?php
		
		if ( !empty($_GET['customerid']) )
		{
			$customers_file = file_get_contents('../data/customers.txt');
			$orders_file = file_get_contents('../data/orders.txt');
			
			$customers_rows = explode("\n", $customers_file);
			$orders_rows = explode("\n", $orders_file);
			
			$CUSTOMER_ORDER_EXISTS = false;
			for ($i = 0; $i < count($orders_rows) - 1; $i ++)
			{
				$row_entries = explode(',', $orders_rows[$i]);

				if ( $_GET['customerid'] == $row_entries[1] ) {
					$CUSTOMER_ORDER_EXISTS = true;
					break;
				}
				
			}
			
			$CUSTOMER_NAME = " ";
			for ($i = 0; $i < count($customers_rows); $i ++)
			{
				$row_entries = explode(',', $customers_rows[$i]);
				
				if ( $_GET['customerid'] == $row_entries[0] ) {
					$CUSTOMER_NAME = $row_entries[1];
					$CUSTOMER_NAME .= " ";
					$CUSTOMER_NAME .= $row_entries[2];
				}
			}
			
			if ( $CUSTOMER_ORDER_EXISTS )
			{	
				print	"<!-- Orders for -->
						<div class='panel panel-danger spaceabove'>           
						<div class='panel-heading'><h4>Orders for $CUSTOMER_NAME</h4></div>
						<table class='table'>
							<tr>
								<th></th>
								<th>ISBN</th>
								<th>Title</th>
								<th>Category</th>
							</tr>";
				
				for ($i = 0; $i < count($orders_rows) - 1; $i ++)
				{

					$row_entries = explode(',', $orders_rows[$i]);

					if ( $_GET['customerid'] == $row_entries[1] ) {
						print	"
								<tr>
									<td> <img src='../images/book/tinysquare/$row_entries[2].jpg' alt='Book Image'> </td>
									<td>$row_entries[2]</td>
									<td><a href='#'>$row_entries[3]</a></td>
									<td>$row_entries[4]</td>
								</tr>
								";
					}
			
				}
				
				print	"</table>
						</div>";
				
			}
			else
			{
				print	"
						<div class = 'well'>No orders for that customer.</div>
						";
			}
			
		} 
		
		?>
			   
      </div>


      </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end container -->
</body>
</html>