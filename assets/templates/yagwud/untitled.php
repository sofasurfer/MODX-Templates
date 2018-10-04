<?php
/* don't execute if in the Manager */
if ($modx->context->get('key') == 'mgr') {
    return;
}

switch ($_SERVER['HTTP_HOST']) {

    case 'www.studeyeah.com:80':
    case 'www.studeyeah.com':
        // if the http_host is of a specific domain, switch the context
        $modx->switchContext('studeyeah');
        break;

    case 'www.mistermilano.it:80':
    case 'www.mistermilano.it':
        // if the http_host is of a specific domain, switch the context
        $modx->switchContext('mistermilano');
        break;

    case 'www.hervethiot.com:80':
    case 'www.hervethiot.com':
        // if the http_host is of a specific domain, switch the context
        $modx->switchContext('hervethiot');
        break;

    case 'www.kindisch.ch:80':
    case 'www.kindisch.ch':
        // if the http_host is of a specific domain, switch the context
        $modx->switchContext('kindisch');
        break;

    case 'www.henrystrongbox.com:80':
    case 'www.henrystrongbox.com':
        // if the http_host is of a specific domain, switch the context
        $modx->switchContext('henrystrongbox');
        break;

    case 'www.putsmarie.com:80':
    case 'www.putsmarie.com':
        // if the http_host is of a specific domain, switch the context
        $modx->switchContext('putsmarie');
        break;

    case 'www.multikulti-naehcafe.ch:80':
    case 'www.multikulti-naehcafe.ch':
        // if the http_host is of a specific domain, switch the context
        $modx->switchContext('multikulti');
        break;

    case 'www.yagwud.com:80':
    case 'www.yagwud.com':
        // if the http_host is of a specific domain, switch the context
        $modx->switchContext('yagwud');
        break;

    default:
        // by default, don't do anything
        break;
}