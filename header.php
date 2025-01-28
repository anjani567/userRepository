<!-- last added -->
<header class="header">
   <div class="flex">

      <!-- Search form replacing logo and aligning to the left -->
      <div class="search-section">
         <form action="items.php" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Search for products..." required>
            <button type="submit" class="search-btn">Search</button>
         </form>

         <!-- Category buttons -->
         <!--<div class="category-buttons">
            <a href="items.php?category=all" class="category-btn">All</a>
            <a href="items.php?category=women" class="category-btn">Women</a>
            <a href="items.php?category=men" class="category-btn">Men</a>
            <a href="items.php?category=child" class="category-btn">Child</a>
         </div>-->
      </div>
      <div class="nav-section">
         <nav class="navbar">
            <a href="herbal.php">add products</a>
            <a href="items.php">view products</a>
         </nav>

         <?php
         $select_rows = mysqli_query($conn, "SELECT * FROM orders") or die('query failed');
         $row_count = mysqli_num_rows($select_rows);
         ?>

         <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span></a>

         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

   </div>
</header>




