<?php
/* calculates relative time ago from a timestamp */
    if (empty($input)) return "Invalid date [$input]";
    if (empty($modx->lexicon)) $modx->getService('lexicon','modLexicon');
    $modx->lexicon->load('filters');

    $agoTS = array();
    $uts['start'] = strtotime($input);
    $uts['end'] = time();
    if( $uts['start']!==-1 && $uts['end']!==-1 ) {
      if( $uts['end'] >= $uts['start'] ) {
        $diff = $uts['end'] - $uts['start'];

        $years = intval((floor($diff/31536000)));
        if ($years) $diff = $diff % 31536000;

        $months = intval((floor($diff/2628000)));
        if ($months) $diff = $diff % 2628000;

        $weeks = intval((floor($diff/604800)));
        if ($weeks) $diff = $diff % 604800;

        $days = intval((floor($diff/86400)));
        if ($days) $diff = $diff % 86400;

        $hours = intval((floor($diff/3600)));
        if ($hours) $diff = $diff % 3600;

        $minutes = intval((floor($diff/60)));
        if ($minutes) $diff = $diff % 60;

        $diff = intval($diff);
        $agoTS = array(
          'years' => $years,
          'months' => $months,
          'weeks' => $weeks,
          'days' => $days,
          'hours' => $hours,
          'minutes' => $minutes,
          'seconds' => $diff,
        );
      }
    }

    $ago = array();
    if (!empty($agoTS['years'])) {
      $ago[] = $modx->lexicon(($agoTS['years'] > 1 ? 'ago_years' : 'ago_year'),array('time' => $agoTS['years']));
    }
    if (!empty($agoTS['months'])) {
      $ago[] = $modx->lexicon(($agoTS['months'] > 1 ? 'ago_months' : 'ago_month'),array('time' => $agoTS['months']));
    }
    if (!empty($agoTS['weeks']) && empty($agoTS['years'])) {
      $ago[] = $modx->lexicon(($agoTS['weeks'] > 1 ? 'ago_weeks' : 'ago_week'),array('time' => $agoTS['weeks']));
    }
    if (!empty($agoTS['days']) && empty($agoTS['months']) && empty($agoTS['years'])) {
      $ago[] = $modx->lexicon(($agoTS['days'] > 1 ? 'ago_days' : 'ago_day'),array('time' => $agoTS['days']));
    }
    if (!empty($agoTS['hours']) && empty($agoTS['weeks']) && empty($agoTS['months']) && empty($agoTS['years'])) {
      $ago[] = $modx->lexicon(($agoTS['hours'] > 1 ? 'ago_hours' : 'ago_hour'),array('time' => $agoTS['hours']));
    }
    if (!empty($agoTS['minutes']) && empty($agoTS['days']) && empty($agoTS['weeks']) && empty($agoTS['months']) && empty($agoTS['years'])) {
      $ago[] = $modx->lexicon('ago_minutes',array('time' => $agoTS['minutes']));
    }
    if (empty($ago)) { /* handle <1 min */
      $ago[] = $modx->lexicon('ago_seconds',array('time' => !empty($agoTS['seconds']) ? $agoTS['seconds'] : 0));
    }
    $output = implode(', ',$ago);
    $output = $modx->lexicon('ago',array('time' => $output));
    return $output;