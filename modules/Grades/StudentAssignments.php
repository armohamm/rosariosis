<?php
/**
 * Student Assignments
 *
 * Consult & submit assignments
 *
 * @since 2.9
 *
 * @package RosarioSIS
 * @subpackage modules/Grades
 */

// Include Student Assignments functions.
require_once 'modules/Grades/includes/StudentAssignments.fnc.php';

DrawHeader( ProgramTitle() );

if ( isset( $_REQUEST['assignment_id'] )
	&& $_REQUEST['assignment_id'] )
{
	if ( $_REQUEST['modfunc'] === 'submit' )
	{
		$submitted = StudentAssignmentSubmit( $_REQUEST['assignment_id'], $error );

		if ( $submitted )
		{
			$note[] = _( 'Assignment submitted.' );

			echo ErrorMessage( $note, 'note' );
		}
		
		echo ErrorMessage( $error );
	}

	$assignments_link = PreparePHP_SELF( $_REQUEST, array( 'search_modfunc', 'assignment_id' ) );

	DrawHeader( '<a href="' . $assignments_link . '">' . _( 'Back to Assignments' ) . '</a>' );

	$_ROSARIO['allow_edit'] = true;

	$form_action = PreparePHP_SELF( $_REQUEST, array(), array( 'modfunc' => 'submit' ) );

	echo '<form method="POST" action="">';

	StudentAssignmentSubmissionOutput( $_REQUEST['assignment_id'] );

	echo '</form>';

	exit;
}

// Output Current Quarter's Assignments List.
StudentAssignmentsListOutput();