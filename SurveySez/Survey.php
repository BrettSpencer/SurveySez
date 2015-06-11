<?php
/**
 * MY_Survey.php extends Survey.php provides the main access class for SurveySez project
 * 
 * 
 * 
 * Data access for several of the SurveySez pages are handled via Survey classes 
 * named Survey,Question & Answer, respectively.  These classes model the one to many 
 * relationships between their namesake database tables. 
 *
 * A survey object (an instance of the Survey class) can be created in this manner:
 *
 *<code>
 *$mySurvey = new SurveySez\MY_Survey(1);
 *</code>
 *
 * In which one is the number of a valid Survey in the database. 
 *
 * The forward slash in front of \IDB picks up the global namespace, which is required 
 * now that we're here inside the SurveySez namespace: \\IDB::conn()
 *
 * Version 2 introduces two new classes, the Response and Choice classes, and moderate 
 * changes to the existing classes, Survey, Question & Answer.  The Response class will 
 * inherit from the Survey Class (using the PHP extends syntax) and will be an elaboration 
 * on a theme.  
 *
 * An instance of the Response class will attempt to identify a SurveyID from the srv_responses 
 * database table, and if it exists, will attempt to create all associated Survey, Question & Answer 
 * objects, nearly exactly as the Survey object.
 *
 * @package SurveySez
 * @author William Newman
 * @version 2.1 2015/05/28
 * @link http://newmanix.com/ 
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see Question.php
 * @see Answer.php
 * @see Response.php
 * @see Choice.php
 */
 
 namespace SurveySez;
 
/**
 * Survey Class retrieves data info for an individual Survey
 * 
 * The constructor an instance of the Survey class creates multiple instances of the 
 * Question class and the Answer class to store questions & answers data from the DB.
 *
 * Properties of the Survey class like Title, Description and TotalQuestions provide 
 * summary information upon demand.
 * 
 * A survey object (an instance of the Survey class) can be created in this manner:
 *
 *<code>
 *$mySurvey = new Survey(1);
 *</code>
 *
 * In which one is the number of a valid Survey in the database. 
 *
 * The showQuestions() method of the Survey object created will access an array of question 
 * objects and internally access a method of the Question class named showAnswers() which will 
 * access an array of Answer objects to produce the visible data.
 *
 * @see Question
 * @see Answer 
 * @todo none
 */
 
class MY_Survey extends Survey
{
	 public function __construct($myID)
     {
         parent::__construct($myID);
     }
}# end Survey class
