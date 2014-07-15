<?php 

namespace Uvweb\UvBundle\Services\CommentManager;

class CommentDataHelper
{
	public function __construct()
    {

    }

	/**
	 * Generate last possible semesters for a comment
	 */
	public function getLastSemesters()
	{
        //Array of semesters
        $semesters = array();
        $currentMonth = date('m');
        $currentSemester = 'A';

        if($currentMonth > 2 && $currentMonth < 9) //Spring semester: March to end of August
            $currentSemester = 'P';

        $year = date('Y') % 100; //Starting with current year

        if($currentSemester == 'A' && $currentMonth < 3) // If beginning of 2014: current semester is A13, not A14
            $year = ($year -1 + 100) % 100;

        for($i = 0; $i < 5; $i++)
        {
            if($currentSemester == 'A')
            {
                if($i % 2 == 0 && !empty($semesters)) //2 Semesters were added (we make sure not to do $year-- if array is still empty)
                    $year = ($year -1 + 100) % 100;

                if($i % 2 == 0)
                    $semesters['A' . $year] = 'A' . $year;
                else
                    $semesters['P' . $year] = 'P' . $year;
            }
            else
            {
                if($i % 2 == 1 && !empty($semesters)) //2 Semesters were added, but starting on spring
                    $year = ($year -1 + 100) % 100;

                if($i % 2 == 1)
                    $semesters['A' . $year] = 'A' . $year;
                else
                    $semesters['P' . $year] = 'P' . $year;
            }
        }

        return $semesters;
	}
}

?>