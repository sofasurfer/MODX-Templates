<?php
/**
 * @package modx
 * @subpackage dashboard
 */
/**
 * @package modx
 * @subpackage dashboard
 */
class modDashboardWidgetLastLogin extends modDashboardWidgetInterface {
    public function render() {
        $timetocheck = (time()-(60*20))+$this->modx->getOption('server_offset_time',null,0);
       
        $c = $this->modx->newQuery('modUser');
        $c->innerJoin('modUserAttributes','UserAttributes');
		$data['total'] = $this->modx->getCount('modUser',$c);

        $c->select($this->modx->getSelectColumns('modUser','modUser'));
        $c->select($this->modx->getSelectColumns('modUserAttributes','UserAttributes','',array('lastlogin')));
        $c->sortby('lastlogin','DESC');
        $c->groupby('user');
        $ausers = $this->modx->getIterator('modUser',$c);

        $users = array();

        /** @var modActiveUser $user */
        $alt = false;
        foreach ($ausers as $user) {
            $userArray = $user->toArray();
            $userArray['lastlogin'] = strftime('%b %d, %Y - %I:%M %p',strtotime($user->get('occurred')));
            $userArray['class'] = $alt ? 'alt' : '';
            $users[] = $this->getFileChunk('dashboard/lastlogin.row.tpl',$userArray);
        }
        
        $output = $this->getFileChunk('dashboard/lastlogin.tpl',array(
            'users' => implode("\n",$users),
            'curtime' => strftime('%I:%M %p',time()+$this->modx->getOption('server_offset_time',null,0)),
        ));
        return $output;
    }
}
return 'modDashboardWidgetWhoIsOnline';
