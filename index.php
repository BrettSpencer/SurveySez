<?php
/**
 * demo_list_pager.php along with demo_view_pager.php provides a sample web application
 *
 * The difference between demo_list.php and demo_list_pager.php is the reference to the 
 * Pager class which processes a mysqli SQL statement and spans records across multiple  
 * pages. 
 *
 * The associated view page, demo_view_pager.php is virtually identical to demo_view.php. 
 * The only difference is the pager version links to the list pager version to create a 
 * separate application from the original list/view. 
 * 
 * @package nmPager
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see demo_view_pager.php
 * @see Pager.php 
 * @todo none
 */

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 
 
# SQL statement
$sql = 
"
select CONCAT(a.FirstName, ' ', a.LastName) AdminName, s.SurveyID, s.Title, s.Description, 
date_format(s.DateAdded, '%W %D %M %Y %H:%i') 'DateAdded' from "
. PREFIX . "surveys s, " . PREFIX . "Admin a where s.AdminID=a.AdminID order by s.DateAdded desc
";

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'Surveys made with love & PHP in Seattle';


# END CONFIG AREA ---------------------------------------------------------- 

get_header(); #defaults to theme header or header_inc.php
?>
<h3 align="center"><?=smartTitle();?></h3>

<p>This page, along with <b>demo_view_pager.php</b>, demonstrate a List/View web application.</p>
<p>It was built on the mysql shared web application page, <b>demo_shared.php</b></p>
<p>This page is the entry point of the application, meaning this page gets a link on your web site.  Since the current subject is muffins, we could name the link something clever like <a href="<?php echo VIRTUAL_PATH; ?>demo_list_pager.php">Surveys</a></p>
<p>Use <b>demo_list_pager.php</b> and <b>demo_view_pager.php</b> as a starting point for building your own List/View web application!</p> 
<?php
#reference images for pager
$prev = '<img src="' . VIRTUAL_PATH . 'images/arrow_prev.gif" border="0" />';
$next = '<img src="' . VIRTUAL_PATH . 'images/arrow_next.gif" border="0" />';

# Create instance of new 'pager' class
$myPager = new Pager(10,'',$prev,$next,'');
$sql = $myPager->loadSQL($sql);  #load SQL, add offset

# connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

if(mysqli_num_rows($result) > 0)
{#records exist - process
	if($myPager->showTotal()==1){$itemz = "survey";}else{$itemz = "surveys";}  //deal with plural
    echo '<div align="center">We have ' . $myPager->showTotal() . ' ' . $itemz . '!</div>';
	while($row = mysqli_fetch_assoc($result))
	{# process each row
         echo '<div align="center"><a href="' . VIRTUAL_PATH . 'surveys/survey_view.php?id=' . (int)$row['SurveyID'] . '">' . dbOut($row['Title']) . '</a>';
         echo '</div>';
	}
	echo $myPager->showNAV(); # show paging nav, only if enough records	 
}else{#no records
    echo "<div align=center>There are currently no surveys.</div>";	
}
@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php
?>