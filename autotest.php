<!doctype html>
<html lang="en">
<?php
  include "head.php";
?>
<body class="no-sidebar">
  
<!-- Header -->
<header id="header">
<?php
  include "navigation.php";
?>
</header>

<section id="cta">      
  <div>
    <h2>Need to change <strong>something</strong>?</h2>
    <p>Add new or update existing entries.</p>
  </div>
  <div>
    <ul class="buttons">
      <li>
        <form method=post>
          <input type="hidden" name="add_TicketButton" value="True"></input>
          <input type="submit" value="Add Entry"/>
        </form>
      </li>
      <li>
        <form method=post>
          <input type="hidden" name="edit_TicketButton" value="True"></input>
          <input type="submit" value="Edit Entry"/>
        </form>
      </li>    
    </ul>
  </div>
  </br>



<div class='inner'>
  <h3 align='center'>New Ticket</h3>
  <form method=post id='addTicket'>
    <p><label for='add_name'>Student Name</label>
    <input  id='addname'class='smallbox' required name='add_name' data-autocomplete='true'>
    <input id="blue" class='smallbox'>
    <div id='toutput'></div></p>
    <p><label for='add_iPad#'>iPad #</label>
    <input  class='smallbox' type='number' pattern='[0-9]*' min='0' maxlength='3' required name='add_iPad#' value=''></p>
    <p><label for='add_StudentStatus'>Student Status</label>
    <select name='add_StudentStatus'>
      <option value='Good'>Good</option>
      <option value='Owes Fine'>Owes Fine</option>
      <option value='Red Cased'>Red Cased</option>
    </select></p>
    <p><label for='add_iPadStatus'>iPad Status</label>
    <select name='add_iPadStatus'>
      <option value='Distributed' >Distributed</option>
      <option value='Distributed'>Cart</option>
      <option disabled>──────────</option>
      <option value='Damaged'>Damaged</option>
      <option value='Good to Go'>Good to Go</option>
      <option disabled>──────────</option>
      <option value='Lost/Stolen'>Lost/Stolen</option>
    </select></p>
    <p><label for='add_Description'>Description</label>
    <textarea  name='add_Description' form='addTicket' placeholder='Enter description here'></textarea></p>
    <p align='center'><input type='submit' value='Add Entry'/></p>
  </form>
  <form method='post'>
    <input type='hidden' name='Cancel' value='Cancel'/>
    <p align='center'><input type='submit'  value='Cancel'/></p>
  </form>
</div>
 </section>
