<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>

<!--

Old way to display ranking.
Now not used.

-->


<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
<meta name="description" content="description"/>
<meta name="keywords" content="keywords"/> 
<meta name="author" content="author"/> 
<link rel="stylesheet" type="text/css" href="default.css" media="screen"/>
<title>Codechef Ranking System</title>
</head>

<body>
<?php include_once "connect.php"; ?>
<div class="top">
				
	<div class="header">

		<div class="left">
			Codechef Rankings
		</div>
		
		<div class="right">
		<?php	include "files/top-right.php"; ?>

		</div>

	</div>	

</div>

<div class="container">	
<?php include "files/nav.php";?>


	<div class="main">		
		
		<div class="content">
<?php
$arr=array();
$k=1;
$names=mysql_query("SELECT name from oct13ques ORDER BY id");
while($row=mysql_fetch_array($names))
{
$arr[$k]=$row['name'];
$k++;
}
?>
			<h2>Submission of this month's Long Contest</h2><br />
			  <h4><a href="add.php">(To add new student codechef username go to Add menu)</a></h4><br />
			   <?php
 $result = mysql_query("SELECT * FROM `update`");
$row = mysql_fetch_array($result);
echo "<b>Last updated : ".$row['time']."</b><br/><br/>";
				if($value==0)
				{
				include "files/select-on-page.php";
				}
				else
				{
	        $sno=1;
      $result = mysql_query("SELECT detail.handle,detail.name,oct13.ques1,oct13.ques2,oct13.ques3,oct13.ques4,
oct13.ques5,oct13.ques6,oct13.ques7,oct13.ques8,oct13.ques9,oct13.ques10 
FROM detail,oct13 WHERE detail.college=".$value." AND detail.handle=SUBSTR(oct13.handle,6) 
ORDER BY oct13.rank");
      echo "<table>
      <tr>
      <th>Sno.</th>
      <th>Username</th>
	  <th>Name</th>
      <th>Problems Solved</th>
      <th>Total</th>
      </tr>";
      while($row = mysql_fetch_array($result))
        {
        $url="http://www.codechef.com/users/";
        echo "<tr>";
        echo "<td>" . $sno++. "</td>";
          echo "<td><a href='".$url . $row['handle'] ."' target=_blank>".$row['handle'] . "</a></td>";       
        echo "<td>".$row['name']."</td>";
		echo "<td>";
$all="";
$k=0;
for($i=1;$i<=10;$i++)
{
if($row['ques'.$i]==1)
{
$all=$all.$arr[$i].", ";
$k++;
}
}
echo $all;
 echo "</td>";
        echo "<td>" . $k . "</td>";
        echo "</tr>";
        }
      echo "</table>";
    echo "<h2>Other members (Inactive in this contest)</h2><br />";
      $sno=1;
      $result = mysql_query("SELECT handle FROM detail WHERE detail.college=".$value." AND detail.handle NOT IN (SELECT handle FROM oct13) ORDER BY handle");
      while($row = mysql_fetch_array($result))
        {
        echo $sno++. ". <a style='text-decoration:none;' href='".$url . $row['handle'] ."' target=_blank>".$row['handle']."</a><br>";
        }
			  }
			 ?>
		</div>

		<div class="sidenav">
			<?php include "files/sidenav.php";?>
		</div>

		<div class="clearer"><span></span></div>

	</div>

	<div class="footer">&copy; 2013 <a href="http://www.shivamkhandelwal.in/" target="_blank">Shivam Khandelwal</a> | Designed and Developed by Shivam Khandelwal
	</div>

</div>

</body>

</html>