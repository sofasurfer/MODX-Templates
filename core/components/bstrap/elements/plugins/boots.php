<?php
/**
 * @var modX $modx
 * @var array $scriptProperties
 */
switch ($modx->event->name) {

    case 'OnBeforeManagerLogin':
        break;
        
    case 'OnManagerLogin':
    
        //$modx->logManagerAction('user_manager_login','modUser',$user->get('id'));
        break;

    case 'OnBeforeWebLogin':
        break;
        
    case 'OnWebLogin':
    
        //$modx->logManagerAction('user_web_login','modUser',$user->get('id'));
        break;

}
return;