<!-- Main -->
<article id="main">
  <header class="special container">
    <span class="icon fa-book"></span>
    <h2>MTA  <strong>IT Work Log</strong></h2>
    <p>Check status of iPad.</p>
  </header>
        
  <!-- One -->
  <section class="wrapper style6 container">
        
    <!-- Content -->
    <div class="content">
    <section>
      <!-- All Students In iPad Office -->
      <caption>All Open Tickets</caption>
        <div class="blocky">
          <table>
        <thead>
          <tr>
            <th>T#</th> 
            <th>Ipad #</th> 
            <th>Student</th> 
            <th>Status</th>
            <th>Description</th> 
          </tr>
        </thead>
        </table>
        <div class="scrolls"><table>
        <tbody>
          <?php
            require_once "pdo.php";
          $sql = "SELECT l.*, s.`Student Status`, s.`First Name`, s.`Last Name`  FROM log AS l INNER JOIN `students14_15` AS s ON l.tStatus='Open' AND s.`Student ID`=l.`Student ID`";
          $stmt = $pdo->query($sql);
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
            echo '<tr><td>';
            echo $row['Ticket #'];
            echo '</td><td>';
            echo $row['iPad #'];
            echo '</td><td>';
            echo $row['First Name'].' '.substr($row['Last Name'], 0,1).'.';
            echo '</td><td>';
            echo $row['Student Status'];
            echo '</td><td>';
            echo $row['Comments'];
            echo '</td></tr>';
          }             
        ?>
        </tbody>
      </table>
      </div></div>
      <p></p>

      <!-- Needs Work -->
      <caption><i class="fa fa-exclamation-circle" style="color:red" ></i>  Needs Work</caption>
                      <div class="blocky">
                        <table>
        <thead>
          <tr>
            <th>T#</th> 
            <th>Ipad #</th> 
            <th>Student</th> 
            <th>Status</th>
            <th>Description</th> 
          </tr>
        </thead>
        </table>
        <div class="scrolls"><table>
        <tbody>
          <?php
            require_once "pdo.php";
          $sql = "SELECT l.`Ticket #`, i.`iPad #`, s.`First Name`, s.`Last Name`,s.`Student Status`,l.`Comments` FROM log AS l INNER JOIN iPads AS i INNER JOIN `students14_15` AS s ON l.tStatus='Open'AND i.Status='Damaged' AND i.`iPad #`=l.`iPad #` AND s.`Student ID`=l.`Student ID`";
          $stmt = $pdo->query($sql);
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
            echo '<tr><td>';
            echo $row['Ticket #'];
            echo '</td><td>';
            echo $row['iPad #'];
            echo '</td><td>';
            echo $row['First Name'].' '.substr($row['Last Name'], 0,1).'.';
            echo '</td><td>';
            echo $row['Student Status'];
            echo '</td><td>';
            echo $row['Comments'];
            echo '</td></tr>';
          }             
        ?>
        </tbody>
      </table>
      </div></div>
      <p></p>
      <!-- Good to Go -->
      <caption><i class="fa fa-check-circle" style="color:green"></i> Good to Go</caption>
                      <div class="blocky">
                        <table>
        <thead>
          <tr>
            <th>T#</th> 
            <th>Ipad #</th> 
            <th>Student</th> 
            <th>Status</th>
            <th>Description</th> 
          </tr>
        </thead>
        </table>
        <div class="scrolls"><table>
        <tbody>
          <?php
          require_once "pdo.php";
        $sql = "SELECT l.`Ticket #`, i.`iPad #`, s.`First Name`, s.`Last Name`,s.`Student Status`,l.`Comments` FROM log AS l INNER JOIN iPads AS i INNER JOIN `students14_15` AS s ON l.tStatus='Open'AND i.Status='Good to Go' AND i.`iPad #`=l.`iPad #` AND s.`Student ID`=l.`Student ID` AND s.`Student Status`='Good'";
        $stmt = $pdo->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
          echo '<tr><td>';
          echo $row['Ticket #'];
          echo '</td><td>';
          echo $row['iPad #'];
          echo '</td><td>';
          echo $row['First Name'].' '.substr($row['Last Name'], 0,1).'.';
          echo '</td><td>';
          echo $row['Student Status'];
          echo '</td><td>';
          echo $row['Comments'];
          echo '</td></tr>';
        }             
        ?>
        </tbody>
      </table>
      </div></div>
      <p></p>
      <!-- All History -->
      <caption>All Work History</caption>
      <div class="blocky">
    
        <table>
          <thead>
          <tr>
            <th>Date</th>
            <th>T#</th> 
            <th>Ipad #</th> 
            <th>Student</th> 
            <th>Condition</th>
            <th>Description</th> 
            </tr>
          </thead>
        </table>
        <div class="scrolls2">
            <table>
            <tbody>
              <?php
              require_once "pdo.php";
            $sql = "SELECT l.*, s.`First Name`, s.`Last Name` FROM `log`as l INNER JOIN `students14_15`as s WHERE l.`Student ID`=s.`Student ID` ORDER BY `num` DESC";
            $stmt = $pdo->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
              echo '<tr><td>';
              echo date_format(date_create($row['Date']), 'M jS');
              echo '</td><td>';
              echo $row['Ticket #'];
              echo '</td><td>';
              echo $row['iPad #'];
              echo '</td><td>';
              echo $row['First Name'].' '.substr($row['Last Name'], 0,1).'.';
              echo '</td><td>';
              echo $row['Status'];
              echo '</td><td>';
              echo $row['Comments'];
              echo '</td></tr>';
            }             
            ?>
            </tbody>
          </table>
        </div>
      </div></div>

    </section>
  </section>
</article>

</body>
</html>